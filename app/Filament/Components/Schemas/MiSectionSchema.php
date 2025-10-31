<?php

namespace App\Filament\Components\Schemas;

use App\DTOs\SectionConfig;
use App\Enums\Constantes\ConstantesInt;
use App\Enums\Constantes\ConstantesString;
use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\Placsp\PLACSP_PreliminaryMarketConsultationTypeCode;
use App\Filament\Components\Forms\MiRichEditor;
use App\Filament\Components\Forms\MiTextInput;
use App\Filament\Components\Forms\MiToogle;
use App\Filament\Components\Infolists\MiTextEntry;
use Filament\Schemas\Components\Section;
use Filament\Support\Colors\Color;

class MiSectionSchema
{
    /**
     * @param SectionConfig $config
     *
     * @return Section
     */
    public function create(SectionConfig $config): Section
    {

        return Section::make()
            ->heading($config->heading)
            ->description($config->description)
            ->icon($config->icon)
            ->iconColor($config->color)
            ->columns($config->columnSpan);
    }

// --------------------------------------------- Inicio Nuevos ---------------------------------------------------------


    public function getSchemaSectionEntidad(MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos de la Entidad';
//        $icon = MiNavigationItem::ENTIDAD->getIcon();
        $icon = 'heroicon-s-building-office-2';

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                    columnSpan: ConstantesInt::TAMANO_12->value
                ))
            ->schema([
                $miTextEntry->getTextEntry('entidad.entidad', 5, 'Nombre de la entidad'),
                $miTextEntry->getTextEntry('entidad.nif', 2,'Nif de la entidad'),
            ]);
    }

    public function getSchemaSectionLogFeedEntry(MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos de Trazabilidad de la importación';
        $icon = 'heroicon-o-finger-print';

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getBadgeTextEntry('tipo_sindicacion', 2, 'Tipo de importación'),
                $miTextEntry->getTextEntry('link_self', 4,'Fichero que contiene el expediente'),
                $miTextEntry->getTextEntry('id_entry', 3,'Identificador único del expediente en PLACSP'),
                $miTextEntry->getBadgeDateTimeTextEntry('updated', 3, Color::Green,'Fecha de la última actualización en PLACSP'),
                $miTextEntry->getTextEntry('summary', 10,'Resumen del expediente'),
//                $miTextEntry->getLinkTextEntry('link', 10,'Enlace al expediente en PLACSP'),
            ])
            ->visible(esSuperAdmin());
    }

    public function getSchemaSectionPreliminaryMarketConsultationStatus(MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos propios de la consulta';
        $icon = 'heroicon-o-information-circle';

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('preliminary_market_consultation_id', 2),
                $miTextEntry->getTextEntry('consultation_name', 10),
                $miTextEntry->getTextEntry('preliminary_market_consultation_status_code', 2),
                $miTextEntry->getBadgeTextEntry('condition_type_code', 2),
                $miTextEntry->getLinkTextEntry('link', 8,'Enlace a la consulta en la PLACSP'),
                $miTextEntry->getTextEntry('condition_type_reason_text', 12)
                    ->visible(fn ($record) => $record ->condition_type_code === PLACSP_PreliminaryMarketConsultationTypeCode::ConsultaAbierta->value),

                $miTextEntry->getTextEntry('party_selection_reason_text', 12)
                    ->visible(fn ($record) => $record ->condition_type_code === PLACSP_PreliminaryMarketConsultationTypeCode::ConsultaAbierta->value),

                $miTextEntry->getTextEntry('conditions_text', 12),
            ]);
    }

    public function getSchemaSectionDatosExpediente(MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos básicos del expediente';
        $icon = 'heroicon-o-document-currency-euro';

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('contract_folder_id', 2, 'Identificador del expediente'),
                $miTextEntry->getBadgeTextEntry('contract_folder_status_code', 2,'Estado del expediente'),
                $miTextEntry->getBadgeTextEntry('mix_contract_indicator', 2,'¿Contrato mixto?'),
                $miTextEntry->getTextEntryMoney('estimated_overall_contract_amount', 2, 'Valor estimado del contrato'),
                $miTextEntry->getTextEntryMoney('tax_exclusive_amount', 2, 'Importe total sin impuestos'),
                $miTextEntry->getTextEntryMoney('total_amount', 2, 'Importe total con impuestos'),
                $miTextEntry->getBadgeTextEntry('type_code', 2, 'Tipo de contrato'),
                $miTextEntry->getTextEntry('subtype_code_enum', 2,'Subtipo de contrato')
                    ->badge()
                    ->color(fn ($state) => $state?->getColor())
                    ->icon(fn ($state) => $state?->getIcon())
                    ->formatStateUsing(fn ($state) => $state?->getLabel()),
                $miTextEntry->getTextEntry('country_subentity', 2, 'Lugar ejecución'),
                $miTextEntry->getBadgeTextEntry('country_subentity_code', 2, 'Código lugar ejecución'),
                $miTextEntry->getLinkTextEntry('link', 7,'Enlace al expediente en la PLACSP'),
                $miTextEntry->getTextEntry('name_objeto', 12, 'Objeto del contrato'),
                $miTextEntry->getTextEntry('description_objeto', 12, 'Descripción del objeto del contrato'),

            ]);
    }

    public function getSchemaSectionDatosOrganoContratacion(MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos del Órgano de Contratación';
//        $icon = MiNavigationItem::ORGANO_CONTRATACION->getIcon();
        $icon = 'heroicon-s-building-library';

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getBadgeTextEntry('contracting_party_type_code', 3, 'Tipo de administración'),
                $miTextEntry->getTextEntry('party_name_organo_contratacion', 3, 'Nombre del órgano de contratación'),
                $miTextEntry->getTextEntry('nif_entidad', 3,'Nif'),
                $miTextEntry->getLinkTextEntry('web_site_uri', 3,'Sitio web del órgano de contratación'),
            ]);
    }

    public function getSchemaSectionProcurementProject(MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos de Procurement_Project';
//        $icon = MiNavigationItem::ORGANO_CONTRATACION->getIcon();
        $icon = 'heroicon-s-building-library';

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getBadgeTextEntry('type_code', 3, 'Tipo de contrato'),
                $miTextEntry->getTextEntry('subtype_code_enum', 7,'Subtipo de contrato')
                    ->badge()
                    ->color(fn ($state) => $state?->getColor())
                    ->icon(fn ($state) => $state?->getIcon())
                    ->formatStateUsing(fn ($state) => $state?->getLabel()),
                $miTextEntry->getBadgeTextEntry('mix_contract_indicator', 2,'Indicador de contrato mixto'),
                $miTextEntry->getTextEntry('name_objeto', 12, 'Objeto del contrato'),
                $miTextEntry->getTextEntry('description_objeto', 12, 'Descripción del objeto del contrato'),
            ]);
    }

    public function getSchemaSectionTenderingProcess(MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos del proceso de licitación';
//        $icon = MiNavigationItem::ORGANO_CONTRATACION->getIcon();
        $icon = 'heroicon-s-building-library';

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
//                $miTextEntry->getTextEntry('urgency_code', 3, 'urgency_code'),

                $miTextEntry->getBadgeTextEntry('submission_method_code', 3, 'Método de envío de ofertas'),
                $miTextEntry->getTextEntry('part_presentation_code', 3, 'Número de lotes a los que se debe ofertar'),
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


    public function getSchemaSectionTenderingTerms(MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos de los términos de la licitación';
        $icon = 'heroicon-o-megaphone';

        return $this
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
                $miTextEntry->getBadgeTextEntry('received_appeal_quantity', 3, 'Número de recursos interpuestos')
                    ->color(
                        function ($state) {
                            return $state > 0 ? Color::Red : Color::Green;
                        }
                    ),
                $miTextEntry->getBadgeTextEntry('epaymentmeans_indicator', 3, '¿Pago electrónico?'),
                $miTextEntry->getBadgeTextEntry('eordering_indicator', 3, '¿Orden electrónica?'),
                $miTextEntry->getBadgeTextEntry('electronic_invoicing_indicator', 3, '¿Factura electrónica?'),
            ]);
    }


    public function getSchemaSectionTenderResults(MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos de la adjudicación';
        $icon = 'heroicon-o-megaphone';

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getBadgeTextEntry('abnormally_low_tenders_indicator', 3, 'Indicador de baja temeraria'),
                $miTextEntry->getBadgeDateTimeTextEntry('award_date', ConstantesInt::TAMANO_2->value,null,'Fecha de adjudicación'),
                $miTextEntry->getTextEntry('eu_nationals_received_tender_quantity', 3, 'Número de ofertas recibidas de extranjeros comunitarios (UE)'),
                $miTextEntry->getTextEntryMoney('higher_tender_amount_quantity', 3, 'Precio de la oferta más alta'),
                $miTextEntry->getTextEntryMoney('lower_tender_amount_quantity', 3, 'Precio de la oferta más baja'),

                $miTextEntry->getTextEntry('noneu_nationals_received_tender_quantity', 2, 'Número de ofertas recibidas de extranjeros no comunitarios ( no UE)'),
                $miTextEntry->getTextEntry('received_tender_quantity', 3, 'Número de ofertas recibidas'),
                $miTextEntry->getBadgeTextEntry('sme_awarded_indicator', 3, 'Indicador si el adjudicatario es pyme'),
                $miTextEntry->getTextEntry('smes_received_tender_quantity', 3, 'Número de ofertas recibidas de pymes'),
                $miTextEntry->getBadgeDateTimeTextEntry('start_date', ConstantesInt::TAMANO_2->value,null,'Fecha de comienzo'),
                $miTextEntry->getTextEntry('awarded_owner_nationality_code', 3, 'Código NUTS asociado a la ubicación del adjudicatario'),
                $miTextEntry->getBadgeTextEntry('result_code', 3, 'Resultado de la licitación'),
                $miTextEntry->getTextEntry('tender_result_description', 3, 'Justificación'),
                $miTextEntry->getTextEntry('descuento', 2, 'Descuento'),
                $miTextEntry->getTextEntryMoney('payable_amount', 3, 'Importe total ofertado (con impuestos)'),
            ]);
    }




    public function getSchemaSectionContractModification(MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos de la modificación';
        $icon = 'heroicon-o-megaphone';

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('contract_id', 3, 'contract_id'),
                $miTextEntry->getTextEntry('id_contract_modification', 3, 'id_contract_modification'),
                $miTextEntry->getTextEntry('issue_date', 3, 'issue_date'),
                $miTextEntry->getTextEntry('note', 3, 'note'),
                $miTextEntry->getTextEntry('contract_modification_lot_id', 3, 'contract_modification_lot_id'),
                $miTextEntry->getTextEntry('contract_id', 3, 'contract_id'),
                $miTextEntry->getTextEntry('tea1', 3, 'tea1'),
                $miTextEntry->getTextEntry('tea2', 3, 'tea2'),
                $miTextEntry->getTextEntry('tia1', 3, 'tia1'),
                $miTextEntry->getTextEntry('tia2', 3, 'tia2'),
            ]);
    }



