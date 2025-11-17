<?php

namespace App\Filament\Components\Forms;

use App\DTOs\RichEditorConfig;
use App\Enums\Constantes\ConstantesInt;
use Filament\Forms\Components\RichEditor;

class MiRichEditor
{
    /**
     * @param int $columnSpan
     *
     * @return RichEditor
     */
    public function getRichEditorWithoutLabel(int $columnSpan): RichEditor
    {

        return $this->create(
            new RichEditorConfig(
                make: 'observaciones',
                columnSpan: $columnSpan,
                label: null
            )
        );
    }

    /**
     * @param string      $make
     * @param int         $columnSpan
     * @param string|null $label
     *
     * @return RichEditor
     */
    public function getRichEditor(string $make, int $columnSpan, ?string $label = null): RichEditor
    {

        return $this->create(
            new RichEditorConfig(
                make: $make,
                columnSpan: $columnSpan,
                label: $label
            )
        );
    }

    public function getRichEditorRespuesta(int $columnSpan, ?string $label = null): RichEditor
    {

        return $this->create(
            new RichEditorConfig(
                make: 'respuesta',
                columnSpan: $columnSpan,
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
