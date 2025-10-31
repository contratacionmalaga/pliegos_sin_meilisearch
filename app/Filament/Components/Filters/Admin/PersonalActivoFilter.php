<?php

namespace App\Filament\Components\Filters\Admin;

use App\Filament\Components\Filters\MiSelectFilter;
use App\Repositories\AreaRepository;
use App\Repositories\DelegacionRepository;
use App\Repositories\EntidadRepository;
use App\Repositories\PersonalActivoRepository;
use App\Repositories\UnidadOrganicaRepository;
use Exception;
use Filament\Tables\Filters\SelectFilter;

class PersonalActivoFilter
{

    /**
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getPuestoTrabajoSelectFilter(): SelectFilter
    {

        $params = [
            'make' => 'puesto',
            'label' => 'Filtrar por el puesto de trabajo',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new PersonalActivoRepository()->getArrayPuestosTrabajo());
    }

    /**
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getUnidadOrganicaSelectFilterByDelegacion(): SelectFilter
    {

        $params = [
            'make' => 'delegacion_id',
            'label' => 'Filtrar por la delegación',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new DelegacionRepository()->getArrayDelegaciones(false));
    }

    /**
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getUnidadOrganicaSelectFilterByArea(): SelectFilter
    {

        $params = [
            'make' => 'id',
            'label' => 'Filtrar por el área',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new AreaRepository()->getArrayAreas(false))
            ->query(function ($query, array $data) {
                return $query->whereHas('delegacion.area', function ($q) use ($data) {
                    if (is_null ($data['value'])) {
                        return $q;
                    }
                    return $q->where('area_id', $data['value']); // Usa el nombre del filtro como clave
                });
            });
    }

    /**
     * @throws Exception
     */
    public function getUnidadOrganicaSelectFilterByEntidad(): SelectFilter
    {

        $params = [
            'make' => 'nif',
            'label' => 'Filtrar por la entidad',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new EntidadRepository()->getArrayEntidades(false))
            ->query(function ($query, array $data) {
                return $query->whereHas('delegacion.area.entidad', function ($q) use ($data) {
                    if (is_null ($data['value'])) {
                        return $q;
                    }
                    return $q->where('nif', $data['value']); // Usa el nombre del filtro como clave
                });
            });
    }
}
