<?php

namespace App\Filament\Resources\PLACSP\RequisitosPreviosParticipacion\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseListRecords;
use App\Filament\Resources\PLACSP\RequisitosPreviosParticipacion\Tables\RequisitoPrevioParticipacionTable;
use Exception;
use Filament\Tables\Table;

class ListRequisitosPreviosParticipacion extends BaseListRecords
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_REQUISITO_PREVIO_PARTICIPACION;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(RequisitoPrevioParticipacionTable::class)->getTable($table);
    }
}
