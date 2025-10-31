<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_TenderingProcessCode: string implements HasLabel
{

    case NormasInternas = '100';
    case Abierto = '1';
    case Restringido = '2';
    case NegociadoSinPublicidad = '3';
    case NegociadoConPublicidad = '4';
    case DialogoCompetitivo = '5';
    case ContratoMenor = '6';
    case BasadoAcuerdoMarco = '7';
    case ConcursoProyectos = '8';
    case AbiertoSimplificado = '9';
    case AsociacionInnovacion = '10';
    case DerivadoAsociacionInnovacion = '11';
    case BasadoSistemaDinamicoAdquisicion = '12';
    case LicitacionConNegociacion = '13';
    case Otros = '999';

    public static function ordenarContratoMenor(): array
    {

        // Definir los casos que deseas incluir en el filtro
        $contratosMenores = [
            self::ContratoMenor,
        ];

        // Obtener todos los casos del enum y ordenarlos por la etiqueta
        return sortEnumByValue($contratosMenores);
    }

    public static function ordenar(): array
    {
        // Obtener todos los casos del enum y ordenarlos por la etiqueta
        return sortEnumByValue(self::cases());
    }

    public static function mapValorRendicionCuentas(string $valor = null): ?string
    {
        return match ($valor) {
            'A' => self::Abierto->value,
            'E' => self::Restringido->value,
            'N' => self::NegociadoSinPublicidad->value,
            'G' => self::NegociadoConPublicidad->value,
            'D' => self::DialogoCompetitivo->value,
            'O' => self::ContratoMenor->value,
            'R' => self::BasadoAcuerdoMarco->value,
            'I' => self::NormasInternas->value,
            'S' => self::Otros->value,
            default => null, // Valor por defecto si no hay coincidencia
        };
    }

    public function getDescription(): string
    {

        return $this->getLabel();
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::NormasInternas => 'Normas Internas',
            self::Abierto => 'Abierto',
            self::Restringido => 'Restringido',
            self::NegociadoSinPublicidad => 'Negociado sin publicidad',
            self::NegociadoConPublicidad => 'Negociado con publicidad',
            self::DialogoCompetitivo => 'Diálogo competitivo',
            self::ContratoMenor => 'Contrato Menor',
            self::BasadoAcuerdoMarco => 'Basado en Acuerdo Marco',
            self::ConcursoProyectos => 'Concurso de proyectos',
            self::AbiertoSimplificado => 'Abierto simplificado',
            self::AsociacionInnovacion => 'Asociación para la innovación',
            self::DerivadoAsociacionInnovacion => 'Derivado de asociación para la innovación',
            self::BasadoSistemaDinamicoAdquisicion => 'Basado en sistema dinámico de adquisición',
            self::LicitacionConNegociacion => 'Licitación con negociación',
            self::Otros => 'Otros',
        };
    }

}
