<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_ProcurementNationalLegislationCode: string implements HasLabel
{

    case NoAplica = '0';
    case RDL_3_2020 = '1';
    case Ley_24_2011 = '2';
    case Ley_9_2017 = '3';

    public function getLabel(): string
    {
        return match ($this) {
            self::NoAplica => 'No Aplica',
            self::RDL_3_2020 => 'RDL 3/2020',
            self::Ley_24_2011 => 'Ley 24/2011',
            self::Ley_9_2017 => 'Ley 9/2017',

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
