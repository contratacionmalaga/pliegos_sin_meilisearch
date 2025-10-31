<?php

namespace App\Services;

use App\Models\PLACSP\CondicionEspecialEjecucion;
use App\Models\PLACSP\Cpv;
use App\Models\PLACSP\CriterioAdjudicacion;
use App\Models\PLACSP\RequisitoPrevioParticipacion;
use Exception;
use JsonException;

class EstadisticasPliegos2Service
{
    /**
     * @throws JsonException
     * @throws Exception
     */
    public function getArrayEstadisticas(): array
    {

        $cacheKey = 'estadisticas:dashboard:pliegos-2';

        return cache()->remember($cacheKey, now()->addMinutes(10), function () {

            $queryCondicionesEspecialesEjecucion = CondicionEspecialEjecucion::query();
            $queryCriteriosAdjudicacion = CriterioAdjudicacion::query();
            $queryRequisitosPreviosParticipacion = RequisitoPrevioParticipacion::query();
            $queryCpvs = Cpv::query();

            $nCondicionesEspecialesEjecucion = $queryCondicionesEspecialesEjecucion->count();
            $nCriteriosAdjudicacion = $queryCriteriosAdjudicacion->count();
            $nRequisitosPreviosParticipacion = $queryRequisitosPreviosParticipacion->count();
            $nCpvs = $queryCpvs->count();

            return [
                'condiciones_especiales_ejecucion' => [
                    'count' => $nCondicionesEspecialesEjecucion,
                ],
                'criterios_adjudicacion' => [
                    'count' => $nCriteriosAdjudicacion,
                ],
                'requisitos_previos_participacion' => [
                    'count' => $nRequisitosPreviosParticipacion,
                ],
                'cpvs' => [
                    'count' => $nCpvs,
                ],
            ];

        });
    }
}
