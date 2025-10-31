<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_DeclarationTypeCode: string implements HasLabel, HasIcon, HasColor
{

    // Tipos de tramitación en un procedimiento de licitación

    case CAPACIDAD_OBRAR = '1';
    case NO_PROHIBICION_CONTRATAR = '2';
    case NO_ESTAR_INCURSO_INCOMPATIBILIDADES = '3';
    case TGSS = '4';
    case AEAT = '5';
    case NO_CONTRATOS_ANTERIORES = '7';
    case PREREGISTRADO_ROLECE = '8';
    case EMPRESAS_EXTRANJERAS = '9';
    case CONTRATOS_RESERVADOS_CENTROS_EMPLEO = '10';
    case CONTRATOS_RESERVADOS_PROGRAMAS_EMPELO_PROTEGIDO = '11';
    case EMPRESAS_CON_TRABAJADORES_CON_DISCAPACIDAD = '12';
    case EMPRESAS_DEDICADAS_INSERCION_LABORAL = '13';
    case CONTRATO_RESERVADO_PROFESION_DETERMINADA = '14';
    case TALLERES_PROGEGIDOS = '16';
    case RESERVADO_ORGANIZACIONES_CUMPLAN_DIRECTIVA_CONTRATACION = '17';


    public static function ordenar(): array
    {

        return sortEnumByLabel(self::cases());
    }

    /**
     * @return string|array|null
     */
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::CAPACIDAD_OBRAR => Color::Lime,
            self::NO_PROHIBICION_CONTRATAR => Color::Green,
            self::NO_ESTAR_INCURSO_INCOMPATIBILIDADES => Color::Emerald,
            self::TGSS => Color::Teal,
            self::AEAT => Color::Cyan,
            self::NO_CONTRATOS_ANTERIORES => Color::Sky,
            self::PREREGISTRADO_ROLECE => Color::Blue,
            self::EMPRESAS_EXTRANJERAS => Color::Indigo,
            self::CONTRATOS_RESERVADOS_CENTROS_EMPLEO => Color::Violet,
            self::CONTRATOS_RESERVADOS_PROGRAMAS_EMPELO_PROTEGIDO => Color::Purple,
            self::EMPRESAS_CON_TRABAJADORES_CON_DISCAPACIDAD => Color::Fuchsia,
            self::EMPRESAS_DEDICADAS_INSERCION_LABORAL => Color::Pink,
            self::CONTRATO_RESERVADO_PROFESION_DETERMINADA => Color::Rose,
            self::TALLERES_PROGEGIDOS => Color::Slate,
            self::RESERVADO_ORGANIZACIONES_CUMPLAN_DIRECTIVA_CONTRATACION => Color::Gray,
        };
    }

    public function getColorHex(): string
    {
        return match ($this) {
            self::CAPACIDAD_OBRAR => '#84cc16', // Lime 500
            self::NO_PROHIBICION_CONTRATAR => '#22c55e', // Green 500
            self::NO_ESTAR_INCURSO_INCOMPATIBILIDADES => '#10b981', // Emerald 500
            self::TGSS => '#14b8a6', // Teal 500
            self::AEAT => '#06b6d4', // Cyan 500
            self::NO_CONTRATOS_ANTERIORES => '#0ea5e9', // Sky 500
            self::PREREGISTRADO_ROLECE => '#3b82f6', // Blue 500
            self::EMPRESAS_EXTRANJERAS => '#6366f1', // Indigo 500
            self::CONTRATOS_RESERVADOS_CENTROS_EMPLEO => '#8b5cf6', // Violet 500
            self::CONTRATOS_RESERVADOS_PROGRAMAS_EMPELO_PROTEGIDO => '#a855f7', // Purple 500
            self::EMPRESAS_CON_TRABAJADORES_CON_DISCAPACIDAD => '#d946ef', // Fuchsia 500
            self::EMPRESAS_DEDICADAS_INSERCION_LABORAL => '#ec4899', // Pink 500
            self::CONTRATO_RESERVADO_PROFESION_DETERMINADA => '#f43f5e', // Rose 500
            self::TALLERES_PROGEGIDOS => '#64748b', // Slate 500
            self::RESERVADO_ORGANIZACIONES_CUMPLAN_DIRECTIVA_CONTRATACION => '#6b7280', // Gray 500
            default => '#000000', // fallback negro
        };
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return match ($this) {
            self::CAPACIDAD_OBRAR => 'heroicon-o-document-text',
            self::NO_PROHIBICION_CONTRATAR => 'heroicon-o-document-arrow-up',
            self::NO_ESTAR_INCURSO_INCOMPATIBILIDADES => 'heroicon-o-document-arrow-down',
            self::TGSS => 'heroicon-o-document-currency-dollar',
            self::AEAT => 'heroicon-o-document-currency-euro',
            self::NO_CONTRATOS_ANTERIORES => 'heroicon-o-document-currency-rupee',
            self::PREREGISTRADO_ROLECE => 'heroicon-o-document-check',
            self::EMPRESAS_EXTRANJERAS => 'heroicon-o-document-currency-pound',
            self::CONTRATOS_RESERVADOS_CENTROS_EMPLEO => 'heroicon-o-document-magnifying-glass',
            self::CONTRATOS_RESERVADOS_PROGRAMAS_EMPELO_PROTEGIDO => 'heroicon-o-document-minus',
            self::EMPRESAS_CON_TRABAJADORES_CON_DISCAPACIDAD => 'heroicon-o-user',
            self::EMPRESAS_DEDICADAS_INSERCION_LABORAL => 'heroicon-o-user-plus',
            self::CONTRATO_RESERVADO_PROFESION_DETERMINADA => 'heroicon-s-user',
            self::TALLERES_PROGEGIDOS => 'heroicon-o-user-circle',
            self::RESERVADO_ORGANIZACIONES_CUMPLAN_DIRECTIVA_CONTRATACION => 'heroicon-o-user-group',
        };
    }

    public function getDescription(): string
    {

        return $this->getLabel();
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::CAPACIDAD_OBRAR => 'Capacidad de obrar',
            self::NO_PROHIBICION_CONTRATAR => 'No prohibición para contratar',
            self::NO_ESTAR_INCURSO_INCOMPATIBILIDADES => 'No estar incurso en incompatibilidades',
            self::TGSS => 'Cumplimiento con las obligaciones con la Seguridad Social',
            self::AEAT => 'Cumplimiento con las obligaciones tributarias',
            self::NO_CONTRATOS_ANTERIORES => 'No haber sido adjudicatario de los contratos anteriores de dirección y/o supervisión de la obra',
            self::PREREGISTRADO_ROLECE => 'Estar prerregistrado en el ROLECE, y declarar que no ha habido modificaciones en los datos registrados',
            self::EMPRESAS_EXTRANJERAS => 'Para las empresas extranjeras, declaración de sometimiento a la legislación española.',
            self::CONTRATOS_RESERVADOS_CENTROS_EMPLEO => 'Contratos reservados. Reservado a Centros Especiales de Empleo, o talleres protegidos',
            self::CONTRATOS_RESERVADOS_PROGRAMAS_EMPELO_PROTEGIDO => 'Contratos reservados. Reservado a programas de empleo protegido',
            self::EMPRESAS_CON_TRABAJADORES_CON_DISCAPACIDAD => 'Preferencia para empresas con trabajadores con discapacidad',
            self::EMPRESAS_DEDICADAS_INSERCION_LABORAL => 'Preferencia para empresas dedicadas a la promoción e inserción laboral de personas en situación de exclusión social',
            self::CONTRATO_RESERVADO_PROFESION_DETERMINADA => 'Contrato reservado a una profesión determinada',
            self::TALLERES_PROGEGIDOS => 'Reservado a talleres protegidos y operadores económicos cuyo objetivo principal sea la integración social y profesional de personas discapacitadas o desfavorecidas',
            self::RESERVADO_ORGANIZACIONES_CUMPLAN_DIRECTIVA_CONTRATACION => 'Reservado a organizaciones que cumplan con las condiciones establecidas en el art. 77 de la Directiva 2014/24/UE o en el art. 94 de la Directiva 2014/25/UE',
        };
    }

    public function getShortLabel(): string
    {
        return match ($this) {
            self::CAPACIDAD_OBRAR => 'Capacidad de obrar',
            self::NO_PROHIBICION_CONTRATAR => 'No prohibición',
            self::NO_ESTAR_INCURSO_INCOMPATIBILIDADES => 'Sin incompatibilidades',
            self::TGSS => 'Oblig. Seg. Social',
            self::AEAT => 'Oblig. tributarias',
            self::NO_CONTRATOS_ANTERIORES => 'Sin contratos previos',
            self::PREREGISTRADO_ROLECE => 'Prerregistrado ROLECE',
            self::EMPRESAS_EXTRANJERAS => 'Empresas extranjeras',
            self::CONTRATOS_RESERVADOS_CENTROS_EMPLEO => 'Res. Centros Empleo',
            self::CONTRATOS_RESERVADOS_PROGRAMAS_EMPELO_PROTEGIDO => 'Res. Empleo protegido',
            self::EMPRESAS_CON_TRABAJADORES_CON_DISCAPACIDAD => 'Emp. con discapacidad',
            self::EMPRESAS_DEDICADAS_INSERCION_LABORAL => 'Emp. inserción laboral',
            self::CONTRATO_RESERVADO_PROFESION_DETERMINADA => 'Prof. determinada',
            self::TALLERES_PROGEGIDOS => 'Talleres protegidos',
            self::RESERVADO_ORGANIZACIONES_CUMPLAN_DIRECTIVA_CONTRATACION => 'Res. organizaciones art. 77',
        };
    }

    public function getTinyLabel(): string
    {
        return match ($this) {
            self::CAPACIDAD_OBRAR => 'Cap. obrar',
            self::NO_PROHIBICION_CONTRATAR => 'No prohib.',
            self::NO_ESTAR_INCURSO_INCOMPATIBILIDADES => 'Sin incomp.',
            self::TGSS => 'Seg. Social',
            self::AEAT => 'Tribut.',
            self::NO_CONTRATOS_ANTERIORES => 'Sin contr. prev.',
            self::PREREGISTRADO_ROLECE => 'ROLECE',
            self::EMPRESAS_EXTRANJERAS => 'Emp. extran.',
            self::CONTRATOS_RESERVADOS_CENTROS_EMPLEO => 'Ctr. Empleo',
            self::CONTRATOS_RESERVADOS_PROGRAMAS_EMPELO_PROTEGIDO => 'Empl. prot.',
            self::EMPRESAS_CON_TRABAJADORES_CON_DISCAPACIDAD => 'Discap.',
            self::EMPRESAS_DEDICADAS_INSERCION_LABORAL => 'Inserc. lab.',
            self::CONTRATO_RESERVADO_PROFESION_DETERMINADA => 'Prof. det.',
            self::TALLERES_PROGEGIDOS => 'Tall. prot.',
            self::RESERVADO_ORGANIZACIONES_CUMPLAN_DIRECTIVA_CONTRATACION => 'Org. art. 77',
        };
    }



}
