<?php

namespace App\Enums\Flags;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum DobleFactorEnum: int implements HasColor, HasIcon, HasLabel
{
    case TRUE = 1;
    case FALSE = 0;

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
            self::FALSE => 'Activado 2FA',
            self::TRUE => 'Desactivado 2FA',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::FALSE => 'heroicon-o-lock-closed',
            self::TRUE => 'heroicon-o-lock-open',
        };
    }
}
