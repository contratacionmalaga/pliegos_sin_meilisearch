<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_TenderPresentationCode: string implements HasLabel, HasColor, HasIcon
{

    // Type de Presentación de la Oferta

    case UnSoloLote = '1';
    case TodosLosLotes = '2';
    case UnoVariosLotes = '3';

    public function getLabel(): string
    {
        return match ($this) {
            self::UnSoloLote => 'A un solo lote',
            self::TodosLosLotes => 'A todos los lotes',
            self::UnoVariosLotes => 'A uno o varios lotes',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::UnSoloLote => Color::Gray,
            self::TodosLosLotes => Color::Green,
            self::UnoVariosLotes => Color::Purple,
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::UnSoloLote => 'heroicon-o-h1',
            self::TodosLosLotes => 'heroicon-o-h2',
            self::UnoVariosLotes => 'heroicon-o-h3',
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


