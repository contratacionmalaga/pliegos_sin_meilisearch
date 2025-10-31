<?php

namespace App\Filament\Components\Schemas;

use App\DTOs\SectionConfig;
use App\Enums\Constantes\ConstantesInt;
use App\Enums\Constantes\ConstantesString;
use App\Enums\Placsp\PLACSP_PreliminaryMarketConsultationTypeCode;
use App\Enums\Placsp\TipoSindicacion;
use App\Filament\Components\Forms\MiToogle;
use App\Filament\Components\Infolists\MiTextEntry;
//use App\Models\EstructuraAdministrativa\Entidad;
use Filament\Schemas\Components\Section;
use Filament\Support\Colors\Color;

class MiSectionInfolist
{
    /**
     * Construye una sección principal reutilizable con un esquema dinámico
     */
    public function getInfolistSectionDatosContratacion(
        MiSection $miSection,
        MiTextEntry $miTextEntry
    ): Section {

        $description = 'Datos económicos';
        $icon = 'heroicon-o-currency-euro';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getNumericoTextEntry('contratos_mayores_count', 3, 'Nº Contratos Mayores')
                    ->badge()
                    ->color(TipoSindicacion::MAY->getColor())
                    ->icon(TipoSindicacion::MAY->getIcon()),
                $miTextEntry->getMoneyTextEntry('contratos_mayores_total', 3, 'Total Contratos Mayores')
                    ->default('0')
                    ->badge()
                    ->color(TipoSindicacion::MAY->getColor()),
                $miTextEntry->getNumericoTextEntry('contratos_menores_count', 3, 'Nº Contratos Menores')
                    ->badge()
                    ->color(TipoSindicacion::MEN->getColor())
                    ->icon(TipoSindicacion::MEN->getIcon()),
                $miTextEntry->getMoneyTextEntry('contratos_menores_total', 3, 'Total Contratos Menores')
                    ->default('0')
                    ->badge()
                    ->color(TipoSindicacion::MEN->getColor()),
                $miTextEntry->getNumericoTextEntry('encargos_medios_propios_count', 3, 'Nº Encargos Medio Propio')
                    ->badge()
                    ->color(TipoSindicacion::EMP->getColor())
                    ->icon(TipoSindicacion::EMP->getIcon()),
                $miTextEntry->getMoneyTextEntry('encargos_medios_propios_total', 3, 'Total Encargos Medio Propio')
                    ->default('0')
                    ->badge()
                    ->color(TipoSindicacion::EMP->getColor()),
                $miTextEntry->getNumericoTextEntry('consultas_preliminares_mercado_count', 3, 'Nº Consultas Preliminares')
                    ->badge()
                    ->color(TipoSindicacion::CPM->getColor())
                    ->icon(TipoSindicacion::CPM->getIcon()),
            ]);
    }
