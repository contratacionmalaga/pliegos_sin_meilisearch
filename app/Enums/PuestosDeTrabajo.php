<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PuestosDeTrabajo: string implements HasColor, HasIcon, HasLabel, HasDescription
{
    case Alcalde = '1';
    case Secretario_Interventor = '2';
    case Otros = '3';

    public function getLabel(): string
    {
        return match ($this) {
            self::Alcalde => 'Alcalde',
            self::Secretario_Interventor => 'Secretario / Interventor',
            self::Otros => 'Otros',
        };
    }

    public function getDescription(): string
    {
        return $this->getLabel();
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Alcalde => Color::Green,
            self::Secretario_Interventor => Color::Purple,
            self::Otros => Color::Blue,
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Alcalde => 'heroicon-s-user-minus',
            self::Secretario_Interventor => 'heroicon-s-user',
            self::Otros => 'heroicon-o-user-circle',
        };
    }

    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }
}
