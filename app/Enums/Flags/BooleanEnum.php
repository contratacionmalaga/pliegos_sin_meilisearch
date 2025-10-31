<?php

namespace App\Enums\Flags;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum BooleanEnum: int implements HasColor, HasIcon, HasLabel
{
    case TRUE = 1;
    case FALSE = 0;

    /**
     * @return string
     */
    public function getColor(): string
    {
       return match ($this) {
            self::TRUE => 'success',
            self::FALSE => 'danger'
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
            self::TRUE => 'heroicon-o-check-circle',
            self::FALSE => 'heroicon-o-x-circle',
        };
    }
}
