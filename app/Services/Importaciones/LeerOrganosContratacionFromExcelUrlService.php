<?php

namespace App\Services\Importaciones;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class LeerOrganosContratacionFromExcelUrlService
{
    /**
     * @throws ConnectionException
     * @throws Exception
     */
    public function leerExcel(string $url): array
    {

        // 1. Descargar el Excel
        $response = Http::get($url);
        if (!$response->successful()) {
            throw new \RuntimeException("No se pudo descargar el archivo desde la URL: $url");
        }

        // 2. Guardar temporalmente
        $tempPath = storage_path('app/temp_organos.xlsx');
        file_put_contents($tempPath, $response->body());

        // 3. Leer el archivo como colección (sin clase de importación)
        $hojas = Excel::toCollection(null, $tempPath);

        // 4. Borrar archivo temporal
        unlink($tempPath);

        // 5. Validar colección y hoja
        if ($hojas->isEmpty()) {
            throw new \RuntimeException("El archivo Excel no contiene hojas válidas.");
        }

        $hoja = $hojas->first();
        if (!$hoja || $hoja->isEmpty()) {
            throw new \RuntimeException("La hoja Excel está vacía.");
        }

        // ⚡ Recuperar la fecha en la celda C2 (fila índice 1, columna índice 2 porque empieza en 0)
        $fechaRaw = $hoja[1][2] ?? null;
        $fecha = null;

        if ($fechaRaw instanceof \DateTimeInterface) {
            $fecha = $fechaRaw->format('Y-m-d');
        } elseif (is_numeric($fechaRaw)) {
            // Excel serial date → convertir
            $fecha = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fechaRaw)->format('Y-m-d');
        } elseif (is_string($fechaRaw)) {
            // Si ya viene como string
            $fecha = $fechaRaw;
        }

        // 6. Saltar cabecera y mapear filas
        $map = $hoja
            ->skip(6)
            ->map(function ($row) {
                return [
                    'id_plataforma' => $row[0] ?? null,
                    'organo_contratacion' => $row[1] ?? null,
                    'ubicacion' => $row[2] ?? null,
                    'dependencia1' => $row[3] ?? null,
                    'dependencia2' => $row[4] ?? null,
                    'nif' => $row[5] ?? null,
                    'dir3' => $row[6] ?? null,
                    'codigo_postal' => $row[7] ?? null,
                    'es_medio_propio' => $row[8] ?? null,
                    'es_activo' => $row[9] ?? null,
                ];
            })
            ->filter(function ($row) {
                return $row['id_plataforma'] !== null
                    && $row['codigo_postal'] >= 29000
                    && $row['codigo_postal'] <= 29999;
            })
            ->keyBy('id_plataforma');

        // 7. Devolver total + data
        return [
            'fecha' => $fecha,
            'total' => $map->count(),
            'data'  => $map,
        ];
    }
}
