<?php

namespace App\Filament\Components\Actions;

use App\Filament\Components\Actions\Traits\EstablecerRetirarSuperAdminSetup;
use Filament\Actions\Action;

class EstablecerRetirarSuperAdminAction extends Action
{
    use EstablecerRetirarSuperAdminSetup;

    protected function setUp(): void
    {
        parent::setUp();
        $this->configureEstablecerRetirarSuperAdminAction();
    }

    public static function getDefaultName(): ?string
    {
        return 'establecer_retirar_super_admin_action';
    }
}
