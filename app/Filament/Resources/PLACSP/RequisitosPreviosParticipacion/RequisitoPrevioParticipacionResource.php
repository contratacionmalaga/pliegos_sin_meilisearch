<?php

namespace App\Filament\Resources\PLACSP\RequisitosPreviosParticipacion;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseResourceNavigationItem;
use App\Filament\Resources\PLACSP\RequisitosPreviosParticipacion\Pages\ListRequisitosPreviosParticipacion;
use App\Filament\Resources\PLACSP\RequisitosPreviosParticipacion\Pages\ViewRequisitoPrevioParticipacion;
use Filament\Resources\Pages\PageRegistration;

class RequisitoPrevioParticipacionResource extends BaseResourceNavigationItem
{

    /**
     * @var MiNavigationItem
     */
    protected static \App\Contracts\MiNavigationItemContract $miNavigationItem = MiNavigationItem::PLACSP_REQUISITO_PREVIO_PARTICIPACION;

    /**
     * @return array|PageRegistration[]
     */
    public static function getPages(): array
    {
        return [
            'index' => ListRequisitosPreviosParticipacion::route('/'),
//            'view' => ViewRequisitoPrevioParticipacion::route('/{record}/view'),
        ];
    }
}

