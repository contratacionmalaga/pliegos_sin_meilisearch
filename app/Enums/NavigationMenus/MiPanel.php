<?php

namespace App\Enums\NavigationMenus;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum MiPanel: string implements HasIcon, HasLabel
{
    // name -> value
//    case DASHBOARD = 'dashboard';
    case ADMIN = 'admin';

    public function getLabel(): string
    {
        return match ($this) {

//            self::DASHBOARD => 'Escritorio de Usuario',
            self::ADMIN => 'Panel de Administracion',
        };
    }

    public function getPath(): string
    {
        return match ($this) {

//            self::DASHBOARD => '/dashboard',
            self::ADMIN => '/admin',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {

//            self::DASHBOARD => 'heroicon-o-user',
            self::ADMIN => 'heroicon-o-shield-check',
        };
    }

    public function getId(): string
    {

        return $this->value;
    }

    /**
     * @return string|array<int,string>
     */
    public function getColor(): string|array
    {
        return match ($this) {
//            self::DASHBOARD => Color::Amber,
            self::ADMIN => Color::Blue,
        };
    }
}
