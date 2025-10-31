<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;


enum PLACSP_ExecutionRequirementCode: string implements HasColor, HasLabel, HasIcon
{

    case TIPO_AMBIENTAL = '1';
    case TIPO_SOCIAL = '2';
    case PROMOVER_EMPLEO = '3';
    case ELIMINAR_DESIGUALDADES = '4';
    case COMBATIR_PARO = '5';
    case FAVORECER_FORMACION_LUGAR_TRABAJO = '6';
    case CUMPLIMIENTO_CONVENCIONES_ORGANIZACION_MUNDIAL = '7';
    case SOMETIMIENTO_NORMATIVA_PROTECCION_DATOS = '8';

    public function getLabel(): string
    {
        return match ($this) {
            self::TIPO_AMBIENTAL => 'Consideraciones de tipo ambiental',
            self::TIPO_SOCIAL => 'Consideraciones tipo social',
            self::PROMOVER_EMPLEO => 'Promover el empleo de personas con dificultades particulares de inserción en el mercado laboral',
            self::ELIMINAR_DESIGUALDADES => 'Eliminar desigualdades entre el hombre y la mujer',
            self::COMBATIR_PARO => 'Combatir el paro',
            self::FAVORECER_FORMACION_LUGAR_TRABAJO => 'Favorecer la formación en el lugar de trabajo',
            self::CUMPLIMIENTO_CONVENCIONES_ORGANIZACION_MUNDIAL => 'Cumplimiento de las Convenciones fundamentales de la Organización Mundial del Trabajo',
            self::SOMETIMIENTO_NORMATIVA_PROTECCION_DATOS => 'Sometimiento del contratista a la normativa de protección de datos',
        };
    }

    public function getShortLabel(): string
    {
        return match ($this) {
            self::TIPO_AMBIENTAL => 'Tipo ambiental',
            self::TIPO_SOCIAL => 'Tipo social',
            self::PROMOVER_EMPLEO => 'Promover empleo',
            self::ELIMINAR_DESIGUALDADES => 'Eliminar desigualdades',
            self::COMBATIR_PARO => 'Combatir paro',
            self::FAVORECER_FORMACION_LUGAR_TRABAJO => 'Formación en el trabajo',
            self::CUMPLIMIENTO_CONVENCIONES_ORGANIZACION_MUNDIAL => 'Convenciones OIT',
            self::SOMETIMIENTO_NORMATIVA_PROTECCION_DATOS => 'Normativa protección datos',
        };
    }

    public function getTinyLabel(): string
    {
        return match ($this) {
            self::TIPO_AMBIENTAL => 'Ambiental',
            self::TIPO_SOCIAL => 'Social',
            self::PROMOVER_EMPLEO => 'Empleo',
            self::ELIMINAR_DESIGUALDADES => 'Igualdad',
            self::COMBATIR_PARO => 'Paro',
            self::FAVORECER_FORMACION_LUGAR_TRABAJO => 'Formación',
            self::CUMPLIMIENTO_CONVENCIONES_ORGANIZACION_MUNDIAL => 'Conv. OIT',
            self::SOMETIMIENTO_NORMATIVA_PROTECCION_DATOS => 'Prot. datos',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::TIPO_AMBIENTAL => 'heroicon-o-sun',
            self::TIPO_SOCIAL => 'heroicon-o-user-group',
            self::PROMOVER_EMPLEO => 'heroicon-o-currency-euro',
            self::ELIMINAR_DESIGUALDADES => 'heroicon-o-equals',
            self::COMBATIR_PARO => 'heroicon-o-user-plus',
            self::FAVORECER_FORMACION_LUGAR_TRABAJO => 'heroicon-o-newspaper',
            self::CUMPLIMIENTO_CONVENCIONES_ORGANIZACION_MUNDIAL => 'heroicon-o-globe-europe-africa',
            self::SOMETIMIENTO_NORMATIVA_PROTECCION_DATOS => 'heroicon-o-computer-desktop',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::TIPO_AMBIENTAL => Color::Fuchsia,
            self::TIPO_SOCIAL => Color::Orange,
            self::PROMOVER_EMPLEO => Color::Slate,
            self::ELIMINAR_DESIGUALDADES => Color::Yellow,
            self::COMBATIR_PARO => Color::Lime,
            self::FAVORECER_FORMACION_LUGAR_TRABAJO => Color::Green,
            self::CUMPLIMIENTO_CONVENCIONES_ORGANIZACION_MUNDIAL => Color::Emerald,
            self::SOMETIMIENTO_NORMATIVA_PROTECCION_DATOS => Color::Teal,
        };
    }

    public function getColorHex(): string
    {
        return match ($this) {
            self::TIPO_AMBIENTAL => '#d946ef', // Fuchsia 500
            self::TIPO_SOCIAL => '#f97316',    // Orange 500
            self::PROMOVER_EMPLEO => '#64748b', // Slate 500
            self::ELIMINAR_DESIGUALDADES => '#eab308', // Yellow 500
            self::COMBATIR_PARO => '#84cc16', // Lime 500
            self::FAVORECER_FORMACION_LUGAR_TRABAJO => '#22c55e', // Green 500
            self::CUMPLIMIENTO_CONVENCIONES_ORGANIZACION_MUNDIAL => '#10b981', // Emerald 500
            self::SOMETIMIENTO_NORMATIVA_PROTECCION_DATOS => '#14b8a6', // Teal 500
            default => '#000000', // fallback negro
        };
    }


    public static function ordenar(): array
    {

        return sortEnumByLabel(self::cases());
    }
}
