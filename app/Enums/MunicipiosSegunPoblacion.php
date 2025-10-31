<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum MunicipiosSegunPoblacion: string implements HasColor, HasIcon, HasLabel, HasDescription
{
    case Menor_1000 = '1';
    case Entre_1000_5000 = '2';
    case Entre_5000_20000 = '3';
    case Mayor_20000_NoGranProblacion = '4';
    case Gran_Poblacion = '5';

    /**
     * @return array<string, string>
     */
    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }

    /**
     * @return int
     */
    public function getNavigationSort(): int
    {
        return match ($this) {
            self::Menor_1000 => 1,
            self::Entre_1000_5000 => 2,
            self::Entre_5000_20000 => 3,
            self::Mayor_20000_NoGranProblacion => 4,
            self::Gran_Poblacion => 5
        };
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->getLabel();
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::Menor_1000 => 'Menor de 1.000 habitantes',
            self::Entre_1000_5000 => 'Entre 1.000 y 5.000 habitantes',
            self::Entre_5000_20000 => 'Entre 5.000 y 20.000 habitantes',
            self::Mayor_20000_NoGranProblacion => 'Mayor 20.000 habitantes',
            self::Gran_Poblacion => 'Gran Población',
        };
    }

    /**
     * @return string|array<string, mixed>|null
     */
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Menor_1000 => Color::Amber,
            self::Entre_1000_5000 => Color::Lime,
            self::Entre_5000_20000 => Color::Cyan,
            self::Mayor_20000_NoGranProblacion => Color::Purple,
            self::Gran_Poblacion => Color::Blue,
        };
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return 'heroicon-m-user-group';
    }
}
