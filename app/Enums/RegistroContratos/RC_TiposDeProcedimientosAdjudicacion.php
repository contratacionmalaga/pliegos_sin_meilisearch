<?php

namespace App\Enums\RegistroContratos;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum RC_TiposDeProcedimientosAdjudicacion: string implements HasColor, HasIcon, HasLabel
{
    case Abierto = 'A';
    case Restringido = 'R';
    case Negociado = 'N';
    case Dialogo_Competitivo = 'D';
    case Directo = 'M';
    case Otros = 'Z';

    public function getLabel(): string
    {
        return match ($this) {
            self::Abierto => 'Abierto',
            self::Restringido => 'Restringido',
            self::Negociado => 'Negociado',
            self::Dialogo_Competitivo => 'Diálogo Competitivo',
            self::Directo => 'Directo',
            self::Otros => 'Otros',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Abierto => Color::hex('#0085c3'),
            self::Restringido => Color::hex('#7ab800'),
            self::Negociado => Color::hex('#f2af00'),
            self::Dialogo_Competitivo => Color::hex('#dc5034'),
            self::Directo => Color::hex('#ce1126'),
            self::Otros => Color::hex('#009bbb'),
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Abierto => 'heroicon-m-sparkles',
            self::Restringido => 'heroicon-m-arrow-path',
            self::Negociado => 'heroicon-m-truck',
            self::Dialogo_Competitivo => 'heroicon-m-check-badge',
            self::Directo => 'heroicon-m-x-circle',
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
