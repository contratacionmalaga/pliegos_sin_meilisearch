<?php

namespace App\Filament\Components\Actions\Traits;

use App\Enums\Acciones\MiAccionEnum;

trait EstablecerRetirarSuperAdminSetup
{

    /**
     * @return void
     */
    protected function configureEstablecerRetirarSuperAdminAction(): void
    {

        $this->label(
            function ($record) {
                if($record->esSuperAdmin()) {
                    return MiAccionEnum::RetirarSuperAdmin->getLabel();
                }
                return MiAccionEnum::AsignarSuperAdmin->getLabel();
            });

        $this->modalHeading(
            function ($record) {
                return $record->esSuperAdmin()
                    ? 'Retirar el rol Super Admin al usuario '. $record->getTitle()
                    : 'Establecer el rol Super Admin al usuario '. $record->getTitle();
            });

        $this->tooltip(
            function($record) {
                if($record->esSuperAdmin()) {
                    return MiAccionEnum::RetirarSuperAdmin->getTooltip();
                }
                return MiAccionEnum::AsignarSuperAdmin->getTooltip();
            });

        $this->color(
            function($record) {
                if($record->esSuperAdmin()) {
                    return MiAccionEnum::RetirarSuperAdmin->getColor();
                }

                return MiAccionEnum::AsignarSuperAdmin->getColor();
            });

        $this->icon(
            function($record) {
                if($record->esSuperAdmin()) {
                    return MiAccionEnum::RetirarSuperAdmin->getIcon();
                }
                return MiAccionEnum::AsignarSuperAdmin->getIcon();
            });

        $this->successNotificationTitle(
            function ($record) {
                return $record->esSuperAdmin()
                    ? $this->getRecordTitle().' establecido super admin correctamente'
                    : $this->getRecordTitle().' retirado super admin correctamente';
            });

        $this->requiresConfirmation();

        $this->action(
            function ($record) {
                $record->esSuperAdmin() ? $record->retirarSuperAdmin() : $record->establecerSuperAdmin();
                $this->success();
            });
    }
}
