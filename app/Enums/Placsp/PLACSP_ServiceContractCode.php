<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_ServiceContractCode: string implements HasLabel, HasDescription, HasColor, HasIcon
{
    case ServiciosMannimientoReparacion = '1';
    case ServiciosTransporteTerrestre = '2';
    case ServiciosTransporteAereo = '3';
    case TransporteCorreoTerrestre = '4';
    case ServiciosTelecomunicacion = '5';
    case ServiciosFinancieros = '6';
    case ServiciosInformatica = '7';
    case ServiciosInvestigacionDesarrollo = '8';
    case ServiciosContabilidad = '9';
    case ServiciosInvestigacion = '10';
    case ServiciosConsultores= '11';
    case ServiciosArquitectura = '12';
    case ServiciosPublicidad = '13';
    case ServiciosLimpieza = '14';
    case ServiciosEditoriales = '15';
    case ServiciosAlcantarillado = '16';
    case ServiciosHosteleria = '17';
    case ServiciosTransporteFerrocarril = '18';
    case ServiciosTransportefluvial = '19';
    case ServiciosTransporteComplementarios = '20';
    case ServiciosJuridicos = '21';
    case ServiciosColocacion = '22';
    case ServiciosInvestigacionSeguridad = '23';
    case ServiciosEducacion = '24';
    case ServiciosSociales = '25';
    case ServiciosEsparcimiento = '26';
    case OtrosServicios = '27';

    public function getLabel(): string
    {
        return match ($this) {
            self::ServiciosMannimientoReparacion => 'Servicios de mantenimiento y reparación',
            self::ServiciosTransporteTerrestre => 'Servicios de transporte por vía terrestre, incluidos los servicios de furgones blindados y servicios de mensajería, excepto el transporte de correo',
            self::ServiciosTransporteAereo => 'Servicios de transporte aéreo: transporte de pasajeros y carga, excepto el transporte de correo',
            self::TransporteCorreoTerrestre => 'Transporte de correo por vía terrestre y por vía aérea',
            self::ServiciosTelecomunicacion => 'Servicios de telecomunicación',
            self::ServiciosFinancieros => 'Servicios financieros: a) servicios de seguros; b) servicios bancarios y de inversión',
            self::ServiciosInformatica => 'Servicios de informática y servicios conexos',
            self::ServiciosInvestigacionDesarrollo => 'Servicios de investigación y desarrollo',
            self::ServiciosContabilidad => 'Servicios de contabilidad, auditoría y teneduría de libros',
            self::ServiciosInvestigacion => 'Servicios de investigación de estudios y encuestas de la opinión pública',
            self::ServiciosConsultores => 'Servicios de consultores de dirección y servicios conexos',
            self::ServiciosArquitectura => 'Servicios de arquitectura; servicios de ingeniería y servicios integrados de ingeniería; servicios de planificación urbana y servicios de arquitectura paisajista. Servicios conexos de consultores en ciencia y tecnología. Servicios de ensayos y análisis técnicos',
            self::ServiciosPublicidad => 'Servicios de publicidad',
            self::ServiciosLimpieza => 'Servicios de limpieza de edificios y servicios de administración de bienes raíces',
            self::ServiciosEditoriales => 'Servicios editoriales y de imprenta, por tarifa o por contrato',
            self::ServiciosAlcantarillado => 'Servicios de alcantarillado y eliminación de desperdicios: servicios de saneamiento y servicios similares',
            self::ServiciosHosteleria => 'Servicios de hostelería y restaurante',
            self::ServiciosTransporteFerrocarril => 'Servicios de transporte por ferrocarril',
            self::ServiciosTransportefluvial => 'Servicios de transporte fluvial y marítimo',
            self::ServiciosTransporteComplementarios => 'Servicios de transporte complementarios y auxiliares',
            self::ServiciosJuridicos => 'Servicios jurídicos',
            self::ServiciosColocacion => 'Servicios de colocación y suministro de personal',
            self::ServiciosInvestigacionSeguridad => 'Servicios de investigación y seguridad, excepto los servicios de furgones blindados',
            self::ServiciosEducacion => 'Servicios de educación y formación profesional',
            self::ServiciosSociales => 'Servicios sociales y de salud',
            self::ServiciosEsparcimiento => 'Servicios de esparcimiento, culturales y deportivos',
            self::OtrosServicios => 'Otros servicios',
        };
    }

    public function getIcon(): string
    {

        return 'heroicon-o-rocket-launch';
    }

    public function getColor(): array
    {

        return Color::Slate;
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
