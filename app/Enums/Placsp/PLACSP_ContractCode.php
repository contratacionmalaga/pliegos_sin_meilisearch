<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_ContractCode: string implements HasColor, HasLabel, HasIcon
{

    case Suministros = '1';
    case Servicios = '2';
    case Obras = '3';
    case Gestion_Servicios = '21';
    case Concesion_Servicios = '22';
    case Concesion_Obras_Publicas = '31';
    case Concesion_Obras = '32';
    case Colaboracion_Publico_Privado = '40';
    case Administrativo_Especial = '7';
    case Privado = '8';
    case Patrimonial = '50';
    case Otros = '999';

    public function getLabel(): string
    {
        return match ($this) {
            self::Suministros => 'Suministros',
            self::Servicios => 'Servicios',
            self::Obras => 'Obras',
            self::Gestion_Servicios => 'Gestión de Servicios',
            self::Concesion_Servicios => 'Concesión de Servicios',
            self::Concesion_Obras_Publicas => 'Concesión de Obras Públicas',
            self::Concesion_Obras => 'Concesión de Obras',
            self::Colaboracion_Publico_Privado => 'Colaboración entre el sector público y sector privado',
            self::Administrativo_Especial => 'Administrativo especial',
            self::Privado => 'Privado',
            self::Patrimonial => 'Patrimonial',
            self::Otros => 'Otros',
        };
    }

    public function getShortLabel(): string
    {
        return match ($this) {
            self::Suministros => 'Suministros',
            self::Servicios => 'Servicios',
            self::Obras => 'Obras',
            self::Gestion_Servicios => 'Gestión de servicios',
            self::Concesion_Servicios => 'Concesión de servicios',
            self::Concesion_Obras_Publicas => 'Concesión obras públicas',
            self::Concesion_Obras => 'Concesión de obras',
            self::Colaboracion_Publico_Privado => 'Colaboración público-privado',
            self::Administrativo_Especial => 'Administrativo especial',
            self::Privado => 'Privado',
            self::Patrimonial => 'Patrimonial',
            self::Otros => 'Otros',
        };
    }

    public function getTinyLabel(): string
    {
        return match ($this) {
            self::Suministros => 'Sum.',
            self::Servicios => 'Serv.',
            self::Obras => 'Obras',
            self::Gestion_Servicios => 'Gest. serv.',
            self::Concesion_Servicios => 'Conc. serv.',
            self::Concesion_Obras_Publicas => 'Conc. obras pub.',
            self::Concesion_Obras => 'Conc. obras',
            self::Colaboracion_Publico_Privado => 'Colab. pub-priv',
            self::Administrativo_Especial => 'Adm. esp.',
            self::Privado => 'Privado',
            self::Patrimonial => 'Patrimonial',
            self::Otros => 'Otros',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Suministros => 'heroicon-o-hand-thumb-up',
            self::Servicios => 'heroicon-o-rocket-launch',
            self::Obras => 'heroicon-o-truck',
            default => 'heroicon-o-trophy',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Suministros => Color::Fuchsia,
            self::Servicios => Color::Orange,
            self::Obras => Color::Slate,
            self::Gestion_Servicios => Color::Yellow,
            self::Concesion_Servicios => Color::Lime,
            self::Concesion_Obras_Publicas => Color::Green,
            self::Concesion_Obras => Color::Emerald,
            self::Colaboracion_Publico_Privado => Color::Teal,
            self::Administrativo_Especial => Color::Cyan,
            self::Privado => Color::Sky,
            self::Patrimonial => Color::Blue,
            self::Otros => Color::Indigo,
        };
    }

    /**
     * @return string|null
     */
    public function getColorHex(): ?string
    {
        return match ($this) {
            self::Suministros => '#d946ef',             // Fuchsia-500
            self::Servicios => '#f97316',               // Orange-500
            self::Obras => '#64748b',                   // Slate-500
            self::Gestion_Servicios => '#eab308',       // Yellow-500
            self::Concesion_Servicios => '#84cc16',     // Lime-500
            self::Concesion_Obras_Publicas => '#22c55e',// Green-500
            self::Concesion_Obras => '#10b981',         // Emerald-500
            self::Colaboracion_Publico_Privado => '#14b8a6', // Teal-500
            self::Administrativo_Especial => '#06b6d4', // Cyan-500
            self::Privado => '#0ea5e9',                 // Sky-500
            self::Patrimonial => '#3b82f6',             // Blue-500
            self::Otros => '#6366f1',                   // Indigo-500
            default => '#ef4444',                       // Red-500
        };
    }

    public function toRC(): string
    {
        return match ($this) {
            self::Suministros => 'C',
            self::Servicios => 'E',
            self::Obras => 'A',
            self::Gestion_Servicios, self::Concesion_Servicios => 'B',
            self::Concesion_Obras_Publicas, self::Concesion_Obras => 'H',
            self::Colaboracion_Publico_Privado => 'J',
            self::Administrativo_Especial => 'F',
            self::Privado => 'I',
            self::Patrimonial, self::Otros => 'Z',
        };
    }

    public static function ordenar(): array
    {

        return sortEnumByLabel(self::cases());
    }
}
