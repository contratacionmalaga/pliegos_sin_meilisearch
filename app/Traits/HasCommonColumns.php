<?php

namespace App\Traits;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

trait HasCommonColumns
{
    public function getColumnasComunes(Table $table, bool $isAdjudication=false): array
    {
        $isRelationManager = $table->getLivewire() instanceof RelationManager;

        return [
            $this->miTextColumn->getSearchableTextColumn('contract_folder_id', 'Expediente')
                ->visible(!$isRelationManager),
            $this->miTextColumn->getLimitableSearchableTextColumn('name_objeto', 'Objeto del contrato')
                 ->visible(!$isRelationManager),
            $this->miTextColumn->getMultilineaTextColumn('party_name_organo_contratacion', 'Órgano de contratación')
                ->visible(!$isRelationManager)
                ->searchable(false),
            $this->miTextColumn->getBadgeFiltrableTextColumn('contract_folder_status_code', 'Estado')
                ->visible(!$isRelationManager && !$isAdjudication),
            $this->miTextColumn->getBadgeFiltrableTextColumn('type_code')
                ->visible(!$isRelationManager),
            $this->miTextColumn->getBadgeFiltrableTextColumn('procedure_code')
                ->visible(!$isRelationManager),

//            $this->miTextColumn->getBadgeDateTimeTextColumn('updated', 'Fecha última actualización en PLACSP')
//                ->visible(!$isRelationManager)
//                ->wrapHeader(true)
        ];
    }

    public function getColumnasComunesTipoContratoAndTipoProcedimiento(Table $table): array
    {
        $isRelationManager = $table->getLivewire() instanceof RelationManager;

        return [
            $this->miTextColumn->getBadgeFiltrableTextColumn('type_code')
                ->visible(!$isRelationManager),
            $this->miTextColumn->getBadgeFiltrableTextColumn('procedure_code')
                ->visible(!$isRelationManager),
        ];
    }
}


