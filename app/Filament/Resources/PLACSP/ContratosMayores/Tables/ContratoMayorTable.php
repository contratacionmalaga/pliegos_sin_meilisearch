<?php

namespace App\Filament\Resources\PLACSP\ContratosMayores\Tables;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Components\Tables\MiTable;
use App\Filament\Components\Tables\MiTextColumn;
use App\Models\PLACSP\ContratoMayor;
use App\Traits\HasCommonColumns;
use Exception;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

readonly class ContratoMayorTable
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
            ? MiRelationManager::PLACSP_CONTRATO_MAYOR
            : MiNavigationItem::PLACSP_CONTRATO_MAYOR;

        // Usamos la función pública `getTable` para obtener la tabla configurada
        return $this->miTable->getTable($table, $configurableItem)
            ->columns(
                array_merge(
                    $this->getColumnasComunes($table),
                    [
                        $this->miTextColumn->getMoneyTextColumn('total_amount', 'Importe c/iva'),
                    ]
                ))
            ->searchable(!$isRelationManager);
    }
}
