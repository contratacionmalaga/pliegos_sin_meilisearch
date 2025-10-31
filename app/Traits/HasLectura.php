<?php

namespace App\Traits;

use App\Enums\Flags\LecturaEnum;
use Illuminate\Database\Eloquent\Builder;

trait HasLectura
{
    /**
     * Verifica si el regisro está habilitado.
     */
    public function esLectura(): bool
    {
        return $this->getAttribute('es_lectura') === LecturaEnum::TRUE;
    }

    /**
     * Establece al regisro como habilitado.
     */
    public function establecerLectura(): void
    {

        if (! $this->esLectura()) {
            $this->forceFill(['es_lectura' => LecturaEnum::TRUE])->save();
        }
    }

    /**
     * Establece al regisro como deshabilitado
     */
    public function retirarLectura(): void
    {

        if ($this->esLectura()) {
            $this->forceFill(['es_lectura' => LecturaEnum::FALSE])->save();
        }
    }

    /**
     * Scope para obtener únicamente los regisro habilitados
     *
     * @param Builder<static> $query
     * @return Builder<static>
     */
    public function scopeEsLectura(Builder $query): Builder
    {

        return $query->where('es_lectura', LecturaEnum::TRUE->value);
    }

    /**
     * Scope para obtener únicamente los regisro deshabilitados
     *
     * @param Builder<static> $query
     * @return Builder<static>
     */
    public function scopeNoEsLectura(Builder $query): Builder
    {

        return $query->where('es_lectura', LecturaEnum::FALSE->value);
    }
}
