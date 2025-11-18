<?php

namespace App\Filament\Resources\PLACSP\Lotes\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseListRecords;
use App\Filament\Resources\PLACSP\Lotes\Tables\LoteTable;
use Exception;
use Filament\Tables\Table;

class ListLotes extends BaseListRecords
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem | MiNavigationItemIncidencias $miNavigationItem = MiNavigationItem::PLACSP_LOTE;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return app(LoteTable::class)->getTable($table);
    }
}
