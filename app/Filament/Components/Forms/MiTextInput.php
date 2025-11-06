<?php

namespace App\Filament\Components\Forms;

use App\DTOs\TextInputConfig;
use App\Enums\Constantes\ConstantesInt;
use App\Enums\Constantes\ConstantesRegex;
use App\Enums\Constantes\ConstantesString;
use Filament\Actions\Action;
use Schmeits\FilamentCharacterCounter\Forms\Components\TextInput;

class MiTextInput
{
    public function getTextInputTitulo(string $make, bool $requerido, int $columnSpam, ?string $label = null): TextInput
    {

        return $this->create(
            new TextInputConfig(
                make: 'titulo',
                columnSpan: $columnSpam,
                characterLimit: ConstantesInt::TAMANO_200->value,
                required: $requerido,
                label: $label
            )
        );
    }

    public function getTextInputDescripcion(string $make, bool $requerido, int $columnSpam, ?string $label = null): TextInput
    {

        return $this->create(
            new TextInputConfig(
                make: 'descripcion',
                columnSpan: $columnSpam,
                characterLimit: ConstantesInt::TAMANO_200->value,
                required: $requerido,
                label: $label
            )
        );
    }

    public function getTextInputEstado(string $make, bool $requerido, int $columnSpam, ?string $label = null): TextInput
    {

        return $this->create(
            new TextInputConfig(
                make: 'estado',
                columnSpan: $columnSpam,
                characterLimit: ConstantesInt::TAMANO_200->value,
                required: $requerido,
                label: $label
            )
        );
    }



// ---------------------------------------------------------------------------------------------------------------------




    public function getTextInputName(string $make, bool $requerido, int $columnSpam, ?string $label = null): TextInput
    {

        return $this->create(
            new TextInputConfig(
                make: $make,
                columnSpan: $columnSpam,
                characterLimit: ConstantesInt::TAMANO_200->value,
                required: $requerido,
                label: $label
            )
        );
    }

    public function getTextInputExtension(bool $requerido, int $columnSpam, ?string $label = null): TextInput
    {

        return $this->create(
            new TextInputConfig(
                make: 'extension',
                columnSpan: $columnSpam,
                characterLimit: ConstantesInt::TAMANO_10->value,
                required: $requerido,
                label: $label
            )
        );
    }

    public function getTextInputNif(bool $requerido, int $columnSpam, ?string $table = null, ?string $label = null): TextInput
    {

        return $this->create(
            new TextInputConfig(
                make: 'nif',
                columnSpan: $columnSpam,
                characterLimit: ConstantesInt::TAMANO_20->value,
                required: $requerido,
                table: $table,
                column: 'nif',
                label: $label
            )
        );
    }

    public function getTextInputDireccion(bool $requerido, int $columnSpam, ?string $label = null): TextInput
    {

        return $this->create(
            new TextInputConfig(
                make: 'direccion',
                columnSpan: $columnSpam,
                characterLimit: ConstantesInt::TAMANO_100->value,
                required: $requerido,
                label: $label
            )
        );
    }

    public function getTextInputCodigoPostal(bool $requerido, int $columnSpam, ?string $label = null): TextInput
    {

        return $this->create(
            new TextInputConfig(
                make: 'codigo_postal',
                columnSpan: $columnSpam,
                characterLimit: ConstantesInt::TAMANO_10->value,
                required: $requerido,
                label: $label
            )
        );
    }

    public function getTextInputInvente(string $make, bool $requerido, int $columnSpam, ?string $class = null, ?string $label = null): TextInput
    {

        $textInput = $this->create(
            new TextInputConfig(
                make: $make,
                columnSpan: $columnSpam,
                characterLimit: ConstantesInt::TAMANO_20->value,
                required: $requerido,
                column: $make,
                class: $class,
                label: $label
            )
        );

        return $textInput
                    ->suffixAction(
                        fn(?string $state): Action => Action::make('visitar')
                            ->icon('heroicon-o-link')
                            ->tooltip('Comprobar la URL')
                            ->url(
                                filled($state) ? ConstantesString::ENLACE_INVENTE->value . $state : null,
                                shouldOpenInNewTab: true,
                            ));
    }

