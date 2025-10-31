<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_PublicPrivateCollaborationContractTypeCode: string implements HasLabel, HasDescription
{
    case Suministros = '1';
    case Servicios = '2';
    case Obras   = '3';



    public function getLabel(): string
    {
        return match ($this) {
            self::Suministros => 'Suministros',
            self::Servicios => 'Servicios',
            self::Obras => 'Obras',

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
