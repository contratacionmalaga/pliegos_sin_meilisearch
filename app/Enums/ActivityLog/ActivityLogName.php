<?php

namespace App\Enums\ActivityLog;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ActivityLogName: string implements HasColor, HasIcon, HasLabel
{
    case REGISTRO_CONTRATOS = 'registro-contratos';
    case CONTRATACION = 'contratacion';
    case API = 'api';
    case META4 = 'meta4';
    case DEFAULT = 'default';
    case SEGURIDAD = 'seguridad';

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::REGISTRO_CONTRATOS => 'Registro de contratos',
            self::CONTRATACION => 'Seguimiento expedientes contratación',
            self::API => 'Api',
            self::META4 => 'Meta4',
            self::DEFAULT => 'Default',
            self::SEGURIDAD => 'Seguridad',
        };
    }

    /**
     * @return array<int,string>
     */
    public function getColor(): array
    {
        return match ($this) {
            self::REGISTRO_CONTRATOS => Color::Red,
            self::CONTRATACION => Color::Green,
            self::API => Color::Emerald,
            self::META4 => Color::Amber,
            self::DEFAULT => Color::Gray,
            self::SEGURIDAD => Color::Violet,

        };
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return match ($this) {
            self::REGISTRO_CONTRATOS => 'heroicon-m-arrow-right-on-rectangle',
            self::CONTRATACION => 'heroicon-o-shopping-cart',
            self::API => 'heroicon-o-arrows-pointing-in',
            self::META4 => 'heroicon-o-users',
            self::DEFAULT => 'heroicon-o-hand-raised',
            self::SEGURIDAD => 'heroicon-o-shield-check',
        };
    }

    /**
     * @return array<string, mixed>
     */
    public static function ordenar(): array
    {

        return sortEnumByLabel(self::cases());
    }
}
