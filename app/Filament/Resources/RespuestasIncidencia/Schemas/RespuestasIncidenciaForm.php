<?php

namespace App\Filament\Resources\RespuestasIncidencia\Schemas;

use App\DTOs\SectionConfig;
use App\Filament\Components\Forms\MiRichEditor;
use App\Filament\Components\Forms\MiSelect;
use App\Filament\Components\Forms\MiTextInput;
use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Components\Schemas\MiSchema;
use App\Filament\Components\Schemas\MiSection;
use App\Filament\Components\Schemas\MiSectionForm;
use App\Filament\Components\Schemas\MiSectionInfolist;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RespuestasIncidenciaForm
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
            $this->getFormSectionGeneral($miSection, $miTextInput,$miTextEntry, $miRichEditor),
        ];

        $seccionesSecundarias = [];

        return $miSchema->getSchema($schema, $seccionesPrincipales, $seccionesSecundarias);
    }

    private function getFormSectionGeneral(
        MiSection $miSection,
        MiTextInput $miTextInput,
        MiTextEntry $miTextEntry,
        MiRichEditor $miRichEditor
    ): Section {

        $description = 'Los campos marcados con * son obligatorios';
        $icon = 'heroicon-o-pencil-square';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon))
            ->schema([
                $miRichEditor->getRichEditorRespuesta(3, 'Respuesta'),
            ])
            ->columnSpan('full');

    }

}
