<?php

namespace App\Filament\Components\Actions\Traits;

use App\Enums\Acciones\MiAccionEnum;

trait EstablecerRetirarActivoSetup
{

    /**
     * @return void
     */
    protected function configureEnableDisableAction(): void
    {

        $this->label(
            function ($record) {
                if($record->esActivo()) {
                    return MiAccionEnum::Disable->getLabel();
                }
                return MiAccionEnum::Enable->getLabel();
            });

        $this->modalHeading(
            function ($record) {
                return $record->esActivo()
                    ? 'Deshabilitar '. $record->getTitle()
                    : 'Habilitar '. $record->getTitle();
            });

        $this->tooltip(
            function($record) {
                if($record->esActivo()) {
                    return MiAccionEnum::Disable->getTooltip();
                }
                return MiAccionEnum::Enable->getTooltip();
        });

        $this->color(
            function($record) {
                if($record->esActivo()) {
                    return MiAccionEnum::Disable->getColor();
                }

                return MiAccionEnum::Enable->getColor();
            });

        $this->icon(
            function($record) {
                if($record->esActivo()) {
                    return MiAccionEnum::Disable->getIcon();
                }
                return MiAccionEnum::Enable->getIcon();
            });

        $this->successNotificationTitle(
            function ($record) {
                return $record->esActivo()
                    ? $this->getRecordTitle().' habilitado correctamente'
                    : $this->getRecordTitle().' deshabilitado correctamente';
            });

        $this->requiresConfirmation();

        $this->action(
            function ($record) {
                $record->esActivo() ? $record->desactivar() : $record->activar();
                $this->success();
            });
    }
}
