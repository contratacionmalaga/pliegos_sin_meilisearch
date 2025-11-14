<?php

namespace App\Filament\Interfaces;

interface IdentificadorIncidenciableInterface
{

    /**
     * Obtener el valor del campo a mostrar en la columna correspondiente al identificador del modelo Incidenciable
     */
    public function obtenerIdentificadorIncidenciable(): string;

//    /**
//     * Obtener el título del recurso
//     */
//    public function obtenerTitulo(): string;
//
//    /**
//     * Obtener las columnas de la tabla
//     */
//    public function obtenerColumnas(): array;
//
//    /**
//     * Obtener los filtros disponibles
//     */
//    public function obtenerFiltros(): array;


}
