<?php

namespace App\Filament\Components\Filters\Admin;

use App\Filament\Components\Filters\MiSelectFilter;
use App\Repositories\OrganismoRepository;
use App\Repositories\ProvinciaRepository;
use Exception;
use Filament\Tables\Filters\SelectFilter;

class ProvinciaFilter
{
    /**
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getProvinciaSelectFilter(): SelectFilter
    {

        $params = [
            'make' => 'provincia_id',
            'label' => 'Filtrar por provincia',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new ProvinciaRepository()->getArrayProvincias());
    }
}
