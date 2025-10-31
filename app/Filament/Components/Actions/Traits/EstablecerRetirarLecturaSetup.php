<?php

namespace App\Filament\Components\Actions\Traits;

use App\Enums\Acciones\MiAccionEnum;

trait EstablecerRetirarLecturaSetup
{

    /**
     * @return void
     */
    protected function configureEstablecerRetirarLecturaAction(): void
    {

        $this->label(
            function ($record) {
                if($record->esLectura()) {
                    return MiAccionEnum::RetirarLectura->getLabel();
                }
                return MiAccionEnum::AsignarLectura->getLabel();
            });

        $this->modalHeading(
            function ($record) {
                return $record->esLectura()
                    ? 'Permitir escribir al usuario '. $record->getTitle()
                    : 'Restringir a sólo lectura al usuario '. $record->getTitle();
            });

        $this->tooltip(
            function($record) {
                if($record->esLectura()) {
                    return MiAccionEnum::RetirarLectura->getTooltip();
                }
                return MiAccionEnum::AsignarLectura->getTooltip();
            });

        $this->color(
            function($record) {
                if($record->esLectura()) {
                    return MiAccionEnum::RetirarLectura->getColor();
                }

                return MiAccionEnum::AsignarLectura->getColor();
            });

        $this->icon(
            function($record) {
                if($record->esLectura()) {
                    return MiAccionEnum::RetirarLectura->getIcon();
                }
                return MiAccionEnum::AsignarLectura->getIcon();
            });

        $this->successNotificationTitle(
            function ($record) {
                return $record->esLectura()
                    ? $this->getRecordTitle().' establecido con permiso de solo lectura'
                    : $this->getRecordTitle().' establecido con permiso de escritura';
            });

        $this->requiresConfirmation();

        $this->action(
            function ($record) {
                $record->esLectura() ? $record->retirarLectura() : $record->establecerLectura();
                $this->success();
            });
    }
}
