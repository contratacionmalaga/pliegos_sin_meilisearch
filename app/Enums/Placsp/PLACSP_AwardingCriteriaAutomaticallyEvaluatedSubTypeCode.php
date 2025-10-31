<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_AwardingCriteriaAutomaticallyEvaluatedSubTypeCode: string implements HasLabel, HasIcon, HasColor
{

    // Tipos de criterios de adjudicación

    case Precio = '1';
    case Otros = '2';
    case Medioambiental = '3';
    case Social = '4';
    case Innovacion = '5';

    public function getLabel(): string
    {
        return match ($this) {
            self::Precio => 'Precio',
            self::Otros => 'Otros',
            self::Medioambiental => 'Medioambiental',
            self::Social => 'Social',
            self::Innovacion => 'Innovación',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Precio => 'heroicon-o-currency-euro',
            self::Otros => 'heroicon-o-question-mark-circle',
            self::Medioambiental => 'heroicon-o-sun',
            self::Social => 'heroicon-o-user-group',
            self::Innovacion => 'heroicon-o-beaker',
        };
    }

    public function getColor(): array
    {
        return match ($this) {
            self::Precio => Color::Blue,
            self::Otros => Color::Slate,
            self::Medioambiental => Color::Green,
            self::Social => Color::Purple,
            self::Innovacion => Color::Amber,
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
}
