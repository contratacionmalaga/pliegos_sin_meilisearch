<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Filament\Support\RawJs;

abstract class BaseChartWidget extends ChartWidget
{

    protected ?string $maxHeight = '250px';

    protected function buildCountDataset($modelClass, string $field, ?callable $labelResolver = null, string $datasetLabel = 'Total'): array
    {
        $query = $modelClass::query();
        return app(\App\Services\ChartDataBuilder::class)->buildByField($query, $field, 'count', $labelResolver, $datasetLabel);
    }

    protected function buildSumDataset($modelClass, string $field, ?callable $labelResolver = null, string $datasetLabel = 'Importe total'): array
    {
        $query = $modelClass::query();
        return app(\App\Services\ChartDataBuilder::class)->buildByField($query, $field, 'sum', $labelResolver, $datasetLabel);
    }

    /**
     * Opciones comunes para gráficos de tipo pie.
     */
    protected function getOptions(): array
    {
        if ($this->getType() !== 'pie') {
            return [];
        }

        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'right',
                    'labels' => [
                        'boxWidth' => 3,
                        'padding' => 3,
                        'font' => [
                            'size' => 10,
                        ],
                    ],
                ],
                'tooltip' => [
                    'enabled' => true,
                ],
                // 'datalabels' => [
                //     'display' => true,
                //     'color' => '#fff',
                //     'font' => [
                //         'weight' => 'bold',
                //         'size' => 12,
                //     ],
                //     // Porcentaje sobre el total del dataset 0 (pie)
                //     // 'formatter' => RawJs::make('(value, ctx) => {\n  const data = ctx.chart.data.datasets[0].data;\n  const total = data.reduce((a, b) => a + b, 0);\n  const pct = total ? (value / total) * 100 : 0;\n  return `${pct.toFixed(1)}%`;\n}'),
                //     'formatter' => RawJs::make('(value) => `${value}%`'),
                // ],
            ],
        ];
    }
}
