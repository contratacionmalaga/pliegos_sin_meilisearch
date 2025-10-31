<?php

namespace App\Filament\Components\Filters\Admin;

use App\Enums\ActivityLog\ActivityLogEvent;
use App\Filament\Components\Filters\MiDateRangeFilter;
use App\Filament\Components\Filters\MiSelectFilter;
use App\Repositories\ActivityLogRepository;
use App\Repositories\UserRepository;
use Exception;
use Filament\Tables\Filters\SelectFilter;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class ActivityLogFilter
{


    /**
     * Filtro para obtener los logs según la fecha de Created_At
     *
     * @return DateRangeFilter
     * @throws Exception
     */
    public function getActivitylogDateRangeFilterByCreatedAt(): DateRangeFilter
    {

        $params = [
            'make' => 'created_at',
            'label' => 'Fecha creación'
        ];

        return new MiDateRangeFilter()->getDateRangeConstructor($params);
    }

    /**
     * Filtro para obtener los log según el EVENTO
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getActivitylogSelectFilterByEvento(): SelectFilter
    {

        $params = [
            'make' => 'event',
            'label' => 'Filtrar por tipo de evento',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(ActivityLogEvent::ordenar());
    }

    /**
     * Filtro para obtener los usuarios según la fecha de creación
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getActivitylogSelectFilterByCauserId(): SelectFilter
    {

        $params = [
            'make' => 'causer_id',
            'label' => 'Filtrar por el causante del evento',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new UserRepository()->getArrayAllUsuarios());
    }

    /**
     * Filtro para obtener los usuarios según la fecha de creación
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function getActivityLogSelectFilterBySubjectId(): SelectFilter
    {

        $params = [
            'make' => 'subject_type',
            'label' => 'Filtrar por la clase asociada al destinatario del evento',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new ActivityLogRepository()->getArrayAllModels());
    }
}
