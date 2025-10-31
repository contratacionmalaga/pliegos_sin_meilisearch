<?php

namespace App\Filament\Resources\PLACSP\Cpvs;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseResourceNavigationItem;
use App\Filament\Resources\PLACSP\Cpvs\Pages\ListCpvs;
use Filament\Resources\Pages\PageRegistration;

class CpvResource extends BaseResourceNavigationItem
{

    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_CPV;

    /**
     * @return array|PageRegistration[]
     */
    public static function getPages(): array
    {
        return [
            'index' => ListCpvs::route('/'),
        ];
    }
}

