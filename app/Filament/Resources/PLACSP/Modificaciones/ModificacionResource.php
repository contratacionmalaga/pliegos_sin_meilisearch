<?php

namespace App\Filament\Resources\PLACSP\Modificaciones;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseResourceNavigationItem;
use App\Filament\Resources\PLACSP\Modificaciones\Pages\ListModificaciones;

class ModificacionResource extends BaseResourceNavigationItem
{

    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem | MiNavigationItemIncidencias $miNavigationItem = MiNavigationItem::PLACSP_MODIFICACION;

    public static function getPages(): array
    {
        return [
            'index' => ListModificaciones::route('/'),
        ];
    }
}
