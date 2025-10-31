<?php

namespace App\Filament\Resources\PLACSP\RequisitosPreviosParticipacion\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Resources\PLACSP\RequisitosPreviosParticipacion\Schemas\RequisitoPrevioParticipacionInfolist;
use Filament\Schemas\Schema;

class ViewRequisitoPrevioParticipacion extends BaseViewRecord
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_REQUISITO_PREVIO_PARTICIPACION;


    /**
     * @param Schema $schema
     *
     * @return Schema
     */
    public function infolist(Schema $schema): Schema
    {

        return new RequisitoPrevioParticipacionInfolist()->getSchema($schema);
    }
}
