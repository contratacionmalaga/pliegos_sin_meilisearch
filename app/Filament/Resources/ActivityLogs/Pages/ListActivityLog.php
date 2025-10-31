<?php

namespace App\Filament\Resources\ActivityLogs\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseListRecords;
use App\Filament\Resources\ActivityLogs\Tables\ActivityLogTable;
use Exception;
use Filament\Tables\Table;

class ListActivityLog extends BaseListRecords
{
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::ACTIVITY_LOG;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(ActivityLogTable::class)->getTable($table);
    }
}
