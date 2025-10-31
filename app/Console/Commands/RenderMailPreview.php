<?php

namespace App\Console\Commands;

use App\Mail\LoginFallido;
use App\Models\User;
use Illuminate\Console\Command;
use ReflectionException;

class RenderMailPreview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-render-mail';


    /**
     * @throws ReflectionException
     */
    public function handle(): void
    {
        $user = User::first();
        $clientInfo = [
            'ip_address' => 'info-ip',
            'browser' => 'info-browser',
            'os' => 'info-os',
            'device' => 'info-device',
            'platform' => 'info-platform',
            'browser_version' => 'info-browser-version',
            ];

        $mail = new LoginFallido($user, $clientInfo);
        file_put_contents(storage_path('app/mail-preview.html'), $mail->render());

        $this->info('Archivo generado en storage/app/mail-preview.html');
    }
}
