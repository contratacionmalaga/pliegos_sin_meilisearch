<?php

namespace App\Filament\Resources\PLACSP\CondicionesEspecialesAdjudicacion\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\Placsp\PLACSP_TenderResultCode;
use App\Filament\Abstracts\BaseListRecords;
use App\Filament\Resources\PLACSP\Adjudicaciones\Tables\AdjudicacionTable;
use App\Filament\Resources\PLACSP\CondicionesEspecialesAdjudicacion\Tables\CondicionEspecialEjecucionTable;
use App\Models\PLACSP\Adjudicacion;
use Exception;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Colors\Color;
use Filament\Tables\Table;

class ListCondicionesEspecialesEjecucion extends BaseListRecords
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_CONDICION_ESPECIAL_EJECUCION;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(CondicionEspecialEjecucionTable::class)->getTable($table);
    }
}
