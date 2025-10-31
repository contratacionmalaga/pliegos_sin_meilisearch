<?php

namespace App\Traits;

use App\Enums\Flags\ActivoEnum;
use App\Enums\Flags\DobleFactorEnum;
use Illuminate\Database\Eloquent\Builder;

trait HasDobleFactor
{
    /**
     * Verifica si el regisro está habilitado.
     */
    public function esObligatorio2FA(): bool
    {
        return $this->getAttribute('2fa') === DobleFactorEnum::TRUE;
    }

    /**
     * Establece al regisro como habilitado.
     */
    public function activar2FA(): void
    {

        if (! $this->esObligatorio2FA()) {
            $this->forceFill(['2fa' => DobleFactorEnum::TRUE])->save();
        }
    }

    /**
     * Establece al regisro como deshabilitado
     */
    public function desactivar2FA(): void
    {

        if ($this->esObligatorio2FA()) {
            $this->forceFill(['2fa' => DobleFactorEnum::FALSE])->save();
        }
    }

    /**
     * Scope para obtener únicamente los regisro habilitados
     *
     * @param Builder<static> $query
     * @return Builder<static>
     */
    public function scope2FActivo(Builder $query): Builder
    {

        return $query->where('2fa', DobleFactorEnum::TRUE->value);
    }

    /**
     * Scope para obtener únicamente los regisro deshabilitados
     *
     * @param Builder<static> $query
     * @return Builder<static>
     */
    public function scope2FAInactivo(Builder $query): Builder
    {

        return $query->where('2fa', DobleFactorEnum::FALSE->value);
    }
}
