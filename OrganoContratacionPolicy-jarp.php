<?php

namespace App\Policies;

use App\Models\User;
use App\Repositories\PermisoRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganoContratacionPolicy
{
    use HandlesAuthorization;

    /**
     * Cache interno para los NIFs permitidos del usuario durante esta autorización.
     */
    protected ?array $idsPlataformaPermitidos = null;

    /**
     * Método 'before' que se ejecuta antes de cualquier otra autorización.
     * Permite filtrar rápidamente ciertas acciones con control de permisos.
     */
    public function before(User $user, string $ability, mixed $record = null): ?bool
    {

        // 1. SuperAdminn
        if ($user->esSuperAdmin()) {
            return true;
        }

        // 2. Solo aplicar lógica para ciertas acciones con entidad
        $accionesConPermiso = ['view', 'update'];
        $puedeAplicar = $record !== null && in_array($ability, $accionesConPermiso, true);

        if (! $puedeAplicar) {
            return null;
        }

        // 3. Obtener los IdPlataforma en los que el usuario tiene permiso
        $this->idsPlataformaPermitidos ??= app(PermisoRepository::class)
            ->getArrayIdsPlataformaConPermisoByUser($user);

        // 4. Obtener el IdPlataforma del registro que estoy analizando
        $idPlataformaOrganoContratacion = $record->id_plataforma ?? null;

        // 5. Comprobar si el IdPlataforma del registro se encuentra dentro del array de los que tiene permiso
        return $idPlataformaOrganoContratacion !== null && in_array($idPlataformaOrganoContratacion, $this->idsPlataformaPermitidos, true);
    }

    // Opcionalmente, puedes definir métodos explícitos para otras acciones si quieres
    // por ejemplo:

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Siempre puede ver el listado (la query ya está limitada por permiso)
        return true;
    }

    public function view(User $user, Entidad $entidad): bool
    {
        // Ya manejado por `before()`
        return false;
    }

    public function update(User $user, Entidad $entidad): bool
    {
        // Ya manejado por `before()`
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return esSuperAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Entidad $entidad): bool
    {
        return esSuperAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Entidad $entidad): bool
    {
        return esSuperAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Entidad $entidad): bool
    {
        return esSuperAdmin();
    }
}
