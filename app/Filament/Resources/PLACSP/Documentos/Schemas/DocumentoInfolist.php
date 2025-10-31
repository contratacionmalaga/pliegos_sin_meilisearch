<?php

namespace App\Filament\Resources\PLACSP\Documentos\Schemas;

use App\DTOs\SectionConfig;
use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\Placsp\TipoSindicacion;
use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Components\Schemas\MiSchema;
use App\Filament\Components\Schemas\MiSectionSchema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DocumentoInfolist
{

    public function getSchema(Schema $schema): Schema
    {
        // Creación de los objetos necesarios
        $miSchema = new MiSchema();
        $miSectionSchema = new MiSectionSchema();
        $miTextEntry = new MiTextEntry();

        // Obtengo el tipo de sindicacion del registro actual
        $record = $schema->getRecord();
        $tipoSindicacion = $record->getAttribute('tipo_sindicacion');

        // Asegurarse de que tipo_sindicacion no sea null antes de proceder
        $sectionDatosExpediente = $tipoSindicacion === TipoSindicacion::EMP
                ? $miSectionSchema->getSchemaSectionPreliminaryMarketConsultationStatus($miTextEntry)
                : $miSectionSchema->getSchemaSectionDatosExpediente($miTextEntry);

        // Asigno valores al array que contendrá las secciones principales del Infolist
        $arraySectionPrincipal = [
            $this->getSchemaSectionDatosDocumento($miSectionSchema, $miTextEntry)->columnSpan(12)->collapsible(),
            $sectionDatosExpediente->columnSpan(12)->collapsible(), // Sección condicional
            $miSectionSchema->getSchemaSectionDatosOrganoContratacion($miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionEntidad($miTextEntry)->columnSpan(12)->collapsible(),
            $miSectionSchema->getSchemaSectionLogFeedEntry($miTextEntry)->columnSpan(12)->collapsible(),
        ];

        // Sección secundaria (vacía en este caso)
        $arraySectionSecundaria = [];

        // Devuelvo el objeto Infolist con las secciones correspondientes
        return $miSchema->getSchema($schema, $arraySectionPrincipal, $arraySectionSecundaria);
    }

    /**
     * Construye una sección principal reutilizable con un esquema dinámico
     */
    private function getSchemaSectionDatosDocumento(
        MiSectionSchema $miSectionSchema,
        MiTextEntry       $miTextEntry
    ): Section
    {

        $description = MiNavigationItem::PLACSP_DOCUMENTO->getInfolistDescription();
        $icon = 'heroicon-o-information-circle';

        return $miSectionSchema
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                )
            )
            ->schema([
                $miTextEntry->getTextEntry('id_document_reference',3, 'Identificador del documento'),
                $miTextEntry->getBadgeTextEntry('document_reference_type',2, 'Tipo de documento'),
                $miTextEntry->getTextEntry('document_hash',2, 'Hash del docuemnto'),
                $miTextEntry->getTextEntry('filename',4, 'Nombre del fichero'),
                $miTextEntry->getLinkTextEntry('uri',12, 'Url del documento'),
            ]);
    }
}


