<?php

namespace App\Filament\Resources\RespuestasIncidencia\Tables;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Enums\NavigationMenus\MiRelationManagerIncidencias;
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
            ? MiRelationManagerIncidencias::PLACSP_RESPUESTAS_INCIDENCIA
            : MiNavigationItemIncidencias::PLACSP_RESPUESTAS_INCIDENCIA;

        // Usamos la función pública `getTable` para obtener la tabla configurada
        return $this->miTable->getTable($table, $configurableItem)
            ->columns([
//                        $this->miTextColumn->getSearchableTextColumn('id', 'ID'),
                        $this->miTextColumn->getMultilineaTextColumn('respuesta', 'Respuesta')->html(),
//                        $this->miTextColumn->getSearchableTextColumn('incidencia_id', 'incidencia_id'),
                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('created_at', 'F.Creacion'),
                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('updated_at', 'F.Actualizacion'),
//                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('deleted_at', 'deleted_at'),
                    ])
            ->searchable(true);
//            ->searchable(!$isRelationManager);
    }
}
