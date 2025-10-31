<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_PreliminaryMarketConsultationStatusCode: string implements HasLabel, HasIcon, HasColor
{

    case Creada = 'CRE';
    case Publicada = 'PUB';
    case Realizada = 'REA';
    case Anulada = 'ANU';

    public function getLabel(): string
    {
        return match ($this) {
            self::Creada => 'Creada',
            self::Publicada => 'Publicada',
            self::Realizada => 'Realizada',
            self::Anulada => 'Anulada',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Creada => 'heroicon-o-plus',
            self::Publicada => 'heroicon-o-document-plus',
            self::Realizada => 'heroicon-o-squares-plus',
            self::Anulada => 'heroicon-o-document-minus',
        };
    }

    /**
     * @return array
     */
    public function getColor(): array
    {
        return match ($this) {
            self::Creada => Color::Fuchsia,
            self::Publicada => Color::Orange,
            self::Realizada => Color::Green,
            self::Anulada => Color::Red,
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

