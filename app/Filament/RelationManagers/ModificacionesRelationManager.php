<?php

namespace App\Filament\RelationManagers;

use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Abstracts\BaseRelationManager;
use App\Filament\Resources\PLACSP\Modificaciones\Schemas\ModificacionInfolist;
use App\Filament\Resources\PLACSP\Modificaciones\Tables\ModificacionTable;
use Exception;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ModificacionesRelationManager extends BaseRelationManager
{
    /**
     * Utilizada dentro de la clase BaseRelationManager para heredar todas las propiedades
     *      que es base a este valor allí se calculan
     */
    protected static MiRelationManager $miRelationManager = MiRelationManager::PLACSP_MODIFICACION;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(ModificacionTable::class)->getTable($table);
    }

    /**
     * @throws Exception
     */
    public function infolist(Schema $schema): Schema
    {

        return app(ModificacionInfolist::class)->getSchema($schema);
    }
}
