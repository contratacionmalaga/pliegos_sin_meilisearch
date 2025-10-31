<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_ContractingAuthorityCode: string implements HasLabel
{

    case Autoridad_Estatal = '1';
    case Autoridad_Regional = '2';
    case Autoridad_Local = '3';
    case Organismo_Derecho_Publico = '4';
    case Otras_Entidades_Sector_Publico = '5';
    case Organismo_Derecho_Publico_Bajo_Control_Estatal = '6';
    case Organismo_Derecho_Publico_Bajo_Control_Regional = '7';
    case Organismo_Derecho_Publico_Bajo_Control_Local = '8';
    case Empresa_Publica_Bajo_Control_Estatal = '9';
    case Empresa_Publica_Bajo_Control_Regional = '10';
    case Empresa_Publica_Bajo_Control_Local = '11';
    case Entidad_Derechos_Especiales = '12';

    public function getLabel(): string
    {
        return match ($this) {
            self::Autoridad_Estatal => 'Autoridad estatal',
            self::Autoridad_Regional => 'Autoridad regional',
            self::Autoridad_Local => 'Autoridad local',
            self::Organismo_Derecho_Publico => 'Organismo de Derecho público',
            self::Otras_Entidades_Sector_Publico => 'Otras Entidades del Sector Público',
            self::Organismo_Derecho_Publico_Bajo_Control_Estatal => 'Organismo de Derecho público bajo el control de una autoridad estatal',
            self::Organismo_Derecho_Publico_Bajo_Control_Regional => 'Organismo de Derecho público bajo el control de una autoridad regional',
            self::Organismo_Derecho_Publico_Bajo_Control_Local => 'Organismo de Derecho público bajo el control de una autoridad local',
            self::Empresa_Publica_Bajo_Control_Estatal => 'Empresa pública bajo el control de una autoridad estatal',
            self::Empresa_Publica_Bajo_Control_Regional => 'Empresa pública bajo el control de una autoridad regional',
            self::Empresa_Publica_Bajo_Control_Local => 'Empresa pública bajo el control de una autoridad local',
            self::Entidad_Derechos_Especiales => 'Entidad con derechos especiales o exclusivos',
        };
    }

    public function getShortLabel(): string
    {
        return match ($this) {
            self::Autoridad_Estatal => 'Autoridad estatal',
            self::Autoridad_Regional => 'Autoridad regional',
            self::Autoridad_Local => 'Autoridad local',
            self::Organismo_Derecho_Publico => 'Organismo de derecho público',
            self::Otras_Entidades_Sector_Publico => 'Otras entidades sector público',
            self::Organismo_Derecho_Publico_Bajo_Control_Estatal => 'Organismo derecho público control estatal',
            self::Organismo_Derecho_Publico_Bajo_Control_Regional => 'Organismo derecho público control regional',
            self::Organismo_Derecho_Publico_Bajo_Control_Local => 'Organismo derecho público control local',
            self::Empresa_Publica_Bajo_Control_Estatal => 'Empresa pública control estatal',
            self::Empresa_Publica_Bajo_Control_Regional => 'Empresa pública control regional',
            self::Empresa_Publica_Bajo_Control_Local => 'Empresa pública control local',
            self::Entidad_Derechos_Especiales => 'Entidad con derechos especiales',
        };
    }

    public function getTinyLabel(): string
    {
        return match ($this) {
            self::Autoridad_Estatal => 'Estatal',
            self::Autoridad_Regional => 'Regional',
            self::Autoridad_Local => 'Local',
            self::Organismo_Derecho_Publico => 'Org. derecho pub.',
            self::Otras_Entidades_Sector_Publico => 'Otras entidades',
            self::Organismo_Derecho_Publico_Bajo_Control_Estatal => 'Org. pub. ctrl. estatal',
            self::Organismo_Derecho_Publico_Bajo_Control_Regional => 'Org. pub. ctrl. regional',
            self::Organismo_Derecho_Publico_Bajo_Control_Local => 'Org. pub. ctrl. local',
            self::Empresa_Publica_Bajo_Control_Estatal => 'Emp. pub. ctrl. estatal',
            self::Empresa_Publica_Bajo_Control_Regional => 'Emp. pub. ctrl. regional',
            self::Empresa_Publica_Bajo_Control_Local => 'Emp. pub. ctrl. local',
            self::Entidad_Derechos_Especiales => 'Derechos especiales',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Autoridad_Estatal => Color::Gray,
            self::Autoridad_Regional => Color::Green,
            self::Autoridad_Local => Color::Purple,
            self::Organismo_Derecho_Publico => Color::Orange,
            self::Otras_Entidades_Sector_Publico => Color::Amber,
            self::Organismo_Derecho_Publico_Bajo_Control_Estatal => Color::Indigo,
            self::Organismo_Derecho_Publico_Bajo_Control_Regional => Color::Emerald,
            self::Organismo_Derecho_Publico_Bajo_Control_Local => Color::Teal,
            self::Empresa_Publica_Bajo_Control_Estatal => Color::Stone,
            self::Empresa_Publica_Bajo_Control_Regional => Color::Rose,
            self::Empresa_Publica_Bajo_Control_Local => Color::Fuchsia,
            self::Entidad_Derechos_Especiales => Color::Slate,
            default => Color::Red,
        };
    }

    /**
     * @return string|null
     */
    public function getColorHex(): ?string
    {
        return match ($this) {
            self::Autoridad_Estatal => '#6b7280',                               // Gray-500
            self::Autoridad_Regional => '#22c55e',                              // Green-500
            self::Autoridad_Local => '#a855f7',                                 // Purple-500
            self::Organismo_Derecho_Publico => '#f97316',                       // Orange-500
            self::Otras_Entidades_Sector_Publico => '#f59e0b',                  // Amber-500
            self::Organismo_Derecho_Publico_Bajo_Control_Estatal => '#6366f1',  // Indigo-500
            self::Organismo_Derecho_Publico_Bajo_Control_Regional => '#10b981', // Emerald-500
            self::Organismo_Derecho_Publico_Bajo_Control_Local => '#14b8a6',    // Teal-500
            self::Empresa_Publica_Bajo_Control_Estatal => '#78716c',            // Stone-500
            self::Empresa_Publica_Bajo_Control_Regional => '#f43f5e',           // Rose-500
            self::Empresa_Publica_Bajo_Control_Local => '#d946ef',              // Fuchsia-500
            self::Entidad_Derechos_Especiales => '#64748b',                     // Slate-500
            default => '#ef4444',                                               // Red-500
        };
    }


    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }
}


