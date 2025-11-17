<?php

namespace App\Filament\Interfaces;

interface IdentificadorIncidenciableInterface
{

    /**
     * Obtener el identificador del modelo
     */
    public function obtenerIdentificadorIncidenciable(): string;

    /**
     * Obtener la descripcion del modelo
     */
    public function obtenerDescripcionIncidenciable(): string;

    /**
     * Obtener el tipo correspondiente al modelo
     */
    public function obtenerTypeIncidenciable(): string;

}
