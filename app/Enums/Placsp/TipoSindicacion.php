<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TipoSindicacion: string implements HasLabel, HasIcon, HasColor, HasDescription
{

    // Tipos de criterios de adjudicación

    case EMP = 'EMP';
    case MAY = 'MAY';
    case MEN = 'MEN';
    case CPM = 'CPM';

    public function getLabel(): string
    {
        return match ($this) {
            self::EMP => 'Encargo medio propio',
            self::MAY => 'Contrato mayor',
            self::MEN => 'Contrato menor',
            self::CPM => 'Consulta preliminar de mercado',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::EMP => 'heroicon-o-user-circle',
            self::MAY => 'heroicon-o-shopping-cart',
            self::MEN => 'heroicon-o-shopping-bag',
            self::CPM => 'heroicon-o-phone',
        };
    }

    /**
     * @return array
     */
    public function getColor(): array
    {
        return match ($this) {
            self::EMP => Color::Blue,
            self::MAY => Color::Green,
            self::MEN => Color::Amber,
            self::CPM => Color::Red,
        };
    }

    public function getDescription(): string
    {

        return $this->getLabel();
    }

    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }

    public static function ordenarExpedientes(): array
    {

        return sortEnumByValue(
            array_filter(self::cases(), static fn ($case) => $case !== self::CPM)
        );
    }

    public static function ordenarContratos(): array
    {

        return sortEnumByValue(
            array_filter(self::cases(), static fn ($case) => $case !== self::CPM && $case !== self::EMP)
        );
    }
}
