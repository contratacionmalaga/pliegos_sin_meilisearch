<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard;
use Illuminate\Contracts\Support\Htmlable;

class MiDashboard extends Dashboard
{
    public function getTitle(): string|Htmlable
    {
        return 'Expedientes tramitados en la Plataforma de Contratación del Sector Público desde el 1 de enero de 2025';
    }

    public function getColumns(): int|array
    {
        // 4 widgets por fila en pantallas XL (12 columnas totales), 2 en MD
        return [
            'md' => 2,
            'lg' => 12,
            'xl' => 12,
        ];
    }

}
