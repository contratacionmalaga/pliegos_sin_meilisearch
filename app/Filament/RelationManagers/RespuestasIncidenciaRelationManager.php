<?php

namespace App\Filament\RelationManagers;

use App\Contracts\MiRelationManagerContract;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Enums\NavigationMenus\MiRelationManagerIncidencias;
use App\Filament\Abstracts\BaseRelationManager;
use App\Filament\Resources\RespuestasIncidencia\Schemas\RespuestasIncidenciaInfolist;
use App\Filament\Resources\RespuestasIncidencia\Tables\RespuestasIncidenciaTable;
use Exception;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class RespuestasIncidenciaRelationManager extends BaseRelationManager
{
    /**
     * Utilizada dentro de la clase BaseRelationManager para heredar todas las propiedades
     *      que es base a este valor allí se calculan
     */
    protected static MiRelationManagerContract $miRelationManager = MiRelationManagerIncidencias::PLACSP_RESPUESTAS_INCIDENCIA;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(RespuestasIncidenciaTable::class)->getTable($table);
    }

    public function infolist(Schema $schema): Schema
    {

        return app(RespuestasIncidenciaInfolist::class)->getSchema($schema);
    }
}
