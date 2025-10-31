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
            $this->miTextColumn->getSearchableSortableTextColumn('contract_folder_id', 'Expediente')
                ->visible(!$isRelationManager),
            $this->miTextColumn->getLimitableSearchableSortableTextColumn('name_objeto', 'Objeto del contrato')
                 ->visible(!$isRelationManager),
            $this->miTextColumn->getMultilineaTextColumn('party_name_organo_contratacion', 'Órgano de contratación')
                ->visible(!$isRelationManager)
                ->searchable(false),
            $this->miTextColumn->getBadgeTextColumn('contract_folder_status_code', 'Estado')
                ->visible(!$isRelationManager && !$isAdjudication),
            $this->miTextColumn->getBadgeTextColumn('type_code')
                ->visible(!$isRelationManager)
                ->searchable(false),
            $this->miTextColumn->getBadgeTextColumn('procedure_code')
                ->visible(!$isRelationManager)
                ->searchable(false),

//            $this->miTextColumn->getBadgeDateTimeTextColumn('updated', 'Fecha última actualización en PLACSP')
//                ->visible(!$isRelationManager)
//                ->wrapHeader(true)
        ];
    }

    public function getColumnasComunesTipoContratoAndTipoProcedimiento(Table $table): array
    {
        $isRelationManager = $table->getLivewire() instanceof RelationManager;

        return [
            $this->miTextColumn->getBadgeTextColumn('type_code')
                ->visible(!$isRelationManager)
                ->searchable(false),
            $this->miTextColumn->getBadgeTextColumn('procedure_code')
                ->visible(!$isRelationManager)
                ->searchable(false),
        ];
    }
}


