<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_AwardingCriteriaSubtypeCode: string implements HasLabel
{

    // Tipos de criterios de adjudicación

    case Precio = '1';
    case Otros = '2';

    public function getLabel(): string
    {
        return match ($this) {
            self::Precio => 'Precio',
            self::Otros => 'Otros',
        };
    }

    public static function ordenar(): array
    {

        return sortEnumByLabel(self::cases());
    }
}
