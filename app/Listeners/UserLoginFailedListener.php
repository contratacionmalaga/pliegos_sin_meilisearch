<?php

namespace App\Listeners;

use App\Enums\ActivityLog\ActivityLogEvent;
use App\Enums\ActivityLog\ActivityLogName;
use App\Models\User;
use App\Services\ClientInfoService;
use App\Services\LoginAlertService;
use Exception;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Hash;

class UserLoginFailedListener
{
    protected ClientInfoService $clientInfoService;
    protected LoginAlertService $loginAlertService; // ✅ Nueva propiedad

    public function __construct(
        ClientInfoService $clientInfoService,
        LoginAlertService $loginAlertService // ✅ Inyectar en el constructor
    ) {
        $this->clientInfoService = $clientInfoService;
        $this->loginAlertService = $loginAlertService; // ✅ Asignar propiedad
    }

    /**
     * Handle the event.
     *
     * @throws Exception
     */
    public function handle(Failed $event): void
    {

        // Obtengo el usuario que ha generado el evento
        $autenticable = $event->user;
        ds($autenticable);

        // Credenciales que fueron enviadas (email, etc.)
        $credentials = $event->credentials;
        ds($credentials);

        // Inicializo $user como null por defecto
        $user = null;

        if ($autenticable) {
            // Solo intento buscar el modelo si $autenticable no es null
            $user = User::query()->find($autenticable->getAuthIdentifier());
            $passwordCorrecta = Hash::check($credentials['password'], $user->password);
            ds('Password correcta:', $passwordCorrecta);
            ds($user);
        }

        // Recopilar información del usuario para generar las properties
        $properties = $this->clientInfoService->getClientInfo();

        // Incluyo las credenciales utilizadas para el intento de inicio de sesión
        $properties = array_merge($properties, $credentials);

        // Reescribo las propiedades con el formato que después voy a recuperar
        $properties = [
            "attributes" => $properties,
            "old" => []
        ];

        ds($properties);

        // Registrar la actividad (solo si el usuario existe, en caso contrario, solo registramos el intento)
        if (! is_null($user)) {
            // Si el usuario fue encontrado, registramos el evento de fallo de contraseña
            activity()
                ->useLog(ActivityLogName::SEGURIDAD->value)
                ->event(ActivityLogEvent::FAILED_LOGIN_PASSWORD->value)
                ->causedBy($autenticable)
                ->withProperties($properties)
                ->performedOn($user)
                ->on($user)
                ->log(ActivityLogEvent::FAILED_LOGIN_PASSWORD->getDescription());

            // ✅ Usar el servicio inyectado para enviar la alerta
            $this->loginAlertService->handle($user, $properties);

        } else {
            // Si no se encontró el usuario, registramos el intento con las credenciales
            activity()
                ->useLog(ActivityLogName::SEGURIDAD->value)
                ->event(ActivityLogEvent::FAILED_LOGIN_USER->value)
                ->withProperties($properties)
                ->log(ActivityLogEvent::FAILED_LOGIN_USER->getDescription());
        }
    }
}
