<?php

namespace App\Filament\Resources\RespuestasIncidencia\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Resources\RespuestasIncidencia\Schemas\RespuestasIncidenciaInfolist;
use Filament\Schemas\Schema;

class ViewRespuestasIncidencia extends BaseViewRecord
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_RESPUESTA_INCIDENCIA;


    /**
     * @param Schema $schema
     *
     * @return Schema
     */
    public function infolist(Schema $schema): Schema
    {
        return new RespuestasIncidenciaInfolist()->getSchema($schema);
    }
}
