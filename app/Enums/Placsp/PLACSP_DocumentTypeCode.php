<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_DocumentTypeCode: string implements HasLabel
{

    case NIF = '1';
    case CIF = '2';
    case NIE = '3';

    public function getLabel(): string
    {
        return match ($this) {
            self::NIF => 'NIF',
            self::CIF => 'CIF',
            self::NIE => 'NIE',
        };
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
