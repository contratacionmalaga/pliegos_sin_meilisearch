<?php

namespace App\Filament\Components\Schemas;

use App\DTOs\SectionConfig;
use App\Enums\Constantes\ConstantesInt;
use App\Filament\Components\Forms\MiRichEditor;
use App\Filament\Components\Forms\MiTextInput;
use App\Filament\Components\Forms\MiToogle;
use Filament\Schemas\Components\Section;

class MiSectionForm
{
    /**
     * @param MiSection   $miSection
     * @param MiTextInput $miTextInput
     *
     * @return Section
     */
    public function getFormSectionContacto(MiSection $miSection, MiTextInput $miTextInput): Section
    {

        $description = 'Datos de contacto';
        $icon = 'heroicon-o-map-pin';

        return $miSection->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextInput->getTextInputEmail('email', 2),
                $miTextInput->getTextInputDireccion('direccion', 3),
                $miTextInput->getTextInputCodigoPostal('codigo_postal', 1),
                $miTextInput->getTextInputTelefono('telefono', 3),
            ]);
    }

    /**
     * @param MiSection   $miSection
     * @param MiTextInput $miTextInput
     *
     * @return Section
     */
    public function getFormSectionLinkPerfilContratante(MiSection $miSection, MiTextInput $miTextInput): Section
    {

        $description = 'Link al perfil de contratante alojado en la Plataforma de Contratación del Sector Público';
        $icon = 'heroicon-o-cursor-arrow-ripple';

        return $miSection->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon
                ))
            ->schema([
                $miTextInput->getTextInputLink('link', false, 7)]);
    }

    /**
     * @param MiSection $miSection
     * @param MiToogle  $miToogle
     *
     * @return Section
     */
    public function getFormSectionFlags(MiSection $miSection, MiToogle $miToogle): Section
    {

        $description = 'Estado del registro';
        $icon = 'heroicon-o-flag';
        $columnSpan = ConstantesInt::TAMANO_2->value;

        return $miSection->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                    columnSpan: $columnSpan,
                ))
            ->schema([
                $miToogle->getToggle('es_activo', true,  ConstantesInt::TAMANO_2->value)
                    ->helperText('Indica si el registro se encuentra disponible para su gestión')]);
    }

    /**
     * @param MiSection    $miSection
     * @param MiRichEditor $miRichEditor
     *
     * @return Section
     */
    public function getFormSectionObservaciones(MiSection $miSection, MiRichEditor $miRichEditor): Section
    {

        $description = 'Información adicional';
        $icon = 'heroicon-o-numbered-list';

        return $miSection->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miRichEditor->getRichEditorWithoutLabel(ConstantesInt::TAMANO_10->value)]);
    }
}
