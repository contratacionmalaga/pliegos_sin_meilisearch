<?php

namespace App\Filament\Resources\RespuestasIncidencia\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseListRecords;
use App\Filament\Resources\RespuestasIncidencia\Tables\RespuestasIncidenciaTable;
use Exception;
use Filament\Tables\Table;

class ListRespuestasIncidencia extends BaseListRecords
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_RESPUESTAS_INCIDENCIA;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(RespuestasIncidenciaTable::class)->getTable($table);
    }

}
