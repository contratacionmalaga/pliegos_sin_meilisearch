<?php

namespace App\Filament\Resources\Incidencias\Tables;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
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

use Filament\Tables\Columns\TextColumn;

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
            : MiNavigationItemIncidencias::PLACSP_INCIDENCIA;

        // Usamos la función pública `getTable` para obtener la tabla configurada
        return $this->miTable->getTable($table, $configurableItem)
            ->modifyQueryUsing(fn ($query) => $query->with('incidenciable')
                                                    ->leftJoin('placsp_anuncios', 'incidencias.incidenciable_id', '=', 'placsp_anuncios.id')
                                                    ->select('incidencias.*') // evita columnas duplicadas
                              )
            ->columns([
//                        $this->miTextColumn->getSearchableTextColumn('id', 'id'),
                        $this->miTextColumn->getMultilineaTextColumn('titulo', 'Titulo'),
                        $this->miTextColumn->getMultilineaTextColumn('descripcion', 'Descripción'),
                        $this->miTextColumn->getSearchableTextColumn('estado', 'Estado'),

//                        $this->miTextColumn->getSearchableTextColumn('incidenciable_identificador', 'IDENTIF. MODELO'),

                        $this->miTextColumn->getSearchableTextColumn('incidenciable_identificador', 'IDENTIF_2. MODELO')
                            ->searchable(query: function ($query, $search): void {
                                $query->BuscarPorIdentificador($search);
                            }),

                        $this->miTextColumn->getMultilineaTextColumn('incidenciable_descripcion', 'DESCRIPCION MODELO')
                            ->searchable(query: function ($query, $search): void {
                                $query->BuscarPorDescripcion($search);
                            }),
                        $this->miTextColumn->getMultilineaTextColumn('incidenciable_tipo', 'Tipo MODELO')
//                            ->searchable(true),
                                    ->searchable(query: function ($query, $search): void {
                                        $query->BuscarPorTipo($search);
                                    }),

////                TextColumn::make('incidenciable_identificador')
//                        $this->miTextColumn->getMultilineaTextColumn('incidenciable_identificador', 'Identificador Mod.')
////                    ->label('Identificador Mod.')
//                    ->getStateUsing(fn ($record) => $record->incidenciable?->obtenerIdentificadorIncidenciable())
//                    ->searchable(query: function (Builder $query, string $search) {
//                        $query->orWhereHasMorph(
//                            'incidenciable',
//                            ['App\Models\PLACSP\Anuncio','App\Models\PLACSP\ContratoMayor'], // todos los modelos incidenciables
//                            function ($q) use ($search) {
//                                $q->whereRaw('LOWER(contract_folder_id) LIKE ?', ['%' . strtolower($search) . '%']);
//                            }
//                        );
//                    }),
//
////                TextColumn::make('incidenciable_descripcion')
//                $this->miTextColumn->getMultilineaTextColumn('incidenciable_descripcion', 'Descripcion Mod.')
////                    ->label('Descripcion Mod.')
//                    ->wrap()
//                    ->getStateUsing(fn ($record) => $record->incidenciable?->obtenerDescripcionIncidenciable())
//                    ->searchable(query: function (Builder $query, string $search) {
//                        $query->orWhereHasMorph(
//                            'incidenciable',
//                            ['App\Models\PLACSP\Anuncio','App\Models\PLACSP\ContratoMayor'], // todos los modelos incidenciables
//                            function ($q) use ($search) {
//                                $q->whereRaw('LOWER(name_objeto) LIKE ?', ['%' . strtolower($search) . '%']);
//                            }
//                        );
//                    }),
//
////                TextColumn::make('incidenciable_tipo')
//                $this->miTextColumn->getMultilineaTextColumn('incidenciable_tipo', 'Tipo Mod.')
////                    ->label('Tipo Mod.')
//                    ->getStateUsing(fn ($record) => $record->incidenciable?->obtenerTypeIncidenciable())
//                    ->searchable(false),
////                    ->searchable(query: function (Builder $query, string $search) {
////                        $query->orWhereHasMorph(
////                            'incidenciable',
////                            ['App\Models\PLACSP\Anuncio','App\Models\PLACSP\ContratoMayor'], // todos los modelos incidenciables
////                            function ($q) use ($search) {
////                                $q->whereRaw('LOWER(XXXXXXXXXXXXX) LIKE ?', ['%' . strtolower($search) . '%']);
////                            }
////                        );
////                    }),




//                        $this->miTextColumn->getSearchableTextColumn('custom_incidenciable_id3', 'ID_INCIDENCIABLE3')
//                            ->getStateUsing(function ($record): ?string {
//                                return $record->incidenciable?->obtenerIdentificadorIncidenciable();
//                            }),
//
//                        $this->miTextColumn->getSearchableTextColumn('custom_incidenciable_des3', 'DES_INCIDENCIABLE3')
//                            ->getStateUsing(function ($record): ?string {
//                                return $record->incidenciable?->obtenerDescripcionIncidenciable();
//                            }),
//
//                        $this->miTextColumn->getSearchableTextColumn('custom_incidenciable2', 'INCIDENCIABLE2')
//                            ->getStateUsing(function ($record): ?string {
//                                return $record->incidenciable?->obtenerTypeIncidenciable();
//                            }),
//


                $this->miTextColumn->getSearchableTextColumn('email', 'email'),

//                        $this->miTextColumn->getSearchableTextColumn('incidenciable_id', 'incidenciable_id'),
//                        $this->miTextColumn->getSearchableTextColumn('incidenciable_type', 'incidenciable_type'),
                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('created_at', 'F.Creación'),
                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('updated_at', 'F.Actualización'),
//                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('deleted_at', 'deleted_at'),
                    ])
            ->searchable(true);
//            ->searchable(!$isRelationManager);
    }
}
