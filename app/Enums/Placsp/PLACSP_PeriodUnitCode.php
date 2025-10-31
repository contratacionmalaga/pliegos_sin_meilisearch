<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_PeriodUnitCode: string implements HasLabel
{

    // name = 'Annios'
    // value 'ANN'

    case Annios = 'ANN';
    case Meses = 'MON';
    case Dias = 'DAY';

    public function getLabel(): string
    {
        return match ($this) {
            self::Annios => 'Años',
            self::Meses => 'Meses',
            self::Dias => 'Días',
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
