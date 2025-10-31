<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_SyndicationResultCode: string implements HasLabel, HasColor
{

    case Desierto = '3';
    case Desistimiento = '4';
    case Renuncia = '5';
    case Adjudicado = '8';
    case Formalizado = '9';

    public function getLabel(): string
    {
        return match ($this) {
            self::Desierto => 'Desierto',
            self::Desistimiento => 'Desistimiento',
            self::Renuncia => 'Renuncia',
            self::Adjudicado => 'Adjudicado',
            self::Formalizado => 'Formalizado',
        };
    }


    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Desierto => Color::Slate,
            self::Desistimiento => Color::Yellow,
            self::Renuncia => Color::Lime,
            self::Adjudicado => Color::Teal,
            self::Formalizado => Color::Cyan,
        };
    }

    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }
}
