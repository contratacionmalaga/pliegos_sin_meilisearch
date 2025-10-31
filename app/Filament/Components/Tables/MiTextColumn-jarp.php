<?php

namespace App\Filament\Components\Tables;

use App\DTOs\TextColumnConfig;
use App\Enums\Constantes\ConstantesFormato;
use App\Enums\Constantes\ConstantesInt;
use App\Enums\Constantes\ConstantesString;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Columns\TextColumn;

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

    public function getBadgeDateTimeTextColumn(string $make, ?string $label = null): TextColumn
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

//    public function getNumericoTextColumn(string $make, ?string $label = null): TextColumn
//    {
//        return $this->create(new TextColumnConfig(
//            make: $make,
//            label: $label,
//            sortable: true,
//            numerico: true
//        ));
//    }

//    public function getDecimalTextColumn(string $make, ?string $label = null): TextColumn
//    {
//        return $this->create(new TextColumnConfig(
//            make: $make,
//            label: $label,
//            sortable: true,
//            decimal: true
//        ));
//    }

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
