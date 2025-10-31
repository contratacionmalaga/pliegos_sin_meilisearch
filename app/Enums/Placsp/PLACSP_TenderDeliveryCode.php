<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_TenderDeliveryCode: string implements HasLabel
{

    case Electronica = '1';
    case Manual = '2';
    case Manual_Y_O_Electronica = '3';

    public function getLabel(): string
    {
        return match ($this) {
            self::Electronica => 'Electronica',
            self::Manual => 'Manual',
            self::Manual_Y_O_Electronica => 'Manual y/o Electrónica',
        };
    }

    public function getDescription(): string
    {

        return $this->getLabel();
    }

    public static function ordenarContratoMenor(): array
    {
        $valoresContratoMenor = [
            self::Manual
        ];

        // Obtener todos los casos del enum y ordenarlos por la etiqueta
        return sortEnumByValue($valoresContratoMenor);
    }

    public static function ordenar(): array
    {
        // Obtener todos los casos del enum y ordenarlos por la etiqueta
        return sortEnumByValue(self::cases());
    }
}
