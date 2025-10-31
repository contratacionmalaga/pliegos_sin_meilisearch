<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notificacion extends Notification implements ShouldQueue
{
    use Queueable;

    protected array $canales;
    protected string $subject;
    protected string $contenido;
    protected string $accion;
    protected string $tipo;
    /**
     * Create a new notification instance.
     */
    public function __construct($canales, $subject, $contenido, $action, $tipo)
    {
        $this->canales = $canales;
        $this->subject = $subject;
        $this->contenido = $contenido;
        $this->accion = $action;
        $this->tipo = $tipo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return $this->canales;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->subject)
            ->line($this->contenido)
            ->action('Notification Action', $this->accion)
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable): array
    {
        return [
            'contenido' => $this->contenido,
            'tipo' => $this->tipo
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
