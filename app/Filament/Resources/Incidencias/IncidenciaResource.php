<?php

namespace App\Filament\Resources\Incidencias;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseResourceNavigationItem;
use App\Filament\RelationManagers\RespuestasIncidenciaRelationManager;
use App\Filament\Resources\Incidencias\Pages\ListIncidencias;
use App\Filament\Resources\Incidencias\Schemas\IncidenciaForm;


use Filament\Schemas\Schema;

class IncidenciaResource extends BaseResourceNavigationItem
{

    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_INCIDENCIA;

    public static function getPages(): array
    {
        return [
            'index' => ListIncidencias::route('/'),
//            'view' => ViewIncidencia::route('/{record}/view'),
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return new IncidenciaForm()->getForm($schema);
    }

    /**
     * @return class-string[]
     */
    public static function getRelations(): array
    {

        return [
            RespuestasIncidenciaRelationManager::class,

        ];
    }
}
