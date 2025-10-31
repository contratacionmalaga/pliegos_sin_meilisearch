<?php

namespace App\Services;

use Jenssegers\Agent\Agent;

class ClientInfoService
{
    /*
     * array{
         *     ip_address: string,
         *     browser: string,
         *     os: string,
         *     device: string,
         *     platform: string,
         *     browser_version: string,
         * }
     */
    /**
     * @return array<string, string|null>
     */
    public function getClientInfo(): array
    {
        // Crear una instancia de Agent
        $agent = new Agent;

        // Obtener la dirección IP del cliente
        $ipAddress = request()->ip();

        // Información del agente de usuario
        $browser = $agent->browser();                   // Navegador
        $os = $agent->platform();                       // Sistema operativo
        $device = $agent->device();                     // Tipo de dispositivo
        $platform = $agent->platform();                 // Tipo de plataforma
        $browserVersion = $agent->version($browser);    // Versión del navegador

        return [
            'ip_address' => $ipAddress,
            'browser' => $browser,
            'os' => $os,
            'device' => $device,
            'platform' => $platform,
            'browser_version' => $browserVersion,
        ];
    }
}
