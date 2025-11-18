<?php

namespace App\Filament\Resources\PLACSP\Anuncios\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseListRecords;
use App\Filament\Resources\PLACSP\Anuncios\Tables\AnuncioTable;
use Exception;
use Filament\Tables\Table;

class ListAnuncios extends BaseListRecords
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem | MiNavigationItemIncidencias $miNavigationItem = MiNavigationItem::PLACSP_ANUNCIO;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(AnuncioTable::class)->getTable($table);
    }
}
