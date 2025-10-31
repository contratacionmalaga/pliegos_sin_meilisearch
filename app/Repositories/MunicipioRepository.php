<?php

namespace App\Repositories;

use App\Models\Municipio;

class MunicipioRepository
{

    /**
     * @return array<string, string>
     */
    public function getArrayMunicipios(): array
    {

        $query = Municipio::query()->select(['id', 'municipio']);

        return $query
            ->orderBy('municipio')
            ->pluck('municipio', 'id')
            ->toArray();
    }
}
