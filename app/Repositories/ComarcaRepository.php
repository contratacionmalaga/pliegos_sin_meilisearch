<?php

namespace App\Repositories;

use App\Models\Comarca;

class ComarcaRepository
{

    /**
     * @return array<string, string>
     */
    public function getArrayComarcas(?string $provincia = null): array
    {

        $query = Comarca::query()->select(['id', 'comarca']);

        if (!is_null($provincia)) {
            $query->where('provincia', $provincia);
        }

        return $query
            ->orderBy('comarca')
            ->pluck('comarca', 'id')
            ->toArray();
    }
}
