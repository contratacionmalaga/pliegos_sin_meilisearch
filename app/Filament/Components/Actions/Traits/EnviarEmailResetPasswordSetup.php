<?php

namespace App\Filament\Components\Actions\Traits;

use App\Models\User;

trait EnviarEmailResetPasswordSetup
{

    /**
     * @return void
     */
    protected function configureEmailResetPassword(): void
    {
        $this->modalHeading(
            function ($record) {
                return 'Enviar email de restablecimiento de contraseña al usuario ' . $record->name;
            });

        $this->successNotificationTitle(
            function ($record) {
                return 'Enviar email de restablecimiento de contraseña al usuario ' . $record->name;
            });

        $this->requiresConfirmation();

        $this->action(
            function (User $record) {
                $record->sendPasswordResetNotification($record->remember_token);
                $this->success();
            });
    }
}
