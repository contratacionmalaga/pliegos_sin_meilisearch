<?php

namespace App\Filament\Resources\PLACSP\ContratosMayores\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Resources\PLACSP\ContratosMayores\Schemas\ContratoMayorInfolist;
use Filament\Schemas\Schema;

class ViewContratoMayor extends BaseViewRecord
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_CONTRATO_MAYOR;


    /**
     * @param Schema $schema
     *
     * @return Schema
     */
    public function infolist(Schema $schema): Schema
    {
        return new ContratoMayorInfolist()->getSchema($schema);
    }
}
