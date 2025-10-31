<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_ProcurementLegislationDocumentReferenceID: string implements HasLabel
{

    case Directiva_23_2014 = '2014/23/EU';
    case Directiva_24_2014 = '2014/24/EU';
    case Directiva_25_2014 = '2014/25/EU';
    case Directiva_2009_81 = '2009/81/EC';
    case NoAplica = 'N/A';

    public function getLabel(): string
    {
        return match ($this) {
            self::Directiva_23_2014 => 'Directiva 2014/23/UE sobre contratos de concesiones',
            self::Directiva_24_2014 => 'Directiva 2014/24/UE sobre contratación pública',
            self::Directiva_25_2014 => 'Directiva 2014/25/UE sobre contratación en sectores especiales',
            self::Directiva_2009_81 => 'Directiva 2009/81/CE sobre contratación en defensa y seguridad',
            self::NoAplica => 'No Aplica',
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
