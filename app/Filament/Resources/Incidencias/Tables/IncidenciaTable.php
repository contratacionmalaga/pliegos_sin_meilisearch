<?php

namespace App\Filament\Resources\Incidencias\Tables;

use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Enums\NavigationMenus\MiRelationManagerIncidencias;
use App\Filament\Components\Tables\MiTable;
use App\Filament\Components\Tables\MiTextColumn;
use App\Traits\HasCommonColumns;
use Exception;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

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
            ? MiRelationManagerIncidencias::PLACSP_INCIDENCIA
            : MiNavigationItemIncidencias::PLACSP_INCIDENCIA;

        // Usamos la función pública `getTable` para obtener la tabla configurada
        return $this->miTable->getTable($table, $configurableItem)
            ->modifyQueryUsing(fn ($query) => $query->with('incidenciable')
                                                    ->leftJoin('placsp_anuncios', 'incidencias.incidenciable_id', '=', 'placsp_anuncios.id')
                                                    ->select('incidencias.*') // evita columnas duplicadas
                              )
            ->columns([
                        $this->miTextColumn->getMultilineaTextColumn('titulo', 'Titulo'),
                        $this->miTextColumn->getMultilineaTextColumn('descripcion', 'Descripción'),
                        $this->miTextColumn->getSearchableTextColumn('estado', 'Estado'),
                        $this->miTextColumn->getSearchableTextColumn('incidenciable_identificador', 'Id. Model')
                            ->searchable(query: function ($query, $search): void {
                                $query->BuscarPorIdentificador($search);
                            }),
                        $this->miTextColumn->getMultilineaTextColumn('incidenciable_descripcion', 'Descrip. Modelo')
                            ->searchable(query: function ($query, $search): void {
                                $query->BuscarPorDescripcion($search);
                            }),
                        $this->miTextColumn->getMultilineaTextColumn('incidenciable_tipo', 'Tipo MODELO')
                                    ->searchable(query: function ($query, $search): void {
                                        $query->BuscarPorTipo($search);
                                    }),
                        $this->miTextColumn->getSearchableTextColumn('email', 'email'),
                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('created_at', 'F.Creación'),
                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('updated_at', 'F.Actualización'),
                    ])
            ->searchable(true);
    }
}
