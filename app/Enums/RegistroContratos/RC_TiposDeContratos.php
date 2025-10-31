<?php

namespace App\Enums\RegistroContratos;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum RC_TiposDeContratos: string implements HasColor, HasIcon, HasLabel
{
    case Obras = 'A';
    case Gestion_Servicios_Publicos = 'B';
    case Suministros = 'C';
    case Consultoria_Asistencia = 'D';
    case Servicios = 'E';
    case Administrativos_Especiales = 'F';
    case Sectores_Agua = 'G';
    case Concesion_Obra_Publica = 'H';
    case Privado = 'I';
    case Colaboracion_Publico_Privado = 'J';
    case Otros = 'Z';

    public function getLabel(): string
    {
        return match ($this) {
            self::Obras => 'Obras',
            self::Gestion_Servicios_Publicos => 'Gestión de Servicios Públicos',
            self::Suministros => 'Suministros',
            self::Consultoria_Asistencia => 'Consultoría y Asistencia',
            self::Servicios => 'Servicios',
            self::Administrativos_Especiales => 'Administrativos Especiales',
            self::Sectores_Agua => 'Sectores agua, energía, transportes y comunicaciones',
            self::Concesion_Obra_Publica => 'Concesión Obras Públicas',
            self::Privado => 'Privados',
            self::Colaboracion_Publico_Privado => 'Colaboración entre Sector Público y Privado',
            self::Otros => 'Otros',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Obras => Color::Teal,
            self::Gestion_Servicios_Publicos => Color::Sky,
            self::Suministros => Color::Yellow,
            self::Consultoria_Asistencia => Color::Amber,
            self::Servicios => Color::Lime,
            self::Administrativos_Especiales => Color::Pink,
            self::Sectores_Agua => Color::hex('#6e2585'),
            self::Concesion_Obra_Publica => Color::Slate,
            self::Privado => Color::Rose,
            self::Colaboracion_Publico_Privado => Color::Fuchsia,
            self::Otros => Color::Emerald,
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Obras => 'heroicon-m-sparkles',
            self::Gestion_Servicios_Publicos => 'heroicon-m-arrow-path',
            self::Suministros => 'heroicon-m-truck',
            self::Consultoria_Asistencia => 'heroicon-m-check-badge',
            self::Servicios => 'heroicon-m-x-circle',
            self::Administrativos_Especiales => 'heroicon-m-sparkles',
            self::Sectores_Agua => 'heroicon-m-arrow-path',
            self::Concesion_Obra_Publica => 'heroicon-m-truck',
            self::Privado => 'heroicon-m-check-badge',
            self::Colaboracion_Publico_Privado => 'heroicon-m-x-circle',
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
