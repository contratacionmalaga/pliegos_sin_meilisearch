<?php

namespace App\Filament\Widgets;

use App\Enums\Placsp\PLACSP_ContractFolderStatusCode;
use App\Models\PLACSP\Adjudicacion;
use App\Services\EstadisticasService;
use Filament\Widgets\ChartWidget;

class EstadisticaCountAdjudicacionesPorEstadoChart  extends \App\Filament\Widgets\BaseChartWidget
{
    protected static ?string $chartId = 'EstadisticaCountAdjudicacionesPorEstadoChar';

    protected ?string $heading = 'Adjudicaciones por estado del contrato';

    protected static ?int $sort = 11;

//    protected int|array|null $columns = 3;
    protected string|int|array $columnSpan = 3;


//    protected ?string $maxHeight = '200px';


    protected function getType(): string
    {
        return 'pie';
    }

    protected function getData(): array
    {
        return $this->buildCountDataset(
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

        $estadisticas = $service->getEstadisticasCountPorCampo($queryTotales,'contract_folder_status_code');

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
//                    'backgroundColor' => 'rgba(54, 162, 235, 0.7)',
//                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => $borderColors,
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
}
