<?php

namespace App\Filament\Resources\PLACSP\Adjudicaciones\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Resources\PLACSP\Adjudicaciones\Schemas\AdjudicacionInfolist;
use Filament\Schemas\Schema;

class ViewAdjudicacion extends BaseViewRecord
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem | MiNavigationItemIncidencias $miNavigationItem = MiNavigationItem::PLACSP_ADJUDICACION;


    /**
     * @param Schema $schema
     *
     * @return Schema
     */
    public function infolist(Schema $schema): Schema
    {

        return new AdjudicacionInfolist()->getSchema($schema);
    }
}
