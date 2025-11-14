<?php

namespace App\Filament\Resources\Incidencias\Schemas;

use App\DTOs\SectionConfig;
use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Components\Schemas\MiSchema;
use App\Filament\Components\Schemas\MiSectionSchema;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class IncidenciaSimpleInfolist
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
            $this->getSectionSchemaDatosIncidencia($miSectionSchema, $miTextEntry)->columnSpan(12)->collapsible(),
            $this->getSectionSchemaRespuestasEnviadas($miSectionSchema, $miTextEntry)->columnSpan(12)->collapsible(),
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

    private function getSectionSchemaDatosIncidencia(
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
                $miTextEntry->getTextEntry('titulo', 5, 'Titulo(SIMPLE)'),
                $miTextEntry->getTextEntry('descripcion', 5, 'Descripcion(SIMPLE)'),
                $miTextEntry->getBadgeTextEntry('estado', 5, 'Estado(SIMPLE)'),
                $miTextEntry->getTextEntry('email', 5, 'email(SIMPLE)'),
            ]);
    }

    private function getSectionSchemaRespuestasEnviadas(
        MiSectionSchema $misectionSchema,
        MiTextEntry     $miTextEntry
    ): Section
    {
        $description = 'Respuestas enviadas';
        $icon = 'heroicon-o-chat-bubble-bottom-center-text';

        return $misectionSchema
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                RepeatableEntry::make('respuestas')
                    ->label('Respuestas Enviadas')
                    ->columns(12)
                    ->schema([
                        $miTextEntry->getTextEntry('respuesta', 6, 'Respuesta'),
                        $miTextEntry->getBadgeDateTimeTextEntry('created_at', 3, null, 'Creada'),
                        $miTextEntry->getBadgeDateTimeTextEntry('updated_at', 3, null, 'Actualizada'),
                    ])
                    ->columnSpan(12)
                    ->visible(fn($record) => $record?->respuestas?->isNotEmpty()),
            ]);
    }

}
