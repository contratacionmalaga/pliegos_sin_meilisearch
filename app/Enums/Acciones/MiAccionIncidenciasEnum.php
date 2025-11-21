<?php

namespace App\Enums\Acciones;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use phpDocumentor\Reflection\Types\Self_;
use function Laravel\Prompts\select;
use function Symfony\Component\String\s;

enum MiAccionIncidenciasEnum: string implements HasColor, HasDescription, HasIcon, HasLabel
{
    case CrearIncidencia = 'crear-incidencia';
    case CrearRespuestaIncidencia = 'crear-respuesta-incidencia';


    public function getLabel(): string
    {
        return match ($this) {
            self::CrearIncidencia => 'Crear Incidencia',
            self::CrearRespuestaIncidencia => 'Crear Respuesta Incidencia',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::CrearIncidencia => 'heroicon-o-cloud-arrow-down',
            self::CrearRespuestaIncidencia => 'heroicon-o-cloud-arrow-down',
        };
    }

    /**
     * @return array<int,string>
     */
    public function getColor(): array
    {
        return match ($this) {

            self::CrearIncidencia => Color::Zinc,
            self::CrearRespuestaIncidencia => Color::Zinc,

        };
    }

    public function getTooltip(): string
    {
        return match ($this) {
            self::CrearIncidencia => 'Crear Incidencia',
            self::CrearRespuestaIncidencia => 'Crear Respuesta Incidencia',
        };
    }

    public function getDescription(): string
    {
        return match ($this) {

            default => 'getDescription() - no implementado',
        };
    }
}


