<?php

namespace App\Enums\NavigationMenus;

use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Navigation\NavigationGroup;

enum MiNavigationGroup: string implements HasLabel, HasIcon
{
    case EXPEDIENTES_CONTRATACION = 'expedientes-contratacion';
    case PLACSP = 'placsp';

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return match ($this) {

            self::EXPEDIENTES_CONTRATACION => 'Expedientes contratación',
            self::PLACSP => 'PLACSP',
         };
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {

        return match ($this) {

            default => 'heroicon-o-no-symbol'
        };

    }

    /**
     * @return int
     */
    public function getSort(): int
    {
        return match ($this) {

           self::EXPEDIENTES_CONTRATACION => 5,
            self::PLACSP => 6,
        };
    }

    /**
     * @return array
     */
    public static function getNavigationGroups(): array
    {

        return collect(self::cases())
            ->sortBy(fn ($group) => $group->getSort())
            ->map(fn ($group) => NavigationGroup::make()
                ->label($group->getLabel()))
            ->values()
            ->toArray();

    }
}
