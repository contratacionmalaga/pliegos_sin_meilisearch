<?php

namespace App\Filament\Components\Infolists;

use App\DTOs\TextEntryConfig;
use App\Enums\Constantes\ConstantesFormato;
use App\Enums\Constantes\ConstantesString;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class MiTextEntry
{
    /**
     * TextEntry genérico (sin opciones adicionales).
     */
    public function getEmailTextEntry(string $make, int $columnSpan, ?string $label = null): TextEntry
    {
        return $this->create(new TextEntryConfig(
            make: $make,
            columnSpan: $columnSpan,
            label: $label,
            badge: true,
            copyable: true
        ))->formatStateUsing(fn ($state) => Str::lower($state));
    }

    /**
     * TextEntry genérico (sin opciones adicionales).
     */
    public function getTextEntry(string $make, int $columnSpan, ?string $label = null): TextEntry
    {
        return $this->create(new TextEntryConfig(
            make: $make,
            columnSpan: $columnSpan,
            label: $label
        ));
    }

    /**
     * TextEntry genérico (sin opciones adicionales).
     */
    public function getNifTextEntry(string $make, int $columnSpan, ?string $label = null): TextEntry
    {
        return $this->create(new TextEntryConfig(
            make: $make,
            columnSpan: $columnSpan,
            label: $label,
        ))
            ->icon('heroicon-o-eye')
            ->iconColor(Color::Blue)
            ->tooltip('Haz clic para ver el NIF')
            ->action(
                Action::make('ver-nif')
                    ->modalWidth(Width::Small)
                    ->modalHeading('Ver NIF Completo')
                    ->modalDescription(function ($record) {
                        // Registrar actividad correctamente:
                        // - `by()` → quién hace la acción (el usuario actual)
                        // - `on()` → sobre qué modelo se realiza (el modelo que contiene el NIF)
                        // - `withProperties()` → información adicional

                        return new HtmlString('NIF del usuario: <b>' . $record->nif . '</b>');
                    })
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false))
            ->formatStateUsing(fn($state) => $this->ofuscarNif($state));
    }

    /**
     * TextEntry genérico (sin opciones adicionales).
     */
    public function getCopyableTextEntry(string $make, int $columnSpan, ?string $label = null): TextEntry
    {
        return $this->create(new TextEntryConfig(
            make: $make,
            columnSpan: $columnSpan,
            label: $label,
            copyable: true
        ));
    }

    /**
     * TextEntry genérico (sin opciones adicionales).
     */
    public function getLinkTextEntry(string $make, int $columnSpan, ?string $label = null): TextEntry
    {
        return $this->create(new TextEntryConfig(
            make: $make,
            columnSpan: $columnSpan,
            label: $label,
            link: true
        ));
    }

    /**
     * TextEntry con badge.
     */
    public function getBadgeTextEntry(string $make, int $columnSpan, ?string $label = null): TextEntry
    {
        return $this->create(new TextEntryConfig(
            make: $make,
            columnSpan: $columnSpan,
            label: $label,
            badge: true
        ));
    }

    /**
     * TextEntry con fecha (badge opcional).
     */
    public function getBadgeDateTextEntry(string $make, int $columnSpan, ?array $color = null, ?string $label = null): TextEntry
    {
        $textEntry = $this->create(new TextEntryConfig(
            make: $make,
            columnSpan: $columnSpan,
            label: $label,
            badge: true,
            dateFormat: ConstantesFormato::FORMATO_FECHA_LARGA->value
        ));

        if (is_null($color)) {
            return $textEntry->color(getColorByColumnName($make));
        }

        return $textEntry->color($color);
    }

    /**
     * TextEntry con money.
     */
    public function getTextEntryMoney(string $make, int $columnSpan, ?string $label = null): TextEntry
    {
        $textEntry = $this->create(new TextEntryConfig(
            make: $make,
            columnSpan: $columnSpan,
            label: $label,
            badge: true,
            money: true
        ));

        return $textEntry->color(Color::Green);
    }

    /**
     * TextEntry con fecha y hora (badge opcional).
     */
    public function getBadgeDateTimeTextEntry(string $make, int $columnSpan, ?array $color = null, ?string $label = null): TextEntry
    {
        $textEntry = $this->create(
            new TextEntryConfig(
                make: $make,
                columnSpan: $columnSpan,
                label: $label,
                badge: true,
                dateFormat: ConstantesFormato::FORMATO_FECHA_HORA_LARGA->value
            )
        );

        if (is_null($color)) {
            return $textEntry->color(getColorByColumnName($make));
        }

        return $textEntry->color($color);
    }

    /**
     * TextEntry Observaciones sin etiqueta.
     */
    public function getTextEntryObservacionesSinEtiqueta(int $columnSpan, ?string $label = null): TextEntry
    {
        return $this->create(
            new TextEntryConfig(
                make: 'observaciones',
                columnSpan: $columnSpan,
                label: $label
            )
        );
    }
    /**
     * TextEntry con botón de copiar al portapapeles.
     */
    private function addCopyableToTextEntry(TextEntry $textEntry, string $make): TextEntry
    {
        return $textEntry
            ->icon('heroicon-o-clipboard-document')
            ->iconColor(Color::Blue)
            ->tooltip(function ($record) use ($make) {
                $valor = data_get($record, $make);
                return $valor !== null
                    ? 'Pulsar para copiar al portapapeles'
                    : null;
            })
            ->copyable()
            ->copyMessage('Texto copiado!')
            ->copyMessageDuration(5000);
    }

    /**
     * TextEntry Respuestas sin etiqueta.
     */
    public function getTextEntryRespuestasSinEtiqueta(int $columnSpan, ?string $label = null): TextEntry
    {
        return $this->create(
            new TextEntryConfig(
                make: 'respuesta',
                columnSpan: $columnSpan,
                label: $label
            )
        );
    }

    /**
     * Constructor del TextEntry
     */
    private function create(TextEntryConfig $config): TextEntry
    {
        $textEntry = TextEntry::make($config->make)
            ->columnSpan($config->columnSpan)
            ->placeholder(ConstantesString::NO_FIGURA->value);

        $resolvedLabel = $this->resolveLabel($config);
        $textEntry->label($resolvedLabel);

        if ($config->badge) {
            $textEntry->badge();
        }

        if ($config->link) {
            $textEntry->color(Color::Blue)
                ->tooltip(
                    fn ($state) => filled($state) ? ConstantesString::ABRIR_ENLACE->value : null
                )
                ->url(
                    fn ($record) => data_get($record, $config->make), shouldOpenInNewTab: true
                );
        }

        if ($config->money) {
            $textEntry->formatStateUsing(fn ($state) => number_format($state, 2, ',', '.') . ' EUR');
        }

        if ($config->dateFormat) {
            $textEntry->date($config->dateFormat);
        }

        if ($config->copyable) {
            $textEntry = $this->addCopyableToTextEntry($textEntry, $config->make);
        }

        return $textEntry;
    }

    // Función para ofuscar el NIF
    private function ofuscarNif(string $nif): string
    {
        return str_repeat('*', strlen($nif));
    }

    private function resolveLabel(TextEntryConfig $config): string
    {
        $label = $config->label ?? __('etiquetas.textentry_' . $config->make);
        return is_array($label) ? implode(' ', $label) : $label;
    }
}
