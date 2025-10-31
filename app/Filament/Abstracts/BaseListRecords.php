<?php

namespace App\Filament\Abstracts;

use App\Filament\Abstracts\Traits\ComunTrait;
use Exception;
use Filament\Actions\ActionGroup;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Colors\Color;

abstract class BaseListRecords extends ListRecords
{
    // Incorporo los métodos comunes
    use ComunTrait;

    /**
     * @return array
     * @throws Exception
     */
    protected function getActions(): array
    {
        $acciones = static::$miNavigationItem->getListPageActions();

        return [
            ActionGroup::make($acciones)
                ->button()
                ->color(Color::Green)
                ->label('Acciones disponibles')
        ];
    }
}
