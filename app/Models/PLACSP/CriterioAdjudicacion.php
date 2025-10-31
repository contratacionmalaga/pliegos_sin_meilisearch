<?php

namespace App\Models\PLACSP;

use App\Casts\AwardingCriteriaSubtypeCodeCast;
use App\Enums\Placsp\PLACSP_AwardingCriteriaAutomaticallyEvaluatedSubTypeCode;
use App\Enums\Placsp\PLACSP_AwardingCriteriaCode;
use App\Enums\Placsp\PLACSP_AwardingCriteriaNotAutomaticallyEvaluatedSubTypeCode;
use App\Enums\Placsp\PLACSP_ContractCode;
use App\Enums\Placsp\PLACSP_SyndicationContractFolderStatusCode;
use App\Enums\Placsp\PLACSP_SyndicationTenderingProcessCode;
use App\Enums\Placsp\TipoSindicacion;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class CriterioAdjudicacion extends Model
{

    use HasUuids;

    protected $table = "placsp_criterios_adjudicacion";

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'procedure_code' => PLACSP_SyndicationTenderingProcessCode::class,
        'type_code' => PLACSP_ContractCode::class,
        'created_at' => 'datetime',
        'awarding_criteria_type_code' => PLACSP_AwardingCriteriaCode::class,
        'contract_folder_status_code' => PLACSP_SyndicationContractFolderStatusCode::class,
        'tipo_sindicacion' => TipoSindicacion::class,
    ];

    public function getAwardingCriteriaSubtypeEnumAttribute(): HasLabel|HasIcon|HasColor|null
    {
        return match ($this->awarding_criteria_type_code) {
            PLACSP_AwardingCriteriaCode::Objetivo => PLACSP_AwardingCriteriaAutomaticallyEvaluatedSubTypeCode::tryFrom($this->awarding_criteria_subtype_code),
            PLACSP_AwardingCriteriaCode::Subjetivo => PLACSP_AwardingCriteriaNotAutomaticallyEvaluatedSubTypeCode::tryFrom($this->awarding_criteria_subtype_code),
            default => null,
        };
    }

    public function contrato_mayor(): BelongsTo
    {
        return $this
            ->belongsTo(ContratoMayor::class, 'id_entry', 'id_entry');
    }

    /**
     * @return BelongsTo
     */
    public function adjudicacion(): BelongsTo
    {
        return $this
            ->belongsTo(Adjudicacion::class, 'id_entry', 'id_entry');
    }

}
