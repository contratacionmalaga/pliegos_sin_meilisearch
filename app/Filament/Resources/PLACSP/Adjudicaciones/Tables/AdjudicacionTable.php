<?php

namespace App\Filament\Resources\PLACSP\Adjudicaciones\Tables;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Components\Tables\MiTable;
use App\Filament\Components\Tables\MiTextColumn;
use App\Models\PLACSP\Adjudicacion;
use App\Traits\HasCommonColumns;
use Exception;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

readonly class AdjudicacionTable
{
    use HasCommonColumns;

    public function __construct(
        private MiTable      $miTable,
        private MiTextColumn $miTextColumn,
    )
    {
        // Constructor vacío
    }

    /**
     * @throws Exception
     */
    public function getTable(Table $table): Table
    {

        $isEmpty = $table->getQuery()?->count() === 0;

        $isRelationManager = $table->getLivewire() instanceof RelationManager;

        // Determinamos el tipo de configuración que se debe aplicar
        $configurableItem = $isRelationManager
            ? MiRelationManager::PLACSP_ADJUDICACION
            : MiNavigationItem::PLACSP_ADJUDICACION;

        // Usamos la función pública `getTable` para obtener la tabla configurada
        return $this->miTable->getTable($table, $configurableItem)
            ->columns(
                array_merge(
                    $this->getColumnasComunes($table,true),
                    [
//                        $this->miTextColumn->getLimitableSearchableSortableTextColumn('name_objeto', 'Objeto del contrato')
//                            ->visible(!$isRelationManager),
                        $this->miTextColumn->getSortableTextColumn('received_appeal_quantity', 'Recursos'),
                        $this->miTextColumn->getBadgeTextColumn('result_code')
                            ->visible(!$isRelationManager),
                        $this->miTextColumn->getMultilineaTextColumn('party_name_adjudicatario', 'Adjudicatario'),
                        $this->miTextColumn->getSortableTextColumn('nif_adjudicatario', 'Nif adjudicatario'),
                        $this->miTextColumn->getBadgeTextColumn('sme_awarded_indicator'),
                        $this->miTextColumn->getMoneyTextColumn('total_amount', 'Adjudicación c/iva'),

                    ],
                ));
    }
}
