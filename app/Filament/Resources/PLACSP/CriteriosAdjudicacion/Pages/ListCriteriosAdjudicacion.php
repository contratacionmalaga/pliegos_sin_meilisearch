<?php

namespace App\Filament\Resources\PLACSP\CriteriosAdjudicacion\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Enums\Placsp\PLACSP_AwardingCriteriaCode;
use App\Filament\Abstracts\BaseListRecords;
use App\Filament\Resources\PLACSP\CriteriosAdjudicacion\Tables\CriterioAdjudicacionTable;
use App\Models\PLACSP\CriterioAdjudicacion;
use Exception;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Colors\Color;
use Filament\Tables\Table;

class ListCriteriosAdjudicacion extends BaseListRecords
{
    /**
     * @var MiNavigationItem
     */
    protected static \App\Contracts\MiNavigationItemContract $miNavigationItem = MiNavigationItem::PLACSP_CRITERIO_ADJUDICACION;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(CriterioAdjudicacionTable::class)->getTable($table);
    }

}
