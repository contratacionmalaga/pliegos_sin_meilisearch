<?php

namespace App\Filament\Resources\PLACSP\RequisitosPreviosParticipacion\Tables;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Components\Tables\MiTable;
use App\Filament\Components\Tables\MiTextColumn;
use App\Models\PLACSP\RequisitoPrevioParticipacion;
use App\Traits\HasCommonColumns;
use Exception;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RequisitoPrevioParticipacionTable
{
    use HasCommonColumns;

//    public function getInfolist(Schema $infolist): Schema
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
            ? MiRelationManager::PLACSP_REQUISITO_PREVIO_PARTICIPACION
            : MiNavigationItem::PLACSP_REQUISITO_PREVIO_PARTICIPACION;

        // Usamos la función pública `getTable` para obtener la tabla configurada
        return $this->miTable->getTable($table, $configurableItem)
            ->columns(
                array_merge(
                    $this->getColumnasComunes($table),
                    [
                        $this->miTextColumn->getBadgeTextColumn('requirement_type_code', 'Requisito previo de participación'),
                    ],
                ))
            ->searchable(!$isRelationManager);
    }
}
