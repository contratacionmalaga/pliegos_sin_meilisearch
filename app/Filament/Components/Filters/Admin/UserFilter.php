<?php

namespace App\Filament\Components\Filters\Admin;

use App\Filament\Components\Filters\MiDateRangeFilter;
use App\Filament\Components\Filters\MiSelectFilter;
use App\Repositories\EntidadRepository;
use Exception;
use Filament\Tables\Filters\SelectFilter;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class UserFilter
{

    /**
     * Filtro para obtener los usuarios asociados a un organismo
     *
     * @param bool $activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getUserSelectFilterByEntidad(bool $activo): SelectFilter
    {

        $params = [
            'make' => 'entidad_id',
            'label' => 'Filtrar por entidad',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new EntidadRepository()->getArrayEntidadesById($activo));
    }

    /**
     * Filtro para obtener los usuarios según la fecha de creación
     *
     * @return DateRangeFilter
     * @throws Exception
     */
    public function getUserDateRangeFilterByDateCreatedAt(): DateRangeFilter
    {

        $params = [
            'make' => 'created_at',
            'label' => 'Filtrar por fecha de creación',
        ];

        return new MiDateRangeFilter()->getDateRangeConstructor($params);
    }

    /**
     * Filtro para obtener los usuarios según la fecha de Verificación del Email
     *
     * @return DateRangeFilter
     * @throws Exception
     */
    public function getUserDateRangeByEmailVerifiedAt(): DateRangeFilter
    {

        $params = [
            'make' => 'email_verified_at',
            'label' => 'Filtrar por fecha de verificación del email',
        ];

        return new MiDateRangeFilter()->getDateRangeConstructor($params);
    }

    /**
     * Filtro para obtener los usuarios según la fecha de creación
     *
     * @return DateRangeFilter
     * @throws Exception
     */
    public function getUserDateRangeFilterByDateUpdatedAt(): DateRangeFilter
    {

        $params = [
            'make' => 'updated_at',
            'label' => 'Filtrar por fecha de modificación',
        ];

        return new MiDateRangeFilter()->getDateRangeConstructor($params);
    }

    /**
     * Filtro para obtener los usuarios según la fecha de creación
     *
     * @return DateRangeFilter
     * @throws Exception
     */
    public function getUserDateRangeFilterByDateDeletedAt(): DateRangeFilter
    {

        $params = [
            'make' => 'deleted_at',
            'label' => 'Filtrar por fecha de borrado',
        ];

        return new MiDateRangeFilter()->getDateRangeConstructor($params);
    }

}
