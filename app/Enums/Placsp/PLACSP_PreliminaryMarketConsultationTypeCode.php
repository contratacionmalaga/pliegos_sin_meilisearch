<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_PreliminaryMarketConsultationTypeCode: string implements HasLabel, HasIcon, HasColor
{

    case ConsultaAbierta = 'A';
    case SeleccionParticipantes = 'S';

    public function getLabel(): string
    {
        return match ($this) {
            self::ConsultaAbierta => 'Consulta abierta',
            self::SeleccionParticipantes => 'Seleccionar participantes',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::ConsultaAbierta => 'heroicon-o-hand-thumb-up',
            self::SeleccionParticipantes => 'heroicon-o-hand-raised',
        };
    }

    /**
     * @return array
     */
    public function getColor(): array
    {
        return match ($this) {
            self::ConsultaAbierta => Color::Green,
            self::SeleccionParticipantes => Color::Fuchsia,
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
