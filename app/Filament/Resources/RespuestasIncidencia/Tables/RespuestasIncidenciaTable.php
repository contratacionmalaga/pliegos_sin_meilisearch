<?php

namespace App\Filament\Resources\RespuestasIncidencia\Tables;

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

readonly class RespuestasIncidenciaTable
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
            ? MiRelationManager::PLACSP_RESPUESTAS_INCIDENCIA
            : MiNavigationItem::PLACSP_RESPUESTAS_INCIDENCIA;

        // Usamos la función pública `getTable` para obtener la tabla configurada
        return $this->miTable->getTable($table, $configurableItem)
            ->columns([
                        $this->miTextColumn->getSearchableTextColumn('id', 'id'),
                        $this->miTextColumn->getSearchableTextColumn('respuesta', 'respuesta'),
                        $this->miTextColumn->getSearchableTextColumn('incidencia_id', 'incidencia_id'),
                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('created_at', 'created_at'),
                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('updated_at', 'updated_at'),
                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('deleted_at', 'deleted_at'),
                    ])
            ->searchable(true);
//            ->searchable(!$isRelationManager);
    }
}
