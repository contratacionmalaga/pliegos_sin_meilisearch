<?php

namespace App\Filament\Widgets;

use App\Enums\Placsp\PLACSP_ContractCode;
use App\Enums\Placsp\PLACSP_ContractFolderStatusCode;
use App\Enums\Placsp\PLACSP_ContractingAuthorityCode;
use App\Enums\Placsp\PLACSP_SyndicationTenderingProcessCode;
use App\Models\PLACSP\Adjudicacion;
use App\Models\PLACSP\ContratoMayor;
use App\Services\EstadisticasService;
use Filament\Widgets\ChartWidget;
use Filament\Support\Colors\Color;

class EstadisticaSumAdjudicacionesPorTipoOrgContratacionChart extends \App\Filament\Widgets\BaseChartWidget
{
    protected static ?string $chartId = 'EstadisticaSumAdjudicacionesPorTipoOrganoContratacionChar';

//    protected ?string $heading = 'Importe total de adjudicaciones por tipo de órgano de contratación';
    protected ?string $heading = 'Importe total por tipo de órg. de contratación';

    protected static ?int $sort = 18;

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
            'contracting_party_type_code',
            fn(string $c) => \App\Enums\Placsp\PLACSP_ContractingAuthorityCode::tryFrom($c)?->getTinyLabel() ?? $c,
            'Total Adjudicaciones'
        );
    }

    protected function getDataOld(): array
    {


        // Base query
        $queryTotales = Adjudicacion::query();

        $service = new EstadisticasService();

        $estadisticas = $service->getEstadisticasSumPorCampo($queryTotales,'contracting_party_type_code');

        // Construir arrays paralelos: labels legibles y totales
        $labels = [];
        $totales = [];
        $backgroundColors = [];
        $borderColors = [];

        foreach ($estadisticas as $codigo => $total) {
            $enum = PLACSP_ContractingAuthorityCode::tryFrom((string) $codigo);
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
