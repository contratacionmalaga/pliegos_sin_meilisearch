<?php

namespace App\Filament\Components\Tables;

use App\DTOs\TableConfig;
use Exception;
use Filament\Actions\Action;
use Filament\Support\Enums\Width;
use Filament\Tables\Table;

class MiTable
{

    /**
     * Función pública para obtener la tabla configurada a partir de un objeto de configuración.
     *
     * @throws Exception
     */
    public function getTable(Table $table, $configurableItem): Table
    {
        // Creamos el TableConfig según el tipo de objeto
        $tableConfig = $this->createTableConfig($table, $configurableItem);

        // Ahora aplicamos las configuraciones comunes sobre el TableConfig
        return $this->getTableFromConfig($tableConfig);
    }

    /**
     * Configura el TableConfig basado en el tipo de objeto (MiNavigationItem o MiRelationManager).
     *
     * @throws Exception
     */
    private function createTableConfig(Table $table, $configurableItem): TableConfig
    {
        // Verificamos el número de registros en la tabla
        $n_registros = $table->getQuery()?->count() ?? 0;

        // Configuramos los filtros y searchable según la cantidad de registros
        $filters = $configurableItem->getFilters();
        if ($n_registros === 0) {
            $filters = []; // Limpiamos los filtros si no hay registros
        }

        return new TableConfig(
            table: $table->columns([]),
            heading: ' ',
            description: '',
            searchable: $n_registros !== 0,
            filters: $filters,  // Solo habilitamos los filtros si hay registros
            filterLayout: $configurableItem->getFilterLayout(),
            defaultSort: $configurableItem->getDefaultSort(),
            defaultSortDirection: $configurableItem->getDefaultSortDirection(),
            tableHeaderActions: $configurableItem->getTableHeaderActions(),
            tableBulkActions: $configurableItem->getTableBulkActions(),
            tableRecordActions: $configurableItem->getTableRecordActions(),
        );
    }

    /**
     * Aplica las configuraciones comunes sobre el TableConfig y devuelve el Table.
     *
     * @param TableConfig $config
     * @return Table
     * @throws Exception
     */
    private function getTableFromConfig(TableConfig $config): Table
    {

        // Configuramos la tabla con los parámetros comunes
        $miTable = $config->table
            ->heading($config->heading)
            ->description($config->description)
            ->searchable($config->searchable)
            ->paginated($config->paginationSizes)
            ->striped()
            ->deferLoading();

        // Si hay filtros, los aplicamos
        if (!empty($config->filters)) {
            $miTable->filters($config->filters);
            $miTable->deferFilters();
            $miTable->filtersLayout($config->filterLayout);
            $miTable->filtersFormWidth(Width::TwoExtraLarge);
            $miTable->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->tooltip('Filtros aplicados sobre la tabla')
                    ->slideOver()
                    ->modalHeading('Filtros disponibles')
                    ->label('Filtros')
            );
        }

        // Si hay un sort por defecto, lo aplicamos
        if (!empty($config->defaultSort)) {
            $miTable->defaultSort($config->defaultSort, $config->defaultSortDirection);
        }

        // Si hay acciones en el encabezado, las aplicamos
        if (!empty($config->tableHeaderActions)) {
            $miTable->headerActions($config->tableHeaderActions);
        }

        // Si hay acciones en masa, las aplicamos
        if (!empty($config->tableBulkActions)) {
            $miTable->toolbarActions($config->tableBulkActions);
        }

        // Si hay acciones sobre los registros, las aplicamos
        if (!empty($config->tableRecordActions)) {
            $miTable->recordActions($config->tableRecordActions);
        }

        // Estado vacío (cuando no hay registros)
        $miTable->emptyStateHeading($config->emptyStateHeading);
        $miTable->emptyStateDescription($config->emptyStateDescription);
        if (!empty($config->emptyStateActions)) {
            $miTable->emptyStateActions($config->emptyStateActions);
        }

        return $miTable;
    }
}
