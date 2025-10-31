<?php

namespace App\Filament\Components\Filters\Admin;

use App\Filament\Components\Filters\MiSelectFilter;
use App\Repositories\EntidadRepository;
use Exception;
use Filament\Tables\Filters\SelectFilter;

class EntidadFilter
{
    /**
     *
     * @param string $make
     * @param bool   $activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getEntidadByNifSelectFilter(string $make, bool $activo): SelectFilter
    {

        $params = [
            'make' => $make,
            'label' => 'Filtrar por entidad',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new EntidadRepository()->getArrayEntidades($activo));
    }
}
