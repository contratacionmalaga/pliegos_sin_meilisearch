<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class ChartDataBuilder
{
    public function __construct(private readonly EstadisticasService $estadisticasService) {}

    /**
     * @param Builder $baseQuery
     * @param string $field
     * @param 'count'|'sum' $aggregator
     * @param callable|null $labelResolver fn(string $codigo): string
     * @param string $datasetLabel
     */
    public function buildByField(
        Builder $baseQuery,
        string $field,
        string $aggregator = 'count',
        ?callable $labelResolver = null,
        string $datasetLabel = 'Total'
    ): array {
        $estadisticas = match ($aggregator) {
            'count' => $this->estadisticasService->getEstadisticasCountPorCampo($baseQuery, $field),
            'sum'   => $this->estadisticasService->getEstadisticasSumPorCampo($baseQuery, $field),
            default => throw new \InvalidArgumentException('Aggregator inválido'),
        };

//        $palette = config('charts.palette_airbus', [
        $palette = config('charts.palette_Susie_Myerson', [
            '#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd',
            '#8c564b', '#e377c2', '#7f7f7f', '#bcbd22', '#17becf',
        ]);
        $paletteCount = max(count($palette), 1);

        // Items base
        $items = [];
        foreach ($estadisticas as $codigo => $total) {
            $label = $labelResolver ? $labelResolver((string) $codigo) : (string) $codigo;
            $items[] = [
                'codigo' => (string) $codigo,
                'label'  => $label,
                'total'  => (int) $total,
            ];
        }

        // Ranking por total (desc) con desempate por label
        $byTotal = $items;
        usort($byTotal, function ($a, $b) {
            if ($a['total'] === $b['total']) {
                return strnatcasecmp($a['label'], $b['label']);
            }
            return $b['total'] <=> $a['total'];
        });

        $colorMap = [];
        foreach ($byTotal as $rank => $it) {
            $colorMap[$it['codigo']] = $palette[$rank % $paletteCount];
        }

        // Orden final por label (asc)
        usort($items, fn($a, $b) => strnatcasecmp($a['label'], $b['label']));

        $labels = $totales = $backgroundColors = $borderColors = [];
        foreach ($items as $it) {
            $labels[] = $it['label'];
            $totales[] = $it['total'];
            $color = $colorMap[$it['codigo']];
            $backgroundColors[] = $color;
            $borderColors[] = $color;
        }

        return [
            'labels' => $labels,
            'datasets' => [[
                'label' => $datasetLabel,
                'data' => $totales,
                'backgroundColor' => $backgroundColors,
                'borderColor' => $borderColors,
                'borderWidth' => 1,
            ]],
        ];
    }
}
