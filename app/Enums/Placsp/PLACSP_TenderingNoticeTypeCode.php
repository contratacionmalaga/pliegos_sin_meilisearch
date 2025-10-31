<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_TenderingNoticeTypeCode: string implements HasLabel
{

    // ANUNCIOS
    case Anuncio_Previo = 'DOC_PIN';
    case Anuncio_Licitacion = 'DOC_CN';
    case Anuncio_Pliegos = 'DOC_CD';
    case Anuncio_Documento_Descriptivo = 'DOC_DD';
    case Anuncio_Adjudicacion_Provisional = 'DOC_CAN_PROV';
    case Anuncio_Adjudicacion_Definitiva = 'DOC_CAN_DEF';
    case Anuncio_Adjudicacion = 'DOC_CAN_ADJ';
    case Anuncio_Formalizacion = 'DOC_FORM';
    case Anuncio_Renuncia = 'RENUNCIA';
    case Anuncio_Desistimiento = 'DESISTIMIENTO';
    case Anuncio_Modificacion_Contrato = 'DOC_MOD';
    case Anuncio_Transparencia_Previa_Voluntaria = 'DOC_ATPV';
//    case Anuncio_Modificacion_Contrato = 'DOC_ATPV';
//    case Anuncio_Modificacion_Contrato = 'DOC_ATPV';

    // ANULACIONES DE LOS ANUNCIOS
    case Anulacion_Anuncio_Previo = 'ANUL_DOC_PIN';
    case Anulacion_Anuncio_Licitacion = 'ANUL_DOC_CN';
    case Anulacion_Anuncio_Pliegos = 'ANUL_DOC_CD';
    case Anulacion_Anuncio_Documento_Descriptivo = 'ANUL_DOC_DD';
    case Anulacion_Anuncio_Adjudicacion_Provisional = 'ANUL_DOC_CAN_PROV';
    case Anulacion_Anuncio_Adjudicacion_Definitiva = 'ANUL_DOC_CAN_DEF';
    case Anulacion_Anuncio_Adjudicacion = 'ANUL_DOC_CAN_ADJ';
    case Anulacion_Anuncio_Formalizacion = 'ANUL_DOC_FORM';
    case Anulacion_Anuncio_Renuncia = 'ANUL_RENUNCIA';
    case Anulacion_Anuncio_Desistimiento = 'ANUL_DESISTIMIENTO';

    // ENCARGOS A MEDIOS PROPIOS
    case Anuncio_Fomalizacion_Encargo = 'DOC_FORM_ENC';
    case Anulacion_Anuncio_Formalizacion_Encargo = 'ANUL_FORM_ENC';
    case Anuncio_Prorroga_Encarga = 'PRO_FORM_ENC';

    // CONSULTAS PRELIMINARES DE MERCADO
    case Anuncio_Consulta_Preliminar_Mercado = 'DOC_CON';
    case Anulacion_Anuncio_Consulta_Preliminar_Mercado = 'ANUL_DOC_CON';

    // ANUNCIO PREVIO REDUCCIÓN DE PLAZOS
    case Anuncio_Previo_Reduccion_Plazos = 'DOC_PIN_RTL';
    case Anulacion_Anuncio_Previo_Reduccion_Plazos = 'ANUL_PIN_RTL';

    // ANUNCIO DE FINALZIACIÓN DE CONTRATO
    case Anuncio_Finalizacion_Contrato = 'DOC_CCN';
    case Anulacion_Anuncio_Finalizacion_Contrato = 'ANUL_CCN';

    public function getLabel(): string
    {
        return match ($this) {

            // ANUNCIOS
            self::Anuncio_Previo => 'Anuncio Previo',
            self::Anuncio_Licitacion => 'Anuncio de Licitación',
            self::Anuncio_Pliegos => 'Anuncio de Pliegos',
            self::Anuncio_Documento_Descriptivo => 'Anuncio de Documento Descriptivo',
            self::Anuncio_Adjudicacion_Provisional => 'Anuncio de Adjudicación Provisional',
            self::Anuncio_Adjudicacion_Definitiva => 'Anuncio de Adjudicación Definitiva',
            self::Anuncio_Adjudicacion => 'Anuncio de Adjudicación',
            self::Anuncio_Formalizacion => 'Anuncio de Formalización',
            self::Anuncio_Renuncia => 'Anuncio de Renuncia',
            self::Anuncio_Desistimiento => 'Anuncio de Desistimiento',
            self::Anuncio_Modificacion_Contrato => 'Anuncio modificación de contrato',
            self::Anuncio_Transparencia_Previa_Voluntaria => 'Anuncio de Transparencia Previa Voluntaria',

            // ANULACIONES DE LOS ANUNCIOS
            self::Anulacion_Anuncio_Previo => 'Anulación de Anuncio Previo',
            self::Anulacion_Anuncio_Licitacion => 'Anulación de Anuncio de Licitación',
            self::Anulacion_Anuncio_Pliegos => 'Anulación de Anuncio de Pliegos',
            self::Anulacion_Anuncio_Documento_Descriptivo => 'Anulación de Anuncio de Documento Descriptivo',
            self::Anulacion_Anuncio_Adjudicacion_Provisional => 'AAnulación de nuncio de Adjudicación Provisional',
            self::Anulacion_Anuncio_Adjudicacion_Definitiva => 'Anulación de Anuncio de Adjudicación Definitiva',
            self::Anulacion_Anuncio_Adjudicacion => 'Anulación de Anuncio de Adjudicación',
            self::Anulacion_Anuncio_Formalizacion => 'Anulación de Anuncio de Formalización',
            self::Anulacion_Anuncio_Renuncia => 'Anulación de Anuncio de Renuncia',
            self::Anulacion_Anuncio_Desistimiento => 'Anulación de Anuncio de Desistimiento',

            // ENCARGOS A MEDIOS PROPIOS
            self::Anuncio_Fomalizacion_Encargo => 'Anuncio de Formalización de Encargo',
            self::Anulacion_Anuncio_Formalizacion_Encargo => 'Anulación de Anuncio de Formalización de Encargo',
            self::Anuncio_Prorroga_Encarga => 'Anuncio de Prórroga de Encargo',

            // CONSULTAS PRELIMINARES DE MERCADO
            self::Anuncio_Consulta_Preliminar_Mercado => 'Anuncio de Consulta Preliminar de Mercado',
            self::Anulacion_Anuncio_Consulta_Preliminar_Mercado => 'Anulación de Anuncio de Consulta Preliminar de Mercado',

            // ANUNCIO PREVIO REDUCCIÓN DE PLAZOS
            self::Anuncio_Previo_Reduccion_Plazos => 'Anuncio Previo con Reducción de Plazos',
            self::Anulacion_Anuncio_Previo_Reduccion_Plazos => 'Anulación de Anuncio Previo con Reducción de Plazos',

            // ANUNCIO DE FINALZIACIÓN DE CONTRATO
            self::Anuncio_Finalizacion_Contrato => 'Anuncio de Finalización de Contrato',
            self::Anulacion_Anuncio_Finalizacion_Contrato => 'Anulación de Anuncio de Finalización de Contrato',

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

