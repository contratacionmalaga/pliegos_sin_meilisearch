<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_PublicationTypeCode: string implements HasColor, HasIcon, HasLabel, HasDescription
{

    case Licitacion = '1';
    case Contrato_Menor = '2';
    case Encargo_Medio_Propio = '3';
    case Consulta_Preliminar_Mercado='4';

    public function getLabel(): string
    {
        return match ($this) {
            self::Licitacion => 'Licitación',
            self::Contrato_Menor => 'Contrato Menor',
            self::Encargo_Medio_Propio => 'Encargo a medio propio',
            self::Consulta_Preliminar_Mercado => 'Consulta preliminar del mercado',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Licitacion => Color::Orange,
            self::Contrato_Menor => Color::Green,
            self::Encargo_Medio_Propio => Color::Blue,
            self::Consulta_Preliminar_Mercado => Color::Yellow,
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Licitacion => 'heroicon-m-sparkles',
            self::Contrato_Menor => 'heroicon-m-arrow-path',
            self::Encargo_Medio_Propio => 'heroicon-m-arrow-path',
            self::Consulta_Preliminar_Mercado => 'heroicon-m-arrow-path',
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
