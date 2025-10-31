<?php

namespace App\Filament\Components\Tables;

use App\DTOs\TextColumnConfig;
use App\Enums\Constantes\ConstantesFormato;
use App\Enums\Constantes\ConstantesInt;
use App\Enums\Constantes\ConstantesString;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class MiTextColumn_bk_31_10_2025
{
    public function getBadgeTextColumn(string $make, ?string $label = null): TextColumn
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

    public function getBadgeDateTimeTextColumn(string $make, ?string $label = null, ?bool $toggleable = false): TextColumn
    {
        return $this->create(
            new TextColumnConfig(
                make: $make,
                label: $label,
                badge: true,
                sortable: true,
                toggleable: $toggleable,
                datetime: true,
            ),
        )->color(
            getColorByColumnName($make),
        );
    }

    public function getBadgeDateTextColumn(string $make, ?string $label = null, ?bool $toggleable = false): TextColumn
    {
        return $this
            ->create(
                new TextColumnConfig(
                    make: $make,
                    label: $label,
                    badge: true,
                    toggleable: $toggleable,
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

    public function getSearchableSortableTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this->create(new TextColumnConfig(
            make: $make,
            label: $label,
            searchable: true,
            sortable: true
        ));
    }

    public function getLimitableSearchableSortableTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this->create(new TextColumnConfig(
            make: $make,
            label: $label,
            searchable: true,
            sortable: true,
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

    public function getMultilineaTextColumn(string $make, ?string $label = null): TextColumn
    {
        return $this->create(new TextColumnConfig(
            make: $make,
            label: $label,
            searchable: true,
            sortable: true,
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
        $textColumn->label($resolvedLabel);

        if ($config->limitable) {
            $this->applyLimitable($textColumn);
        }

        if ($config->placeholder) {
            $textColumn->placeholder(ConstantesString::NO_FIGURA->value);
        }

        if ($config->badge) {
            $textColumn->badge();
        }

        if ($config->searchable) {
            $textColumn->searchable();
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
            $textColumn->alignment(Alignment::Right);
        }

        if ($config->html) {
            $textColumn->formatStateUsing(fn ($state) => strip_tags($state));
        }

        if ($config->copyable) {
            $textColumn = $this->applyCopyable($textColumn, $config->make);
        }

        return $textColumn;
    }

    private function resolveLabel(TextColumnConfig $config): string|HtmlString
    {
        $label = $config->label ?? __('etiquetas.textcolumn_' . $config->make);
        return is_array($label) ? implode(' ', $label) : $label;


//        if ($config->searchable) {
//            $color = Color::Blue[700];
//
//            return new HtmlString(
//                Blade::render(
//                    sprintf(
//                        '<x-heroicon-o-magnifying-glass class="w-4 h-4 align-middle mr-1" style="color: %s" /> %s',
//                        $color,
//                        e($label),
//                    ),
//                ),
//            );
//        }

//        return $label;
    }


    private function applyLimitable(TextColumn $textColumn): void
    {
        $textColumn->formatStateUsing(function ($state) {
            if (strlen($state) > ConstantesInt::TAMANO_120->value) {
                return substr($state, 0, ConstantesInt::TAMANO_120->value) . '...';
            }
            return $state;
        });

        $textColumn->tooltip(function ($state) {
            if (strlen($state) > ConstantesInt::TAMANO_120->value) {
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
