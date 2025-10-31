<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_SyndicationContractFolderStatusCode: string implements HasLabel, HasColor
{

    case PRE = 'PRE';
    case PUB = 'PUB';
    case EV = 'EV';
    case ADJ = 'ADJ';
    case RES = 'RES';
    case ANUL = 'ANUL';

    public static function ordenar(): array
    {

        return sortEnumByLabel(self::cases());
    }

    public function getColor(): array
    {
        return match ($this) {
            self::PRE => Color::Stone,
            self::PUB => Color::Green,
            self::EV => Color::Fuchsia,
            self::ADJ => Color::Amber,
            self::RES => Color::Teal,
            self::ANUL => Color::Red,
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::PRE => 'Anuncio previo',
            self::PUB => 'En plazo presentación ofertas',
            self::EV => 'Pendiente adjudicación',
            self::ADJ => 'Adjudicada',
            self::RES => 'Resuelta',
            self::ANUL => 'Anulada',
        };
    }
}


