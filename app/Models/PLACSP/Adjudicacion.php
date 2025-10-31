<?php

namespace App\Models\PLACSP;

use App\Enums\Flags\BooleanEnum;
use App\Enums\Placsp\PLACSP_ContractCode;
use App\Enums\Placsp\PLACSP_ContractingAuthorityCode;
use App\Enums\Placsp\PLACSP_DiligenceTypeCode;
use App\Enums\Placsp\PLACSP_FundingProgramCode;
use App\Enums\Placsp\PLACSP_SyndicationContractFolderStatusCode;
use App\Enums\Placsp\PLACSP_SyndicationTenderingProcessCode;
use App\Enums\Placsp\PLACSP_TenderDeliveryCode;
use App\Enums\Placsp\PLACSP_TenderResultCode;
use App\Enums\Placsp\TipoSindicacion;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Adjudicacion extends Model
{

    use HasUuids;

    protected $table = "placsp_adjudicaciones";


    protected function casts(): array
    {

        return [
            'result_code' => PLACSP_TenderResultCode::class,
            'contract_folder_status_code' => PLACSP_SyndicationContractFolderStatusCode::class,
            'contracting_party_type_code' => PLACSP_ContractingAuthorityCode::class,
            'type_code' => PLACSP_ContractCode::class,
            'procedure_code' => PLACSP_SyndicationTenderingProcessCode::class,
            'sme_awarded_indicator'=> BooleanEnum::class,
            'es_contrato_mixto'=> BooleanEnum::class,
            'overthreshold_indicator'=> BooleanEnum::class,
            'required_curricula_indicator' => BooleanEnum::class,
//            'received_appeal_quantity' => BooleanEnum::class,
            'received_appeal_quantity' => 'int',
            'eordering_indicator' => BooleanEnum::class,
            'electronic_invoicing_indicator' => BooleanEnum::class,
            'abnormally_low_tenders_indicator' => BooleanEnum::class,
            'urgency_code'=> PLACSP_DiligenceTypeCode::class,
            'estado'=>PLACSP_SyndicationContractFolderStatusCode::class,
            'funding_program_code'=>PLACSP_FundingProgramCode::class,
            'tipo_sindicacion'=>TipoSindicacion::class,
            'submission_method_code' => PLACSP_TenderDeliveryCode::class,
        ];
    }

    public function contrato_mayor(): BelongsTo
    {
        return $this
            ->belongsTo(ContratoMayor::class, 'id_entry', 'id_entry');
    }

    /**
     * @return HasMany<Documento, $this>
     */
    public function documentos(): HasMany
    {
        return $this
            ->hasMany(Documento::class, 'id_entry', 'id_entry');
    }

    /**
     * @return HasMany<Anuncio, $this>
     */
    public function anuncios(): HasMany
    {
        return $this
            ->hasMany(Anuncio::class, 'id_entry', 'id_entry');
    }
}
