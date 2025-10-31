<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_ResultCode: string implements HasLabel, HasColor
{

    case ResultadoLicitacion_AdjudicadoProvisionalmente = '1';
    case ResultadoLicitacion_AdjudicadoDefinitivamente = '2';
    case Desierto = '3';
    case Desistimiento = '4';
    case Renuncia = '5';
    case Desierto_Provisionalmente = '6';
    case Desierto_Definitivamente = '7';
    case Adjudicado = '8';
    case Formalizado = '9';
    case Licitador_Mejor_Valorado = '10';
    case Encargo_Formalizado = '11';


    public static function ordenar(): array
    {
        // Obtener todos los casos del enum y ordenarlos por la etiqueta
        return sortEnumByValue(self::cases());
    }

    public function getDescription(): string
    {

        return $this->getLabel();
    }

    public function getLabel(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return match ($this) {
            self::ResultadoLicitacion_AdjudicadoProvisionalmente => '#FF5733', // Rojo
            self::ResultadoLicitacion_AdjudicadoDefinitivamente => '#33FF57', // Verde
            self::Desierto => '#3357FF', // Azul
            self::Desistimiento => '#FF33A6', // Rosa
            self::Renuncia => '#FF9633', // Naranja
            self::Desierto_Provisionalmente => '#33FFF5', // Turquesa
            self::Desierto_Definitivamente => '#9c27b0', // Púrpura
            self::Adjudicado => '#2196F3', // Azul claro
            self::Formalizado => '#FF9800', // Amarillo
            self::Licitador_Mejor_Valorado => '#673AB7', // Violeta
            self::Encargo_Formalizado => '#4CAF50', // Verde claro
        };
    }
}


