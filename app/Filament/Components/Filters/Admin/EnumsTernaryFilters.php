<?php

namespace App\Filament\Components\Filters\Admin;

use App\Enums\Flags\ActivoEnum;
use App\Enums\Flags\ActivoOrganoContratacionEnum;
use App\Enums\Flags\BooleanEnum;
use App\Enums\Flags\MedioPropioEnum;
use App\Enums\Flags\SuperAdminEnum;
use App\Filament\Components\Filters\MiTernaryFilter;
use Exception;
use Filament\Tables\Filters\TernaryFilter;

class EnumsTernaryFilters
{

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return TernaryFilter
     * @throws Exception
     */
    public function getPymeTernaryFilter(): TernaryFilter
    {

        $params = [
            'make' => 'sme_awarded_indicator',
            'label' => 'Filtrar si el adjudicatario es Pyme',
        ];

        return new MiTernaryFilter()->getTernaryFilterConstructor($params, BooleanEnum::class);
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return TernaryFilter
     * @throws Exception
     */
    public function getMedioPropioTernaryFilter(): TernaryFilter
    {

        $params = [
            'make' => 'es_medio_propio',
            'label' => 'Filtrar por medio pripio',
        ];

        return new MiTernaryFilter()->getTernaryFilterConstructor($params, MedioPropioEnum::class);
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return TernaryFilter
     * @throws Exception
     */
    public function getActivoInactivoTernaryFilter(): TernaryFilter
    {

        $params = [
            'make' => 'es_activo',
            'label' => 'Filtrar por estado',
        ];

        return new MiTernaryFilter()->getTernaryFilterConstructor($params, ActivoEnum::class);
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return TernaryFilter
     * @throws Exception
     */
    public function getUsuarioSuperAdminTernaryFilter(): TernaryFilter
    {

        $params = [
            'make' => 'es_super_admin',
            'label' => 'Filtrar por tipo de usuario',
        ];

        return new MiTernaryFilter()->getTernaryFilterConstructor($params, SuperAdminEnum::class);
    }

    /**
     * Filtro para obtener los usuarios según el valor del flag es_activo
     *
     * @return TernaryFilter
     * @throws Exception
     */
    public function getActivoInactivoOrganoContratacionTernaryFilter(): TernaryFilter
    {

        $params = [
            'make' => 'es_activo',
            'label' => 'Filtrar por estado del órgano de contatación',
        ];

        return new MiTernaryFilter()->getTernaryFilterConstructor($params, ActivoOrganoContratacionEnum::class);
    }
}
