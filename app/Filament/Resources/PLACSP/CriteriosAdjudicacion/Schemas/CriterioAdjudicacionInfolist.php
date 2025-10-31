<?php

namespace App\Filament\Resources\PLACSP\CriteriosAdjudicacion\Schemas;

use App\DTOs\SectionConfig;
use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Components\Schemas\MiSchema;
use App\Filament\Components\Schemas\MiSectionSchema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;

class CriterioAdjudicacionInfolist
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
            $this->getSchemaSectionDatosCriterioAdjudicacion($miSectionSchema, $miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionDatosExpediente($miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionDatosOrganoContratacion($miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionProcurementProject($miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionTenderingProcess($miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionTenderingTerms($miTextEntry)->columnSpan(12)->collapsible(),
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
    private function getSchemaSectionDatosCriterioAdjudicacion(
        MiSectionSchema $misectionSchema,
        MiTextEntry       $miTextEntry
    ): Section
    {

        $description = MiNavigationItem::PLACSP_CRITERIO_ADJUDICACION->getInfolistDescription();
        $icon = 'heroicon-o-variable';

        return $misectionSchema
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('id', 3, 'Identificador del criterio'),
                $miTextEntry->getBadgeTextEntry('awarding_criteria_type_code', 3, 'Tipo de criterio'),
                $miTextEntry->getBadgeTextEntry('awarding_criteria_subtype_code', 3, 'Subtipo de criterio'),
                $miTextEntry->getTextEntry('weight_numeric', 3, 'Peso de criterio'),
                $miTextEntry->getTextEntry('description', 12, 'Decripción asociada al criterio'),
                $miTextEntry->getTextEntry('note', 12, 'Notas asociadas al criterio'),
            ]);
    }
}
