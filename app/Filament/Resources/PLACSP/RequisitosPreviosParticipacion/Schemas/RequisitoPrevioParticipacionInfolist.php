<?php

namespace App\Filament\Resources\PLACSP\RequisitosPreviosParticipacion\Schemas;

use App\DTOs\SectionConfig;
use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Components\Schemas\MiSchema;
use App\Filament\Components\Schemas\MiSectionSchema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RequisitoPrevioParticipacionInfolist
{

//    public function getInfolist(Schema $infolist): Schema
    public function getSchema(Schema $schema): Schema
    {

        // Creación de los objetos MiInfoList, MiSectionInfolist, MiTextEntry
        $miSchema = new MiSchema();
        $miSectionSchema = new MiSectionSchema();
        $miTextEntry = new MiTextEntry();

        /*
         * Creo el array con las Secciones asociadas a la sección principal
         */
        $arraySectionPrincipal = [
//            $this->getInfolistSectionDatos($misectionSchema, $miTextEntry),

            // COMUNES COM EXPEDIENTES
            $this->getSchemaSectionDatosRequisitoPrevioParticipacion($miSectionSchema, $miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionLogFeedEntry($miTextEntry)->columnSpan(10)->collapsible(),
            $miSectionSchema->getSchemaSectionDatosExpediente($miTextEntry)->columnSpan(10)->collapsible(),
            $miSectionSchema->getSchemaSectionDatosOrganoContratacion($miTextEntry)->columnSpan(10)->collapsible(),
            $miSectionSchema->getSchemaSectionProcurementProject($miTextEntry)->columnSpan(10)->collapsible(),
            $miSectionSchema->getSchemaSectionTenderingProcess($miTextEntry)->columnSpan(10)->collapsible(),
            $miSectionSchema->getSchemaSectionTenderingTerms($miTextEntry)->columnSpan(10)->collapsible(),
        ];

        /*
         * Creo el array con las Secciones asociadas a la sección secundaria
         */
        $arraySectionSecundaria = [
            $miSectionSchema->getInfoListSectionFechasRegistro()->columnSpan(2),
        ];

        /*
         * Devuelvo el obtjeto Infolist según se define es el consturctor
         */
        return $miSchema->getSchema($schema, $arraySectionPrincipal, $arraySectionSecundaria);
    }

    /**
     * Construye una sección principal reutilizable con un esquema dinámico
     */
    private function getSchemaSectionDatosRequisitoPrevioParticipacion(
        MiSectionSchema $misectionSchema,
        MiTextEntry       $miTextEntry
    ): Section
    {

        $description = MiNavigationItem::PLACSP_REQUISITO_PREVIO_PARTICIPACION->getInfolistDescription();
        $icon = 'heroicon-o-variable';

        return $misectionSchema
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('id', 3, 'Uuid'),
                $miTextEntry->getBadgeTextEntry('requirement_type_code', 3, 'Requisito previo de participación'),
                $miTextEntry->getBadgeTextEntry('updated', 3, 'Actualización en PLACSP'),
                $miTextEntry->getTextEntry('contract_folder_id', 3, 'Expediente'),
                $miTextEntry->getTextEntry('contract_folder_status_code', 12, 'Estado expediente'),
                $miTextEntry->getTextEntry('party_name_organo_contratacion', 12, 'Órgano de contratación'),
            ]);

    }
}
