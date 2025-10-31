<?php

namespace App\Filament\Resources\EstructuraAdministrativa\Entidades\Widgets;

use App\Services\EstadisticasEntidadService;
use Filament\Widgets\ChartWidget;

class EstadisticaChart extends ChartWidget
{
    protected static ?string $chartId = 'EstadisticaChar';

    protected ?string $heading = 'Total';

    public string $nifEntidad = '';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {

        $service = new EstadisticasEntidadService()->setNifEntidad($this->nifEntidad);

        $datos = $service->getEstadisticasDetalladas();

        // Supongamos que quieres mostrar barras comparativas para 2025 tipo vs pymes
        $annioActual = now()->year;
        $annioAnterior = now()->subYear()->year;

        $dataActual = $datos[$annioActual]['por_type_code'] ?? [];
        $dataAnterior = $datos[$annioAnterior]['por_type_code'] ?? [];

        // Obtener todos los type_code involucrados (de ambos años)
        $allLabels = collect(array_merge(array_keys($dataActual), array_keys($dataAnterior)))->unique()->values()->all();

        // Mapeamos los valores a cada label para cada año
        $seriesActual = array_map(static fn ($label) => $dataActual[$label]['total']['count'] ?? 0, $allLabels);
        $seriesAnterior = array_map(static fn ($label) => $dataAnterior[$label]['total']['count'] ?? 0, $allLabels);

        return [
            'labels' => $allLabels,
            'datasets' => [
                [
                    'label' => "Total adjudicaciones $annioAnterior",
                    'data' => $seriesAnterior,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.7)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => "Total adjudicaciones $annioActual",
                    'data' => $seriesActual,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.7)',
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
}
