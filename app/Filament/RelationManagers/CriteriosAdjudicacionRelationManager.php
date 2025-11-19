<?php

namespace App\Filament\RelationManagers;

use App\Contracts\MiRelationManagerContract;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Abstracts\BaseRelationManager;
use App\Filament\Resources\PLACSP\CriteriosAdjudicacion\Schemas\CriterioAdjudicacionInfolist;
use App\Filament\Resources\PLACSP\CriteriosAdjudicacion\Tables\CriterioAdjudicacionTable;
use Exception;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CriteriosAdjudicacionRelationManager extends BaseRelationManager
{
    /**
     * Utilizada dentro de la clase BaseRelationManager para heredar todas las propiedades
     *      que es base a este valor allí se calculan
     */
    protected static MiRelationManagerContract $miRelationManager = MiRelationManager::PLACSP_CRITERIO_ADJUDICACION;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(CriterioAdjudicacionTable::class)->getTable($table);
    }

    public function infolist(Schema $schema): Schema
    {

        return app(CriterioAdjudicacionInfolist::class)->getSchema($schema);
    }
}
