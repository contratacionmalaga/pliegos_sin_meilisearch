<?php

namespace App\Enums\RegistroContratos;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum RC_TiposDeAdministraciones: string implements HasColor, HasIcon, HasLabel, HasDescription
{
    case Organo_Constitucional = '01';
    case Estado = '02';
    case CCAA = '03';
    case Entidad_Local = '04';
    case Sectores_Especiales = '05';
    case Universidades = '06';
    case Fundaciones = '07';
    case Empresas = '08';
    case Mutuas = '09';
    case Otros = '10';

    public function getLabel(): string
    {
        return match ($this) {
            self::Organo_Constitucional => 'Órgano Constitucional',
            self::Estado => 'Estado',
            self::CCAA => 'CCAA',
            self::Entidad_Local => 'Entidad Local',
            self::Sectores_Especiales => 'Sectores Especiales',
            self::Universidades => 'Universidades',
            self::Fundaciones => 'Fundaciones',
            self::Empresas => 'Empresas',
            self::Mutuas => 'Mutuas',
            self::Otros => 'Otros',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Organo_Constitucional => Color::Slate,
            self::Estado => Color::Red,
            self::CCAA => Color::Amber,
            self::Entidad_Local => Color::Purple,
            self::Sectores_Especiales => Color::Cyan,
            self::Universidades => Color::Blue,
            self::Fundaciones => Color::Lime,
            self::Empresas => Color::Fuchsia,
            self::Mutuas => Color::Rose,
            self::Otros => Color::Indigo,
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Organo_Constitucional => 'heroicon-m-sparkles',
            self::Estado => 'heroicon-m-arrow-path',
            self::CCAA => 'heroicon-m-truck',
            self::Entidad_Local => 'heroicon-m-check-badge',
            self::Sectores_Especiales => 'heroicon-m-x-circle',
            self::Universidades => 'heroicon-m-sparkles',
            self::Fundaciones => 'heroicon-m-arrow-path',
            self::Empresas => 'heroicon-m-truck',
            self::Mutuas => 'heroicon-m-check-badge',
            self::Otros => 'heroicon-m-x-circle',
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
