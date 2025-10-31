<?php

namespace App\Services;

use App\Enums\Flags\BooleanEnum;
use App\Enums\Placsp\TipoSindicacion;
use App\Models\ImportacionPlacsp\Adjudicacion;
use Carbon\Carbon;

class EstadisticasEntidadService
{
    protected ?string $nifEntidad = '';

    public function setNifEntidad(string $nif): self
    {
        $this->nifEntidad = $nif;

        return $this;
    }

    public function getEstadisticasDetalladas(): array
    {
        $annios = [
            now()->year,
            now()->subYear()->year,
        ];

        $resultados = [];

        foreach ($annios as $annio) {

            $inicio = Carbon::createFromDate($annio)->startOfYear();
            $fin = Carbon::createFromDate($annio)->endOfYear();

            // Base query
            $queryTotales = Adjudicacion::query()
                ->where('tipo_sindicacion', TipoSindicacion::MAY)
                ->where('nif_entidad', $this->nifEntidad)
                ->whereBetween('award_date', [$inicio, $fin]);

            $queryPymes = Adjudicacion::query()
                ->where('tipo_sindicacion', TipoSindicacion::MAY)
                ->where('sme_awarded_indicator', BooleanEnum::TRUE)
                ->where('nif_entidad', $this->nifEntidad)
                ->whereBetween('award_date', [$inicio, $fin]);

            // Obtener datos generales
            $totalCount = $queryTotales->count();
            $totalImporte = $queryTotales->sum('total_amount');

            $pymesCount = $queryPymes->count();
            $pymesImporte = $queryPymes->sum('total_amount');

            $resultados[$annio]['global'] = [
                'total' => [
                    'count' => $totalCount,
                    'importe' => $totalImporte,
                ],
                'pymes' => [
                    'count' => $pymesCount,
                    'importe' => $pymesImporte,
                ],
                'porcentaje' => [
                    'count' => $totalCount > 0 ? round(($pymesCount / $totalCount) * 100, 2) : 0,
                    'importe' => $totalImporte > 0 ? round(($pymesImporte / $totalImporte) * 100, 2) : 0,
                ],
            ];

            // Obtener datos agrupados por type_code y procedure_code
            $resultados[$annio]['por_type_code'] = $this->getEstadisticasPorCampo($queryTotales, $queryPymes, 'type_code');
            $resultados[$annio]['por_procedure_code'] = $this->getEstadisticasPorCampo($queryTotales, $queryPymes, 'procedure_code');
        }

        return $resultados;
    }

    protected function getEstadisticasPorCampo($queryTotales, $queryPymes, string $campo): array
    {
        // Clonar los queries para evitar afectarlos
        $totales = (clone $queryTotales)
            ->select($campo, \DB::raw('count(*) as count'), \DB::raw('sum(total_amount) as importe'))
            ->groupBy($campo)
            ->get()
            ->keyBy($campo);

        $pymes = (clone $queryPymes)
            ->select($campo, \DB::raw('count(*) as count'), \DB::raw('sum(total_amount) as importe'))
            ->groupBy($campo)
            ->get()
            ->keyBy($campo);

        $resultados = [];

        $todosLosCodigos = $totales->keys()->merge($pymes->keys())->unique();

        foreach ($todosLosCodigos as $codigo) {
            $total = $totales->get($codigo);
            $pyme = $pymes->get($codigo);

            $totalCount = $total->count ?? 0;
            $totalImporte = $total->importe ?? 0;

            $pymesCount = $pyme->count ?? 0;
            $pymesImporte = $pyme->importe ?? 0;

            // 🔁 Traducir código a etiqueta legible usando el casting del modelo
            $label = $this->getLabelFromEnum(Adjudicacion::class, $campo, $codigo);

            $resultados[$label] = [
                'total' => [
                    'count' => $totalCount,
                    'importe' => $totalImporte,
                ],
                'pymes' => [
                    'count' => $pymesCount,
                    'importe' => $pymesImporte,
                ],
                'porcentaje' => [
                    'count' => $totalCount > 0 ? round(($pymesCount / $totalCount) * 100, 2) : 0,
                    'importe' => $totalImporte > 0 ? round(($pymesImporte / $totalImporte) * 100, 2) : 0,
                ],
            ];
        }

        return $resultados;
    }

    protected function getLabelFromEnum(string $modelClass, string $campo, mixed $valor): string
    {
        $casts = (new $modelClass)->getCasts();

        if (! isset($casts[$campo])) {
            return (string) $valor; // Sin casting, devolver tal cual
        }

        $enumClass = $casts[$campo];

        try {
            return method_exists($enumClass, 'tryFrom') && $enumClass::tryFrom($valor)
                ? $enumClass::tryFrom($valor)->getLabel()
                : (string) $valor;
        } catch (\Throwable $e) {
            return (string) $valor;
        }
    }
}
