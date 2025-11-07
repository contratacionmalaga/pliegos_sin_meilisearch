<?php

namespace App\Filament\Resources\Incidencias\Schemas;

use App\DTOs\SectionConfig;
use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Components\Schemas\MiSchema;
use App\Filament\Components\Schemas\MiSectionSchema;
use Filament\Schemas\Components\Section;
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
            $this->getSectionSchemaIncidencia($miSectionSchema, $miTextEntry)->columnSpan(12)->collapsible(),
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

    private function getSectionSchemaIncidencia(
        MiSectionSchema $misectionSchema,
        MiTextEntry     $miTextEntry
    ): Section
    {

        $description = MiNavigationItem::PLACSP_INCIDENCIA->getInfolistDescription();
        $icon = 'heroicon-o-information-circle';

        return $misectionSchema
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('titulo', 3, 'Titulo'),
                $miTextEntry->getTextEntry('descripcion', 3, 'Descripcion'),
                $miTextEntry->getBadgeTextEntry('estado', 3, 'Estado'),
                $miTextEntry->getTextEntry('email', 3, 'email'),
            ]);
    }

}
