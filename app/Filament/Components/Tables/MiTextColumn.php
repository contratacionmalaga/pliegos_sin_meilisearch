<?php

namespace App\Filament\Components\Tables;

use App\DTOs\TextColumnConfig;
use App\Enums\Constantes\ConstantesFormato;
use App\Enums\Constantes\ConstantesInt;
use App\Enums\Constantes\ConstantesString;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\HtmlString;

class MiTextColumn
{
    public function getBadgeSortableTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this
            ->create(
                new TextColumnConfig(
                    make: $make,
                    label: $label,
                    badge: true,
                    sortable: true
                ));
    }

    public function getBadgeTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this
            ->create(
                new TextColumnConfig(
                    make: $make,
                    label: $label,
                    badge: true,
                ));
    }

    public function getBadgeSearchableTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this
            ->create(
                new TextColumnConfig(
                    make: $make,
                    label: $label,
                    badge: true,
                    searchable: true,
                ));
    }

    public function getBadgeFiltrableTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this
            ->create(
                new TextColumnConfig(
                    make: $make,
                    label: $label,
                    badge: true,
                    filtrable: true,
                ));
    }

    public function getTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this->create(
            new TextColumnConfig(
                make: $make,
                label: $label,
            ),
        );
    }

    public function getEmailTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this->create(
            new TextColumnConfig(
                make: $make,
                label: $label,
                badge: true,
                searchable: true,
                sortable: true,
                copyable: true,
            ),
        );
    }

    public function getBadgeDateTimeFiltrableTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this->create(
            new TextColumnConfig(
                make: $make,
                label: $label,
                badge: true,
                datetime: true,
                filtrable: true,
            ),
        )->color(
            getColorByColumnName($make),
        );
    }

    public function getBadgeDateTimeSortableTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this->create(
            new TextColumnConfig(
                make: $make,
                label: $label,
                badge: true,
                sortable: true,
                datetime: true,
            ),
        )->color(
            getColorByColumnName($make),
        );
    }

    public function getBadgeDateTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this
            ->create(
                new TextColumnConfig(
                    make: $make,
                    label: $label,
                    badge: true,
                    sortable: true,
                    date: true
                ))
            ->color(
                getColorByColumnName($make)
            );
    }

    public function getSearchableTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this->create(new TextColumnConfig(
            make: $make,
            label: $label,
            searchable: true
        ));
    }

    public function getLimitableSearchableTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this->create(new TextColumnConfig(
            make: $make,
            label: $label,
            searchable: true,
            multilinea: true,
            limitable: true,
        ));
    }

    public function getMoneyTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this->create(new TextColumnConfig(
            make: $make,
            label: $label,
            money: true,
            sortable: true
        ))
            ->default('0');
    }

    public function getNumericoTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this->create(new TextColumnConfig(
            make: $make,
            label: $label,
            sortable: true,
            numerico: true
        ));
    }

    public function getDecimalTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this->create(new TextColumnConfig(
            make: $make,
            label: $label,
            sortable: true,
            decimal: true
        ));
    }

    public function getMultilineaTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this->create(new TextColumnConfig(
            make: $make,
            label: $label,
            searchable: true,
            multilinea: true
        ));
    }

    public function getSortableTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this->create(new TextColumnConfig(
            make: $make,
            label: $label,
            sortable: true
        ));
    }

    /**
     * Constructor del TextColumn.
     */
    private function create(TextColumnConfig $config): TextColumn
    {
        $textColumn = TextColumn::make($config->make);
        $resolvedLabel = $this->resolveLabel($config);
        $textColumn->wrapHeader();

        if ($config->limitable) {
            $this->applyLimitable($textColumn);
        }

        if ($config->placeholder) {
            $textColumn->placeholder(ConstantesString::NO_FIGURA->value);
        }

        if ($config->badge) {
            $textColumn->badge();
        }

        // Aplicar searchable ANTES de modificar el label
        if ($config->searchable) {
            $textColumn->searchable();
        }

        // Combinar lógica de iconos para searchable y filtrable
        if ($config->searchable || $config->filtrable) {
            $textColumn->label(function () use ($resolvedLabel, $config) {
                $icons = '';

                // Icono de búsqueda
                if ($config->searchable) {
                    $icons .=
                        '<div 
                            x-tooltip="{
                                content: \'Esta columna permite búsquedas\',
                                onShow(instance) { 
                                    const box = instance.popper.querySelector(\'.tippy-box\');
                                    if (box) {
                                        box.style.backgroundColor = \'white\';
                                        box.style.color = \'black\';
                                        box.style.border = \'1px solid #e5e7eb\';
                                        box.style.boxShadow = \'0 2px 6px rgba(0,0,0,0.1)\';
                                    }
                                }
                            }"
                            style="display: flex; align-items: center;"
                        >
                            <svg style="width: 16px; height: 16px; color: rgb(156, 163, 175); flex-shrink: 0; cursor: help;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>';
                }

                // Icono de filtro
                if ($config->filtrable) {
                    $icons .= '<div 
            x-data="{}" 
            x-tooltip="{
                content: \'Esta columna permite filtros\',
                onShow(instance) { 
                    const box = instance.popper.querySelector(\'.tippy-box\');
                    if (box) {
                        box.style.backgroundColor = \'white\';
                        box.style.color = \'black\';
                        box.style.border = \'1px solid #e5e7eb\';
                        box.style.boxShadow = \'0 2px 6px rgba(0,0,0,0.1)\';
                    }
                }
            }"
            style="display: flex; align-items: center;"
        >
            <svg style="width: 16px; height: 16px; color: rgb(156, 163, 175); flex-shrink: 0; cursor: help;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
            </svg>
        </div>';
                }

                // Icono de búsqueda
                //                if ($config->searchable) {
                //                    $icons .= '<div x-data="{}" x-tooltip="\'Esta columna permite búsquedas\'" style="display: flex; align-items: center;">'.
                //                        '<svg style="width: 16px; height: 16px; color: rgb(156, 163, 175); flex-shrink: 0; cursor: help;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">'.
                //                        '<path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />'.
                //                        '</svg>'.
                //                        '</div>';
                //                }
                //
                //                // Icono de filtro
                //                if ($config->filtrable) {
                //                    $icons .= '<div x-data="{}" x-tooltip="\'Esta columna permite filtros\'" style="display: flex; align-items: center;">'.
                //                        '<svg style="width: 16px; height: 16px; color: rgb(156, 163, 175); flex-shrink: 0; cursor: help;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">'.
                //                        '<path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />'.
                //                        '</svg>'.
                //                        '</div>';
                //                }

                return new HtmlString(
                    '<div style="display: flex; align-items: center; gap: 0.5rem;">'.
                    $icons.
                    '<span>'.e($resolvedLabel).'</span>'.
                    '</div>'
                );
            });
        } else {
            $textColumn->label($resolvedLabel);
        }

        if ($config->sortable) {
            $textColumn->sortable();
        }

        if ($config->toggleable) {
            $textColumn->toggleable(isToggledHiddenByDefault: true);
        }

        if ($config->multilinea) {
            $textColumn->wrap();
        } else {
            $textColumn->limit(ConstantesInt::TAMANO_120->value);
        }

        if ($config->date) {
            $textColumn->date(ConstantesFormato::FORMATO_FECHA_CORTA->value);
        }

        if ($config->datetime) {
            $textColumn->date(ConstantesFormato::FORMATO_FECHA_HORA_CORTA->value);
        }

        if ($config->money) {
            $textColumn->formatStateUsing(fn ($state) => number_format($state, 2, ',', '.').' €');
            $textColumn->alignment(Alignment::End);
        }

        if ($config->numerico) {
            $textColumn->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'));
            $textColumn->alignment(Alignment::End);
        }

        if ($config->decimal) {
            $textColumn->formatStateUsing(fn ($state) => number_format($state, 2, ',', '.'));
            $textColumn->alignment(Alignment::End);
        }

        if ($config->html) {
            $textColumn->formatStateUsing(fn ($state) => strip_tags($state));
        }

        if ($config->copyable) {
            $textColumn = $this->applyCopyable($textColumn, $config->make);
        }

        return $textColumn;
    }

    private function resolveLabel(TextColumnConfig $config): string
    {
        $label = $config->label ?? __('etiquetas.textcolumn_'.$config->make);

        return is_array($label) ? implode(' ', $label) : $label;
    }

    private function applyLimitable(TextColumn $textColumn): void
    {
        $textColumn->formatStateUsing(function ($state) {
            if (strlen($state) > ConstantesInt::TAMANO_100->value) {
                return substr($state, 0, ConstantesInt::TAMANO_100->value).'...';
            }

            return $state;
        });

        $textColumn->tooltip(function ($state) {
            if (strlen($state) > ConstantesInt::TAMANO_100->value) {
                return $state;
            }

            return null;
        });
    }

    /**
     * TextEntry con botón de copiar al portapapeles.
     */
    private function applyCopyable(TextColumn $textColum, string $make): TextColumn
    {
        return $textColum
            ->icon('heroicon-o-clipboard-document')
            ->iconColor(Color::Blue)
            ->tooltip(function ($record) use ($make) {
                $valor = data_get($record, $make);

                return $valor !== null
                    ? 'Pulsar para copiar al portapapeles'
                    : null;
            })
            ->copyable(fn ($record) => (string) $record->getAttribute($make))
            ->copyMessage('Texto copiado!')
            ->copyMessageDuration(5000);
    }
}
