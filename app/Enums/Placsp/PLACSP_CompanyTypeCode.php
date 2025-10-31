<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_CompanyTypeCode: string implements HasLabel
{

    case UTE = '1';
    case PersonaFisica = '2';

    public function getLabel(): string
    {
        return match ($this) {
            self::UTE => 'UTE',
            self::PersonaFisica => 'Persona Física',
        };
    }

    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }
}
