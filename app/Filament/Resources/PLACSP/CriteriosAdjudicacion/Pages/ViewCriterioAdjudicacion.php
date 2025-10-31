<?php

namespace App\Filament\Resources\PLACSP\CriteriosAdjudicacion\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Resources\PLACSP\CriteriosAdjudicacion\Schemas\CriterioAdjudicacionInfolist;
use Filament\Schemas\Schema;

class ViewCriterioAdjudicacion extends BaseViewRecord
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_CRITERIO_ADJUDICACION;


    /**
     * @param Schema $schema
     *
     * @return Schema
     */
    public function infolist(Schema $schema): Schema
    {

        return new CriterioAdjudicacionInfolist()->getSchema($schema);
    }
}
