<?php

namespace App\Repositories;

use App\Enums\Flags\ActivoOrganoContratacionEnum;
use App\Models\OrganoContratacion;

class OrganoContratacionRepository
{
    /**
     * @param bool        $activo
     * @param string|null $nif
     *
     * @return array<string, string>
     */
    public function getArrayOrganosContratacion(bool $activo, ?string $nif = null): array
    {
        $query = OrganoContratacion::query()
            ->selectRaw('id_plataforma, LEFT(organo_contratacion, 100) as organo_contratacion'); // Truncar a 100 caracteres

        if ($activo) {
            $query = $query->where('es_activo', ActivoOrganoContratacionEnum::TRUE->value);
        }

        if (!is_null($nif)) {
            $query = $query->where('nif', $nif);
        }

        // Obtener las opciones ordenadas por 'organo_contratacion'
        return $query
            ->orderBy('organo_contratacion')
            ->pluck('organo_contratacion', 'id_plataforma')
            ->toArray();
    }
}
