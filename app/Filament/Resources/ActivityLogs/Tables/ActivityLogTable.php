<?php

namespace App\Filament\Resources\ActivityLogs\Tables;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Components\Tables\MiTable;
use App\Filament\Components\Tables\MiTextColumn;
use Exception;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Spatie\Activitylog\Models\Activity;

readonly class ActivityLogTable
{

    public function __construct(
        private MiTable      $miTable,
        private MiTextColumn $miTextColumn,
    ) {}

    /**
     * @throws Exception
     */
    public function getTable(Table $table): Table
    {

        $isRelationManager = $table->getLivewire() instanceof RelationManager;

        // Determinamos el tipo de configuración que se debe aplicar
        $configurableItem = $isRelationManager
            ? MiRelationManager::ACTIVITY
            : MiNavigationItem::ACTIVITY_LOG;

        // Usamos la función pública `getTable` para obtener la tabla configurada
        $builder = $this->miTable->getTable($table, $configurableItem);

        return $builder
            ->columns($this->buildColumns(includeSubject: !$isRelationManager, includeCauser: $isRelationManager));
    }

    /**
     * Construye las columnas comunes + opcionales según parámetros
     *
     * @param bool $includeSubject
     * @param bool $includeCauser
     * @return array<int, TextColumn>
     */
    private function buildColumns(bool $includeSubject, bool $includeCauser): array
    {
        $columns = [];

        /*
         * Columnas comunes a todas las tablas
         */
        $columns[] = $this->miTextColumn->getBadgeTextColumn('event');
        $columns[] = $this->miTextColumn->getSearchableSortableTextColumn('description');

        /*
         * Columnas de causer (si aplica)
         */
        if ($includeCauser) {
            $columns[] = $this->miTextColumn->getSearchableTextColumn('causer_id')
                ->getStateUsing(function (Activity $record) {
                    if (!is_null($record->causer_type)) {
                        return resolveCauserLabelByType(
                            $record->getAttribute('causer_type'),
                            $record->getAttribute('causer_id')
                        );
                    }
                    return null;
                });
        }

        /*
         * Columnas de subject (si aplica)
         */
        if ($includeSubject) {
            $columns[] = $this->miTextColumn->getSortableTextColumn('subject_type');
            $columns[] = $this->miTextColumn->getSearchableTextColumn('subject_id')
                ->getStateUsing(function (Activity $record) {
                    if (! is_null($record->getAttribute('subject_type'))) {
                        return resolveSubjectLabelByType(
                            $record->getAttribute('subject_type'),
                            $record->getAttribute('subject_id')
                        );
                    }
                    return null;
                });
        }



        /*
         * Columna final: fecha de creación
         */
        $columns[] = $this->miTextColumn->getBadgeDateTimeTextColumn('created_at');

        return $columns;
    }
}
