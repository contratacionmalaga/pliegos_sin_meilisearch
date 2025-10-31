<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_PatrimonialContractCode: string implements HasLabel, HasDescription
{
    case AutorizacionDemanial = '10';
    case ConcesionDemanial = '11';
    case ExplotacionBienesInmuebles = '20';
    case ExplotacionBienesMuebles = '21';
    case ExplotacionBienesPropiedadIncorporal = '22';
    case Cesion = '23';
    case AdquisicionInmuebles = '30';
    case AdquisicionDerechos = '31';
    case ArrendamientoInmuebles = '40';
    case EnajenacionInmuebles = '50';
    case EnajenacionBienesMuebles = '51';
    case EnajenacionDerechosPropiedadIncorporal = '52';
    case Permuta = '60';
    case OtrosContratosPatrimoniales = '100';

    public function getLabel(): string
    {
        return match ($this) {
            self::AutorizacionDemanial => 'Autorización demanial',
            self::ConcesionDemanial => 'Concesión demanial',
            self::ExplotacionBienesInmuebles => 'Explotación de bienes inmuebles mediante arrendamiento',
            self::ExplotacionBienesMuebles => 'Explotación de bienes muebles mediante arrendamiento',
            self::ExplotacionBienesPropiedadIncorporal => 'Explotación de bienes de propiedad incorporal',
            self::Cesion => 'Cesión de uso/titularidad',
            self::AdquisicionInmuebles => 'Adquisición de inmuebles',
            self::AdquisicionDerechos => 'Adquisición de derechos de propiedad incorporal',
            self::ArrendamientoInmuebles => 'Arrendamiento de inmuebles',
            self::EnajenacionInmuebles => 'Enajenación de inmuebles',
            self::EnajenacionBienesMuebles => 'Enajenación de bienes muebles',
            self::EnajenacionDerechosPropiedadIncorporal => 'Enajenación de derechos de propiedad incorporal',
            self::Permuta => 'Permuta',
            self::OtrosContratosPatrimoniales => 'Otros contratos patrimoniales',

        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {

            self::AutorizacionDemanial => Color::Purple,
            self::ConcesionDemanial => Color::Purple,
            self::ExplotacionBienesInmuebles => Color::Purple,
            self::ExplotacionBienesMuebles => Color::Purple,
            self::ExplotacionBienesPropiedadIncorporal => Color::Purple,
            self::Cesion => Color::Purple,
            self::AdquisicionInmuebles => Color::Purple,
            self::AdquisicionDerechos => Color::Purple,
            self::ArrendamientoInmuebles => Color::Purple,
            self::EnajenacionInmuebles => Color::Purple,
            self::EnajenacionBienesMuebles => Color::Purple,
            self::EnajenacionDerechosPropiedadIncorporal => Color::Purple,
            self::Permuta => Color::Purple,
            self::OtrosContratosPatrimoniales => Color::Purple,
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::AutorizacionDemanial => 'heroicon-m-arrow-path',
            self::ConcesionDemanial => 'heroicon-m-arrow-path',
            self::ExplotacionBienesInmuebles => 'heroicon-m-arrow-path',
            self::ExplotacionBienesMuebles => 'heroicon-m-arrow-path',
            self::ExplotacionBienesPropiedadIncorporal => 'heroicon-m-arrow-path',
            self::Cesion => 'heroicon-m-arrow-path',
            self::AdquisicionInmuebles => 'heroicon-m-arrow-path',
            self::AdquisicionDerechos => 'heroicon-m-arrow-path',
            self::ArrendamientoInmuebles => 'heroicon-m-arrow-path',
            self::EnajenacionInmuebles => 'heroicon-m-arrow-path',
            self::EnajenacionBienesMuebles => 'heroicon-m-arrow-path',
            self::EnajenacionDerechosPropiedadIncorporal => 'heroicon-m-arrow-path',
            self::Permuta => 'heroicon-m-arrow-path',
            self::OtrosContratosPatrimoniales => 'heroicon-m-arrow-path',

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




