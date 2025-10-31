<?php

namespace App\Filament\Components\Filters\Admin;

use App\Filament\Components\Filters\MiSelectFilter;
use App\Repositories\EntidadRepository;
use Exception;
use Filament\Tables\Filters\SelectFilter;

class AnuncioFilter
{
    /**
     *
     * @param bool $activo
     *
     * @return SelectFilter
     * @throws Exception
     */
    public function get(bool $activo): SelectFilter
    {

        $params = [
            'make' => 'notice_type_code',
            'label' => 'Filtrar por tipo de anuncio',
        ];

        return new MiSelectFilter()->getSelectFilterBase($params)
            ->options(new EntidadRepository()->getArrayEntidades($activo));
    }
}
