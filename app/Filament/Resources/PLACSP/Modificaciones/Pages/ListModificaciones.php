<?php

namespace App\Filament\Resources\PLACSP\Modificaciones\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseListRecords;
use App\Filament\Resources\PLACSP\Modificaciones\Tables\ModificacionTable;
use Exception;
use Filament\Tables\Table;

class ListModificaciones extends BaseListRecords
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_MODIFICACION;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(ModificacionTable::class)->getTable($table);
    }
}
