<?php

namespace App\Filament\Resources\PLACSP\CondicionesEspecialesAdjudicacion;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseResourceNavigationItem;
use App\Filament\Resources\PLACSP\CondicionesEspecialesAdjudicacion\Pages\ListCondicionesEspecialesEjecucion;
use Filament\Resources\Pages\PageRegistration;

class CondicionEspecialEjecucionResource extends BaseResourceNavigationItem
{

    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_CONDICION_ESPECIAL_EJECUCION;

    /**
     * @return array|PageRegistration[]
     */
    public static function getPages(): array
    {
        return [
            'index' => ListCondicionesEspecialesEjecucion::route('/'),
        ];
    }
}

