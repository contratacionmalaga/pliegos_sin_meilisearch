<?php

namespace App\Filament\Resources\Incidencias\Tables;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Components\Tables\MiTable;
use App\Filament\Components\Tables\MiTextColumn;
use App\Models\Incidencia;
use App\Models\PLACSP\ContratoMayor;
use App\Traits\HasCommonColumns;
use Exception;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

readonly class IncidenciaTable
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
            ? MiRelationManager::PLACSP_INCIDENCIA
            : MiNavigationItem::PLACSP_INCIDENCIA;

        // Usamos la función pública `getTable` para obtener la tabla configurada
        return $this->miTable->getTable($table, $configurableItem)
            ->modifyQueryUsing(fn ($query) => $query->with('incidenciable'))
            ->columns([
                        $this->miTextColumn->getSearchableTextColumn('id', 'id'),
                        $this->miTextColumn->getSearchableTextColumn('titulo', 'titulo'),
                        $this->miTextColumn->getSearchableTextColumn('descripcion', 'descripcion'),
                        $this->miTextColumn->getSearchableTextColumn('email', 'email'),
                        $this->miTextColumn->getSearchableTextColumn('estado', 'estado'),

                        $this->miTextColumn->getSearchableTextColumn('incidenciable_identificador', 'INCIDENCIABLE_IDENTIFICADOR'),

                        $this->miTextColumn->getSearchableTextColumn('custom_incidenciable_id3', 'INCIDENCIABLE3')
//                            ->getStateUsing(function (Incidencia $record): ?string {
                            ->getStateUsing(function ($record): ?string {

//                                ds('$record->incidenciable=');
                                ds($record->incidenciable);

//                                ds('$record->incidenciable?->obtenerIdIncidenciable()=');
                                return $record->incidenciable?->obtenerIdentificadorIncidenciable();
                            }),

                        $this->miTextColumn->getSearchableTextColumn('custom_incidenciable2', 'INCIDENCIABLE2')
                            ->getStateUsing(function (Incidencia $record): ?string {
                                return $record->incidenciable?->obtenerIdentificadorIncidenciable();
                            }),

                        $this->miTextColumn->getSearchableTextColumn('custom_incidenciable1', 'INCIDENCIABLE1')
                             ->state(function (Incidencia $record): string {
                                // Aquí puedes agregar lógica adicional
                                $identificador = $record->incidenciable?->obtenerIdentificadorIncidenciable();
                                return strtoupper($identificador); // ejemplo de transformación
                             }),

                        $this->miTextColumn->getSearchableTextColumn('incidenciable_id', 'incidenciable_id'),
                        $this->miTextColumn->getSearchableTextColumn('incidenciable_type', 'incidenciable_type'),
                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('created_at', 'created_at'),
                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('updated_at', 'updated_at'),
                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('deleted_at', 'deleted_at'),
                    ])
            ->searchable(true);
//            ->searchable(!$isRelationManager);
    }
}
