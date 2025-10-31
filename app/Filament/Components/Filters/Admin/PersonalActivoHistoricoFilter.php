<?php

namespace App\Filament\Components\Filters\Admin;

use App\Filament\Components\Filters\MiDateRangeFilter;
use Exception;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class PersonalActivoHistoricoFilter
{
    /**
     * Filtro para obtener los logs según la fecha de Created_At
     *
     * @return DateRangeFilter
     * @throws Exception
     */
    public function getPersonalActivoHistoricoRangeFilterByCreatedAt(): DateRangeFilter
    {

        $params = [
            'make' => 'created_at',
            'label' => 'Fecha de importación'
        ];

        return new MiDateRangeFilter()->getDateRangeConstructor($params);
    }
}
