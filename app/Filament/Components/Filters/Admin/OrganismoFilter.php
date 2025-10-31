<?php

namespace App\Filament\Components\Filters\Admin;

use App\Filament\Components\Filters\MiSelectFilter;
use App\Repositories\OrganismoRepository;
use Exception;
use Filament\Tables\Filters\SelectFilter;

class OrganismoFilter
{
    /**
     *
     * @param bool $activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getOrganismoSelectFilter(bool $activo): SelectFilter
    {

        $params = [
            'make' => 'organismo_id',
            'label' => 'Filtrar por organismo',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new OrganismoRepository()->getArrayOrganismos($activo));
    }
}
