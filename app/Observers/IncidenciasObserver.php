<?php

namespace App\Observers;

use App\Models\Incidencia;
use App\Notifications\CustomNotification;

class IncidenciasObserver
{
//    public function creating(Incidencia $incidencia): void
//    {
//        if (empty($incidencia->incidenciable_type) && auth()->check()) {
//            $incidencia->incidenciable_type = auth()->user()->getMorphClass();
//            $incidencia->incidenciable_id = auth()->id();
//        }
//    }

//    public function creating(RegistroContratoEntidad $registroContratoRemesa): void
//    {
//
//        $registroContratoRemesa->setAttribute('es_aprobado', AprobadoEnum::FALSE);
//        ds($registroContratoRemesa);
//    }

//    public function created(RegistroContratoEntidad $registroContratoRemesa): void
//    {
//        $annio = $registroContratoRemesa->getAttribute('annio');
//        $nifEntidad = $registroContratoRemesa->getAttribute('nif_entidad');
//        $entidadRepository = new EntidadRepository;
//        $entidad = $entidadRepository->getByNif($nifEntidad);
//        $nombreEntidad = $entidad?->getAttribute('entidad');
//
//        $user = Auth::user();
//
//        $mensaje = "El usuario {$user->name} ({$user->email}) ha aprobado el envío al Registro de Contratos del año {$annio} para la entidad {$nombreEntidad}.";
//
//        // 💬 Notificar al usuario actual, a los administradores y opcionalmente a un grupo (null en este caso)
//        NotificationHelper::notifyWithAdminsAndOptionalGroup(
//            'Aprobación de remesa - Registro de Contratos',
//            $mensaje,
//            collect([$user]),
//            NotificationTypeEnum::SUCCESS
//        );
//    }

    public function created(Incidencia $incidencia): void
    {
        // Después de crear una incidencia se envía una notificación al mail indicado en la misma
        // con la respuesta asociada

        // mail to ($incidencia->email, 'Nueva Incidencia Creada',
        //     "Se ha creado una nueva incidencia con el título: {$incidencia->titulo}.\n\nDescripción: {$incidencia->descripcion}\n\nEstado: {$incidencia->estado}");

        // Paso 3: Enviar notificación al usuario
        $incidencia->notify(new CustomNotification(
//            channels: ['mail', 'database'],
            channels: ['mail'],
            subject: 'Recupera tu contraseña',
            greeting: 'Hola ',
            message: 'Haz clic para restablecer tu contraseña.',
            actionText: 'Restablecer contraseña',
//            actionUrl: $resetLink,
            type: 'info'
        ));

    }

}
