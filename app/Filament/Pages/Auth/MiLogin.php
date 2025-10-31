<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;

class MiLogin extends Login
{

    /**
     * Sobrescribe el método que renderiza el formulario de login.
     *
     * @param Schema $schema *
     *
     * @return Schema
     */
    public function form(Schema $schema): Schema
    {

        return parent::form($schema)
            ->schema([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                Checkbox::make('remember')
                    ->label('Recordarme es este dispositivo'),  // Cambia el label del checkbox
            ]);
    }

    /**
     * @return string|Htmlable
     */
    public function getHeading(): string|Htmlable
    {
        return ' ';
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Usuario')
            ->placeholder('Introduce el usuario')
            ->email()
            ->rule('required')
            ->markAsRequired()
            ->validationMessages(['required' => 'El campo es obligatorio'])
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('Contraseña')
            ->placeholder('Introduce la contraseña')
            ->password()
//            ->revealable(filament()->arePasswordsRevealable())
            ->autocomplete('current-password')
            ->rule('required')
            ->markAsRequired()
            ->validationMessages(['required' => 'El campo es obligatorio'])
            ->extraInputAttributes(['tabindex' => 2]);
    }
}

