<?php

namespace App\Filament\RelationManagers;

use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Abstracts\BaseRelationManager;
use App\Filament\Resources\PLACSP\Adjudicaciones\Schemas\AdjudicacionInfolist;
use App\Filament\Resources\PLACSP\Adjudicaciones\Tables\AdjudicacionTable;
use Exception;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class AdjudicacionesRelationManager extends BaseRelationManager
{
    /**
     * Utilizada dentro de la clase BaseRelationManager para heredar todas las propiedades
     *      que es base a este valor allí se calculan
     */
    protected static MiRelationManager $miRelationManager = MiRelationManager::PLACSP_ADJUDICACION;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(AdjudicacionTable::class)->getTable($table);
    }

    /**
     * @throws Exception
     */
    public function infolist(Schema $schema): Schema
    {

        return app(AdjudicacionInfolist::class)->getSchema($schema);
    }
}
