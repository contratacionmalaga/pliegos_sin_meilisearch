<?php

namespace App\Repositories;

use App\Models\Area;

class AreaRepository
{

    /**
     * @return array<string, string>
     */
    public function getArrayAreas(bool $activo): array
    {

        $query = Area::query()->select(['area_id', 'area']);

        if ($activo) {
            $query = $query->activo();      // scopeActivo del trait
        }

        return $query
            ->orderBy('area')
            ->pluck('area', 'area_id')
            ->toArray();
    }
}
