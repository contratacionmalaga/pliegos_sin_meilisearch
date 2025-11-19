<?php

namespace App\Filament\Abstracts;

use App\Contracts\MiNavigationItemContract;
use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use Filament\Panel;
use Filament\Resources\Resource;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

abstract class BaseResourceNavigationItem extends Resource
{
    protected static MiNavigationItemContract $miNavigationItem;

    public static function getNavigationSort(): int
    {
        return static::$miNavigationItem->getSort();
    }

    // public static function getNavigationBadgeColor(): string | array | null
    // {
    //     return static::$miNavigationItem->getColor();
    // }

    // public static function getNavigationBadge(): ?string
    // {
    //     // Obtengo el modelo
    //     $modelClass = static::$miNavigationItem->getModel();

    //     // Validación de clase modelo
    //     if (!class_exists($modelClass) || !is_subclass_of($modelClass, Model::class)) {
    //         return '0';
    //     }

    //     // Obtengo la query asociada al modelo
    //     $query = $modelClass::query();

    //     // Cuento la consulta
    //     $n_registros = $query->count();
    //     return number_format($n_registros, 0, ',', '.');
    // }

    public static function getNavigationGroup(): ?string
    {
        return static::$miNavigationItem->getMiNavigationGroup();
    }

    public static function getNavigationIcon(): string|Htmlable|null
    {
        return null;
    }

    public static function getModel(): string
    {
        return static::$miNavigationItem->getModel();
    }

    public static function getNavigationLabel(): string
    {
        return static::$miNavigationItem->getLabel();
    }

    public static function getModelLabel(): string
    {
        return static::$miNavigationItem->getModelLabel();
    }

    public static function getSlug(?Panel $panel = null): string
    {
        return static::$miNavigationItem->getSlug();
    }

    public static function getRecordTitleAttribute(): ?string
    {
        return static::$miNavigationItem->getRecordTitleAttribute();
    }

    public static function canAccess(): bool
    {
        if (!static::$miNavigationItem->getRegisterNavigation()) {
            redirect(route('welcome'));
            return false;
        }

        return true;
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::$miNavigationItem->getRegisterNavigation();
    }
}
