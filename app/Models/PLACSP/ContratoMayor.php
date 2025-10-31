<?php

namespace App\Models\PLACSP;

use App\Enums\Flags\BooleanEnum;
use App\Enums\Placsp\PLACSP_ContractCode;
use App\Enums\Placsp\PLACSP_ContractingAuthorityCode;
use App\Enums\Placsp\PLACSP_ContractingSystemCode;
use App\Enums\Placsp\PLACSP_DiligenceTypeCode;
use App\Enums\Placsp\PLACSP_FundingProgramCode;
use App\Enums\Placsp\PLACSP_GoodsContractCode;
use App\Enums\Placsp\PLACSP_PatrimonialContractCode;
use App\Enums\Placsp\PLACSP_ProcurementLegislationDocumentReferenceID;
use App\Enums\Placsp\PLACSP_ProcurementNationalLegislationCode;
use App\Enums\Placsp\PLACSP_ServiceContractCode;
use App\Enums\Placsp\PLACSP_SyndicationContractFolderStatusCode;
use App\Enums\Placsp\PLACSP_SyndicationTenderingProcessCode;
use App\Enums\Placsp\PLACSP_TenderDeliveryCode;
use App\Enums\Placsp\PLACSP_WorksContractCode;
use App\Enums\Placsp\TipoSindicacion;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContratoMayor extends Model
{

    protected $table = "placsp_contratos_mayores";
    protected $primaryKey = "id_entry";

    protected function casts(): array
    {
        return [
            'abnormally_low_tenders_indicator' => BooleanEnum::class,
            'contract_folder_status_code' => PLACSP_SyndicationContractFolderStatusCode::class,
            'contracting_party_type_code' => PLACSP_ContractingAuthorityCode::class,
            'contracting_system_code' => PLACSP_ContractingSystemCode::class,
            'es_contrato_mixto'=> BooleanEnum::class,
            'electronic_invoicing_indicator' => BooleanEnum::class,
            'eordering_indicator' => BooleanEnum::class,
            'financiacion_codigo'=> PLACSP_FundingProgramCode::class,
            'mix_contract_indicator' => BooleanEnum::class,
            'overthreshold_indicator'=> BooleanEnum::class,
            'procedure_code' => PLACSP_SyndicationTenderingProcessCode::class,
            'procurement_national_legislation_code' => PLACSP_ProcurementNationalLegislationCode::class,
            'procurement_legislation_document_reference' => PLACSP_ProcurementLegislationDocumentReferenceID::class,
            'required_curricula_indicator' => BooleanEnum::class,
            'sme_awarded_indicator'=> BooleanEnum::class,
            'submission_method_code' => PLACSP_TenderDeliveryCode::class,
            'tipo_sindicacion'=> TipoSindicacion::class,
            'type_code' => PLACSP_ContractCode::class,
            'urgency_code'=> PLACSP_DiligenceTypeCode::class,
            'variant_constraint_indicator' => BooleanEnum::class,
        ];
    }

    public function getSubtypeCodeEnumAttribute(): HasLabel|HasIcon|HasColor|null
    {

        return match ($this->type_code) {
            PLACSP_ContractCode::Servicios => PLACSP_ServiceContractCode::tryFrom($this->subtype_code),
            PLACSP_ContractCode::Suministros => PLACSP_GoodsContractCode::tryFrom($this->subtype_code),
            PLACSP_ContractCode::Obras => PLACSP_WorksContractCode::tryFrom($this->subtype_code),
            PLACSP_ContractCode::Patrimonial => PLACSP_PatrimonialContractCode::tryFrom($this->subtype_code),
            default => null,
        };
    }

    /**
     * @return HasMany<Adjudicacion, $this>
     */
    public function adjudicaciones(): HasMany
    {
        return $this
            ->hasMany(Adjudicacion::class, 'id_entry', 'id_entry');
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
     * @return HasMany<Modificacion, $this>
     */
    public function modificaciones(): HasMany
    {
        return $this
            ->hasMany(Modificacion::class, 'id_entry', 'id_entry');
    }

    /**
     * @return HasMany<Anuncio, $this>
     */
    public function anuncios(): HasMany
    {
        return $this
            ->hasMany(Anuncio::class, 'id_entry', 'id_entry');
    }

    /**
     * @return HasMany<Anuncio, $this>
     */
    public function criterios_adjudicacion(): HasMany
    {
        return $this
            ->hasMany(CriterioAdjudicacion::class, 'id_entry', 'id_entry');
    }

    /**
     * @return HasMany<Anuncio, $this>
     */
    public function condiciones_especiales_ejecucion(): HasMany
    {
        return $this
            ->hasMany(CondicionEspecialEjecucion::class, 'id_entry', 'id_entry');
    }

    /**
     * @return HasMany<Anuncio, $this>
     */
    public function lotes(): HasMany
    {
        return $this
            ->hasMany(Lote::class, 'id_entry', 'id_entry');
    }

    /**
     * @return HasMany<Anuncio, $this>
     */
    public function requisitos_previos_participacion(): HasMany
    {
        return $this
            ->hasMany(RequisitoPrevioParticipacion::class, 'id_entry', 'id_entry');
    }
}
