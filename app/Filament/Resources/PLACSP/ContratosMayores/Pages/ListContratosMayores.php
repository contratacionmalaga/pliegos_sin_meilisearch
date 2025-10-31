<?php

namespace App\Filament\Resources\PLACSP\ContratosMayores\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\Placsp\TipoSindicacion;
use App\Filament\Abstracts\BaseListRecords;
use App\Filament\Resources\PLACSP\ContratosMayores\Tables\ContratoMayorTable;
use Exception;
use Filament\Tables\Table;

class ListContratosMayores extends BaseListRecords
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_CONTRATO_MAYOR;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(ContratoMayorTable::class)->getTable($table);
    }

}
