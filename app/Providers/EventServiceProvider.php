<?php

namespace App\Providers;

use App\Listeners\UserPasswordResetLinkSentListener;
use Illuminate\Auth\Events\PasswordResetLinkSent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

// Eventos de autenticación

// Listeners personalizados

/*
 * ORDEN CRONOLÓGICO DE LOS EVENTOS:
 *
    Registro:
     -> Registered -> Verified
    Login:
      -> Attempting -> Validated -> Authenticated -> (Login | Failed | Lockout)
    Logout:
      -> Logout | CurrentDeviceLogout | OtherDeviceLogout
    Password Reset:
      -> PasswordResetLinkSent -> PasswordReset
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        PasswordResetLinkSent::class => [
            UserPasswordResetLinkSentListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
