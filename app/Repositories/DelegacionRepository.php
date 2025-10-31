<?php

namespace App\Repositories;

use App\Models\Delegacion;

class DelegacionRepository
{

    /**
     * @return array<string, string>
     */
    public function getArrayDelegaciones(bool $activo): array
    {

        $query = Delegacion::query()->select(['delegacion_id', 'delegacion']);

        if ($activo) {
            $query = $query->activo();      // scopeActivo del trait
        }

        return $query
            ->orderBy('delegacion')
            ->pluck('delegacion', 'delegacion_id')
            ->toArray();
    }
}
