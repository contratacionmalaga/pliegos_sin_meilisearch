<?php

namespace App\Filament\Resources\Incidencias\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Resources\Incidencias\Schemas\IncidenciaSimpleInfolist;
use Filament\Schemas\Schema;

class ViewIncidenciaSimple extends BaseViewRecord
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_INCIDENCIA;

    public function infolist(Schema $schema): Schema
    {
        return new IncidenciaSimpleInfolist()->getSchema($schema);
    }

    /**
     * Forzar que esta vista no muestre RelationManagers.
     *
     * @return array
     */
    public function getRelationManagers(): array
    {
        return [];
    }
}


