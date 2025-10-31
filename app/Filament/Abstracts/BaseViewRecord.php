<?php

namespace App\Filament\Abstracts;

use App\Filament\Abstracts\Traits\ComunTrait;
use App\Filament\Components\Actions\ActionsConstructor;
use Exception;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;

abstract class BaseViewRecord extends ViewRecord
{
    // Incorporo los métodos comunes
    use ComunTrait;

    /**
     * @return array
     * @throws Exception
     */
    protected function getHeaderActions(): array
    {

        $acciones = array_filter(
            static::$miNavigationItem->getViewPageActions(),
            static fn ($action) => $action instanceof Action
        );

        return [
            new ActionsConstructor()->getGoToListAction(static::$miNavigationItem),
            ActionGroup::make($acciones)
                ->button()
                ->color(Color::Green)
                ->label('Acciones disponibles')
            ];
    }
}

