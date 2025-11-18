<?php

namespace App\Enums\Incidencias;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum EstadoIncidenciaEnum: int implements HasLabel, HasColor
{

    case TO_DO = 1;
    case EN_RESOLUCION = 2;
    case EN_REVISION = 3;
    case RESUELTA = 4;

//To Do       1
//In Progress 2
//Review      3
//Done        4


//    public function getLabel(): string
//    {
//        return $this->name;
//    }

    public function getLabel(): string
    {
        return match ($this) {
            self::TO_DO => 'Creada',
            self::EN_RESOLUCION => 'En Resolucion',
            self::EN_REVISION => 'En Revision',
            self::RESUELTA => 'Resuelta',
        };
    }

    public static function ordenar(): array
    {

        return sortEnumByLabel(self::cases());
    }

    /**
     * @return string|array|null
     */
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::TO_DO => Color::Lime,
            self::EN_RESOLUCION => Color::Green,
            self::EN_REVISION => Color::Emerald,
            self::RESUELTA => Color::Teal,
        };
    }

    /**
     * @return string|null
     */
    public function getColorHex(): ?string
    {
        return match ($this) {
            self::TO_DO => '#84cc16',   // Lime-500
            self::EN_RESOLUCION => '#22c55e',   // Green-500
            self::EN_REVISION => '#10b981',   // Emerald-500
            self::RESUELTA => '#14b8a6',   // Teal-500
            default => '#ef4444',   // Red-500
        };
    }

}


