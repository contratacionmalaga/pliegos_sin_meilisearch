<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Obtiene todos los usuarios como array [id => name].
     */
    public function getArrayAllUsuarios(): array
    {
        return $this->getArrayUsuariosByQuery();
    }

    /**
     * Obtiene usuarios de un organismo específico como array [id => name].
     */
    public function getArrayAllUsuariosByOrganismo(string $organismoId): array
    {
        return $this->getArrayUsuariosByQuery($organismoId);
    }

    /**
     * Obtiene solo los usuarios activos como array [id => name].
     */
    public function getArrayAllUsuariosActivos(): array
    {
        return $this->getArrayUsuariosByQuery(activos: true);
    }

    /**
     * Obtiene solo los usuarios con rol de super administrador como array [id => name].
     */
    public function getArrayAllUsuariosAdministradores(): array
    {
        return $this->getArrayUsuariosByQuery(administradores: true);
    }

    /**
     * Obtiene un usuario por su ID.
     */
    public function getUserById(string $userId): ?User
    {
        return User::find($userId);
    }

    /**
     * Obtiene el email de un usuario por su ID.
     */
    public function getEmailById(int $userId): ?string
    {
        return User::whereKey($userId)->value('email');
    }

    /**
     * Construye una consulta filtrada de usuarios y devuelve [id => name].
     *
     * @param string|null $organismoId
     * @param bool $activos
     * @param bool $administradores
     * @return array<string, string>
     */
    private function getArrayUsuariosByQuery(
        ?string $organismoId = null,
        bool $activos = false,
        bool $administradores = false,
    ): array {
        $query = User::query();

        if ($activos) {
            $query->activo(); // Scope
        }

        if ($administradores) {
            $query->superAdmin(); // Scope
        }

        if ($organismoId !== null) {
            $query->where('organismo_id', $organismoId);
        }

        return $query->orderBy('name')->pluck('name', 'id')->toArray();
    }
}
