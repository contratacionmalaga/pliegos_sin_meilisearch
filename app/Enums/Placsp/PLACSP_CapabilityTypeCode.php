<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_CapabilityTypeCode: string implements HasLabel
{
    case Clasificacion = '1';
    case InformeEntidadesFinancieras = '2';
    case SeguroIndemnizacion = '3';
    case FondosPropios = '4';
    case CifraAnualNegocio = '5';

    public function getLabel(): string
    {
        return match ($this) {
            self::Clasificacion => 'Clasificación',
            self::InformeEntidadesFinancieras => 'Informe entidades financieras',
            self::SeguroIndemnizacion => 'Seguro de indemnización',
            self::FondosPropios => 'Fondos propios',
            self::CifraAnualNegocio => 'Cifra anual de negocio',
        };
    }

    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }
}
