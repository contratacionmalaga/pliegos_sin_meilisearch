<?php

namespace App\Filament\Abstracts\Traits;

use App\Enums\NavigationMenus\MiNavigationItem;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Model $record
 */
trait ComunTrait
{
    protected static MiNavigationItem $miNavigationItem;

    /**
     * Devuelve el Label de MiNavigationItem
     *
     * @return string
     */
    public static function getNavigationLabel(): string
    {
        return static::$miNavigationItem->getLabel();
    }

    /**
     * Devuelve el icono de MiNavigationItem
     *
     * @return string
     */
    public static function getNavigationIcon(): string
    {
        return static::$miNavigationItem->getIcon();
    }

    /**
     * Devuelve el título de MiNavigationItem
     *
     * @return string|Htmlable
     */
    public function getTitle(): string|Htmlable
    {

        return static::$miNavigationItem->getLabel();
    }

    /**
     * Devuelve un string con la redicción
     *
     * @return string
     */
    protected function getRedirectUrl(): string
    {
        // Obtener el nombre de la clase de recurso
        $resourceClass = self::getResource();

        // Creo la instancia
        $newInstance = new $resourceClass;

        // Crear una instancia de la clase de recurso
        return (string) $newInstance->getUrl('view', ['record' => $this->record->getKey()]);
    }

    /**
     * Devuelve un string como recurso
     *
     * @return string
     */
    public static function getResource(): string
    {

        return static::$miNavigationItem->getResource();
    }

    /**
     * Autoriza el Acceso a la página
     */
    protected function authorizeAccess(): void
    {

    }
}
