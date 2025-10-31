<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginFallido extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public array $clientInfo;

    /**
     * Create a new message instance.
     *
     * @param $user       User
     * @param $clientInfo array<string, string|null>
     */
    public function __construct(User $user, array $clientInfo)
    {
        $this->user = $user;
        $this->clientInfo = $clientInfo;
    }

    public function build(): LoginFallido
    {
        return $this->subject('Intento de inicio de sesión fallido')
            ->markdown('emails.login-fallido');
    }
}
