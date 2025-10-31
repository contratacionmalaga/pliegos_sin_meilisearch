<?php

namespace App\Models\PLACSP;

use App\Enums\Placsp\PLACSP_ContractCode;
use App\Enums\Placsp\PLACSP_ContractingAuthorityCode;
use App\Enums\Placsp\PLACSP_DeclarationTypeCode;
use App\Enums\Placsp\PLACSP_SyndicationContractFolderStatusCode;
use App\Enums\Placsp\PLACSP_SyndicationTenderingProcessCode;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequisitoPrevioParticipacion extends Model
{

    use HasUuids;

    protected $table = "placsp_requisitos_previos_participacion";

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'contract_folder_status_code' => PLACSP_SyndicationContractFolderStatusCode::class,
            'procedure_code' => PLACSP_SyndicationTenderingProcessCode::class,
            'type_code' => PLACSP_ContractCode::class,
            'contracting_party_type_code' => PLACSP_ContractingAuthorityCode::class,
            'requirement_type_code' => PLACSP_DeclarationTypeCode::class,
        ];
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
