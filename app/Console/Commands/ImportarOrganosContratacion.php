<?php

namespace App\Console\Commands;

use App\Enums\Acciones\AccionesImportarEntry;
use App\Models\OrganoContratacion;
use App\Models\OrganoContratacionHistorico;
use App\Services\Importaciones\LeerOrganosContratacionFromExcelUrlService;
use Illuminate\Console\Command;

class ImportarOrganosContratacion extends Command
{
    protected $signature = 'app:importar-organos-contratacion';
    protected $description = 'Importación de los datos de los órganos de contratación alojados en la Plataforma de Contratación';

    public function handle(): void
    {
        $url = 'https://contrataciondelsectorpublico.gob.es/datosabiertos/OrganosContratacion.xlsx';
        ds($url);

        // Órganos locales no eliminados
        $array_oc_local = OrganoContratacion::query()->get()->keyBy('id_plataforma');
        ds($array_oc_local);

        // Leer Excel
        $servicioLectura = new LeerOrganosContratacionFromExcelUrlService();
        $array_oc_excel = $servicioLectura->leerExcel($url);

        ds($array_oc_excel['fecha']);
        ds($array_oc_excel['total']);
        ds($array_oc_excel['data']);

        $data = $array_oc_excel['data'];
        $procesados = [];

        foreach ($array_oc_local as $key => $oc_local) {
            ds("Organo local -> {$oc_local->organo_contratacion}, id_plataforma -> {$oc_local->id_plataforma}");

            if (!isset($data[$key])) {
                // Eliminar
                $oc_local->deleted_at = now();
                $oc_local->save();

                $this->registrarHistorico($key, AccionesImportarEntry::ELIMINAR, $oc_local);
            } else {
                // Actualizar si hay cambios
                $cambios = $this->detectarCambios($oc_local, $data[$key]);
                if ($cambios) {
                    $valoresAntiguos = $oc_local->only([
                        'organo_contratacion','ubicacion','dependencia1','dependencia2',
                        'nif','dir3','codigo_postal','es_medio_propio','es_activo'
                    ]);

                    $oc_local->fill($data[$key]);
                    $oc_local->save();

                    $this->registrarHistorico(
                        $key,
                        AccionesImportarEntry::ACTUALIZAR,
                        $oc_local,
                        $valoresAntiguos,
                        $cambios
                    );
                }

                $procesados[] = $key;
            }
        }

        // Crear o reactivar
        foreach ($data as $key => $nuevo) {
            if (!in_array($key, $procesados, true)) {
                if ($array_oc_local->has($key)) {
                    // Reactivar
                    $localItem = $array_oc_local[$key];
                    $localItem->fill($nuevo);
                    $localItem->deleted_at = null;
                    $localItem->save();

                    $this->registrarHistorico($key, AccionesImportarEntry::REACTIVAR, $localItem);
                } else {
                    // Crear nuevo
                    $nuevoRegistro = OrganoContratacion::query()->create($nuevo);
                    $this->registrarHistorico($key, AccionesImportarEntry::CREAR, $nuevoRegistro);
                }
            }
        }

        $this->info("Sincronización completada.");
    }

    private function detectarCambios(OrganoContratacion $oc_local, array $nuevo): ?string
    {
        $campos = [
            'organo_contratacion','ubicacion','dependencia1','dependencia2',
            'nif','dir3','codigo_postal','es_medio_propio','es_activo'
        ];

        $cambios = [];
        foreach ($campos as $campo) {
            $valorActual = $oc_local->{$campo};
            $valorNuevo = $nuevo[$campo] ?? null;

            // Convertir enums a string
            $valorActualStr = $valorActual instanceof \BackedEnum ? $valorActual->value : (string) $valorActual;
            $valorNuevoStr = $valorNuevo instanceof \BackedEnum ? $valorNuevo->value : (string) $valorNuevo;

            if ($valorActualStr !== $valorNuevoStr) {
                $cambios[] = "$campo: '$valorActualStr' => '$valorNuevoStr'";
            }
        }

        return $cambios ? implode('; ', $cambios) : null;
    }

    private function registrarHistorico(
        string                $idPlataforma,
        AccionesImportarEntry $accion,
        ?OrganoContratacion   $modelo = null,
        ?array                $oldModelo = null,
        ?string               $observaciones = null
    ): void {
        OrganoContratacionHistorico::query()->create([
            'id_plataforma' => $idPlataforma,
            'accion' => $accion,
            'datos' => [
                'attributes' => $modelo ? $modelo->only([
                    'organo_contratacion','ubicacion','dependencia1','dependencia2',
                    'nif','dir3','codigo_postal','es_medio_propio','es_activo',
                    'created_at','updated_at','deleted_at'
                ]) : [],
                'old' => $oldModelo ?? [],
            ],
            'observaciones' => $observaciones,
        ]);
    }
}
