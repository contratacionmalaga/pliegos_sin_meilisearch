<?php

namespace App\Filament\Resources\RespuestasIncidencia\Schemas;

use App\DTOs\SectionConfig;
use App\Enums\Constantes\ConstantesInt;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Components\Schemas\MiSchema;
use App\Filament\Components\Schemas\MiSectionSchema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RespuestasIncidenciaInfolist
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
            $this->getSectionSchemaRespuestaIncidencia($miSectionSchema, $miTextEntry)->columnSpan(12)->collapsible(),
        ];

        /*
         * Creo el array con las Secciones asociadas a la sección secundaria
         */
        $arraySectionSecundaria = [
        ];

        /*
         * Devuelvo el objeto Schema según se define es el constructor
         */
        return $miSchema->getSchema($schema, $arraySectionPrincipal, $arraySectionSecundaria);
    }

    private function getSectionSchemaRespuestaIncidencia(
        MiSectionSchema $misectionSchema,
        MiTextEntry     $miTextEntry
    ): Section
    {

        $description = MiNavigationItemIncidencias::PLACSP_RESPUESTAS_INCIDENCIA->getInfolistDescription();
        $icon = 'heroicon-o-information-circle';

        return $misectionSchema
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntryRespuestasSinEtiqueta(ConstantesInt::TAMANO_10->value, 'Respuesta')
                    ->html(),
                $miTextEntry->getBadgeDateTimeTextEntry('created_at', 3, null,'created_at'),
                $miTextEntry->getBadgeDateTimeTextEntry('updated_at', 3, null,'updated_at'),
                $miTextEntry->getBadgeDateTimeTextEntry('deleted_at', 3, null,'deleted_at'),
            ]);
    }

}
