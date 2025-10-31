<?php

namespace App\Enums\Flags;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum MedioPropioEnum: string implements HasColor, HasIcon, HasLabel
{
    case TRUE = 'Sí';
    case FALSE = 'No';

    /**
     * @return array<string>
     */
    public function getColor(): array
    {
        return match ($this) {
            self::TRUE => Color::Green,
            self::FALSE => Color::Red,
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::TRUE => 'Sí',
            self::FALSE => 'No',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::TRUE => 'heroicon-o-shopping-cart',
            self::FALSE => 'heroicon-o-no-symbol',
        };
    }
}
