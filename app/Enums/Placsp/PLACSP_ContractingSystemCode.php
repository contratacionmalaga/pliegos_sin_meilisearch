<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_ContractingSystemCode: string implements HasLabel
{

    // Tipos de tramitación en un procedimiento de licitación

    case NoAplica = '0';
    case EstablecimientoAcuerdoMarco = '1';
    case EstablecimientoSistemaDinamicoAdquisicion = '2';
    case ContratoBasadoAcuerdoMarco = '3';
    case ContratoBasadoSistemaDinamicoAdquisicion = '4';

    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }

    public function getLabel(): string
    {

        return match ($this) {
            self::NoAplica => 'No aplica',
            self::EstablecimientoAcuerdoMarco => 'Establecimiento del Acuerdo Marco',
            self::EstablecimientoSistemaDinamicoAdquisicion => 'Establecimiento del Sistema Dinámico de Adquisición',
            self::ContratoBasadoAcuerdoMarco => 'Contrato basado en un Acuerdo Marco',
            self::ContratoBasadoSistemaDinamicoAdquisicion => 'Contrato basado en un Sistema Dinámico de Adquisición',
        };
    }
}
