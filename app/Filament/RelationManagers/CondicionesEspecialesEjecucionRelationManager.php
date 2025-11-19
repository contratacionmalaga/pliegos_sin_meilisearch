<?php

namespace App\Filament\RelationManagers;

use App\Contracts\MiRelationManagerContract;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Abstracts\BaseRelationManager;
use App\Filament\Resources\PLACSP\CondicionesEspecialesAdjudicacion\Tables\CondicionEspecialEjecucionTable;
use Exception;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CondicionesEspecialesEjecucionRelationManager extends BaseRelationManager
{
    /**
     * Utilizada dentro de la clase BaseRelationManager para heredar todas las propiedades
     *      que es base a este valor allí se calculan
     */
    protected static MiRelationManagerContract $miRelationManager = MiRelationManager::PLACSP_CONDICION_ESPECIAL_EJECUCION;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(CondicionEspecialEjecucionTable::class)->getTable($table);
    }
}
