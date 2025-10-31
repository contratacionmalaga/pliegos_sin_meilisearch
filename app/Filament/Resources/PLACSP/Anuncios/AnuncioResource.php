<?php

namespace App\Filament\Resources\PLACSP\Anuncios;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseResourceNavigationItem;
use App\Filament\Resources\PLACSP\Anuncios\Pages\ListAnuncios;
use App\Filament\Resources\PLACSP\Anuncios\Pages\ViewAnuncio;
use Filament\Resources\Pages\PageRegistration;

class AnuncioResource extends BaseResourceNavigationItem
{

    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_ANUNCIO;

    /**
     * @return array|PageRegistration[]
     */
    public static function getPages(): array
    {
        return [
            'index' => ListAnuncios::route('/'),
//            'view' => ViewAnuncio::route('/{record}/view'),
        ];
    }
}

