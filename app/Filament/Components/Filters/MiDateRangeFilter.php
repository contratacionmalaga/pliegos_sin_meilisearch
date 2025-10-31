<?php

namespace App\Filament\Components\Filters;

use App\Repositories\EntidadRepository;
use Exception;
use Filament\Tables\Filters\SelectFilter;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

class MiDateRangeFilter
{
    /**
     * @param array{
     *       make: string,
     *       label: string
     *  } $params
     *
     * @throws Exception
     */
    public function getDateRangeConstructor(array $params): DateRangeFilter
    {

        return DateRangeFilter::make($params['make'])
            ->disableClear()
            ->alwaysShowCalendar()
            ->label($params['label'])
            ->columnSpan(1)
            ->placeholder('Pulse y después en Aplicar'); //TODO: Etiqueta del placeholder
    }

    /**
     * Filtro para obtener los registros por fecha
     *
     * @return DateRangeFilter
     * @throws Exception
     */
    public function getDateRangeFilterByUpdaded(): DateRangeFilter
    {

        $params = [
            'make' => 'updated',
            'label' => 'Filtrar por fecha última actualización en PLACSP',
        ];

        return $this->getDateRangeConstructor($params);
    }

    /**
     * Filtro para obtener los registros por fecha
     *
     * @return DateRangeFilter
     * @throws Exception
     */
    public function getDateRangeFilterByIssueDate(): DateRangeFilter
    {

        $params = [
            'make' => 'issue_date',
            'label' => 'Filtrar por fecha de publicación del anuncio',
        ];

        return $this->getDateRangeConstructor($params);
    }
}
