<?php

namespace App\Filament\RelationManagers;

use App\Contracts\MiRelationManagerContract;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Abstracts\BaseRelationManager;
use App\Filament\Resources\PLACSP\Documentos\Schemas\DocumentoInfolist;
use App\Filament\Resources\PLACSP\Documentos\Tables\DocumentoTable;
use Exception;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class DocumentosRelationManager extends BaseRelationManager
{
    /**
     * Utilizada dentro de la clase BaseRelationManager para heredar todas las propiedades
     *      que es base a este valor allí se calculan
     */
    protected static MiRelationManagerContract $miRelationManager = MiRelationManager::PLACSP_DOCUMENTO;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(DocumentoTable::class)->getTable($table);
    }

    /**
     * @throws Exception
     */
    public function infolist(Schema $schema): Schema
    {

        return app(DocumentoInfolist::class)->getSchema($schema);
    }
}
