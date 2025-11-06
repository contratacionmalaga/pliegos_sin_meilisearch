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

//        // Obtengo si existen registros por si es necesario incluir la sección secundaria
//        $record = $schema->getRecord();
//        $hasRecord = ! is_null($record);
//
//        $seccionesPrincipales = [
//            $miSectionInfolist->getInfolistSectionDatosOrganoContratacionPlacsp($miSection, $miTextEntry),
////            $this->getFormSectionDatosEntidadAsociada($miSection, $miTextEntry, $miSelect),
//            $this->getFormSectionContacto($miSection, $miTextInput),
//            $miSectionForm->getFormSectionLinkPerfilContratante($miSection, $miTextInput),
////            $miSectionForm->getSectionFormObservaciones($miSection, $miRichEditor),
//        ];
//
//        $seccionesSecundarias = $hasRecord
//            ? [
//                $miSectionInfolist->getInfoListSectionFechasRegistro($miSection, $miTextEntry)->columnSpan(2),
//                $miSectionInfolist->getInfoListSectionEstadoRegistro($miSection, $miTextEntry)->columnSpan(2),
//            ]
//            : [];


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
                $miTextInput->getTextInputTitulo('respuesta',true, 3, 'Respuesta'),
//                $miTextInput->getTextInputDescripcion('descripcion',true, 3,'Descripcion'),
//                $miTextInput->getTextInputEstado('estado',true, 3,'Estado'),               // TODO: Select?
//                $miTextInput->getTextInputTitulo('incidenciable_id',true, 3,'incidenciable_id'),
//                $miTextInput->getTextInputTitulo('incidenciable_type',true, 3,'incidenciable_type'),
                $miTextInput->getTextInputTitulo('created_at',true, 3,'created_at'),
                $miTextInput->getTextInputTitulo('updated_at',true, 3,'updated_at'),
                $miTextInput->getTextInputTitulo('deleted_at',true, 3,'deleted_at'),

            ])
            ->columnSpan('full');

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
