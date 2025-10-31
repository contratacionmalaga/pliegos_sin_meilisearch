<?php

namespace App\Enums\Flags;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ActivoOrganoContratacionEnum: string implements HasColor, HasIcon, HasLabel
{
    case TRUE = 'Activo';
    case FALSE = 'Inactivo';

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
            self::FALSE => 'Inactivo',
            self::TRUE => 'Activo',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::FALSE => 'heroicon-o-exclamation-triangle',
            self::TRUE => 'heroicon-o-shield-check',
        };
    }
}
