<?php

namespace App\Enums\Placsp;


use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_WorksContractCode: string implements HasLabel, HasDescription
{
    case Construccion = '4500';
    case PreparacionObras = '4510';
    case DemolicionInmuebles = '4511';
    case PerforacionesSondeos = '4512';
    case ConstruccionGeneralInmuebles = '4520';
    case ConstruccionGeneralEdificios = '4521';
    case ConstruccionCubiertas = '4522';
    case ConstruccionAutopistasCarreteras = '4523';
    case ObrasHidraulicas = '4524';
    case OtrasConsturcciones = '4525';
    case InstalacionEdificios = '4530';
    case InstalacionElectrica = '4531';
    case AislamientoTermico = '4532';
    case Fontaneria = '4533';
    case OtrasInstalacionesEdificiosObras = '4534';
    case AcabadoEdificiosObras = '4540';
    case Revocamiento = '4541';
    case InstalacionesCarpinteria = '4542';
    case RevestimientoSuelosParedes = '4543';
    case PinturaAcristalamiento = '4544';
    case OtrosAcabadosEdificios = '4545';
    case AlquilerEquipoConstruccionDemolicion = '4550';



    public function getLabel(): string
    {
        return match ($this) {
            self::Construccion => 'Construcción',
            self::PreparacionObras => 'Preparación de obras',
            self::DemolicionInmuebles => 'Demolición de inmuebles y movimientos de tierras',
            self::PerforacionesSondeos => 'Perforaciones y sondeos',
            self::ConstruccionGeneralInmuebles => 'Construcción general de inmuebles y obras de ingeniería civil',
            self::ConstruccionGeneralEdificios => 'Construcción general de edificios y obras singulares de ingeniería civil (puentes, túneles, etc.)',
            self::ConstruccionCubiertas => 'Construcción de cubiertas y estructuras de cerramiento',
            self::ConstruccionAutopistasCarreteras => 'Construcción de autopistas,carreteras, campos de aterrizaje, vías férreas y centros deportivos',
            self::ObrasHidraulicas => 'Obras hidráulicas',
            self::OtrasConsturcciones => 'Otras construcciones especializadas',
            self::InstalacionEdificios => 'Instalación de edificios y obras',
            self::InstalacionElectrica => 'Instalación eléctrica',
            self::AislamientoTermico => 'Aislamiento térmico, acústico y antivibratorio',
            self::Fontaneria => 'Fontanería',
            self::OtrasInstalacionesEdificiosObras => 'Otras instalaciones de edificios y obras',
            self::AcabadoEdificiosObras => 'Acabado de edificios y obras',
            self::Revocamiento => 'Revocamiento',
            self::InstalacionesCarpinteria => 'Instalaciones de carpintería',
            self::RevestimientoSuelosParedes => 'Revestimiento de suelos y paredes',
            self::PinturaAcristalamiento => 'Pintura y acristalamiento',
            self::OtrosAcabadosEdificios => 'Otros acabados de edificios y obras',
            self::AlquilerEquipoConstruccionDemolicion => 'Alquiler de equipo de construcción o demolición con operario',

        };
    }

    public function getColor(): array
    {

        return Color::Blue;
    }

    public function getIcon(): string
    {

        return 'heroicon-o-truck';
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




