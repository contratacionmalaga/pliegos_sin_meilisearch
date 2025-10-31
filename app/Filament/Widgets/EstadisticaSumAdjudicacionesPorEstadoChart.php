<?php

namespace App\Filament\Widgets;

use App\Enums\Placsp\PLACSP_ContractFolderStatusCode;
use App\Models\PLACSP\Adjudicacion;
use App\Models\PLACSP\ContratoMayor;
use App\Services\EstadisticasService;
use Filament\Widgets\ChartWidget;
use Filament\Support\Colors\Color;

class EstadisticaSumAdjudicacionesPorEstadoChart extends \App\Filament\Widgets\BaseChartWidget
{
    protected static ?string $chartId = 'EstadisticaSumAdjudicacionesPorEstadoChar';

//    protected ?string $heading = 'Importe total de adjudicaciones por estado del contrato';
    protected ?string $heading = 'Importe total por estado del contrato';

    protected static ?int $sort = 15;

//    protected int|array|null $columns = 3;
    protected string|int|array $columnSpan = 3;


//    protected ?string $maxHeight = '200px';


    protected function getType(): string
    {
        return 'pie';
    }


    protected function getData(): array
    {
        return $this->buildSumDataset(
            \App\Models\PLACSP\Adjudicacion::class,
            'contract_folder_status_code',
            fn(string $c) => \App\Enums\Placsp\PLACSP_ContractFolderStatusCode::tryFrom($c)?->getLabel() ?? $c,
            'Total Adjudicaciones'
        );
    }

    protected function getDataOld(): array
    {


        // Base query
        $queryTotales = Adjudicacion::query();

        $service = new EstadisticasService();

        $estadisticas = $service->getEstadisticasSumPorCampo($queryTotales,'contract_folder_status_code');

        // Construir arrays paralelos: labels legibles y totales
        $labels = [];
        $totales = [];
        $backgroundColors = [];
        $borderColors = [];

        foreach ($estadisticas as $codigo => $total) {
            $enum = PLACSP_ContractFolderStatusCode::tryFrom((string) $codigo);
            $labels[] = $enum ? $enum->getTinyLabel() : (string) $codigo;
            $totales[] = (int) $total;
            $backgroundColors[] = $enum ? $enum->getColorHex() : '#ef4444';
            $borderColors[] = $enum ? $enum->getColorHex() : '#ef4444';
//            $backgroundColors[] = $enum ? 'rgba(54, 162, 135, 0.7)' : 'rgba(54, 162, 235, 0.7)';
        }

        // Ordenar labels ascendentemente, manteniendo correspondencia con totales y colores
        if (! empty($labels)) {
            array_multisort($labels, SORT_ASC, SORT_NATURAL | SORT_FLAG_CASE, $totales);
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => "Total Expedientes",
                    'data' => $totales,
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => $borderColors,
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
}