    public function getTextInputCodigo(string $make, bool $requerido, int $columnSpam, ?string $class = null, ?string $label = null): TextInput
    {

        return $this->create(
            new TextInputConfig(
                make: $make,
                columnSpan: $columnSpam,
                characterLimit: ConstantesInt::TAMANO_20->value,
                required: $requerido,
                column: $make,
                class: $class,
                label: $label
            )
        );
    }

    public function getTextInputEmail(bool $requerido, int $columnSpam, ?string $table = null, ?string $label = null): TextInput
    {

        return $this->create(
            new TextInputConfig(
                make: 'email',
                columnSpan: $columnSpam,
                characterLimit: ConstantesInt::TAMANO_100->value,
                required: $requerido,
                table: $table,
                column: 'email',
                label: $label
            )
        );
    }

    public function getTextInputLink(string $make, bool $requerido, int $columnSpam, ?string $label = null): TextInput
    {

        return $this->create(
            new TextInputConfig(
                make: $make,
                columnSpan: $columnSpam,
                characterLimit: ConstantesInt::TAMANO_200->value,
                required: $requerido,
                link: true,
                label: $label
            )
        );
    }

    public function getTextInputTelefono(bool $requerido, int $columnSpam, ?string $label = null): TextInput
    {

        return $this->create(
            new TextInputConfig(
                make: 'telefono',
                columnSpan: $columnSpam,
                characterLimit: ConstantesInt::TAMANO_50->value,
                required: $requerido,
                label: $label
            )
        );
    }

    public function getTextInputPuestoTrabajo(bool $requerido, int $columnSpam, ?string $label = null): TextInput
    {

        return $this->create(
            new TextInputConfig(
                make: 'puesto_trabajo',
                columnSpan: $columnSpam,
                characterLimit: ConstantesInt::TAMANO_100->value,
                required: $requerido,
                label: $label
            )
        );
    }

    /**
     * @param TextInputConfig $config
     *
     * @return TextInput
     */
    private function create(TextInputConfig $config): TextInput
    {

        $textInput = TextInput::make($config->make)
            ->placeholder(__('etiquetas.' . 'placeholder_' . $config->make))
            ->reactive()
            ->columnSpan($config->columnSpan);

        $resolvedLabel = $this->resolveLabel($config);
        $textInput->label($resolvedLabel);

        if ($config->characterLimit) {
            $textInput->characterLimit($config->characterLimit);
        }

        $messagesValidation = [];

        if ($config->required) {
            $textInput->rule('required', $config->required);
            $textInput->markAsRequired($config->required);
            $messagesValidation = array_merge($messagesValidation, ['required' => __('etiquetas.validation_required')]);
        }

        if ($config->class) {
            $textInput->unique(table: $config->table, column: $config->column, ignoreRecord: true);
            $messagesValidation = array_merge($messagesValidation, ['unique' => __('etiquetas.validation_unique')]);
        }

        if ($config->email) {
            $textInput->regex(ConstantesRegex::REGEX_EMAIL->value);
            $messagesValidation = array_merge($messagesValidation, ['regex' => __('etiquetas.validation_email')]);
        }

        if ($config->numerico) {
            $textInput->regex(ConstantesRegex::REGEX_TELEFONO->value);
            $messagesValidation = array_merge($messagesValidation, ['regex' => __('etiquetas.validation_telefono')]);
        }

        if ($config->link) {
            $textInput->regex(ConstantesRegex::REGEX_URL->value);
            $messagesValidation = array_merge($messagesValidation, ['regex' => __('etiquetas.validation_url')]);
            $textInput->suffixAction(
                fn(?string $state): Action => Action::make('visitar')
                    ->icon('heroicon-o-link')
                    ->tooltip('Comprobar la URL')
                    ->url(
                        filled($state) ? (string)$state : null,
                        shouldOpenInNewTab: true,
                    ));
        }

        $textInput->validationMessages($messagesValidation);

        return $textInput;
    }

    private function resolveLabel(TextInputConfig $config): string
    {
        $label = $config->label ?? __('etiquetas.textinput_' . $config->make);
        return is_array($label) ? implode(' ', $label) : $label;
    }
}
