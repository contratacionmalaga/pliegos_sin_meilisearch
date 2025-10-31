@component('mail::message')
    # Intento de inicio de sesión fallido

    Hola {{ $user->name }},

    Se ha detectado un intento fallido de inicio de sesión en tu cuenta.

    Si no reconoces este intento, te recomendamos cambiar tu contraseña de inmediato y contactar al administrador enviando un email a la dirección {{ config('mail.from.address') }}

    Gracias,

    El equipo de {{ config('app.name') }}
@endcomponent
