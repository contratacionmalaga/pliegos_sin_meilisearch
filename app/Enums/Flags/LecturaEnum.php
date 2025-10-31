<?php

namespace App\Enums\Flags;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum LecturaEnum: int implements HasColor, HasIcon, HasLabel
{

    case TRUE = 1;
    case FALSE = 0;

    /**
     * @return array<string>
     */
    public function getColor(): array
    {
        return match ($this) {
            self::FALSE => Color::Blue,
            self::TRUE => Color::Red,
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::TRUE => 'Si',
            self::FALSE => 'No',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::TRUE => 'heroicon-o-no-symbol',
            self::FALSE => 'heroicon-o-pencil',
        };
    }
}
