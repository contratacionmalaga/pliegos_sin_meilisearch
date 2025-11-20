<?php

namespace App\Repositories;

use App\Models\PLACSP\ContratoMayor;
use App\Models\User;

class ContratoMayorRepository
{

    /**
     * Obtiene el ID de un Contrato a partir de su id_entry.
     */
    public function getContratoMayorIdByIdEntry(string $id_entry): ?string
    {
        return ContratoMayor::where('id_entry', $id_entry)->value('id');
    }

}
