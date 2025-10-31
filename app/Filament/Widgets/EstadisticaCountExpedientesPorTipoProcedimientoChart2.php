<?php

namespace App\Filament\Widgets;

// use App\Enums\Placsp\PLACSP_ContractFolderStatusCode;
// use App\Models\PLACSP\ContratoMayor;
// use App\Services\EstadisticasService;
// use Filament\Widgets\ChartWidget;
// use Filament\Support\Colors\Color;

class EstadisticaCountExpedientesPorTipoProcedimientoChart2 extends EstadisticaCountExpedientesPorTipoProcedimientoChart
{
    protected static ?string $chartId = 'EstadisticaCountExpedientesPorTipoProcedimientoChart2';
    protected ?string $heading = 'Nº Expedientes por Tipo Procedimiento (copia)';

    protected static ?int $sort = 0;
    protected string|int|array $columnSpan = 3;
   protected ?string $maxHeight = '400px';
}
