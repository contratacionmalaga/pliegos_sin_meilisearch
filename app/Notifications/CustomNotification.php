<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected array $channels;

    protected string $subject;

    protected string $greeting;

    protected string $message;

    protected ?string $actionText;

    protected ?string $actionUrl;

    protected string $type;

    public function __construct(
        array $channels = ['mail'],
        string $subject = '',
        string $greeting = '',
        string $message = '',
        ?string $actionText = null,
        ?string $actionUrl = null,
        string $type = 'info'
    ) {
        $this->channels = $channels;
        $this->subject = $subject;
        $this->greeting = $greeting;
        $this->message = $message;
        $this->actionText = $actionText;
        $this->actionUrl = $actionUrl;
        $this->type = $type;
    }

    public function via(object $notifiable): array
    {
        return $this->channels;
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject($this->subject)
            ->greeting($this->greeting)
            ->line($this->message);

        if ($this->actionText && $this->actionUrl) {
            $mail->action($this->actionText, $this->actionUrl);
        }

        return $mail->line('Gracias por utilizar nuestro sistema!');
    }

    public function toDatabase(object $notifiable): array
    {
        // Formato para que Filament reconozca y muestre bien la notificación
        return [
            'title' => $this->subject,
            'body' => $this->message,
            'color' => $this->getColorFromType(),
            'icon' => $this->getIconFromType(),
            'actions' => $this->actionText && $this->actionUrl ? [[
                'label' => $this->actionText,
                'url' => $this->actionUrl,
                'color' => $this->getColorFromType(),
            ]] : [],
            'status' => $this->type,
            'duration' => 'persistent',
        ];
    }

    public function toArray(object $notifiable): array
    {
        return $this->toDatabase($notifiable);
    }

    protected function getColorFromType(): string
    {
        return match ($this->type) {
            'info' => 'primary',
            'success' => 'success',
            'warning' => 'warning',
            'danger', 'error' => 'danger',
            default => 'primary',
        };
    }

    protected function getIconFromType(): string
    {
        return match ($this->type) {
            'info' => 'heroicon-o-information-circle',
            'success' => 'heroicon-o-check-circle',
            'warning' => 'heroicon-o-exclamation',
            'danger', 'error' => 'heroicon-o-x-circle',
            default => 'heroicon-o-bell',
        };
    }
}
