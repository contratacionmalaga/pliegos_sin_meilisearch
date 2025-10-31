<?php

namespace App\Repositories;

use App\Models\PersonalActivo;

class PersonalActivoRepository
{

    /**
     * @return array<string, string>
     */
    public function getArrayPersonalActivo(?bool $activo = false): array
    {

        $query = PersonalActivo::query();

        if($activo) {
            $query = $query->whereNull('deleted_at');
        }

        return $query
            ->get()                                     // <-- aquí obtenemos las instancias del modelo (con accessors)
            ->sortBy('nombre_completo')         // ordena por el accessor
            ->pluck('nombre_completo', 'cod_personal')  // usa el accessor aquí
            ->toArray();
    }

    /**
     * @return array<string, string>
     */
    public function getArrayPuestosTrabajo(): array
    {

        return PersonalActivo::query()
            ->select(['puesto', 'puesto'])
            ->distinct('puesto')
            ->orderBy('puesto')
            ->pluck('puesto', 'puesto')
            ->toArray();
    }
}
