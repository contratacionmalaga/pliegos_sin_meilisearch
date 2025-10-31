<?php

namespace App\Filament\Components\Filters\Admin;

use App\Filament\Components\Filters\MiDateRangeFilter;
use Exception;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class ConsultaPreliminarMercadoFilter
{
    /**
     *
     * @return DateRangeFilter
     * @throws Exception
     */
    public function getPlannedDateRangeFilter(): DateRangeFilter
    {

        $params = [
            'make' => 'planned_date',
            'label' => 'Filtrar por fecha de inicio de la consulta',
        ];

        return new MiDateRangeFilter()->getDateRangeConstructor($params);
    }

    /**
     *
     * @return DateRangeFilter
     * @throws Exception
     */
    public function getLimitDateRangeFilter(): DateRangeFilter
    {

        $params = [
            'make' => 'limit_date',
            'label' => 'Filtrar por fecha de final de consulta',
        ];

        return new MiDateRangeFilter()->getDateRangeConstructor($params);
    }
}
