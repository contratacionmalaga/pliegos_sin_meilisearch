<?php

namespace App\Traits;

trait HasRecordTittle
{
    /**
     * Verifica si el regisro está habilitado.
     */
    public function getRecordTittle(): string
    {
        return $this->getAttribute('es_activo');
    }
}
