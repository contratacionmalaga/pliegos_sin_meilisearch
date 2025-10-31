<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_FundingProgramCode: string implements HasLabel
{

    case Europeo = 'EU';
    case Nacional = 'NAC';
    case Autonomico = 'AUT';
    case Local = 'LOC';
    case CompraPublicaInnovadora = 'CPTI';
    case CompraPublicaPrecomercial = 'CPP';
    case No_Europeo = 'NO-EU';
    case Fondos_REU = 'REU';
    case Fondos_FEDER = 'FEDER';
    case Fondos_FSE = 'FSE+';
    case Fondos_FEADER = 'FEADER';
    case Fondos_FEMP = 'FEMP';
    case Fondos_PRTR = 'PRTR';
    case Fondos_OFE = 'OFE';


    public function getLabel(): string
    {
        return match ($this) {
            self::Europeo => 'Financiación con fondos de la UE',
            self::Nacional => 'Subvencionado por un programa nacional',
            self::Autonomico => 'Subvencionado por un programa autonómico',
            self::Local => 'Subvencionado por un programa local',
            self::CompraPublicaInnovadora => 'Compra Pública de Tecnología Innovadora',
            self::CompraPublicaPrecomercial => 'Compra Pública Precomercial',
            self::No_Europeo => 'No hay financiación con fondos de la UE',
            self::Fondos_REU => 'Ayuda a la Recuperación para la cohesión y los territorios de Europa',
            self::Fondos_FEDER => 'Fondo Europeo de Desarrollo Regional',
            self::Fondos_FSE => 'Fondo Social Europeo Plus',
            self::Fondos_FEADER => 'Fondo Europeo Agrícola del Desarrollo Rural',
            self::Fondos_FEMP => 'Fondo Europeo Marítimo y de Pesca',
            self::Fondos_PRTR => 'Asociado al Plan de Recuperación, Transformación y Resiliencia',
            self::Fondos_OFE => 'Otros Fondos Europeos',
        };
    }

    public static function ordenarFinanciacionUE(): array
    {
        $valores = [
            self::No_Europeo,
            self::Fondos_REU,
            self::Fondos_FEDER,
            self::Fondos_FSE,
            self::Fondos_FEADER,
            self::Fondos_FEMP,
            self::Fondos_PRTR,
            self::Fondos_OFE
        ];

        return sortEnumByValue($valores);
    }

    public function getDescription(): string
    {

        return $this->getLabel();
    }

    public static function ordenar(): array
    {
        // Obtener todos los casos del enum y ordenarlos por la etiqueta
        return sortEnumByValue(self::cases());
    }
}
