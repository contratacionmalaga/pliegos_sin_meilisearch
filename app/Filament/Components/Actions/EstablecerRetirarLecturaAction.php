<?php

namespace App\Filament\Components\Actions;

use App\Filament\Components\Actions\Traits\EstablecerRetirarLecturaSetup;
use Filament\Actions\Action;

class EstablecerRetirarLecturaAction extends Action
{
    use EstablecerRetirarLecturaSetup;

    protected function setUp(): void
    {
        parent::setUp();
        $this->configureEstablecerRetirarLecturaAction();
    }

    public static function getDefaultName(): ?string
    {
        return 'establecer_retirar_lectura_action';
    }
}
