<?php

namespace App\Filament\Components\Filters\Admin;

use App\Filament\Components\Filters\MiSelectFilter;
use App\Repositories\EntidadRepository;
use Exception;
use Filament\Tables\Filters\SelectFilter;

class AreaFilter
{
    /**
     *
     * @param bool $activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getAreaSelectFilterByEntidad(bool $activo): SelectFilter
    {

        $params = [
            'make' => 'entidad_nif',
            'label' => 'Filtrar por entidad',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new EntidadRepository()->getArrayEntidades($activo));
    }
}
