<?php

namespace App\Filament\Resources\PLACSP\Modificaciones\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Resources\PLACSP\Modificaciones\Schemas\ModificacionInfolist;
use Filament\Schemas\Schema;

class ViewModificacion extends BaseViewRecord
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem | MiNavigationItemIncidencias $miNavigationItem = MiNavigationItem::PLACSP_MODIFICACION;


    /**
     * @param Schema $schema
     *
     * @return Schema
     */
    public function infolist(Schema $schema): Schema
    {

        return new ModificacionInfolist()->getSchema($schema);
    }
}
