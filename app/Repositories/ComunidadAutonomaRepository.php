<?php

namespace App\Repositories;

use App\Models\ComunidadAutonoma;

class ComunidadAutonomaRepository
{

    /**
     * @return array<string, string>
     */
    public function getArrayComunidadesAutonomas(): array
    {

        $query = ComunidadAutonoma::query()->select(['id', 'comunidad_autonoma']);

        return $query
            ->orderBy('comunidad_autonoma')
            ->pluck('comunidad_autonoma', 'id')
            ->toArray();
    }
}
