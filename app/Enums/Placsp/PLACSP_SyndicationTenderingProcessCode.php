<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_SyndicationTenderingProcessCode: string implements HasLabel, HasColor
{

    case Abierto = '1';
    case Restringido = '2';
    case NegociadoSinPublicidad = '3';
    case NegociadoConPublicidad = '4';
    case DialogoCompetitivo = '5';
    case ContratoMenor = '6';
    case DerivadoAcuerdoMarco = '7';
    case NormasInternas = '100';
    case Otros = '999';
    case ConcursoProyectos = '8';
    case AbiertoSimplificado = '9';
    case AsociacionInnovacion = '10';
    case DerivadoAsociacionInnovacion = '11';
    case BasadoSistemaDinamicoAdquisicion = '12';
    case LicitacionConNegociacion = '13';


    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Abierto => Color::Gray,
            self::Restringido => Color::Green,
            self::NegociadoSinPublicidad => Color::Purple,
            self::NegociadoConPublicidad => Color::Orange,
            self::DialogoCompetitivo => Color::Amber,
            self::ContratoMenor => Color::Indigo,
            self::DerivadoAcuerdoMarco => Color::Emerald,
            self::NormasInternas => Color::Teal,
            self::Otros => Color::Stone,
            self::ConcursoProyectos => Color::Rose,
            self::AbiertoSimplificado => Color::Fuchsia,
            self::AsociacionInnovacion => Color::Slate,
            self::DerivadoAsociacionInnovacion => Color::Violet,
            self::BasadoSistemaDinamicoAdquisicion => Color::Blue,
            self::LicitacionConNegociacion => Color::Sky,
        };
    }

    /**
     * @return string|null
     */
    public function getColorHex(): ?string
    {
        return match ($this) {
            self::Abierto => '#6b7280',                        // Gray-500
            self::Restringido => '#22c55e',                    // Green-500
            self::NegociadoSinPublicidad => '#a855f7',         // Purple-500
            self::NegociadoConPublicidad => '#f97316',         // Orange-500
            self::DialogoCompetitivo => '#f59e0b',            // Amber-500
            self::ContratoMenor => '#6366f1',                  // Indigo-500
            self::DerivadoAcuerdoMarco => '#10b981',           // Emerald-500
            self::NormasInternas => '#14b8a6',                 // Teal-500
            self::Otros => '#78716c',                          // Stone-500
            self::ConcursoProyectos => '#f43f5e',             // Rose-500
            self::AbiertoSimplificado => '#d946ef',            // Fuchsia-500
            self::AsociacionInnovacion => '#64748b',           // Slate-500
            self::DerivadoAsociacionInnovacion => '#8b5cf6',   // Violet-500
            self::BasadoSistemaDinamicoAdquisicion => '#3b82f6', // Blue-500
            self::LicitacionConNegociacion => '#0ea5e9',       // Sky-500
            default => '#ef4444',                               // Red-500
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::Abierto => 'Abierto',
            self::Restringido => 'Restringido',
            self::NegociadoSinPublicidad => 'Negociado sin publicidad',
            self::NegociadoConPublicidad => 'Negociado con publicidad',
            self::DialogoCompetitivo => 'Dialogo competitivo',
            self::ContratoMenor => 'Contrato menor',
            self::DerivadoAcuerdoMarco => 'Derivado de acuerdo marco',
            self::NormasInternas => 'Normas internas',
            self::Otros => 'Otros',
            self::ConcursoProyectos => 'Concurso de proyectos',
            self::AbiertoSimplificado => 'Abierto simplificado',
            self::AsociacionInnovacion => 'Asociación para la innovación',
            self::DerivadoAsociacionInnovacion => 'Derivado de asociación para la innovación',
            self::BasadoSistemaDinamicoAdquisicion => 'Basado en un sistema dinámico de adquisición',
            self::LicitacionConNegociacion => 'Licitación con negociación',
        };
    }

    public function getShortLabel(): string
    {
        return match ($this) {
            self::Abierto => 'Abierto',
            self::Restringido => 'Restringido',
            self::NegociadoSinPublicidad => 'Negociado sin publicidad',
            self::NegociadoConPublicidad => 'Negociado con publicidad',
            self::DialogoCompetitivo => 'Diálogo competitivo',
            self::ContratoMenor => 'Contrato menor',
            self::DerivadoAcuerdoMarco => 'Derivado de acuerdo marco',
            self::NormasInternas => 'Normas internas',
            self::Otros => 'Otros',
            self::ConcursoProyectos => 'Concurso de proyectos',
            self::AbiertoSimplificado => 'Abierto simplificado',
            self::AsociacionInnovacion => 'Asociación innovación',
            self::DerivadoAsociacionInnovacion => 'Derivado asociación innovación',
            self::BasadoSistemaDinamicoAdquisicion => 'Sistema dinámico adquisición',
            self::LicitacionConNegociacion => 'Licitación con negociación',
        };
    }

    public function getTinyLabel(): string
    {
        return match ($this) {
            self::Abierto => 'Abierto',
            self::Restringido => 'Restringido',
            self::NegociadoSinPublicidad => 'Neg. sin pub.',
            self::NegociadoConPublicidad => 'Neg. con pub.',
            self::DialogoCompetitivo => 'Diálogo comp.',
            self::ContratoMenor => 'Contrato menor',
            self::DerivadoAcuerdoMarco => 'Derivado ac. marco',
            self::NormasInternas => 'Normas int.',
            self::Otros => 'Otros',
            self::ConcursoProyectos => 'Concurso proj.',
            self::AbiertoSimplificado => 'Abierto simplif.',
            self::AsociacionInnovacion => 'Asoc. innovación',
            self::DerivadoAsociacionInnovacion => 'Derivado asoc. innovación',
            self::BasadoSistemaDinamicoAdquisicion => 'Sistema dinámico',
            self::LicitacionConNegociacion => 'Lic. con negoc.',
        };
    }


    public function toRC(): string
    {
        return match ($this) {
            self::Abierto => 'A',
            self::Restringido => 'R',
            self::NegociadoSinPublicidad => 'N',
            self::NegociadoConPublicidad => 'N',
            self::DialogoCompetitivo => 'D',
            self::ContratoMenor => 'M',
            self::DerivadoAcuerdoMarco => 'Z',
            self::NormasInternas => 'Z',
            self::Otros => 'Z',
            self::ConcursoProyectos => 'P',
            self::AbiertoSimplificado => 'S',
            self::AsociacionInnovacion => 'I',
            self::DerivadoAsociacionInnovacion => 'I',
            self::BasadoSistemaDinamicoAdquisicion => 'Z',
            self::LicitacionConNegociacion => 'N',
        };
    }

    public static function ordenar(): array
    {
        // Obtener todos los casos del enum y ordenarlos por la etiqueta
        return sortEnumByLabel(self::cases());
    }
}


