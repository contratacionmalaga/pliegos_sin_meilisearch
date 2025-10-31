<?php

namespace App\Filament\Resources\PLACSP\Adjudicaciones\Schemas;


use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Components\Schemas\MiSchema;
use App\Filament\Components\Schemas\MiSectionSchema;
use Filament\Schemas\Schema;

class AdjudicacionInfolist
{
    protected int $numColumnSpan = 12;

    public function getSchema(Schema $schema): Schema
    {

        // Creación de los objetos MiSchema, MiSectionSchema, MiTextEntry
        $miSchema = new MiSchema();
        $miSectionSchema = new MiSectionSchema();
        $miTextEntry = new MiTextEntry();


//       $isRelationManager = $schema->getLivewire() instanceof RelationManager;
       $isRelationManager = $schema->getLivewire() instanceof AdjudicacionesRelationManager;
//        $isRelationManager = isRelationManager();
//        $isRelationManager = method_exists($schema->getLivewire(), 'getOwnerRecord');
//        $isRelationManager = true;

        //->hidden(fn ($livewire) => $livewire->getOwnerRecord() instanceof Team),
       // O una versión más genérica:
       // ->hidden(fn ($livewire) => $livewire->getOwnerRecord() !== null),

//        $isRelationManager = $schema->getLivewire()->getOwnerRecord();
//        $isRelationManager = $schema instanceof \Filament\Resources\RelationManagers\RelationManager;
//        $isRelationManager = $schema->getLivewire() instanceof \App\Filament\Resources\PLACSP\Expedientes\RelationManagers\AdjudicacionesRelationManager;

        ds($schema); //TODO: Quitar
        ds($schema->getLivewire()); //TODO: Quitar
        ds('$isRelationManager =' . $isRelationManager); //TODO: Quitar

        $arraySectionPrincipal = [
            // Informacion propia de la adjudicacion
            $miSectionSchema->getSchemaSectionTenderResults($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
        ];

        // Si no esta en un relation manager se añade la informacion comun con el expediente
        if (!$isRelationManager) {

            $arraySectionPrincipal = array_merge(
                    [
                        $miSectionSchema->getSchemaSectionDatosExpediente($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
                        $miSectionSchema->getSchemaSectionTenderingProcess($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
                        $miSectionSchema->getSchemaSectionTenderingTerms($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
                            $miSectionSchema->getSchemaSectionDatosOrganoContratacion($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
//                            $miSectionSchema->getSchemaSectionDatosEntidad($miTextEntry)->columnSpan(12)->collapsible(),
                        $miSectionSchema->getSchemaSectionLogFeedEntry($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
                    ],
                    $arraySectionPrincipal
                );
        }

//        /*
//         * Creo el array con las Secciones asociadas a la sección principal
//         */
//        $arraySectionPrincipal = [
//// Originales
////            $miSectionSchema->getSchemaSectionLogFeedEntry($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
////            $miSectionSchema->getSchemaSectionDatosExpediente($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
////            $miSectionSchema->getSectionInfolistDatosOrganoContratacion($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
////            $miSectionSchema->getSchemaSectionProcurementProject($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
////            $miSectionSchema->getSchemaSectionTenderingProcess($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
////            $miSectionSchema->getSchemaSectionTenderingTerms($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
//
//
//
//            $miSectionSchema->getSchemaSectionDatosExpediente($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
//            $miSectionSchema->getSchemaSectionTenderingProcess($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
//            $miSectionSchema->getSchemaSectionTenderingTerms($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
//            $miSectionSchema->getSectionInfolistDatosOrganoContratacion($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
//            $miSectionSchema->getSectionInfolistDatosEntidad($miTextEntry)->columnSpan(12)->collapsible(),
//            $miSectionSchema->getSchemaSectionLogFeedEntry($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
//
//            // Informacion propia de la adjudicacion
//            $miSectionSchema->getSchemaSectionTenderResults($miTextEntry)->columnSpan($this->numColumnSpan)->collapsible(),
//
//        ];

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
}
