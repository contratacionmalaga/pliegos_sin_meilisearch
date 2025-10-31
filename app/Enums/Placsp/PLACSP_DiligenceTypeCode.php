<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_DiligenceTypeCode: string implements HasLabel, HasIcon, HasColor
{

    // Tipos de tramitación en un procedimiento de licitación

    case TramitacionExpedienteOrdinaria = '1';
    case TramitacionExpedienteUrgente = '2';
    case TramitacionExpedienteEmergencia = '3';

    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }

    public static function mapValorRendicionCuentas(string $valor = null): ?string
    {
        return match ($valor) {
            'W', 'w' => self::TramitacionExpedienteOrdinaria->value,
            'Y' => self::TramitacionExpedienteUrgente->value,
            'Z' => self::TramitacionExpedienteEmergencia->value,
            default => null, // Valor por defecto si no hay coincidencia
        };
    }

    /**
     * @return string|array|null
     */
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::TramitacionExpedienteOrdinaria => Color::Green,
            self::TramitacionExpedienteUrgente => Color::Amber,
            self::TramitacionExpedienteEmergencia => Color::Red,
        };
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return match ($this) {
            self::TramitacionExpedienteOrdinaria => 'heroicon-m-sparkles',
            self::TramitacionExpedienteUrgente => 'heroicon-m-arrow-path',
            self::TramitacionExpedienteEmergencia => 'heroicon-o-rocket-launch',
        };
    }

    public function getDescription(): string
    {

        return $this->getLabel();
    }

    public function toRC(): string
    {
        return match ($this) {
            self::TramitacionExpedienteOrdinaria => 'O',
            self::TramitacionExpedienteUrgente => 'U',
            self::TramitacionExpedienteEmergencia => 'E',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::TramitacionExpedienteOrdinaria => 'Ordinaria',
            self::TramitacionExpedienteUrgente => 'Urgente',
            self::TramitacionExpedienteEmergencia => 'Emergencia',
        };
    }
}
