<?php

namespace App\Filament\RelationManagers;

use App\Contracts\MiRelationManagerContract;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Abstracts\BaseRelationManager;
use App\Filament\Resources\PLACSP\Lotes\Schemas\LoteInfolist;
use App\Filament\Resources\PLACSP\Lotes\Tables\LoteTable;
use Exception;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class LotesRelationManager extends BaseRelationManager
{
    /**
     * Utilizada dentro de la clase BaseRelationManager para heredar todas las propiedades
     *      que es base a este valor allí se calculan
     */
    protected static MiRelationManagerContract $miRelationManager = MiRelationManager::PLACSP_LOTE;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(LoteTable::class)->getTable($table);
    }

    public function infolist(Schema $schema): Schema
    {

        return app(LoteInfolist::class)->getSchema($schema);
    }
}
