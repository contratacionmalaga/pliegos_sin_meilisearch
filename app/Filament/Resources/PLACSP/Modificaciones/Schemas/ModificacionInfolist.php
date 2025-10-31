<?php

namespace App\Filament\Resources\PLACSP\Modificaciones\Schemas;

use App\DTOs\SectionConfig;
use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Components\Schemas\MiSchema;
use App\Filament\Components\Schemas\MiSectionSchema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ModificacionInfolist
{

    protected int $numColumnSpan = 12;

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
// Originales
//            $miSectionSchema->getSchemaSectionLogFeedEntry($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
//            $miSectionSchema->getSchemaSectionDatosExpediente($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
//            $miSectionSchema->getSectionInfolistDatosOrganoContratacion($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
//            $miSectionSchema->getSchemaSectionProcurementProject($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
//            $miSectionSchema->getSchemaSectionTenderingProcess($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
//            $miSectionSchema->getSchemaSectionTenderingTerms($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),

            $miSectionSchema->getSchemaSectionDatosExpediente($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
            $miSectionSchema->getSchemaSectionTenderingProcess($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
            $miSectionSchema->getSchemaSectionTenderingTerms($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
                $miSectionSchema->getSchemaSectionDatosOrganoContratacion($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
//                $miSectionSchema->getSchemaSectionDatosEntidad($miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionLogFeedEntry($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),

            // Informacion propia de la modificacion
//            $miSectionSchema->getSchemaSectionContractModification($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),

        ];

        /*
         * Creo el array con las Secciones asociadas a la sección secundaria
         */
        $arraySectionSecundaria = [
//            $miSectionSchema->getInfoListSectionFechasRegistro(),
//            $miSectionSchema->getInfoListSectionEstadoRegistro(),
        ];

        /*
         * Devuelvo el obtjeto Infolist según se define es el consturctor
         */
        return $miSchema->getSchema($schema, $arraySectionPrincipal, $arraySectionSecundaria);
    }

    /**
     * Construye una sección principal reutilizable con un esquema dinámico
     */
    private function getInfolistSectionDatosExpexdiente(
        MiSectionSchema $miSectionSchema,
        MiTextEntry       $miTextEntry
    ): Section
    {

        $description = MiNavigationItem::PLACSP_MODIFICACION->getInfolistDescription();
        $icon = 'heroicon-o-information-circle';

        return $miSectionSchema
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('contract_folder_id', 3),
                $miTextEntry->getBadgeTextEntry('name_objeto', 1),
                $miTextEntry->getTextEntry('contract_folder_status_code', 3),
                $miTextEntry->getTextEntry('type_code', 3),
                $miTextEntry->getTextEntry('procedure_code', 3),
            ]);

    }
}
