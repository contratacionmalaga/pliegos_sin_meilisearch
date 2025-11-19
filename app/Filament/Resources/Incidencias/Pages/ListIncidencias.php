<?php

namespace App\Filament\Resources\Incidencias\Pages;

use App\Contracts\MiNavigationItemContract;
use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseListRecords;
use App\Filament\Resources\Incidencias\Tables\IncidenciaTable;
use Exception;
use Filament\Tables\Table;

class ListIncidencias extends BaseListRecords
{
    /**
     * @var MiNavigationItemContract
     */
    protected static MiNavigationItemContract $miNavigationItem = MiNavigationItemIncidencias::PLACSP_INCIDENCIA;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(IncidenciaTable::class)->getTable($table);
    }

}
