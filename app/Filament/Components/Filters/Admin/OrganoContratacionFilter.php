<?php

namespace App\Filament\Components\Filters\Admin;

use App\Filament\Components\Filters\MiSelectFilter;
use App\Repositories\EntidadRepository;
use App\Repositories\OrganoContratacionRepository;
use Exception;
use Filament\Tables\Filters\SelectFilter;

class OrganoContratacionFilter
{
    /**
     *
     * @param bool $activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getOrganoContratacionSelectFilterByEntidad(bool $activo): SelectFilter
    {

        $params = [
            'make' => 'nif',
            'label' => 'Filtrar por entidad',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new EntidadRepository()->getArrayEntidades($activo))
            ->searchable(true)
            ->preload(true);
    }

    /**
     *
     * @param string $make
     * @param bool   $activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getOrganoContratacionSelectFilter(string $make, bool $activo): SelectFilter
    {

        $params = [
            'make' => $make,
            'label' => 'Filtrar por órgano de contratación',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->searchable(true)
            ->preload()
            ->options(new OrganoContratacionRepository()->getArrayOrganosContratacion($activo));
    }
}
