<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_ContractModificationReasonCode: string implements HasLabel
{

    // Tipos de tramitación en un procedimiento de licitación

    case NecesidadAdicional = '1';
    case NecesidadCircustanciaNoPrevista = '2';

    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }

    public function getLabel(): string
    {

        return match ($this) {
            self::NecesidadAdicional => 'Necesidad de obras, servicios o suministros adicionales, a cargo del contratista/concesionario inicial [artículo 43, apartado 1, letra b), de la Directiva 2014/23/UE; artículo 72, apartado 1, letra b), de la Directiva 2014/24/UE y artículo 89, apartado 1, letra b), de la Directiva 2014/25/UE]',
            self::NecesidadCircustanciaNoPrevista => 'Necesidad de modificación derivada de circunstancias que un poder adjudicador diligente no podrá prever [artículo 43, apartado 1, letra c), de la Directiva 2014/23/UE; artículo 72, apartado 1, letra c), de la Directiva 2014/24/UE y artículo 89, apartado 1, letra c), de la Directiva 2014/25/UE]',
        };
    }
}
