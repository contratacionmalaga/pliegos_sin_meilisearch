<?php

namespace App\Filament\Resources\Incidencias\Schemas;

use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Components\Schemas\MiSchema;
use App\Filament\Components\Schemas\MiSectionSchema;
use Filament\Schemas\Schema;

class IncidenciaInfolist
{

    public function getSchema(Schema $schema): Schema
    {

        // Creación de los objetos MiSchema, MiSectionSchema, MiTextEntry
        $miSchema = new MiSchema();
        $miSectionSchema = new MiSectionSchema();
        $miTextEntry = new MiTextEntry();

        /*
         * Creo el array con las Secciones asociadas a la sección principal
         */
        $arraySectionPrincipal = [
            $miSectionSchema->getSchemaSectionDatosExpediente( $miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionTenderingProcess( $miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionTenderingTerms( $miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionDatosOrganoContratacion( $miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionLogFeedEntry( $miTextEntry)->columnSpan(12)->collapsible(),
        ];

        /*
         * Creo el array con las Secciones asociadas a la sección secundaria
         */
        $arraySectionSecundaria = [
        ];

        /*
         * Devuelvo el obtjeto Schema según se define es el consturctor
         */
        return $miSchema->getSchema($schema, $arraySectionPrincipal, $arraySectionSecundaria);
    }
}
