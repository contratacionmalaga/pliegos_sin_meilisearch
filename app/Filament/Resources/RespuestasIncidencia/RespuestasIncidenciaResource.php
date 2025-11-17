<?php

namespace App\Filament\Resources\RespuestasIncidencia;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseResourceNavigationItem;
use App\Filament\Resources\Incidencias\Pages\ViewIncidencia;
use App\Filament\Resources\RespuestasIncidencia\Pages\ListRespuestasIncidencia;
use App\Filament\Resources\RespuestasIncidencia\Pages\ViewRespuestasIncidencia;
use App\Filament\Resources\RespuestasIncidencia\Schemas\RespuestasIncidenciaForm;


use Filament\Schemas\Schema;

class RespuestasIncidenciaResource extends BaseResourceNavigationItem
{

    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_RESPUESTAS_INCIDENCIA;

    public static function getPages(): array
    {
        return [
            'index' => ListRespuestasIncidencia::route('/'),
            'view' => ViewRespuestasIncidencia::route('/{record}/view'),
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return new RespuestasIncidenciaForm()->getForm($schema);
    }

    /**
     * @return class-string[]
     */
    public static function getRelations(): array
    {

        return [
//            LotesRelationManager::class,

        ];
    }
}
