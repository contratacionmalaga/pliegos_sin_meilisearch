<?php

namespace App\Filament\Components\Forms;

use App\DTOs\TextAreaConfig;
use App\Enums\Constantes\ConstantesInt;
use Filament\Forms\Components\Textarea;

class MiTextArea
{
    /**
     * @param int $columnSpam
     *
     * @return Textarea
     */
    public function getTextEntryObservacionesWithoutLabel(int $columnSpam): Textarea
    {

        return $this->create(
            new TextAreaConfig(
                make: 'observaciones',
                columnSpan: $columnSpam,
                label: ' '
            )
        );
    }

    /**
     * @param string      $make
     * @param int         $columnSpam
     * @param string|null $label
     *
     * @return Textarea
     */
    public function getTextArea(string $make, int $columnSpam, ?string $label = null): Textarea
    {

        return $this->create(
            new TextAreaConfig(
                make: $make,
                columnSpan: $columnSpam,
                label: $label
            )
        );
    }

    /**
     * @param TextAreaConfig $config
     *
     * @return Textarea
     */
    private function create(TextAreaConfig $config): Textarea
    {

        $testArea = TextArea::make($config->make)
            ->placeholder(__('etiquetas.' . 'placeholder_' . $config->make))
            ->reactive()
            ->columnSpan($config->columnSpan);

        $resolvedLabel = $this->resolveLabel($config);
        $testArea->label($resolvedLabel);

        // characterLimit
        $testArea->maxLength(ConstantesInt::TAMANO_1000000->value);

        return $testArea;
    }

    private function resolveLabel(TextAreaConfig $config): string
    {
        $label = $config->label ?? __('etiquetas.textinput_' . $config->make);
        return is_array($label) ? implode(' ', $label) : $label;
    }
}
