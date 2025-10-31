<?php

namespace App\Filament\Widgets;

use App\Services\EstadisticasPliegos2Service;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use JsonException;

class EstadisticasPliegosRestoWidget extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected ?string $pollingInterval = null;

    protected static ?int $sort = 19;

//    protected int|array|null $columns = 4;
    protected string|int|array $columnSpan = 12;

//    protected ?string $heading = '';

    /**
     * @throws JsonException
     */
    protected function getStats(): array
    {

        $estadisticas = new EstadisticasPliegos2Service()->getArrayEstadisticas();

        return [
            Stat::make(
                'Nº de Condiciones Especiales de Ejecución',
                number_format($estadisticas['condiciones_especiales_ejecucion']['count'], 0, ',', '.')
            ),
            Stat::make(
                'Nº de Criterios de Adjudicación',
                number_format($estadisticas['criterios_adjudicacion']['count'], 0, ',', '.')
            ),
            Stat::make(
                'Nº de Requisitos Previos DE Participación',
                number_format($estadisticas['requisitos_previos_participacion']['count'], 0, ',', '.')
            ),
            Stat::make(
                'Nº de CPVs',
                number_format($estadisticas['cpvs']['count'], 0, ',', '.')
            ),

        ];
    }
}
