<?php

namespace App\DTOs;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class TableConfig
{
    /**
     * @param Table $table
     * @param string $heading
     * @param string $description
     * @param bool $searchable
     * @param array<string, mixed> $filters
     * @param FiltersLayout $filterLayout
     * @param string $defaultSort
     * @param string $defaultSortDirection
     * @param array<Action>|ActionGroup $tableHeaderActions
     * @param array<BulkAction>|ActionGroup $tableBulkActions
     * @param array|ActionGroup $tableRecordActions
     * @param array<int> $paginationSizes
     * @param string|null $emptyStateHeading
     * @param string|null $emptyStateDescription
     * @param array<Action> $emptyStateActions
     */
    public function __construct(
        public Table                $table,
        public string               $heading,
        public string               $description,
        public bool                 $searchable = true,
        public array                $filters = [],
        public FiltersLayout        $filterLayout = FiltersLayout::AboveContent,
        public string               $defaultSort = '',
        public string               $defaultSortDirection = '',
        public array|ActionGroup    $tableHeaderActions = [],
        public array|ActionGroup    $tableBulkActions = [],
        public array|ActionGroup    $tableRecordActions = [],
        public array                $paginationSizes = [10, 25],
        public ?string              $emptyStateHeading = 'Sin resultados',
        public ?string              $emptyStateDescription = 'No se encontraron registros para mostrar.',
        public array                $emptyStateActions = [],
    ) {}
}

