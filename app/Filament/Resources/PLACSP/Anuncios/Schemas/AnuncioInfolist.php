<?php

namespace App\Filament\Resources\PLACSP\Anuncios\Schemas;

use App\DTOs\SectionConfig;
use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Components\Schemas\MiSchema;
use App\Filament\Components\Schemas\MiSectionSchema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;

class AnuncioInfolist
{

    public function getSchema(Schema $infolist): Schema
    {

        // Creación de los objetos MiInfoList, MiSectionInfolist, MiTextEntry
//        $miInfoList = new MiInfolist();
        $miInfoList = new MiSchema();
        $miSectionSchema = new MiSectionSchema();
        $miTextEntry = new MiTextEntry();


        // Asigno valores al array que contendrá las secciones principales del Infolist
        $arraySectionPrincipal = [
            $this->getSectionSchemaAnuncio($miSectionSchema, $miTextEntry)->columnSpan(12),
            $miSectionSchema->getSchemaSectionDatosExpediente($miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionDatosOrganoContratacion($miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionEntidad($miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionLogFeedEntry($miTextEntry)->columnSpan(12)->collapsible(),
        ];

        /*
         * Creo el array con las Secciones asociadas a la sección secundaria
         */
        $arraySectionSecundaria = [
        ];

        /*
         * Devuelvo el obtjeto Infolist según se define es el consturctor
         */
        return $miInfoList->getSchema($infolist, $arraySectionPrincipal, $arraySectionSecundaria);
    }

    /**
     * Construye una sección principal reutilizable con un esquema dinámico
     */
    private function getSectionSchemaAnuncio(
        MiSectionSchema $misectionSchema,
        MiTextEntry       $miTextEntry
    ): Section
    {

        $description = MiNavigationItem::PLACSP_ANUNCIO->getInfolistDescription();
        $icon = 'heroicon-o-information-circle';

        return $misectionSchema
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getTextEntry('id', 3, 'Identificador del anuncio'),
                $miTextEntry->getBadgeTextEntry('notice_type_code', 3, 'Tipo de Anuncio'),
                $miTextEntry->getTextEntry('publication_media_name', 3, 'Lugar de publicación'),
                $miTextEntry->getBadgeDateTextEntry('issue_date', 3, Color::Blue, 'Fecha de publicación'),
            ]);
    }
}
