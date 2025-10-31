<?php

namespace App\Filament\Components\Filters\Admin;

use App\Filament\Components\Filters\MiDateRangeFilter;
use Exception;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class OrganoContratacionHistoricoFilter
{
    /**
     * Filtro para obtener los logs según la fecha de Created_At
     *
     * @return DateRangeFilter
     * @throws Exception
     */
    public function getOrganoContratacionHistoricoRangeFilterByCreatedAt(): DateRangeFilter
    {

        $params = [
            'make' => 'created_at',
            'label' => 'Fecha de importación'
        ];

        return new MiDateRangeFilter()->getDateRangeConstructor($params);
    }
}
