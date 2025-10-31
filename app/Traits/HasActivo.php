<?php

namespace App\Traits;

use App\Enums\Flags\ActivoEnum;
use Illuminate\Database\Eloquent\Builder;

trait HasActivo
{
    /**
     * Verifica si el regisro está habilitado.
     */
    public function esActivo(): bool
    {
        return $this->getAttribute('es_activo') === ActivoEnum::TRUE;
    }

    /**
     * Establece al regisro como habilitado.
     */
    public function activar(): void
    {

        if (! $this->esActivo()) {
            $this->forceFill(['es_activo' => ActivoEnum::TRUE])->save();
        }
    }

    /**
     * Establece al regisro como deshabilitado
     */
    public function desactivar(): void
    {

        if ($this->esActivo()) {
            $this->forceFill(['es_activo' => ActivoEnum::FALSE])->save();
        }
    }

    /**
     * Scope para obtener únicamente los regisro habilitados
     *
     * @param Builder<static> $query
     * @return Builder<static>
     */
    public function scopeActivo(Builder $query): Builder
    {

        return $query->where('es_activo', ActivoEnum::TRUE->value);
    }

    /**
     * Scope para obtener únicamente los regisro deshabilitados
     *
     * @param Builder<static> $query
     * @return Builder<static>
     */
    public function scopeInactivo(Builder $query): Builder
    {

        return $query->where('es_activo', ActivoEnum::FALSE->value);
    }
}
