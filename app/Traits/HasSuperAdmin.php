<?php

namespace App\Traits;

use App\Enums\Flags\SuperAdminEnum;
use Illuminate\Database\Eloquent\Builder;

trait HasSuperAdmin
{
    /**
     * Verifica si el regisro está habilitado.
     */
    public function esSuperAdmin(): bool
    {
        return $this->getAttribute('es_super_admin') === SuperAdminEnum::TRUE;
    }

    /**
     * Establece al regisro como habilitado.
     */
    public function establecerSuperAdmin(): void
    {

        if (! $this->esSuperAdmin()) {
            $this->forceFill(['es_super_admin' => SuperAdminEnum::TRUE])->save();
        }
    }

    /**
     * Establece al regisro como deshabilitado
     */
    public function retirarSuperAdmin(): void
    {

        if ($this->esSuperAdmin()) {
            $this->forceFill(['es_super_admin' => SuperAdminEnum::FALSE])->save();
        }
    }

    /**
     * Scope para obtener únicamente los regisro habilitados
     *
     * @param Builder<static> $query
     * @return Builder<static>
     */
    public function scopeEsSuperAdmin(Builder $query): Builder
    {

        return $query->where('es_super_admin', SuperAdminEnum::TRUE->value);
    }

    /**
     * Scope para obtener únicamente los regisro deshabilitados
     *
     * @param Builder<static> $query
     * @return Builder<static>
     */
    public function scopeNoEsSuperAdmin(Builder $query): Builder
    {

        return $query->where('es_super_admin', SuperAdminEnum::FALSE->value);
    }
}
