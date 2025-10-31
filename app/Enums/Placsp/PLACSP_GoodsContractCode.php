<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_GoodsContractCode: string implements HasColor, HasDescription, HasIcon, HasLabel
{
    case Alquiler = '1';
    case Adquisicion = '2';

    public function getLabel(): string
    {
        return match ($this) {
            self::Alquiler => 'Alquiler',
            self::Adquisicion => 'Adquisición',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Alquiler => Color::hex('#d52685'),
            self::Adquisicion => Color::hex('#553a99'),
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Alquiler => 'heroicon-m-sparkles',
            self::Adquisicion => 'heroicon-m-arrow-path',
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
