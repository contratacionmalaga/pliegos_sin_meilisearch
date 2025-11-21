<?php

namespace App\Filament\Resources\Incidencias;

use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseResourceNavigationItem;
use App\Filament\RelationManagers\RespuestasIncidenciaRelationManager;
use App\Filament\Resources\Incidencias\Pages\ListIncidencias;
use App\Filament\Resources\Incidencias\Pages\ViewIncidencia;
use App\Filament\Resources\Incidencias\Schemas\IncidenciaForm;
use App\Contracts\MiNavigationItemContract;

use Filament\Schemas\Schema;


class IncidenciaResource extends BaseResourceNavigationItem
{


    protected static MiNavigationItemContract $miNavigationItem = MiNavigationItemIncidencias::PLACSP_INCIDENCIA;

    public static function getPages(): array
    {
        return [
            'index' => ListIncidencias::route('/'),
            'view' => ViewIncidencia::route('/{record}/view'),
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
