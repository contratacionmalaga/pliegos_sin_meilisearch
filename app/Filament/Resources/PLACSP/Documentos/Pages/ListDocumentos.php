<?php

namespace App\Filament\Resources\PLACSP\Documentos\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseListRecords;
use App\Filament\Resources\PLACSP\Documentos\Tables\DocumentoTable;
use Exception;
use Filament\Tables\Table;

class ListDocumentos extends BaseListRecords
{
    /**
     * @var MiNavigationItem
     */
    protected static \App\Contracts\MiNavigationItemContract $miNavigationItem = MiNavigationItem::PLACSP_DOCUMENTO;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(DocumentoTable::class)->getTable($table);
    }
}
