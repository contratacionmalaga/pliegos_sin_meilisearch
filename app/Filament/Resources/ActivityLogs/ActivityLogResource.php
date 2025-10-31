<?php

namespace App\Filament\Resources\ActivityLogs;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseResourceNavigationItem;
use App\Filament\Resources\ActivityLogs\Pages\ListActivityLog;
use App\Filament\Resources\ActivityLogs\Pages\ViewActivityLog;

class ActivityLogResource extends BaseResourceNavigationItem
{
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::ACTIVITY_LOG;

    public static function getPages(): array
    {
        return [
            'index' => ListActivityLog::route('/'),
            'view' => ViewActivityLog::route('/{record}/view'),
        ];
    }
}
