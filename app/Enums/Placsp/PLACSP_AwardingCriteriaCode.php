<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_AwardingCriteriaCode: string implements HasLabel, HasIcon, HasColor
{

    // Tipos de criterios de adjudicación

    case Objetivo = 'OBJ';
    case Subjetivo = 'SUBJ';

    public function getLabel(): string
    {
        return match ($this) {
            self::Objetivo => 'Objetivo',
            self::Subjetivo => 'Subjetivo',
        };
    }

    public function getShortLabel(): string
    {
        return match ($this) {
            self::Objetivo => 'Obj.',
            self::Subjetivo => 'Subj.',
        };
    }

    public function getTinyLabel(): string
    {
        return match ($this) {
            self::Objetivo => 'Obj.',
            self::Subjetivo => 'Subj.',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Objetivo => 'heroicon-o-variable',
            self::Subjetivo => 'heroicon-o-question-mark-circle',
        };
    }

    public function getColor(): array
    {
        return match ($this) {
            self::Objetivo => Color::Green,
            self::Subjetivo => Color::Red,
        };
    }


    public function getColorHex(): string
    {
        return match ($this) {
            self::Objetivo => '#00c951',
            self::Subjetivo => '#fb2c36',
        };
    }


    public function getDescription(): string
    {

        return $this->getLabel();
    }

    public static function ordenar(): array
    {

        return sortEnumByLabel(self::cases());
    }
}
