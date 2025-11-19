<?php

namespace App\Filament\RelationManagers;

use App\Contracts\MiRelationManagerContract;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Abstracts\BaseRelationManager;
use App\Filament\Resources\PLACSP\RequisitosPreviosParticipacion\Schemas\RequisitoPrevioParticipacionInfolist;
use App\Filament\Resources\PLACSP\RequisitosPreviosParticipacion\Tables\RequisitoPrevioParticipacionTable;
use Exception;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class RequisitosPreviosParticipacionRelationManager extends BaseRelationManager
{
    /**
     * Utilizada dentro de la clase BaseRelationManager para heredar todas las propiedades
     *      que es base a este valor allí se calculan
     */
    protected static MiRelationManagerContract $miRelationManager = MiRelationManager::PLACSP_REQUISITO_PREVIO_PARTICIPACION;

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {

        return app(RequisitoPrevioParticipacionTable::class)->getTable($table);
    }

    public function infolist(Schema $schema): Schema
    {

        return app(RequisitoPrevioParticipacionInfolist::class)->getSchema($schema);
    }
}
