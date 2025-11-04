<?php

namespace App\Listeners;

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

    }
}
