<?php

namespace App\Filament\Resources\Incidencias\Schemas;

use App\DTOs\SectionConfig;
use App\Enums\Incidencias\EstadoIncidenciaEnum;
use App\Filament\Components\Forms\MiRichEditor;
use App\Filament\Components\Forms\MiSelect;
use App\Filament\Components\Forms\MiTextInput;
use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Components\Schemas\MiSchema;
use App\Filament\Components\Schemas\MiSection;
use App\Filament\Components\Schemas\MiSectionForm;
use App\Filament\Components\Schemas\MiSectionInfolist;
use App\Filament\Components\Schemas\MiSectionSchema;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class IncidenciaForm
{
    public function getForm(Schema $schema): Schema
    {

        $miSchema = new MiSchema;
        $miSection = new MiSection;
        $miSectionForm = new MiSectionForm;
        $miSectionInfolist = new MiSectionInfolist;
        $miTextEntry = new MiTextEntry;
        $miTextInput = new MiTextInput;
        $miSelect = new MiSelect;
        $miRichEditor = new MiRichEditor;

        $seccionesPrincipales = [
            $this->getFormSectionGeneral($miSection, $miTextInput,$miTextEntry, $miSelect),
//            $this->getSectionSchemaRespuestasEnviadas($miSectionForm, $miTextEntry)->columnSpan(12)->collapsible(),
        ];

        $seccionesSecundarias = [];

        return $miSchema->getSchema($schema, $seccionesPrincipales, $seccionesSecundarias);
    }

    private function getFormSectionGeneral(
        MiSection $miSection,
        MiTextInput $miTextInput,
        MiTextEntry $miTextEntry,
        MiSelect $miSelect
    ): Section {

        $description = 'Los campos marcados con * son obligatorios';
        $icon = 'heroicon-o-pencil-square';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon))
            ->schema([
                $miTextInput->getTextInputTitulo('titulo',true, 5, 'Titulo'),
                $miTextInput->getTextInputDescripcion('descripcion',true, 5,'Descripcion'),

                $miSelect->getSelectEnum('estado', true, EstadoIncidenciaEnum::class, 4, 'Estado'),
//                    ->disabled(false),
//                $miTextInput->getTextInputEstado('estado',true, 5,'Estado'),               // TODO: Select?

                $miTextInput->getTextInputEmail(true, 5),

            ])
            ->columnSpan('full')
            ;

    }



    private function getSectionSchemaRespuestasEnviadas(
        MiSectionForm $miSectionForm,
        MiTextEntry   $miTextEntry
    ): Section
    {
        $description = 'Respuestas enviadas';
        $icon = 'heroicon-o-chat-bubble-bottom-center-text';

        return $miSectionForm
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                RepeatableEntry::make('respuestas')
                    ->label('Respuestas')
                    ->schema([
                        $miTextEntry->getTextEntry('respuesta', 12, 'Respuesta'),
                        $miTextEntry->getBadgeDateTimeTextEntry('created_at', 6, null, 'Creada'),
                        $miTextEntry->getBadgeDateTimeTextEntry('updated_at', 6, null, 'Actualizada'),
                    ])
                    ->columnSpan(12)
                    ->visible(fn($record) => $record?->respuestas?->isNotEmpty()),
            ]);
    }



}
