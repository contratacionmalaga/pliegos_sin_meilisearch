<?php

namespace App\Enums\Modulos;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ModulosEnum: string implements HasColor, HasDescription, HasIcon, HasLabel
{
    case CONTRATO_MAYOR = 'contrato-mayor';
    case CONTRATO_MENOR = 'contrato-menor';
    case ENCARGO_MEDIO_PROPIO = 'encargo-medio-propio';
    case CONSULTA_PRELIMINAR_MERCADO = 'consulta-preliminar-mercado';
    case REGISTRO_CONTRATOS = 'registro-contratos';
    case TRIBUNAL_CUENTAS = 'tribunal-cuentas';
    case CONSULTA_META = 'consulta-meta';
    case CONSULTA_PLIEGOS = 'consulta-pligos';

    public function getLabel(): string
    {
        return match ($this) {
            self::CONTRATO_MAYOR => 'Volver al Listado',
            self::CONTRATO_MENOR => 'Ver',
            self::ENCARGO_MEDIO_PROPIO => 'Editar',
            self::CONSULTA_PRELIMINAR_MERCADO => 'Borrar',
            self::REGISTRO_CONTRATOS => 'Crear',
            self::TRIBUNAL_CUENTAS => 'Restaurar',
            self::CONSULTA_META => 'Forzar borrado',
            self::CONSULTA_PLIEGOS => 'Borrado en masa',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::CONTRATO_MAYOR => 'heroicon-o-shopping-cart',
            self::CONTRATO_MENOR => 'heroicon-o-shopping-bag',
            self::ENCARGO_MEDIO_PROPIO => 'heroicon-o-hand-thumb-up',
            self::CONSULTA_PRELIMINAR_MERCADO => 'heroicon-o-phone-arrow-up-right',
            self::REGISTRO_CONTRATOS => 'heroicon-o-pencil-square',
            self::TRIBUNAL_CUENTAS => 'heroicon-o-eye',
            self::CONSULTA_META => 'heroicon-o-user-group',
            self::CONSULTA_PLIEGOS => 'heroicon-o-document-duplicate',
        };
    }

    /**
     * @return array<int,string>
     */
    public function getColor(): array
    {
        return match ($this) {
            self::CONTRATO_MAYOR => Color::Red,
            self::CONTRATO_MENOR => Color::Orange,
            self::ENCARGO_MEDIO_PROPIO => Color::Amber,
            self::CONSULTA_PRELIMINAR_MERCADO => Color::Yellow,
            self::REGISTRO_CONTRATOS =>Color::Blue,
            self::TRIBUNAL_CUENTAS => Color::Purple,
            self::CONSULTA_META => Color::Pink,
            self::CONSULTA_PLIEGOS => Color::Slate,
        };
    }

    public function getTooltip(): string
    {
        return $this->getDescription();
    }

    public function getDescription(): string
    {
        return match ($this) {
            self::CONTRATO_MAYOR => 'Gestión de los contratos mayores',
            self::CONTRATO_MENOR => 'Gestión de los contratos menores',
            self::ENCARGO_MEDIO_PROPIO => 'Gestión de los encargos a medio propio',
            self::CONSULTA_PRELIMINAR_MERCADO => 'Gestión de las consultas preliminares de mercado',
            self::REGISTRO_CONTRATOS => 'Registro de contratos',
            self::TRIBUNAL_CUENTAS => 'Tribunal de cuentas',
            self::CONSULTA_META => 'Consulta de datos procedentes de Meta4',
            self::CONSULTA_PLIEGOS => 'Consulta de pliegos asociados a perfiles de contrante alojados en la Plataforma de Contratación del Sector Público',
        };
    }
}
