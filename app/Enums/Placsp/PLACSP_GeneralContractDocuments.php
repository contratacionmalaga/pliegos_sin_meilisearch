<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_GeneralContractDocuments: string implements HasLabel
{

    case ActosPublicosAperturaOfertas = '1';
    case ComposicionMesaContratacion = '2';
    case ComposicionComiteExpertos = '3';
    case LevantamientoSuspensionProcedimiento = '4';
    case MantenimientoEfectosContrato = '5';
    case DeclaracionNulidad = '6';
    case SuspensionProcedimiento = '7';
    case AcuerdoIniciacionExpediente = '8';
    case MemoriaJustificativa = '9';
    case InformeInsuficienciaMedios = '10';
    case DocumentoAprobacionExpediente = '11';
    case ActaOrganoAsistencia = '12';
    case InformeValoracionCriteriosAdjudicacionJuiciosValor = '13';
    case InformeOfertasIncursasAnormalidad = '14';
    case ComposicionJuradoConcursoProyectos = '15';
    case InformeAdhesionSistemaDinamicoAdquisicion = '16';
    case FormalizacionESDA = '17';
    case Otros = 'ZZZ';

    public function getLabel(): string
    {
        return match ($this) {
            self::ActosPublicosAperturaOfertas => 'Actos públicos informativos ó de apertura de ofertas',
            self::ComposicionMesaContratacion => 'Composición de la mesa de contratación',
            self::ComposicionComiteExpertos => 'Composición del comité de expertos',
            self::SuspensionProcedimiento => 'Suspensión del procedimiento',
            self::LevantamientoSuspensionProcedimiento => 'Levantamiento de la suspensión del procedimiento',
            self::MantenimientoEfectosContrato => 'Mantenimiento de los efectos del contrato',
            self::DeclaracionNulidad => 'Declaración de nulidad',
            self::AcuerdoIniciacionExpediente => 'Acuerdo de iniciación del expediente',
            self::MemoriaJustificativa => 'Memoria justificativa',
            self::InformeInsuficienciaMedios => 'Informe de insuficiencia de medios',
            self::DocumentoAprobacionExpediente => 'Documento de aprobación del expediente',
            self::ActaOrganoAsistencia => 'Acta del órgano de asistencia',
            self::InformeValoracionCriteriosAdjudicacionJuiciosValor => 'Informe de valoración de los criterios de adjudicación cuantificables mediante juicio de valor',
            self::InformeOfertasIncursasAnormalidad => 'Informe sobre las ofertas incursas en presunción de anormalidad',
            self::ComposicionJuradoConcursoProyectos => 'Composición del jurado del concurso de proyectos',
            self::InformeAdhesionSistemaDinamicoAdquisicion => 'Informe sobre la adhesión de licitadores al Sistema Dinámico de Adquisición',
            self::FormalizacionESDA => 'Formalización del Establecimiento del Sistema Dinámico de Adquisición',
            self::Otros => 'Otros documentos',
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
