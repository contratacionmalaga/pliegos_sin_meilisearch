<?php

namespace App\Enums\Flags;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum SuperAdminEnum: int implements HasColor, HasIcon, HasLabel
{
    case TRUE = 1;
    case FALSE = 0;

    /**
     * @return array<string>
     */
    public function getColor(): array
    {
        return match ($this) {
            self::TRUE => Color::Blue,
            self::FALSE => Color::Slate,
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::FALSE => 'Usuario',
            self::TRUE => 'Super Administrador',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::FALSE => 'heroicon-o-user',
            self::TRUE => 'heroicon-o-user-plus',
        };
    }
}
