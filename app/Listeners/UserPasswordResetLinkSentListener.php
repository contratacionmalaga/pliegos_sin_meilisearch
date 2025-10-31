<?php

namespace App\Listeners;

use App\Enums\ActivityLog\ActivityLogEvent;
use App\Enums\ActivityLog\ActivityLogName;
use App\Services\ClientInfoService;
use Exception;
use Illuminate\Auth\Events\PasswordResetLinkSent;

class UserPasswordResetLinkSentListener
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
    public function handle(PasswordResetLinkSent $event): void
    {

        ds('Evento PasswordResetLinkSent capturado', ['user' => $event->user]);

        /*
            public function __construct(
                public $user,
            ) {
            }
         */
        $user = $event->user;

        $properties = $this->clientInfoService->getClientInfo();

        $properties = [
            "attributes" => $properties,
            "old" => []
        ];

        activity()
            ->useLog(ActivityLogName::SEGURIDAD->value)
            ->event(ActivityLogEvent::PASSWORD_RESET_LINK_SENT->value)
            ->causedBy($user)
            ->withProperties($properties)
            ->log(ActivityLogEvent::PASSWORD_RESET_LINK_SENT->getDescription());
    }
}
