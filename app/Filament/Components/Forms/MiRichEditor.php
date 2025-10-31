<?php

namespace App\Filament\Components\Forms;

use App\DTOs\RichEditorConfig;
use App\Enums\Constantes\ConstantesInt;
use Filament\Forms\Components\RichEditor;

class MiRichEditor
{
    /**
     * @param int $columnSpam
     *
     * @return RichEditor
     */
    public function getRichEditorWithoutLabel(int $columnSpam): RichEditor
    {

        return $this->create(
            new RichEditorConfig(
                make: 'observaciones',
                columnSpan: $columnSpam,
                label: null
            )
        );
    }

    /**
     * @param string      $make
     * @param int         $columnSpam
     * @param string|null $label
     *
     * @return RichEditor
     */
    public function getRichEditor(string $make, int $columnSpam, ?string $label = null): RichEditor
    {

        return $this->create(
            new RichEditorConfig(
                make: $make,
                columnSpan: $columnSpam,
                label: $label
            )
        );
    }

    /**
     * @param RichEditorConfig $config
     *
     * @return RichEditor
     */
    public function create(RichEditorConfig $config): RichEditor
    {

        $richEditor = RichEditor::make($config->make)
            ->toolbarButtons([
                'bold',
                'italic',
                'underline',
                'bulletList',
                'orderedList',
            ])
            ->reactive()
            ->columnSpanFull();

        if (is_null($config->label)) {
            $richEditor->label('Notas del registro');
        } else {
            $richEditor->label($config->label);
        }

        // Tamaño máximo
        $richEditor->maxLength(ConstantesInt::TAMANO_1000000->value);
        $richEditor->placeholder('Introduzca cualquier nota sobre el registro que considere necesaria');
        return $richEditor;
    }
}
