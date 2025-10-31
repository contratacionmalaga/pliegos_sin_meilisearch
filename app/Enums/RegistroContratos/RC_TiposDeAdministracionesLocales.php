<?php

namespace App\Enums\RegistroContratos;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum RC_TiposDeAdministracionesLocales: string implements HasColor, HasIcon, HasLabel, HasDescription
{
    case Ayuntamiento = 'A';
    case Cabildo = 'C';
    case Diputacion_Provincial = 'D';
    case Mancomunidad = 'M';
    case Consorcio = 'X';
    case Comarcas = 'Y';
    case Otros = 'Z';

    public function getLabel(): string
    {
        return match ($this) {
            self::Ayuntamiento => 'Ayuntamiento',
            self::Cabildo => 'Cabildo / Consell Insular',
            self::Diputacion_Provincial => 'Diputación Provincial / Foral',
            self::Mancomunidad => 'Mancomunidad',
            self::Consorcio => 'Consorcio',
            self::Comarcas => 'Comarcas',
            self::Otros => 'Otros',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Ayuntamiento => Color::Green,
            self::Cabildo => Color::Yellow,
            self::Diputacion_Provincial => Color::Purple,
            self::Mancomunidad => Color::Red,
            self::Consorcio => Color::Cyan,
            self::Comarcas => Color::Fuchsia,
            self::Otros => Color::Gray,
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Ayuntamiento => 'heroicon-m-sparkles',
            self::Cabildo => 'heroicon-m-arrow-path',
            self::Diputacion_Provincial => 'heroicon-m-truck',
            self::Mancomunidad => 'heroicon-m-check-badge',
            self::Consorcio => 'heroicon-m-x-circle',
            self::Comarcas => 'heroicon-m-x-circle',
            self::Otros => 'heroicon-m-x-circle',
        };
    }

    public function getDescription(): ?string
    {
        return $this->getLabel();
    }

    public function getSortOrder(): string {

        return $this->getLabel();
    }

    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }
}