// --------------------------------------------- Fin Nuevos ------------------------------------------------------------

    public function getSchemaSectionDatosEntidad(MiTextEntry $miTextEntry): Section
    {

        $description = 'Datos de la entidad';
//        $icon = MiNavigationItem::ENTIDAD->getIcon();
        $icon = 'heroicon-s-building-office-2';

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry( 'entidad.entidad', 3, 'Nombre de la entidad' ),
                $miTextEntry->getTextEntry('entidad.nif', 1, 'Nif de la entidad'),
                $miTextEntry->getLinkTextEntry('entidad.link', 6, 'Enlace al perfil de contratante de la entidad'),
            ]);
    }

    /**
     * @return Section
     */
    public function getInfolistSectionRegistroContrato(): Section
    {

        $description = 'Datos necesarios para la exportación al registro de contratos';
        $icon = 'heroicon-o-map-pin';

        $miTextEntry = new MiTextEntry();

        return $this
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

    /**
     * @return Section
     */
    public function getInfolistSectionContacto(): Section
    {

        $description = 'Datos de contacto';
        $icon = 'heroicon-o-map-pin';

        $miTextEntry = new MiTextEntry();

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getEmailTextEntry('email', 2),
                $miTextEntry->getTextEntry('direccion', 3),
                $miTextEntry->getTextEntry('codigo_postal', 1),
                $miTextEntry->getTextEntry('telefono', 3),
            ]);
    }

    /**
     * @return Section
     */
    public function getFormSectionContacto(): Section
    {

        $description = 'Datos de contacto';
        $icon = 'heroicon-o-map-pin';

        $miTextInput = new MiTextInput();

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextInput->getTextInputEmail('email', 2),
                $miTextInput->getTextInputDireccion('direccion', 3),
                $miTextInput->getTextInputCodigoPostal('codigo_postal', 1),
                $miTextInput->getTextInputTelefono('telefono', 3),
            ]);
    }

    /**
     * @return Section
     */
    public function getInfolistSectionDatosOrganoContratacionPlacsp(): Section
    {

        $miTextEntry = new MiTextEntry();

        $description = 'Datos extraídos desde la Plataforma de Contratación';
        $icon = 'heroicon-o-arrow-down-tray';

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('organo_contratacion', 6),
                $miTextEntry->getTextEntry('nif', 1),
                $miTextEntry->getTextEntry('id_plataforma', 1),
                $miTextEntry->getTextEntry('codigo_dir3', 1),
                $miTextEntry->getBadgeTextEntry('es_medio_propio', 1),

                $miTextEntry->getTextEntry('ubicacion', 3),
                $miTextEntry->getTextEntry('dependencia1', 4),
                $miTextEntry->getTextEntry('dependencia2', 3),
            ]);
    }

    /**
     * @param bool $incluir_fecha_verficiacion
     *
     * @return Section
     */
    public function getInfoListSectionFechasRegistro(bool $incluir_fecha_verficiacion = false): Section
    {
        $description = 'Fechas asociadas al registro';
        $icon = 'heroicon-o-calendar';
        $columnSpan = ConstantesInt::TAMANO_2->value;

        $miTextEntry = new MiTextEntry;

        $array_campos = [
            $miTextEntry->getBadgeDateTimeTextEntry('created_at', ConstantesInt::TAMANO_2->value)
                ->color(getColorByColumnName('created_at')),
            $miTextEntry->getBadgeDateTimeTextEntry('updated_at', ConstantesInt::TAMANO_2->value)
                ->color(getColorByColumnName('updated_at')),
            $miTextEntry->getBadgeDateTimeTextEntry('deleted_at', ConstantesInt::TAMANO_2->value)
                ->color(getColorByColumnName('deleted_at')),
        ];

        if ($incluir_fecha_verficiacion) {
            $array_campos = array_merge(
                $array_campos,
                [
                    $miTextEntry->getBadgeDateTimeTextEntry('email_verified_at', ConstantesInt::TAMANO_2->value)
                        ->color(getColorByColumnName('email_verified_at'))
                    ]);
        }

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                    columnSpan: $columnSpan,
                ))
            ->schema(
                $array_campos);
    }

    public function getInfoListSectionEstadoRegistro(): Section
    {
        $description = 'Estado del registro';
        $icon = 'heroicon-o-flag';
        $columnSpan = ConstantesInt::TAMANO_2->value;

        $miTextEntry = new MiTextEntry;

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                    columnSpan: $columnSpan,
                ))
            ->schema([
                $miTextEntry->getBadgeTextEntry('es_activo', ConstantesInt::TAMANO_2->value)
            ]);
    }

    public function getInfolistSectionInvente(): Section
    {
        $description = 'Acceso a la plataforma Invente del Ministerio de Hacienda';
        $icon = 'heroicon-o-cursor-arrow-ripple';

        $miTextEntry = new MiTextEntry();

        return $this
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
                                ? ConstantesString::ENLACE_INVENTE->value . $codInvente
                                : ConstantesString::NO_FIGURA->value;
                        }
                    )
                    ->url(
                        function ($record) {
                            $codInvente = $record->codigo_invente;
                            return filled($codInvente)
                                ? ConstantesString::ENLACE_INVENTE->value . $codInvente
                                : ConstantesString::NO_FIGURA->value;
                        },
                        shouldOpenInNewTab: true
                    ),
            ]);
    }

    public function getInfolistSectionPlacsp(): Section
    {

        $description = 'Enlace a la Plataforma de Contratación del Sector Público';
        $icon = 'heroicon-o-cursor-arrow-ripple';

        $miTextEntry = new MiTextEntry();

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getLinkTextEntry('link', 10),
            ]);
    }

    public function getInfolistSectionObservaciones(): Section
    {

        $description = 'Notas asociadas al registro';
        $icon = 'heroicon-o-numbered-list';

        $miTextEntry = new MiTextEntry();

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntryObservacionesSinEtiqueta(ConstantesInt::TAMANO_10->value)
                    ->label( ' ')
                    ->html()
            ]);
    }

    /**
     * @return Section
     */
    public function getFormSectionLinkPerfilContratante(): Section
    {

        $miTextInput = new MiTextInput();

        $description = 'Link al perfil de contratante alojado en la Plataforma de Contratación del Sector Público';
        $icon = 'heroicon-o-cursor-arrow-ripple';

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon
                ))
            ->schema([
                $miTextInput->getTextInputLink('link', false, 7)]);
    }

    /**
     * @return Section
     */
    public function getFormSectionFlags(): Section
    {

        $miToogle = new MiToogle();

        $description = 'Estado del registro';
        $icon = 'heroicon-o-flag';
        $columnSpan = ConstantesInt::TAMANO_2->value;

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                    columnSpan: $columnSpan,
                ))
            ->schema([
                $miToogle->getToggle('es_activo', true,  ConstantesInt::TAMANO_2->value)
                    ->helperText('Indica si el registro se encuentra disponible para su gestión')]);
    }

    /**
     * @return Section
     */
    public function getFormSectionObservaciones(): Section
    {

        $miRichEditor = new MiRichEditor();

        $description = 'Información adicional';
        $icon = 'heroicon-o-numbered-list';

        return $this
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miRichEditor->getRichEditorWithoutLabel(ConstantesInt::TAMANO_10->value)]);
    }
}
