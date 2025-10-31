<?php

namespace App\Models\PLACSP;

use App\Enums\Flags\BooleanEnum;
use App\Enums\Placsp\PLACSP_ContractCode;
use App\Enums\Placsp\PLACSP_DiligenceTypeCode;
use App\Enums\Placsp\PLACSP_FundingProgramCode;
use App\Enums\Placsp\PLACSP_SyndicationContractFolderStatusCode;
use App\Enums\Placsp\PLACSP_SyndicationTenderingProcessCode;
use App\Enums\Placsp\PLACSP_TenderResultCode;
use App\Enums\Placsp\TipoSindicacion;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Modificacion extends Model
{

    use HasUuids;


    protected $table = "placsp_modificaciones";

    protected function casts(): array
    {

        return [
            'contract_folder_status_code' => PLACSP_SyndicationContractFolderStatusCode::class,
            'result_code' => PLACSP_TenderResultCode::class,
            'type_code' => PLACSP_ContractCode::class,
            'procedure_code' => PLACSP_SyndicationTenderingProcessCode::class,
            'sme_awarded_indicator'=> BooleanEnum::class,
            'es_contrato_mixto'=> BooleanEnum::class,
            'overthreshold_indicator'=> BooleanEnum::class,
            'required_curricula_indicator' => BooleanEnum::class,
            'received_appeal_quantity' => BooleanEnum::class,
            'eordering_indicator' => BooleanEnum::class,
            'electronic_invoicing_indicator' => BooleanEnum::class,
            'abnormally_low_tenders_indicator' => BooleanEnum::class,
            'urgencia'=> PLACSP_DiligenceTypeCode::class,
            'estado'=>PLACSP_SyndicationContractFolderStatusCode::class,
            'financiacion_codigo'=>PLACSP_FundingProgramCode::class,
            'tipo_sindicacion'=>TipoSindicacion::class,
        ];
    }

    public function contrato_mayor(): BelongsTo
    {
        return $this
            ->belongsTo(ContratoMayor::class, 'id_entry', 'id_entry');
    }

}
