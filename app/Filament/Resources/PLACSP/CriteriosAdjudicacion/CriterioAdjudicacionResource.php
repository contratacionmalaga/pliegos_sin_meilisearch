<?php

namespace App\Filament\Resources\PLACSP\CriteriosAdjudicacion;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseResourceNavigationItem;
use App\Filament\Resources\PLACSP\CriteriosAdjudicacion\Pages\ListCriteriosAdjudicacion;
use App\Filament\Resources\PLACSP\CriteriosAdjudicacion\Pages\ViewCriterioAdjudicacion;
use Filament\Resources\Pages\PageRegistration;

class CriterioAdjudicacionResource extends BaseResourceNavigationItem
{

    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_CRITERIO_ADJUDICACION;

    /**
     * @return array|PageRegistration[]
     */
    public static function getPages(): array
    {
        return [
            'index' => ListCriteriosAdjudicacion::route('/'),
//            'view' => ViewCriterioAdjudicacion::route('/{record}/view'),
        ];
    }
}

