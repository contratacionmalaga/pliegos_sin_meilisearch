<?php

namespace App\Filament\Components\Actions\Traits;

use App\Enums\Acciones\MiAccionEnum;

trait EstablecerRetirarDobleFactorSetup
{

    /**
     * @return void
     */
    protected function configureEnableDisableDobleFactorAction(): void
    {

        $this->label(
            function ($record) {
                if($record->esObligatorio2FA()) {
                    return MiAccionEnum::Disable2fa->getLabel();
                }
                return MiAccionEnum::Enable2fa->getLabel();
            });

        $this->modalHeading(
            function ($record) {
                return $record->esObligatorio2FA()
                    ? 'Desactivar el 2FA al usuario '. $record->getTitle()
                    : 'Activar el 2FA al usuario '. $record->getTitle();
            });

        $this->tooltip(
            function($record) {
                if($record->esObligatorio2FA()) {
                    return MiAccionEnum::Disable2fa->getTooltip();
                }
                return MiAccionEnum::Enable2fa->getTooltip();
        });

        $this->color(
            function($record) {
                if($record->esObligatorio2FA()) {
                    return MiAccionEnum::Disable2fa->getColor();
                }

                return MiAccionEnum::Enable2fa->getColor();
            });

        $this->icon(
            function($record) {
                if($record->esObligatorio2FA()) {
                    return MiAccionEnum::Disable2fa->getIcon();
                }
                return MiAccionEnum::Enable2fa->getIcon();
            });

        $this->successNotificationTitle(
            function ($record) {
                return $record->esObligatorio2FA()
                    ? $this->getRecordTitle().' habilitado el doble factor de autenticación correctamente'
                    : $this->getRecordTitle().' deshabilitado el doble factor de autenticación correctamente';
            });

        $this->requiresConfirmation();

        $this->action(
            function ($record) {
                $record->esObligatorio2FA() ? $record->desactivar2FA() : $record->activar2FA();
                $this->success();
            });
    }
}
