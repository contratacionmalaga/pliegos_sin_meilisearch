<?php

namespace App\Filament\Components\Actions;

use App\Filament\Components\Actions\Traits\EstablecerRetirarActivoSetup;
use Filament\Actions\Action;

class EstablecerRetirarActivoAction extends Action
{
    use EstablecerRetirarActivoSetup;

    protected function setUp(): void
    {
        parent::setUp();
        $this->configureEnableDisableAction();
    }

    public static function getDefaultName(): ?string
    {
        return 'enable_disable_action';
    }
}
