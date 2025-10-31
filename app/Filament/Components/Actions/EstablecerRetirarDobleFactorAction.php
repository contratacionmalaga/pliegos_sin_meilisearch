<?php

namespace App\Filament\Components\Actions;

use App\Filament\Components\Actions\Traits\EstablecerRetirarActivoSetup;
use App\Filament\Components\Actions\Traits\EstablecerRetirarDobleFactorSetup;
use Filament\Actions\Action;

class EstablecerRetirarDobleFactorAction extends Action
{
    use EstablecerRetirarDobleFactorSetup;

    protected function setUp(): void
    {
        parent::setUp();
        $this->configureEnableDisableDobleFactorAction();
    }

    public static function getDefaultName(): ?string
    {
        return 'enable_disable_2fa_action';
    }
}
