<?php

namespace App\Filament\Resources\Incidencias\Schemas;

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
            $this->getFormSectionGeneral($miSection, $miTextInput,$miTextEntry),
        ];

        $seccionesSecundarias = [];

        return $miSchema->getSchema($schema, $seccionesPrincipales, $seccionesSecundarias);
    }

    private function getFormSectionGeneral(
        MiSection $miSection,
        MiTextInput $miTextInput,
        MiTextEntry $miTextEntry,
    ): Section {

        $description = 'Los campos marcados con * son obligatorios';
        $icon = 'heroicon-o-pencil-square';

        return $miSection
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon))
            ->schema([
//                $miTextInput->getTextInputEmail(true, 3),
//                $miTextInput->getTextInputDireccion(true, 4),
//                $miTextInput->getTextInputCodigo('codigo_postal', true, 2),
//                $miTextInput->getTextInputTelefono(true, 3),

//                $miTextInput->getTextInputTitulo('id', false,'id'),
                $miTextInput->getTextInputTitulo('titulo',true, 3, 'Titulo'),
                $miTextInput->getTextInputDescripcion('descripcion',true, 3,'Descripcion'),
                $miTextInput->getTextInputEstado('estado',true, 3,'Estado'),               // TODO: Select?
                $miTextInput->getTextInputEmail(true, 3),

//                $miTextInput->getTextInputTitulo('incidenciable_id',true, 3,'incidenciable_id'),
//                $miTextInput->getTextInputTitulo('incidenciable_type',true, 3,'incidenciable_type'),
//                $miTextInput->getTextInputTitulo('created_at',true, 3,'created_at'),
//                $miTextInput->getTextInputTitulo('updated_at',true, 3,'updated_at'),
//                $miTextInput->getTextInputTitulo('deleted_at',true, 3,'deleted_at'),
//                $miTextInput->getTextInputTitulo('created_by',true, 3,'created_by'),
//                $miTextInput->getTextInputTitulo('updated_by',true, 3,'updated_by'),
//                $miTextInput->getTextInputTitulo('deleted_by',true, 3,'deleted_by'),

            ])
            ->columnSpan('full');

/*
            $this->miTextColumn->getSearchableTextColumn('id', 'id'),
            $this->miTextColumn->getSearchableTextColumn('titulo', 'titulo'),
            $this->miTextColumn->getSearchableTextColumn('descripcion', 'descripcion'),
            $this->miTextColumn->getSearchableTextColumn('estado', 'estado'),
            $this->miTextColumn->getSearchableTextColumn('incidenciable_id', 'incidenciable_id'),
            $this->miTextColumn->getSearchableTextColumn('incidenciable_type', 'incidenciable_type'),
            $this->miTextColumn->getBadgeDateTimeSortableTextColumn('created_at', 'created_at'),
            $this->miTextColumn->getBadgeDateTimeSortableTextColumn('updated_at', 'updated_at'),
            $this->miTextColumn->getBadgeDateTimeSortableTextColumn('deleted_at', 'deleted_at'),
            $this->miTextColumn->getSearchableTextColumn('created_by', 'created_by'),
            $this->miTextColumn->getSearchableTextColumn('updated_by', 'updated_by'),
            $this->miTextColumn->getSearchableTextColumn('deleted_by', 'deleted_by'),
*/

    }

//    private function getFormSectionContacto(
//        MiSection $miSection,
//        MiTextInput $miTextInput
//    ): Section {
//
//        $description = 'Los campos marcados con * son obligatorios';
//        $icon = 'heroicon-o-pencil-square';
//
//        return $miSection
//            ->create(
//                new SectionConfig(
//                    description: $description,
//                    icon: $icon))
//            ->schema([
//                $miTextInput->getTextInputEmail(true, 3),
//                $miTextInput->getTextInputDireccion(true, 4),
//                $miTextInput->getTextInputCodigo('codigo_postal', true, 2),
//                $miTextInput->getTextInputTelefono(true, 3),
//            ]);
//    }

    private function getFormSectionDatosEntidadAsociada(
        MiSection $miSection,
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
                $miTextEntry->getTextEntry('estado', 4),
//                $miSelect->getSelectEnum('tipo_organo_contratacion_rc_id', true, RC_TiposDeOrganosContratacion::class, 4)
//                    ->disabled(! esSuperAdmin()),
            ]);
    }

}
