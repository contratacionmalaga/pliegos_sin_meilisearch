<?php

namespace App\Filament\Resources\PLACSP\ContratosMayores;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseResourceNavigationItem;
use App\Filament\RelationManagers\IncidenciasRelationManager;
use App\Filament\Resources\PLACSP\ContratosMayores\Pages\ListContratosMayores;
use App\Filament\Resources\PLACSP\ContratosMayores\Pages\ViewContratoMayor;
use App\Filament\RelationManagers\AdjudicacionesRelationManager;
use App\Filament\RelationManagers\AnunciosRelationManager;
use App\Filament\RelationManagers\CondicionesEspecialesEjecucionRelationManager;
use App\Filament\RelationManagers\CriteriosAdjudicacionRelationManager;
use App\Filament\RelationManagers\DocumentosRelationManager;
use App\Filament\RelationManagers\LotesRelationManager;
use App\Filament\RelationManagers\ModificacionesRelationManager;
use App\Filament\RelationManagers\RequisitosPreviosParticipacionRelationManager;

class ContratoMayorResource extends BaseResourceNavigationItem
{

    /**
     * @var MiNavigationItem
     */
    protected static \App\Contracts\MiNavigationItemContract $miNavigationItem = MiNavigationItem::PLACSP_CONTRATO_MAYOR;

    public static function getPages(): array
    {
        return [
            'index' => ListContratosMayores::route('/'),
            'view' => ViewContratoMayor::route('/{record}/view'),
        ];
    }

    /**
     * @return class-string[]
     */
    public static function getRelations(): array
    {

        return [
            LotesRelationManager::class,
            RequisitosPreviosParticipacionRelationManager::class,
            CriteriosAdjudicacionRelationManager::class,
            CondicionesEspecialesEjecucionRelationManager::class,
            AnunciosRelationManager::class,
            DocumentosRelationManager::class,
            AdjudicacionesRelationManager::class,
            ModificacionesRelationManager::class,
            IncidenciasRelationManager::class,
        ];
    }
}
