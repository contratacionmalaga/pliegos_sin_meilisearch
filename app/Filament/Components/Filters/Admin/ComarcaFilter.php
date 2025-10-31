<?php

namespace App\Filament\Components\Filters\Admin;

use App\Filament\Components\Filters\MiSelectFilter;
use App\Repositories\ComarcaRepository;
use App\Repositories\OrganismoRepository;
use Exception;
use Filament\Tables\Filters\SelectFilter;

class ComarcaFilter
{
    /**
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getComarcaoSelectFilter(): SelectFilter
    {

        $params = [
            'make' => 'comarca_id',
            'label' => 'Filtrar por comarca',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new ComarcaRepository()->getArrayComarcas());
    }
}
