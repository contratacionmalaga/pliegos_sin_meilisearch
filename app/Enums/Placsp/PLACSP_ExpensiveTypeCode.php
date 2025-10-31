<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_ExpensiveTypeCode: string implements HasColor, HasIcon, HasLabel
{

    // Código de Tramitación del Gasto

    case TramitacionGastoOrdinaria = '1';
    case TramitacionGastoAnticipada = '2';

    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }

    /**
     * @return string|array|null
     */
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::TramitacionGastoOrdinaria => Color::Green,
            self::TramitacionGastoAnticipada => Color::Red,
        };
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return match ($this) {
            self::TramitacionGastoOrdinaria => 'heroicon-m-sparkles',
            self::TramitacionGastoAnticipada => 'heroicon-m-arrow-path',
        };
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {

        return $this->getLabel();
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::TramitacionGastoOrdinaria => 'Ordinaria',
            self::TramitacionGastoAnticipada => 'Anticipada',
        };
    }
}
