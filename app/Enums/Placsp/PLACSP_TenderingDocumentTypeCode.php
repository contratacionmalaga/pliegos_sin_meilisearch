<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_TenderingDocumentTypeCode: string implements HasLabel, HasColor
{

    case NULO = '';
    case ACTA_ADJ = 'ACTA_ADJ';
    case ACTA_FORM = 'ACTA_FORM';

    public function getLabel(): string
    {
        return match ($this) {
            self::NULO => '',
            self::ACTA_ADJ => 'Documento de Acta de Resolución',
            self::ACTA_FORM => 'Documento de Acta de Formalización',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::NULO => Color::Slate,
            self::ACTA_ADJ => Color::Fuchsia,
            self::ACTA_FORM => Color::Orange,
        };
    }

    public static function ordenar(): array
    {

        return sortEnumByValue(
            array_filter(self::cases(), static fn($case) => $case !== self::NULO)
        );
    }
}
