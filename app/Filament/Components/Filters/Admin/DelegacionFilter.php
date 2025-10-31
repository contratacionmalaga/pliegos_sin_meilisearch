<?php

namespace App\Filament\Components\Filters\Admin;

use App\Filament\Components\Filters\MiSelectFilter;
use App\Repositories\AreaRepository;
use App\Repositories\EntidadRepository;
use Exception;
use Filament\Tables\Filters\SelectFilter;

class DelegacionFilter
{

    /**
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getDelegacionSelectFilterByEntidad(bool $activo): SelectFilter
    {

        $params = [
            'make' => 'nif',
            'label' => 'Filtrar por entidad',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new EntidadRepository()->getArrayEntidades($activo))
            ->query(function ($query, array $data) {
                return $query->whereHas('area.entidad', function ($q) use ($data) {
                    if (is_null ($data['value'])) {
                        return $q;
                    }
                    return $q->where('nif', $data['value']); // Usa el nombre del filtro como clave
                });
            });
    }

    /**
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getDelegacionSelectFilterByArea(bool $activo): SelectFilter
    {

        $params = [
            'make' => 'area_id',
            'label' => 'Filtrar por área',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new AreaRepository()->getArrayAreas($activo));
    }
}
