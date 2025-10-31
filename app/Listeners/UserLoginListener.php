<?php

namespace App\Listeners;

use App\Enums\ActivityLog\ActivityLogEvent;
use App\Enums\ActivityLog\ActivityLogName;
use App\Models\User;
use App\Services\ClientInfoService;
use Exception;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserLoginListener
{
    protected ClientInfoService $clientInfoService;

    /**
     * Create the event listener.
     */
    public function __construct(ClientInfoService $clientInfoService)
    {
        $this->clientInfoService = $clientInfoService;
    }

    /**
     * Handle the event.
     *
     * @throws Exception
     */
    public function handle(Login $event): void
    {

        /** @var User $user */
        $user = $event->user;
        ds($user);

        // Recopilar información del cliente
        $properties = [
            'attributes' => $this->clientInfoService->getClientInfo(),
            'old' => [],
        ];
        ds($properties);

        /*
         * Verificar si el usuario se encuentra habilitado
         */
        if (! $user->esActivo()) {
            /*
             * Caso: Usuario NO HABILITADO
             */

            ds('UserLoginListener -> Usuario NO ACTIVO' . $user->getAttribute('name'));

            /*
             * Salgo del sistema
             */
            Auth::logout();

            /*
             * Registro la actividad de LOGIN ERROR debido a USUARIO DESHABILITADO
             */
            activity()
                ->useLog(ActivityLogName::SEGURIDAD->value)
                ->event(ActivityLogEvent::FAILED_LOGIN_USER_NOT_ENABLED->value)
                ->causedBy($user)
                ->withProperties($properties)
                ->log(ActivityLogEvent::FAILED_LOGIN_USER_NOT_ENABLED->getDescription());

            /*
             * Lanzo una excepción si el usuario no está activo
             */
            throw ValidationException::withMessages([
                'data.email' => 'Este usuario está inactivo.',
                //  'data.email' => __('filament-panels::pages/auth/login.messages.failed'),
            ]);

        }

        /*
     * Verificar si el usuario ha verificado su correo electrónico
     */
        if (! $user->hasVerifiedEmail()) {
            /*
             * Caso: Usuario NO VERIFICADO
             */

            ds('UserLoginListener -> Usuario NO VERIFICADO EMAIL' . $user->getAttribute('name'));

            /*
             * Salgo del sistema
             */
            Auth::logout();

            /*
             * Registro la actividad de LOGIN ERROR debido a USUARIO NO VERIFICADO
             */
            activity()
                ->useLog(ActivityLogName::SEGURIDAD->value)
                ->event(ActivityLogEvent::FAILED_LOGIN_USER_EMAIL_NOT_VERIFIED->value)
                ->causedBy($user)
                ->withProperties($properties)
                ->log(ActivityLogEvent::FAILED_LOGIN_USER_EMAIL_NOT_VERIFIED->getDescription());

            /*
             * Lanzo una excepción si el usuario no ha verificado su correo electrónico
             */
            throw ValidationException::withMessages([
                'data.email' => 'El usuario no ha verificado el email.',
                //  'data.email' => __('filament-panels::pages/auth/login.messages.failed'),
            ]);
        }

    /*
     * Usuario HABILITADO y VERIFICADO
     * Registro la actividad como Login Correcto
     */
        ds('UserLoginListener -> Usuario: ' . $user->getAttribute('name') . " - ACTIVO e EMAIL VERIFICADO");
        activity()
            ->useLog(ActivityLogName::SEGURIDAD->value)
            ->event(ActivityLogEvent::LOGIN->value)
            ->causedBy($user)
            ->withProperties($properties)
            ->log(ActivityLogEvent::LOGIN->getDescription());
    }
}
