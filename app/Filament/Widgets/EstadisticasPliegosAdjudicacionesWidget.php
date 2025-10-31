<?php

namespace App\Filament\Widgets;

use App\Services\EstadisticasPliegos1Service;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use JsonException;

class EstadisticasPliegosAdjudicacionesWidget extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected ?string $pollingInterval = null;

    protected static ?int $sort = 10;

//    protected int|array|null $columns = 2;
    protected string|int|array $columnSpan = 12;

//    protected ?string $heading = 'Expedientes de Contratación';

    /**
     * @throws JsonException
     */
    protected function getStats(): array
    {

        $estadisticas = new EstadisticasPliegos1Service()->getArrayEstadisticas();

        return [
//            Stat::make(
//                'Nº de expedientes tramitados / Importe',
//                number_format($estadisticas['tramitados']['count'], 0, ',', '.').' / '.
//                number_format($estadisticas['tramitados']['importe'], 2, ',', '.').'€'
//            ),
            Stat::make(
                'Nº de adjudicaciones / Importe',
                number_format($estadisticas['adjudicados']['count'], 0, ',', '.').' / '.
                number_format($estadisticas['adjudicados']['importe'], 2, ',', '.').'€'
            ),
        ];
    }
}
