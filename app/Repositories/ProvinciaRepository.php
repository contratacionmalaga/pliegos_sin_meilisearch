<?php

namespace App\Repositories;

use App\Models\Provincia;

class ProvinciaRepository
{

    /**
     * @return array<string, string>
     */
    public function getArrayProvincias(?string $comunidad_autonoma = null): array
    {

        $query = Provincia::query()->select(['id', 'provincia']);

        if (!is_null($comunidad_autonoma)) {
            $query = $query->where('comunidad_autonoma_id', $comunidad_autonoma);
        }

        return $query
            ->orderBy('provincia')
            ->pluck('provincia', 'id')
            ->toArray();
    }
}
