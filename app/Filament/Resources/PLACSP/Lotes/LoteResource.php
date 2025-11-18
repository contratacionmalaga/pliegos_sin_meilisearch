<?php

namespace App\Filament\Resources\PLACSP\Lotes;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseResourceNavigationItem;
use App\Filament\Resources\PLACSP\Lotes\Pages\ListLotes;
use Filament\Resources\Pages\PageRegistration;

class LoteResource extends BaseResourceNavigationItem
{

    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem | MiNavigationItemIncidencias $miNavigationItem = MiNavigationItem::PLACSP_LOTE;

    /**
     * @return array|PageRegistration[]
     */
    public static function getPages(): array
    {
        return [
            'index' => ListLotes::route('/'),
        ];
    }
}

