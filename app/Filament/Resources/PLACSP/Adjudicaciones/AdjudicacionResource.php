<?php

namespace App\Filament\Resources\PLACSP\Adjudicaciones;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseResourceNavigationItem;
use App\Filament\Resources\PLACSP\Adjudicaciones\Pages\ListAdjudicaciones;
use App\Filament\RelationManagers\AnunciosRelationManager;
use App\Filament\RelationManagers\DocumentosRelationManager;
use Filament\Resources\Pages\PageRegistration;

class AdjudicacionResource extends BaseResourceNavigationItem
{

    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_ADJUDICACION;

    /**
     * @return array|PageRegistration[]
     */
    public static function getPages(): array
    {
        return [
            'index' => ListAdjudicaciones::route('/'),
        ];
    }

    /**
     * @return class-string[]
     */
    public static function getRelations(): array
    {

        return [
            DocumentosRelationManager::class,
            AnunciosRelationManager::class
        ];
    }


}

