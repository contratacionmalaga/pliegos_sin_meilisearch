<?php

namespace App\Filament\Resources\Incidencias\Tables;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Components\Tables\MiTable;
use App\Filament\Components\Tables\MiTextColumn;
use App\Models\PLACSP\ContratoMayor;
use App\Traits\HasCommonColumns;
use Exception;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

readonly class IncidenciaTable
{

    use HasCommonColumns;

    public function __construct(
        private MiTable      $miTable,
        private MiTextColumn $miTextColumn,
    )
    {
        // Constructor vacío
    }

    /**
     * @throws Exception
     */
    public function getTable(Table $table): Table
    {

        $isRelationManager = $table->getLivewire() instanceof RelationManager;

        // Determinamos el tipo de configuración que se debe aplicar
        $configurableItem = $isRelationManager
            ? MiRelationManager::PLACSP_INCIDENCIA
            : MiNavigationItem::PLACSP_INCIDENCIA;

        // Usamos la función pública `getTable` para obtener la tabla configurada
        return $this->miTable->getTable($table, $configurableItem)
            ->columns([
//                        $this->miTextColumn->getMoneyTextColumn('total_amount', 'Importe c/iva'),
//                        $this->miTextColumn->getSearchableTextColumn('contract_folder_id', 'Expediente'),
//                        $this->miTextColumn->getLimitableSearchableTextColumn('name_objeto', 'Objeto del contrato'),
//                        $this->miTextColumn->getMultilineaTextColumn('party_name_organo_contratacion', 'Órgano de contratación'),
//                        $this->miTextColumn->getBadgeFiltrableTextColumn('contract_folder_status_code', 'Estado'),
//                        $this->miTextColumn->getBadgeFiltrableTextColumn('type_code'),
//                        $this->miTextColumn->getBadgeFiltrableTextColumn('procedure_code'),

                        $this->miTextColumn->getSearchableTextColumn('id', 'id'),
                        $this->miTextColumn->getSearchableTextColumn('titulo', 'titulo'),
                        $this->miTextColumn->getSearchableTextColumn('descripcion', 'descripcion'),
                        $this->miTextColumn->getSearchableTextColumn('email', 'email'),
                        $this->miTextColumn->getSearchableTextColumn('estado', 'estado'),
                        $this->miTextColumn->getSearchableTextColumn('incidenciable_id', 'incidenciable_id'),
                        $this->miTextColumn->getSearchableTextColumn('incidenciable_type', 'incidenciable_type'),
                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('created_at', 'created_at'),
                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('updated_at', 'updated_at'),
                        $this->miTextColumn->getBadgeDateTimeSortableTextColumn('deleted_at', 'deleted_at'),
//                        $this->miTextColumn->getSearchableTextColumn('created_by', 'created_by'),
//                        $this->miTextColumn->getSearchableTextColumn('updated_by', 'updated_by'),
//                        $this->miTextColumn->getSearchableTextColumn('deleted_by', 'deleted_by'),

                    ])
            ->searchable(true);
//            ->searchable(!$isRelationManager);
    }
}
