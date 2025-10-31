<?php

namespace App\Enums\NavigationMenus;

use Filament\Navigation\MenuItem;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum MiMenuItem: string implements HasIcon, HasLabel
{
    // name -> value
    case Admin = 'admin';
    case Pulse = 'pulse';
    case Telescope = 'telescope';

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {

            self::Admin => 'Panel de administración',
            self::Pulse => 'Monitorización aplicación',
            self::Telescope => 'Inspección aplicación',
        };
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return match ($this) {

            self::Admin => 'heroicon-o-user-plus',
            self::Pulse => 'heroicon-o-queue-list',
            self::Telescope => 'heroicon-o-chart-bar',
        };
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return match ($this) {

            self::Admin,
            self::Pulse,
            self::Telescope => 'javascript:window.open(\'' . $this->getPath() . '\', \'_blank\');',
        };
    }

    /**
     * @return string
     */
    public function getPath(): string
    {

        return config('routes.' . $this->value);
    }


    /**
     * @return array<string, mixed>
     */
    public static function ordenar(): array
    {

        $opciones = array_map(static fn($case) => $case->value, self::cases());
        return sortEnumByLabel($opciones);
    }

    public static function getMenuItems(MiPanel $miPanel): array
    {
        $arrayMenuItem = [];
        ds('getMenuItems() - Panel -> ' . $miPanel->getPath());
        if (auth()->check()) {
            ds('getMenuItems() - Usuario -> ' . auth()->user()->getAuthIdentifier());
        } else {
            ds('getMenuItems() - Usuario no autenticado.');
        }

        foreach (MiPanel::cases() as $miPanelAux) {
            ds('getMenuItems() - Analizando Panel -> ' . $miPanelAux->getPath());

            if ($miPanel !== $miPanelAux) {
                $arrayMenuItem[] = MenuItem::make()
                    ->label($miPanelAux->getLabel())
                    ->url($miPanelAux->getPath())
                    ->icon($miPanelAux->getIcon())
                    ->visible(fn() => auth()->check() && auth()->user()->esSuperadmin());
            }
        }

        return $arrayMenuItem;
    }
}
