<?php

namespace App\Filament\RelationManagers;

use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Abstracts\BaseRelationManager;
use App\Filament\Resources\Incidencias\Schemas\IncidenciaInfolist;
use App\Filament\Resources\Incidencias\Tables\IncidenciaTable;
use Exception;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class IncidenciaRelationManager extends BaseRelationManager
{
    /**
     * Utilizada dentro de la clase BaseRelationManager para heredar todas las propiedades
     *      que es base a este valor allí se calculan
     */
    protected static MiRelationManager $miRelationManager = MiRelationManager::PLACSP_INCIDENCIA;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(IncidenciaTable::class)->getTable($table);
    }

    public function infolist(Schema $schema): Schema
    {

        return app(IncidenciaInfolist::class)->getSchema($schema);
    }
}
