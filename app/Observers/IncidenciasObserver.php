<?php

namespace App\Observers;

use App\Models\Incidencia;

class IncidenciasObserver
{
    public function creating(Incidencia $incidencia): void
    {
        if (empty($incidencia->incidenciable_type) && auth()->check()) {
            $incidencia->incidenciable_type = auth()->user()->getMorphClass();
            $incidencia->incidenciable_id = auth()->id();
        }
    }
}
