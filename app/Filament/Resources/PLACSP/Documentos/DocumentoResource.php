<?php

namespace App\Filament\Resources\PLACSP\Documentos;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseResourceNavigationItem;
use App\Filament\Resources\PLACSP\Documentos\Pages\ListDocumentos;
use App\Filament\Resources\PLACSP\Documentos\Pages\ViewDocumento;
use Filament\Resources\Pages\PageRegistration;

class DocumentoResource extends BaseResourceNavigationItem
{

    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem | MiNavigationItemIncidencias $miNavigationItem = MiNavigationItem::PLACSP_DOCUMENTO;

    /**
     * @return array|PageRegistration[]
     */
    public static function getPages(): array
    {

        return [
            'index' => ListDocumentos::route('/'),
//            'view' => ViewDocumento::route('/{record}/view'),
        ];
    }
}

