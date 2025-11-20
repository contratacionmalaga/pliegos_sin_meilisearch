<?php

use App\Models\User;
use App\Notifications\Notificacion;
use Filament\Facades\Filament;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Repositories\ContratoMayorRepository;

/**
 * @return bool
 */
/**
 * @param mixed $value
 *
 * @return string
 * @throws JsonException
 */
function formatValue(mixed $value): string
{
    return match (true) {
        is_bool($value), $value === 1, $value === 0 => $value ? 'Sí' : 'No',
        is_null($value) => 'N/A',
        is_array($value) => json_encode($value, JSON_THROW_ON_ERROR),
        default => (string) $value,
    };
}

/**
 * @return bool
 */
function esSuperAdmin(): bool
{
    $user = auth()->user();
    return $user instanceof User && $user->esSuperAdmin();
}

/**
 * @return bool
 */
function esDiputacion(): bool
{
    $user = auth()->user();
    return $user instanceof User && $user->entidad_nif === 'P2900000G';
}

/**
 * @return array<string>
 */
function getColorByColumnName(string $columnName): array
{
    return match ($columnName) {
        'created_at' => Color::Blue,

        'deleted_at',
        'limit_date'=> Color::Red,

        'updated_at',
        'updated '=> Color::Fuchsia,

        'email_verified_at',
        'planned_date' => Color::Green,

        default => Color::Slate,
    };
}

/**
 * @return Collection [
 * [
 *  "admin" => [
 *      "App\Models\User" => "User",
 *     ],
 *  "otro_panel" => [
 *      "App\Models\Post" => "Post",
 *      "App\Models\Comment" => "Comment",
 *      ],
 * ]
 */
function getModelsByPanel(): Collection
{

    return collect(Filament::getPanels())
        ->mapWithKeys(function($panel) {
            $resources = $panel->getResources();

            $panelModels = collect($resources)
                ->mapWithKeys(function($resource) {
                    $model = $resource::getModel();

                    // nombre amigable: si el modelo tiene un método friendlyName() lo usamos
                    $label = method_exists($model, 'friendlyName')
                        ? $model::friendlyName()
                        : class_basename($model);

                    return [$model => $label];
                });

            return [$panel->getId() => $panelModels];
        });
}

/**
 * @param Schema $schema
 * @return Model|null
 */
function getOwnerRecord(Schema $schema): ?Model
{

    $isRelationManager = $schema->getLivewire() instanceof RelationManager;

    $ownerRecord = null;
    if ($isRelationManager) {
        /** @var RelationManager $livewire */
        $livewire = $schema->getLivewire();
        $ownerRecord = $livewire->getOwnerRecord(); // Este es el modelo padre, e.g., Area
    }

    return $ownerRecord;
}


/**
 * @param User   $notifiable
 * @param array  $canales
 * @param string $subject
 * @param string $contenido
 * @param string $accion
 * @param string $tipo
 *
 * @return void
 */
function enviarNotificacion(
    User $notifiable,
    array $canales,
    string $subject,
    string $contenido,
    string $accion,
    string $tipo): void
{

    $notificacion = new Notificacion($canales, $subject, $contenido, $accion, $tipo);
    $notifiable->notify($notificacion);
}

function ObtenerId(string $id_entry): ?string
{
    return new ContratoMayorRepository()->getContratoMayorIdByIdEntry($id_entry);
}
