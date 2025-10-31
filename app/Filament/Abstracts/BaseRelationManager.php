<?php

namespace App\Filament\Abstracts;

use App\Enums\NavigationMenus\MiRelationManager;
use Exception;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRelationManager extends RelationManager
{
    protected static MiRelationManager $miRelationManager;

    public static function getRelationshipName(): string
    {
        return static::$miRelationManager->getRelationshipName();
    }

    public static function getBadgeColor(Model $ownerRecord, string $pageClass): ?string
    {
        return static::$miRelationManager->getBadgeColor();
    }

    /**
     * @throws Exception
     */
    public static function getIcon(Model $ownerRecord, string $pageClass): ?string
    {
        return static::$miRelationManager->getIcon();
    }

    /**
     * @throws Exception
     */
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return static::$miRelationManager->getLabel();
    }

    public static function getBadgeTooltip(Model $ownerRecord, string $pageClass): string
    {
        return static::$miRelationManager->getBadgeTooltip();
    }

    /**
     * @throws Exception
     */
    public static function getModelLabel(): ?string
    {
        return static::$miRelationManager->getLabel();
    }

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {

        $relacion = static::$miRelationManager->getRelationshipName();

        // Devuelve el número de registros
        return (string) $ownerRecord->$relacion->count(); // Convertir el número a cadena de texto para mostrarlo en el badge
    }

    /**
     * Ensure Filament Tables always receives a string key for each related record.
     * This guards against cases where the model key might be null (e.g., custom primary keys
     * or missing key in selected columns), avoiding type errors in RelationManager internals.
     */
    public function getTableRecordKey(Model|array $record): string
    {
        $key = $record->getKey();

        if ($key !== null) {
            return (string) $key;
        }

        // Fallbacks for common key attributes if Eloquent key is null
        foreach (['id', 'uuid', 'id_entry'] as $attribute) {
            $value = $record->getAttribute($attribute);
            if ($value !== null) {
                return (string) $value;
            }
        }

        // Last resort: serialize a unique signature
        return (string) spl_object_id($record);
    }
}
