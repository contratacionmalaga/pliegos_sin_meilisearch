<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MunicipioPolicy
{
    use HandlesAuthorization;

    /**
     * Método 'before' que se ejecuta antes de cualquier otra autorización.
     * Permite filtrar rápidamente ciertas acciones con control de permisos.
     */
    public function before(User $user, string $ability, mixed $record = null): ?bool
    {
        // 1. SuperAdmin
        if ($user->esSuperAdmin()) {
            return true;
        }

        // Si devuelvo null el permiso se reduce a la acción
        return false;
    }
}
