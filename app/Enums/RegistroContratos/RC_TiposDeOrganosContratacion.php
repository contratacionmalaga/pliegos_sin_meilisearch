<?php

namespace App\Enums\RegistroContratos;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum RC_TiposDeOrganosContratacion: string implements HasColor, HasIcon, HasLabel
{
    case Pleno = '1';
    case Alcalde = '2';
    case Junta_Gobierno = '3';
    case Presidente = '4';
    case Otros = '9';

    public function getLabel(): string
    {
        return match ($this) {
            self::Pleno => 'Pleno',
            self::Alcalde => 'Alcalde',
            self::Junta_Gobierno => 'Junta de Gobierno',
            self::Presidente => 'Presidente',
            self::Otros => 'Otros',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Pleno => Color::Amber,
            self::Alcalde => Color::Green,
            self::Junta_Gobierno => Color::Sky,
            self::Presidente => Color::Purple,
            self::Otros => Color::Slate,
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Pleno => 'heroicon-o-user-group',
            self::Presidente, self::Alcalde => 'heroicon-o-user',
            self::Junta_Gobierno => 'heroicon-o-users',
            self::Otros => 'heroicon-o-user-circle',
        };
    }

    public function getDescription(): ?string
    {
        return $this->getLabel();
    }

    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }
}
