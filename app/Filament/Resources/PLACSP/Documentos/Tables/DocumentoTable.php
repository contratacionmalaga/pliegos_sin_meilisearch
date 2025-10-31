<?php

namespace App\Filament\Resources\PLACSP\Documentos\Tables;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiRelationManager;
use App\Filament\Components\Tables\MiTable;
use App\Filament\Components\Tables\MiTextColumn;
use App\Models\PLACSP\Documento;
use App\Traits\HasCommonColumns;
use Exception;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

readonly class DocumentoTable
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
            ? MiRelationManager::PLACSP_DOCUMENTO
            : MiNavigationItem::PLACSP_DOCUMENTO;

        // Usamos la función pública `getTable` para obtener la tabla configurada
        return $this->miTable->getTable($table, $configurableItem)
            ->columns(
                array_merge(
                    $this->getColumnasComunes($table),
                    [
                        $this->miTextColumn->getBadgeTextColumn('document_reference_type','Tipo de documento'),
                        $this->miTextColumn->getTextColumn('filename', 'Nombre del fichero')
                            ->label('Nombre del fichero')
                            ->badge()
                            ->getStateUsing(function ($record) {

                                // Verificar directamente en el record
                                if (!is_null($record->filename)) {
                                    if (in_array($record->document_reference_type?->value, ['PPT', 'PCAP', 'ADDICIONAL'])) {
                                        return $record->id_document_reference;
                                    }
                                }

                                return $record->filename;
                            }),
//                        $this->miTextColumn->getSearchableSortableTextColumn('id_document_reference','Identificador'),
                    ],
                ))
            ->searchable(!$isRelationManager);

    }
}
