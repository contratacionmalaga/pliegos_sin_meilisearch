<?php

namespace App\Services;

use App\Enums\Placsp\PLACSP_ContractFolderStatusCode;
use App\Models\PLACSP\ContratoMayor;
use Tiptap\Nodes\Table;

class EstadisticasService
{

    public function getEstadisticasTotalesPorCampo($queryTotales, string $campo): array
    {

        // Clonar la query para evitar afectarlos
//        $totales = (clone $queryTotales)
//            ->select($campo, \DB::raw('count(*) as count'), \DB::raw('sum(total_amount) as total_importe'))
//            ->groupBy($campo)
//            ->get()
//            ->keyBy($campo);

//        $totales = (clone $queryTotales)
//            ->select($campo, \DB::raw('count(*) as count'), \DB::raw('sum(total_amount) as total_importe'))
//            ->groupBy($campo)
//            ->get()
//            ->toArray();

//        $totales = (clone $queryTotales)
//            ->select($campo, \DB::raw('count(*) as count'), \DB::raw('sum(total_amount) as total_importe'))
//            ->groupBy($campo)
//            ->get()
//            ->keyBy($campo)
//            ->map(function($item) {
//                return [
//                    'count' => $item->count,
//                    'total_importe' => $item->total_importe,
//                ];
//            })
//            ->toArray();

        $totales = (clone $queryTotales)
            ->select($campo, \DB::raw('count(*) as count'), \DB::raw('sum(total_amount) as total_importe'))
            ->groupBy($campo)
            ->get()
            ->map(function($item) use ($campo) {
                return [
                    $item->$campo,
//                    $item->PLACSP_ContractFolderStatusCode::tryFrom((string) $campo)->getLabel() ?? 'Desconocido',
                    $item->count,
                    $item->total_importe,
                ];
            })
            ->toArray();


        return $totales;

    }

    public function getEstadisticasCountPorCampo($queryTotales, string $campo): array
    {

//        return ContratoMayor::query()
//            ->selectRaw('contract_folder_status_code, COUNT(*) as total')
//            ->groupBy('contract_folder_status_code')
//            ->pluck('total', 'contract_folder_status_code')
//            ->toArray();

        // Clonar la query para evitar afectarlos
        $totales = (clone $queryTotales)
            ->select($campo, \DB::raw('count(*) as total'))
            ->groupBy($campo)
            ->pluck('total', $campo)
            ->toArray();

        return $totales;

    }


    public function getEstadisticasSumPorCampo($queryTotales, string $campo): array
    {

        // Clonar la query para evitar afectarlos
        $totales = (clone $queryTotales)
            ->select($campo, \DB::raw('sum(total_amount) as total_importe'))
            ->groupBy($campo)
            ->pluck('total_importe', $campo)
            ->toArray();

        return $totales;

    }

        public function getEstadisticasNumExpedientesPorEstado(): array
    {

        return ContratoMayor::query()
            ->selectRaw('contract_folder_status_code, COUNT(*) as total')
            ->groupBy('contract_folder_status_code')
            ->pluck('total', 'contract_folder_status_code')
            ->toArray();

    }

    public function getEstadisticasNumExpedientesPorTipoExpediente(): array
    {

        return ContratoMayor::query()
            ->selectRaw('type_code, COUNT(*) as total')
            ->groupBy('type_code')
            ->pluck('total', 'contract_folder_status_code')
            ->toArray();

    }

    public function getEstadisticasNumExpedientesPorTipoProcedimiento(): array
    {

        return ContratoMayor::query()
            ->selectRaw('procedure_code, COUNT(*) as total')
            ->groupBy('procedure_code')
            ->pluck('total', 'contract_folder_status_code')
            ->toArray();

    }

}
