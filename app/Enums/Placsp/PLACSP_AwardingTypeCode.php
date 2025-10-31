<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_AwardingTypeCode: string implements HasLabel
{

    // Tipos de criterios de adjudicación

    case OfertaMasVentajosa = '1';
    case PrecioMasBajo = '2';

    public function getLabel(): string
    {
        return match ($this) {
            self::OfertaMasVentajosa => 'Oferta más ventajosa',
            self::PrecioMasBajo => 'Precio más bajo',
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
