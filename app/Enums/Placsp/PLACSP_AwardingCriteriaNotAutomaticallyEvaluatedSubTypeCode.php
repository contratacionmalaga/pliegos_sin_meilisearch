<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_AwardingCriteriaNotAutomaticallyEvaluatedSubTypeCode: string implements HasLabel, HasColor, HasIcon
{

    // Tipos de criterios de adjudicación


    case Medioambiental = '01';
    case Social = '02';
    case Innovacion = '03';
    case Otros = '99';

    public function getLabel(): string
    {
        return match ($this) {
            self::Otros => 'Otros',
            self::Medioambiental => 'Medioambiental',
            self::Social => 'Social',
            self::Innovacion => 'Innovación',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Otros => 'heroicon-o-question-mark-circle',
            self::Medioambiental => 'heroicon-o-sun',
            self::Social => 'heroicon-o-user-group',
            self::Innovacion => 'heroicon-o-beaker',
        };
    }

    public function getColor(): array
    {
        return match ($this) {
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
