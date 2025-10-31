<?php

namespace App\Filament\Resources\ActivityLogs\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Resources\ActivityLogs\Schemas\ActivityLogInfolist;
use Filament\Schemas\Schema;

class ViewActivityLog extends BaseViewRecord
{
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::ACTIVITY_LOG;

    public function infolist(Schema $schema): Schema
    {

        return new ActivityLogInfolist()->getInfolist($schema);
    }
}
