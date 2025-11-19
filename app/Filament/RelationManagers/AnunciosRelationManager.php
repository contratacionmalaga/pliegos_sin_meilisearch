<?php

namespace App\Filament\RelationManagers;

use App\Contracts\MiRelationManagerContract;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Abstracts\BaseRelationManager;
use App\Filament\Resources\PLACSP\Anuncios\Schemas\AnuncioInfolist;
use App\Filament\Resources\PLACSP\Anuncios\Tables\AnuncioTable;
use Exception;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class AnunciosRelationManager extends BaseRelationManager
{
    /**
     * Utilizada dentro de la clase BaseRelationManager para heredar todas las propiedades
     *      que es base a este valor allí se calculan
     */
    protected static MiRelationManagerContract $miRelationManager = MiRelationManager::PLACSP_ANUNCIO;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(AnuncioTable::class)->getTable($table);
    }

    /**
     * @throws Exception
     */
    public function infolist(Schema $schema): Schema
    {

        return app(AnuncioInfolist::class)->getSchema($schema);
    }
}
