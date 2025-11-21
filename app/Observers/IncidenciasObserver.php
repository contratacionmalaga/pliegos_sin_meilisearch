<?php

namespace App\Observers;

use App\Models\Incidencia;
use App\Notifications\CustomNotification;

use Illuminate\Support\Facades\Notification;

class IncidenciasObserver
{

    public function created(Incidencia $incidencia): void
    {

        // 1. Después de crear una incidencia se envía una notificación al mail indicado
        //    en el campo email de la misma

        // OPCIÓN 1: Usando Notification::sendNow()
//         $destinatarios = [$incidencia];
////         Notification::sendNow($destinatarios, new CustomNotification(  // Sin colas, se envia inmediatamente
//         Notification::send($destinatarios, new CustomNotification(   // Usando colas
//                                                     // channels: ['mail', 'database'],
//                                                     channels: ['mail'],
//                                                     subject: 'Nueva Incidencia',
//                                                     greeting: 'Hola ',
//                                                     message: 'Se ha creado una nueva incidencia.',
//                                                     actionText: 'Restablecer contraseña',
//                                                     // actionUrl: $resetLink,
//                                                     type: 'info'));


//        // OPCIÓN 2: Usando el metodo notify() sobre el modelo Incidencia
        $incidencia->notify(new CustomNotification(           // Usando colas
//        $incidencia->notifyNow(new CustomNotification(      // Sin colas, se envia inmediatamente
                                  channels: ['mail', 'database'],
                                  // channels: ['mail'],
                                  subject: 'Notificación creación incidencia.',
                                  greeting: 'Hola.',
                                  message: 'Se ha creado la incidencia con id \''. $incidencia->id . '\'.',
                                  actionText: 'Pulse en el siguiente link para acceder a la misma.',
                                  actionUrl: route('filament.admin.resources.incidencias.view', ['record' => $incidencia->id]),
                                  type: 'info'),
//                              ['mail', 'database']
                              );

        // 2. Se notifica también a nuestra direccion de correos de incidencias en contratacion (.env)
        //    No se puede usar canal 'database' aquí porque AnonymousNotifiable no tiene tabla de notificaciones
        //    Para forzar canales, usar notifyNow($notification, ['mail'])
        Notification::route('mail', config('MAIL_USERNAME','incidenciascontratacion@malaga.es'))
//                    ->route('mail', 'jamores@malaga.es')
            ->notify(new CustomNotification(
                channels: ['mail', 'database'],
                subject: 'Notificación creación incidencia.',
                greeting: 'Hola.',
                message: "Se ha creado la incidencia con id '{$incidencia->id}'.",
//                actionText: 'Pulse en el link para ver la incidencia.',
//                actionUrl: route('filament.admin.resources.incidencias.view', ['record' => $incidencia->id]),
                type: 'info',
            ));

//        // Alternativa con lista dinámica
//        $emails = ['incidenciascontratacion@malaga.es', 'jamores@malaga.es'];
//
//        $notifiables = collect($emails)->map(
//            fn ($email) => (new AnonymousNotifiable())->route('mail', $email)
//        );
//
//        Notification::sendNow($notifiables, new CustomNotification(
//            channels: ['mail'],
//            subject: 'Notificación creación incidencia.',
//            greeting: 'Hola.',
//            message: "Se ha creado la incidencia con id '{$incidencia->id}'.",
//            type: 'info',
//        ));

//        $incidencia->notify(new CustomNotification(
//            channels: ['mail', 'database'],
//            // channels: ['mail'],
//            subject: 'Notificación creación incidencia.',
//            greeting: 'Hola.',
//            message: 'Se ha creado la incidencia con id \''. $incidencia->id . '\'.',
//            actionText: 'Pulse en el link para ver la incidencia.',
//            actionUrl: route('filament.admin.resources.incidencias.view', ['record' => $incidencia->id]),
//            type: 'info'),
//        );

    }

}