//
//    public function getInfoListSectionAccesoExterno(MiSection $miSection, MiTextEntry $miTextEntry): Section
//    {
//        $description = 'Acceso externo';
//        $icon = 'heroicon-o-globe-alt';
//
//        return $miSection
//            ->create(
//                new SectionConfig(
//                    description: $description,
//                    icon: $icon,
//                )
//            )
//            ->schema([
//                $miTextEntry->getBadgeTextEntry('acceso_externo.token', 6, 'Enlace público a las estadísticas conforme a la Ley 14/2022')
//                    ->state(function (Entidad $record) {
//                        $externalAccess = $record->acceso_externo()->first();
//
//                        if (! $externalAccess) {
//                            return 'No disponible';
//                        }
//
//                        return url('/'.ConstantesString::ACCESO_EXTERNO->value.'/'.$externalAccess->access_token);
//                    })
//                    ->url(function (Entidad $record) {
//                        // Obtener el modelo relacionado external_access, no la relación
//                        $externalAccess = $record->acceso_externo()->first();
//
//                        if (! $externalAccess) {
//                            return null; // O un enlace vacío o alternativo si no existe
//                        }
//
//                        // Construir la url pública con el token de acceso
//                        return url('/'.ConstantesString::ACCESO_EXTERNO->value.'/'.$externalAccess->access_token);
//                    }, shouldOpenInNewTab: true)
//                    ->icon('heroicon-o-link')
//                    ->color(function (Entidad $record) {
//                        $externalAccess = $record->acceso_externo()->first();
//
//                        if (! $externalAccess) {
//                            return Color::Red;
//                        }
//
//                        return Color::Blue;
//                    }),
//                $miTextEntry->getBadgeTextEntry('acceso_externo.es_activo', 2, 'Estado'),
//                $miTextEntry->getBadgeCopiableTextEntry('acceso_externo.password', 4, 'Código de acceso'),
//            ]);
//    }

    public function getSchemaSectionLogFeedEntry(MiSection $miSection, MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos de Trazabilidad de la importación';
        $icon = 'heroicon-o-finger-print';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getBadgeTextEntry('tipo_sindicacion', 3, 'Tipo de importación'),
                $miTextEntry->getTextEntry('link_self', 3, 'Fichero que contiene el expediente'),
                $miTextEntry->getTextEntry('id_entry', 3, 'Identificador único del expediente en ImportacionPlacsp'),
                $miTextEntry->getBadgeDateTimeTextEntry('updated', 3, Color::Green, 'Fecha de la última actualización en Placsp'),
                $miTextEntry->getTextEntry('summary', 10, 'Resumen del expediente'),
                //                $miTextEntry->getLinkTextEntry('link', 10,'Enlace al expediente en ImportacionPlacsp'),
            ])
            ->visible(esSuperAdmin());
    }

    public function getSchemaSectionPreliminaryMarketConsultationStatus(MiSection $miSection, MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos propios de la consulta';
        $icon = 'heroicon-o-information-circle';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('preliminary_market_consultation_id', 2),
                $miTextEntry->getTextEntry('consultation_name', 10),
                $miTextEntry->getBadgeTextEntry('preliminary_market_consultation_status_code', 2),
                $miTextEntry->getBadgeTextEntry('condition_type_code', 2),
                $miTextEntry->getLinkTextEntry('link', 8, 'Enlace a la consulta en la ImportacionPlacsp'),
                $miTextEntry->getTextEntry('condition_type_reason_text', 12)
                    ->visible(fn ($record) => $record->condition_type_code === PLACSP_PreliminaryMarketConsultationTypeCode::ConsultaAbierta->value),

                $miTextEntry->getTextEntry('party_selection_reason_text', 12)
                    ->visible(fn ($record) => $record->condition_type_code === PLACSP_PreliminaryMarketConsultationTypeCode::ConsultaAbierta->value),

                $miTextEntry->getTextEntry('conditions_text', 12),
            ]);
    }

    public function getSectionInfolistDatosContratoMayor(MiSection $miSection, MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos de un contrato mayor';
        $icon = 'heroicon-o-document-currency-euro';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('contract_folder_id', 2, 'Identificador del expediente'),
                $miTextEntry->getBadgeTextEntry('contract_folder_status_code', 2, 'Estado del expediente'),
                $miTextEntry->getBadgeTextEntry('mix_contract_indicator', 2, '¿Contrato mixto?'),
                $miTextEntry->getMoneyTextEntry('estimated_overall_contract_amount', 2, 'Valor estimado del contrato'),
                $miTextEntry->getMoneyTextEntry('tax_exclusive_amount', 2, 'Importe total sin impuestos'),
                $miTextEntry->getMoneyTextEntry('total_amount', 2, 'Importe total con impuestos'),
                $miTextEntry->getBadgeTextEntry('type_code', 2, 'Tipo de contrato'),
                $miTextEntry->getTextEntry('subtype_code_enum', 3, 'Subtipo de contrato')
                    ->badge()
                    ->color(fn ($state) => $state?->getColor())
                    ->icon(fn ($state) => $state?->getIcon())
                    ->formatStateUsing(fn ($state) => $state?->getLabel()),
                $miTextEntry->getLinkTextEntry('link', 7, 'Enlace al expediente en la ImportacionPlacsp'),
                $miTextEntry->getTextEntry('country_subentity', 2, 'Lugar ejecución'),
                $miTextEntry->getBadgeTextEntry('country_subentity_code', 2, 'Código lugar ejecución'),
                $miTextEntry->getTextEntry('party_name_organo_contratacion', 4, 'Órgano de Contratación'),
                $miTextEntry->getTextEntry('entidad.entidad', 4, 'Entidad'),
                $miTextEntry->getTextEntry('name_objeto', 12, 'Objeto del contrato'),
            ]);
    }

    public function getSectionInfolistDatosContratoMenor(MiSection $miSection, MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos de un contrato menor';
        $icon = 'heroicon-o-document-currency-euro';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('contract_folder_id', 2, 'Identificador del expediente'),
                $miTextEntry->getBadgeTextEntry('contract_folder_status_code', 2, 'Estado del expediente'),
                $miTextEntry->getBadgeTextEntry('mix_contract_indicator', 2, '¿Contrato mixto?'),
                $miTextEntry->getMoneyTextEntry('estimated_overall_contract_amount', 2, 'Valor estimado del contrato'),
                $miTextEntry->getMoneyTextEntry('tax_exclusive_amount', 2, 'Importe total sin impuestos'),
                $miTextEntry->getMoneyTextEntry('total_amount', 2, 'Importe total con impuestos'),
                $miTextEntry->getBadgeTextEntry('type_code', 2, 'Tipo de contrato'),
                $miTextEntry->getTextEntry('subtype_code_enum', 3, 'Subtipo de contrato')
                    ->badge()
                    ->color(fn ($state) => $state?->getColor())
                    ->icon(fn ($state) => $state?->getIcon())
                    ->formatStateUsing(fn ($state) => $state?->getLabel()),
                $miTextEntry->getLinkTextEntry('link', 7, 'Enlace al expediente en la ImportacionPlacsp'),
                $miTextEntry->getTextEntry('country_subentity', 2, 'Lugar ejecución'),
                $miTextEntry->getBadgeTextEntry('country_subentity_code', 2, 'Código lugar ejecución'),
                $miTextEntry->getTextEntry('party_name_organo_contratacion', 4, 'Órgano de Contratación'),
                $miTextEntry->getTextEntry('entidad.entidad', 4, 'Entidad'),
                $miTextEntry->getTextEntry('name_objeto', 12, 'Objeto del contrato'),
            ]);
    }

    public function getSectionInfolistDatosEncargoMedioPropio(MiSection $miSection, MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos del encargo a medio propio';
        $icon = 'heroicon-o-document-currency-euro';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('contract_folder_id', 2, 'Identificador del expediente'),
                $miTextEntry->getBadgeTextEntry('contract_folder_status_code', 2, 'Estado del expediente'),
                $miTextEntry->getMoneyTextEntry('total_amount', 2, 'Importe total con impuestos'),
                $miTextEntry->getBadgeTextEntry('type_code', 2, 'Tipo de contrato'),
                $miTextEntry->getTextEntry('country_subentity', 2, 'Lugar ejecución'),
                $miTextEntry->getBadgeTextEntry('country_subentity_code', 2, 'Código lugar ejecución'),
                $miTextEntry->getLinkTextEntry('link', 6, 'Enlace al expediente en la Placsp'),
                $miTextEntry->getTextEntry('party_name_adjudicatario', 3, 'Adjudicatario'),
                $miTextEntry->getTextEntry('id_plataforma_adjudicatario', 2, 'Id. Plataforma'),
                $miTextEntry->getTextEntry('nif_adjudicatario', 1, 'Nif'),
                $miTextEntry->getTextEntry('name_objeto', 12, 'Objeto del contrato'),
            ]);
    }

    public function getSectionInfolistDatosOrganoContratacion(MiSection $miSection, MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos del Órgano de Contratación';
        $icon = 'heroicon-o-building-library';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getBadgeTextEntry('contracting_party_type_code', 3, 'Tipo de administración'),
                $miTextEntry->getTextEntry('party_name_organo_contratacion', 3, 'Nombre del órgano de contratación'),
                $miTextEntry->getTextEntry('id_plataforma_organo_contratacion', 3, 'Identificador de plataforma'),
                $miTextEntry->getTextEntry('nif_entidad', 3, 'Nif'),
                $miTextEntry->getLinkTextEntry('web_site_uri', 4, 'Sitio web del órgano de contratación'),
                $miTextEntry->getLinkTextEntry('buyer_profile_uri_id', 8, 'Perfil del contratante del órgano de contratación'),
            ]);
    }

    public function getSchemaSectionTenderingProcess(MiSection $miSection, MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos del proceso de licitación';
        $icon = 'heroicon-o-bars-arrow-up';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                //                $miTextEntry->getTextEntry('urgency_code', 3, 'urgency_code'),

                $miTextEntry->getBadgeTextEntry('submission_method_code', 3, 'Método de envío de las ofertas'),
                $miTextEntry->getBadgeTextEntry('part_presentation_code', 3, 'Número de lotes a los que se debe ofertar'),
                $miTextEntry->getBadgeTextEntry('procedure_code', 3, 'Procedimiento de contratación'),
                $miTextEntry->getBadgeTextEntry('contracting_system_code', 3, 'Sistema de contratación'),
                $miTextEntry->getBadgeDateTimeTextEntry('tender_submission_deadline_period', 3, Color::Red, 'Fecha y hora final de presentación de ofertas'),
                $miTextEntry->getBadgeDateTimeTextEntry('document_availability_period', 3, Color::Red, 'Fecha y hora final de documentación disponible'),
                $miTextEntry->getBadgeTextEntry('overthreshold_indicator', 3, '¿Contrato sara?'),
                $miTextEntry->getTextEntry('maximun_tenderer_awarded_lot_quantity', 3, 'Número máximo de lotes que se puede adjudicar a un licitador'),
                $miTextEntry->getTextEntry('maximum_lot_presentation_quantity', 3, 'Número máximo de lotes a los que se puede ofertar'),
                $miTextEntry->getTextEntry('lots_combination_contracting_authority_rights', 3, 'El poder adjudicador se reserva el derecho de adjudicar contratos que combinen lotes'),
            ]);
    }

    public function getSchemaSectionTenderingTerms(MiSection $miSection, MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos de los términos de la licitación';
        $icon = 'heroicon-o-megaphone';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('price_revision_formula_description', 3, 'Fórmula de revisión de precios'),
                $miTextEntry->getBadgeTextEntry('funding_program_code', 3, 'Programa de financiación de la UE'),
                $miTextEntry->getBadgeTextEntry('funding_program', 3, 'Descripción del programa'),
                $miTextEntry->getBadgeTextEntry('procurement_national_legislation_code', 3, 'Ley Nacional de aplicación'),
                $miTextEntry->getBadgeTextEntry('procurement_legislation_document_reference', 3, 'Directiva de aplicación'),
                $miTextEntry->getBadgeTextEntry('variant_constraint_indicator', 3, '¿Admite variantes?'),
                $miTextEntry->getBadgeTextEntry('required_curricula_indicator', 3, 'Indicador de Personal y cualificación profesional'),
                $miTextEntry->getTextEntry('received_appeal_quantity', 3, 'Número de recursos interpuestos'),
                $miTextEntry->getBadgeTextEntry('epaymentmeans_indicator', 3, '¿Pago electrónico?'),
                $miTextEntry->getBadgeTextEntry('eordering_indicator', 3, '¿Orden electrónica?'),
                $miTextEntry->getBadgeTextEntry('electronic_invoicing_indicator', 3, '¿Factura electrónica?'),
            ]);
    }

    // --------------------------------------------- Fin Nuevos ------------------------------------------------------------

    public function getInfolistSectionRegistroContrato(MiSection $miSection, MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos necesarios para la exportación al registro de contratos';
        $icon = 'heroicon-o-map-pin';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('codigo_organismo_rc', 2),
                $miTextEntry->getBadgeTextEntry('tipo_admin_id', 3),
                $miTextEntry->getBadgeTextEntry('tipo_admin_local_id', 3),
            ]);
    }

    public function getInfolistSectionContacto(MiSection $miSection, MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos de contacto';
        $icon = 'heroicon-o-identification';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getEmailTextEntry('email', 3),
                $miTextEntry->getTextEntry('direccion', 3),
                $miTextEntry->getTextEntry('codigo_postal', 3),
                $miTextEntry->getTextEntry('telefono', 3),
            ]);
    }

    public function getInfolistSectionDatosOrganoContratacionPlacsp(MiSection $miSection, MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos extraídos desde la Plataforma de Contratación';
        $icon = 'heroicon-o-arrow-down-tray';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('organo_contratacion', 7),
                $miTextEntry->getTextEntry('nif_entidad', 1),
                $miTextEntry->getTextEntry('id_plataforma', 2),
                $miTextEntry->getTextEntry('codigo_dir3', 1),
                $miTextEntry->getBadgeTextEntry('es_medio_propio', 1),

                $miTextEntry->getTextEntry('ubicacion', 4),
                $miTextEntry->getTextEntry('dependencia1', 4),
                $miTextEntry->getTextEntry('dependencia2', 4),
            ]);
    }

    public function getInfoListSectionFechasRegistro(MiSection $miSection, MiTextEntry $miTextEntry, bool $incluir_fecha_verficiacion = false): Section
    {
        $description = 'Fechas asociadas al registro';
        $icon = 'heroicon-o-calendar';
        $columnSpan = ConstantesInt::TAMANO_2->value;

        $array_campos = [
            $miTextEntry->getBadgeDateTimeTextEntry('created_at', $columnSpan)
                ->color(getColorByColumnName('created_at')),
            $miTextEntry->getBadgeDateTimeTextEntry('updated_at', $columnSpan)
                ->color(getColorByColumnName('updated_at')),
            $miTextEntry->getBadgeDateTimeTextEntry('deleted_at', $columnSpan)
                ->color(getColorByColumnName('deleted_at')),
        ];

        if ($incluir_fecha_verficiacion) {
            $array_campos = array_merge(
                $array_campos,
                [
                    $miTextEntry->getBadgeDateTimeTextEntry('email_verified_at', $columnSpan)
                        ->color(getColorByColumnName('email_verified_at')),
                ]);
        }

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                    columnSpan: $columnSpan,
                ))
            ->schema(
                $array_campos);
    }

    public function getInfoListSectionEstadoRegistro(MiSection $miSection, MiTextEntry $miTextEntry): Section
    {
        $description = 'Estado del registro';
        $icon = 'heroicon-o-flag';
        $columnSpan = ConstantesInt::TAMANO_2->value;

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                    columnSpan: $columnSpan,
                ))
            ->schema([
                $miTextEntry->getBadgeTextEntry('es_activo', $columnSpan),
            ]);
    }

    public function getInfolistSectionInvente(MiSection $miSection, MiTextEntry $miTextEntry): Section
    {
        $description = 'Acceso a la plataforma Invente del Ministerio de Hacienda';
        $icon = 'heroicon-o-cursor-arrow-ripple';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([

                $miTextEntry->getTextEntry('codigo_invente', 2),

                $miTextEntry->getTextEntry('link_invente', 8)
                    ->color(Color::Blue)
                    ->tooltip(
                        fn ($state) => filled($state) ? ConstantesString::ABRIR_ENLACE->value : null
                    )
                    ->state(
                        function ($record) {
                            $codInvente = $record->codigo_invente;

                            return filled($codInvente)
                                ? ConstantesString::ENLACE_INVENTE->value.$codInvente
                                : ConstantesString::NO_FIGURA->value;
                        }
                    )
                    ->url(
                        function ($record) {
                            $codInvente = $record->codigo_invente;

                            return filled($codInvente)
                                ? ConstantesString::ENLACE_INVENTE->value.$codInvente
                                : ConstantesString::NO_FIGURA->value;
                        },
                        shouldOpenInNewTab: true
                    ),
            ]);
    }

    public function getInfolistSectionPlacsp(MiSection $miSection, MiTextEntry $miTextEntry): Section
    {

        $description = 'Enlace a la Plataforma de Contratación del Sector Público';
        $icon = 'heroicon-o-cursor-arrow-ripple';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getLinkTextEntry('link', 12, 'Enlace a la Plataforma de Contratación'),
            ]);
    }

    public function getInfolistSectionObservaciones(MiSection $miSection, MiTextEntry $miTextEntry): Section
    {

        $description = 'Notas asociadas al registro';
        $icon = 'heroicon-o-numbered-list';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntryObservacionesSinEtiqueta(ConstantesInt::TAMANO_10->value)
                    ->label(' ')
                    ->html(),
            ]);
    }

    public function getFormSectionFlags(MiSection $miSection, MiToogle $miToogle): Section
    {

        $description = 'Estado del registro';
        $icon = 'heroicon-o-flag';
        $columns = ConstantesInt::TAMANO_2->value;

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                    columnSpan: $columns,
                ))
            ->schema([
                $miToogle->getToggle('es_activo', $columns, true)
                    ->disabled(! esSuperAdmin())
                    ->helperText('Indica si el registro se encuentra disponible para su gestión')]);
    }
}
