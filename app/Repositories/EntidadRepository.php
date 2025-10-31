<?php

namespace App\Repositories;

use App\Models\Entidad;

class EntidadRepository
{
    /**
     * @return array<string, string>
     */
    public function getArrayEntidades(bool $activo, ?string $nif = null): array
    {
        $query = Entidad::query()->select(['nif', 'entidad']);

        if ($activo) {
            $query = $query->activo();
        }

        if (!is_null($nif)) {
            $query = $query->where('nif', '=', $nif);
        }

        // Obtener las opciones ordenadas por 'area'
        return $query
            ->orderBy('entidad')
            ->pluck('entidad', 'nif')
            ->toArray();
    }

    /**
     * @return array<string, string>
     */
    public function getArrayEntidadesById(bool $activo): array
    {
        $query = Entidad::query()->select(['id', 'entidad']);

        if ($activo) {
            $query = $query->activo();
        }

        // Obtener las opciones ordenadas por 'area'
        return $query
            ->orderBy('entidad')
            ->pluck('entidad', 'id')
            ->toArray();
    }
}
