<?php

namespace App\Filament\Components\Actions;

use App\Filament\Components\Actions\Traits\EstablecerRetirarActivoSetup;
use App\Models\User;
use Filament\Actions\Action;

class EnlacePlacspAction extends Action
{
    use EstablecerRetirarActivoSetup;

    protected function setUp(): void
    {
        parent::setUp();

        $this->action(
            function (User $record) {
                $record->esActivo() ? $record->desactivar() : $record->activar();
                $this->success();
            });
    }

    public static function getDefaultName(): ?string
    {
        return 'enlace_placsp_action';
    }
}
