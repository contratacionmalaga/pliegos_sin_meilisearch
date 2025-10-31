<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_CommissionDocument: string implements HasLabel
{
    case EMP_DocumentoFormalizacion = 'EMP_DocumentoFormalizacion';
    case EMP_DocumentoJustificacionTerceros = 'EMP_DocumentoJustificacionTerceros';
    case EMP_DocumentoTarifasAplicables = 'EMP_DocumentoTarifasAplicables';
    case EMP_DocumentoProrroga = 'EMP_DocumentoProrroga';
    case EMP_DocumentoAnulacion = 'EMP_DocumentoAnulacion';

    public static function getTipoDocumentoPlacsp($valor): string
    {
        return match ($valor) {
            self::EMP_DocumentoFormalizacion => '1',
            self::EMP_DocumentoJustificacionTerceros => '2',
            self::EMP_DocumentoTarifasAplicables => '3',
            self::EMP_DocumentoProrroga => '4',
            self::EMP_DocumentoAnulacion => '5',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::EMP_DocumentoFormalizacion => 'Documento de formalización del encargo',
            self::EMP_DocumentoJustificacionTerceros => 'Documento de justificación de contratación a terceros',
            self::EMP_DocumentoTarifasAplicables => 'Documento de tarifas aplicables al encargo',
            self::EMP_DocumentoProrroga => 'Documento de justificación de prórroga del encargo',
            self::EMP_DocumentoAnulacion => 'Documento de justificación de anulación del encargo',
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
