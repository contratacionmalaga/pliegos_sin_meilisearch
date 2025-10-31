<?php

namespace App\Repositories;

use App\Models\Organismo;

class OrganismoRepository
{
    /**
     * @param bool $activo
     *
     * @return array<string, string>
     */
    public function getArrayOrganismos(bool $activo): array
    {
        $query = Organismo::query()->select(['id', 'organismo']);

        if ($activo) {
            $query = $query->activo();
        }

        // Obtener las opciones ordenadas por 'area'
        return $query
            ->orderBy('organismo')
            ->pluck('organismo', 'id')
            ->toArray();
    }
}
