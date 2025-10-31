<?php

namespace App\Filament\Resources\PLACSP\CriteriosAdjudicacion\Tables;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Components\Tables\MiTable;
use App\Filament\Components\Tables\MiTextColumn;
use App\Models\PLACSP\CriterioAdjudicacion;
use App\Traits\HasCommonColumns;
use Exception;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

readonly class CriterioAdjudicacionTable
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

        $isRelationManager = $table->getLivewire() instanceof RelationManager;

        // Determinamos el tipo de configuración que se debe aplicar
        $configurableItem = $isRelationManager
            ? MiRelationManager::PLACSP_CRITERIO_ADJUDICACION
            : MiNavigationItem::PLACSP_CRITERIO_ADJUDICACION;

        return $this->miTable->getTable($table, $configurableItem)
            ->columns(
                array_merge(
                    $this->getColumnasComunes($table),
                    [
                        $this->miTextColumn->getBadgeTextColumn('awarding_criteria_type_code', 'Tipo de criterio'),
                        $this->miTextColumn->getTextColumn('awarding_criteria_subtype_enum', 'Subtipo de criterio')
                            ->badge()
                            ->color(fn($state) => $state?->getColor())
                            ->icon(fn($state) => $state?->getIcon())
                            ->formatStateUsing(fn($state) => $state?->getLabel()),
                        $this->miTextColumn->getTextColumn('weight_numeric', 'Peso del criterio'),
                    ],
                ))
            ->searchable(!$isRelationManager);
    }


}
