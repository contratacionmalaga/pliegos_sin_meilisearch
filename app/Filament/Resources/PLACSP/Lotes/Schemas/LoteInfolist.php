<?php

namespace App\Filament\Resources\PLACSP\Lotes\Schemas;

use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Components\Schemas\MiSchema;
use App\Filament\Components\Schemas\MiSectionSchema;
use Filament\Schemas\Schema;

class LoteInfolist
{

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
}
