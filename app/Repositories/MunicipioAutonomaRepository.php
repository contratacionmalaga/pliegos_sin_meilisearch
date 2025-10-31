<?php

namespace App\Repositories;

use App\Models\ComunidadAutonoma;

class MunicipioAutonomaRepository
{

    /**
     * @return array<string, string>
     */
    public function getArrayComunidadAutonoma(): array
    {

        $query = ComunidadAutonoma::query()->select(['id', 'municipio']);

        return $query
            ->orderBy('municipio')
            ->pluck('municipio', 'id')
            ->toArray();
    }
}
