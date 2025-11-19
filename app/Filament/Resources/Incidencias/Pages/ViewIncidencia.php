<?php

namespace App\Filament\Resources\Incidencias\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Resources\Incidencias\Schemas\IncidenciaInfolist;
use Filament\Schemas\Schema;

class ViewIncidencia extends BaseViewRecord
{
    /**
     * @var MiNavigationItem
     */
    protected static \App\Contracts\MiNavigationItemContract $miNavigationItem = MiNavigationItemIncidencias::PLACSP_INCIDENCIA;


    /**
     * @param Schema $schema
     *
     * @return Schema
     */
    public function infolist(Schema $schema): Schema
    {
        return new IncidenciaInfolist()->getSchema($schema);
    }

}
