<?php

namespace App\Models\PLACSP;

use App\Enums\Placsp\PLACSP_ContractCode;
use App\Enums\Placsp\PLACSP_ContractingAuthorityCode;
use App\Enums\Placsp\PLACSP_SyndicationContractFolderStatusCode;
use App\Enums\Placsp\PLACSP_SyndicationTenderingProcessCode;
use App\Enums\Placsp\PLACSP_TenderingDocumentTypeCode;
use App\Enums\Placsp\PLACSP_TenderingNoticeTypeCode;
use App\Traits\HasIncidencias;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Anuncio extends Model
{

    use HasUuids;
    use HasIncidencias;

    protected $table = "placsp_anuncios";

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
            'document_type_code' => PLACSP_TenderingDocumentTypeCode::class,
            'notice_type_code' => PLACSP_TenderingNoticeTypeCode::class,
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
