<?php

namespace App\Filament\Resources\PLACSP\Cpvs\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseListRecords;
use App\Filament\Resources\PLACSP\Cpvs\Tables\CpvTable;
use Exception;
use Filament\Tables\Table;

class ListCpvs extends BaseListRecords
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_CPV;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(CpvTable::class)->getTable($table);
    }
}
