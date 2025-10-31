<?php

namespace App\Filament\Widgets;

use App\Enums\Placsp\PLACSP_ContractFolderStatusCode;
use App\Models\PLACSP\ContratoMayor;
use App\Services\EstadisticasService;
use Filament\Widgets\ChartWidget;
use Filament\Support\Colors\Color;

class EstadisticaCountExpedientesPorEstadoChart extends \App\Filament\Widgets\BaseChartWidget
{
    protected static ?string $chartId = 'EstadisticaCountExpedientesPorEstadoChar';

    protected ?string $heading = 'Nº Expedientes por estado del contrato';

    protected static ?int $sort = 2;

//    protected int|array|null $columns = 8;
    protected string|int|array $columnSpan = 3;

//    protected ?string $maxHeight = '200px';


    protected function getType(): string
    {
        return 'pie';
    }

    protected function getData(): array
    {
        return $this->buildCountDataset(
            \App\Models\PLACSP\ContratoMayor::class,
            'contract_folder_status_code',
            fn(string $c) => \App\Enums\Placsp\PLACSP_ContractFolderStatusCode::tryFrom($c)?->getLabel() ?? $c,
            'Total Expedientes'
        );
    }

    protected function getDataOld(): array
    {


        // Base query
        $queryTotales = ContratoMayor::query();

        $service = new EstadisticasService();

        $estadisticas = $service->getEstadisticasCountPorCampo($queryTotales,'contract_folder_status_code');

//         // Construir arrays paralelos: labels legibles y totales
//         $labels = [];
//         $totales = [];
//         $backgroundColors = [];
//         $borderColors = [];

//         foreach ($estadisticas as $codigo => $total) {
//             $enum = PLACSP_ContractFolderStatusCode::tryFrom((string) $codigo);
//             $labels[] = $enum ? $enum->getTinyLabel() : (string) $codigo;
//             $totales[] = (int) $total;
//             $backgroundColors[] = $enum ? $enum->getColorHex() : '#ef4444';
//             $borderColors[] = $enum ? $enum->getColorHex() : '#ef4444';
// //            $backgroundColors[] = $enum ? 'rgba(54, 162, 135, 0.7)' : 'rgba(54, 162, 235, 0.7)';
//         }

//         // Ordenar labels ascendentemente, manteniendo correspondencia con totales y colores
//         if (! empty($labels)) {
//             array_multisort($labels, SORT_ASC, SORT_NATURAL | SORT_FLAG_CASE, $totales);
//         }

        // Paleta global (o define la tuya aquí si no usas config/charts.php)
        $palette = config('charts.palette', [
            '#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd',
            '#8c564b', '#e377c2', '#7f7f7f', '#bcbd22', '#17becf',
        ]);
        $paletteCount = max(count($palette), 1);

        // 1) Construir items base (label, total, clave para mapear)
        $items = [];
        foreach ($estadisticas as $codigo => $total) {
            $enum = PLACSP_ContractFolderStatusCode::tryFrom((string) $codigo);
            $items[] = [
                'codigo' => (string) $codigo,
                'label'  => $enum ? $enum->getTinyLabel() : (string) $codigo,
                'total'  => (int) $total,
            ];
        }

        // 2) Asignar colores por ranking de total (desc), con desempate por label (asc)
        $byTotal = $items;
        usort($byTotal, function ($a, $b) {
            if ($a['total'] === $b['total']) {
                return strnatcasecmp($a['label'], $b['label']);
            }
            return $b['total'] <=> $a['total']; // descendente
        });

        $colorMap = [];
        foreach ($byTotal as $rank => $it) {
            $colorMap[$it['codigo']] = $palette[$rank % $paletteCount];
        }

        // 3) Orden final por label (asc) manteniendo colores y totales
        usort($items, fn($a, $b) => strnatcasecmp($a['label'], $b['label']));

        $labels = [];
        $totales = [];
        $backgroundColors = [];
        $borderColors = [];

        foreach ($items as $it) {
            $labels[] = $it['label'];
            $totales[] = $it['total'];
            $color = $colorMap[$it['codigo']];
            $backgroundColors[] = $color;
            $borderColors[] = $color;
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
