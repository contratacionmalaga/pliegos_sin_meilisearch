<?php

namespace App\Services;

use App\Models\PLACSP\Adjudicacion;
use App\Models\PLACSP\ContratoMayor;
use Exception;
use JsonException;

class EstadisticasPliegos1Service
{
    /**
     * @throws JsonException
     * @throws Exception
     */
    public function getArrayEstadisticas(): array
    {

        $cacheKey = 'estadisticas:dashboard:pliegos-1';

        return cache()->remember($cacheKey, now()->addMinutes(10), function () {
            $queryTramitados = ContratoMayor::query();
            $queryAdjudicados = Adjudicacion::query();

            $nTramitados = $queryTramitados->clone()->count();
            $importeTramitados = $queryTramitados->clone()->sum('estimated_overall_contract_amount');

            $nAdjudicados = $queryAdjudicados->count();
            $importeAdjudicados = $queryAdjudicados->sum('total_amount');

            return [
                'tramitados' => [
                    'count' => $nTramitados,
                    'importe' => $importeTramitados,
                ],
                'adjudicados' => [
                    'count' => $nAdjudicados,
                    'importe' => $importeAdjudicados,
                ],
            ];
        });
    }
}
