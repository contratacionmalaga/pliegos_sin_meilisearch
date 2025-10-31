<?php

namespace App\Enums\Acciones;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum Roles: string implements HasLabel, HasColor, HasDescription, HasIcon
{
    case LEER = 'leer';
    case ESCRIBIR = 'escribir';
    case GESTIONAR = 'gestionar';
    case ADMINISTRAR = 'administrar';

    public function getLabel(): string
    {
        return match ($this) {
            self::LEER => 'Acceso y lectura al módulo',
            self::ESCRIBIR => 'Escritura sobre el módulo',
            self::GESTIONAR => 'Gestión avanzada sobre el módulo',
            self::ADMINISTRAR => 'Administración del módulo',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::LEER => 'heroicon-o-eye',
            self::ESCRIBIR => 'heroicon-o-pencil-square',
            self::GESTIONAR => 'heroicon-o-wrench',
            self::ADMINISTRAR => 'heroicon-o-cog-8-tooth',
        };
    }

    /**
     * @return array<int,string>
     */
    public function getColor(): array
    {
        return match ($this) {
            self::LEER => Color::Green,
            self::ESCRIBIR => Color::Blue,
            self::GESTIONAR => Color::Purple,
            self::ADMINISTRAR => Color::Red,
        };
    }

    public function getTooltip(): string
    {
        return $this->getDescription();
    }

    public function getDescription(): string
    {
        return $this->getLabel();
    }

    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }
}
