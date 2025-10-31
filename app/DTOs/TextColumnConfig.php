<?php

namespace App\DTOs;

/**
 * Configuración para una columna de texto en tablas de Filament.
 */
class TextColumnConfig
{
    /**
     * @param string $make Campo del modelo a mostrar.
     * @param string|null $label Etiqueta a mostrar (si no se pasa, se infiere automáticamente).
     * @param bool $placeholder Establece un valor por defecto.
     * @param bool $badge Mostrar como badge.
     * @param bool $money Formatear como moneda.
     * @param bool $searchable Permite buscar por esta columna.
     * @param bool $sortable Permite ordenar por esta columna.
     * @param bool $toggleable Ocultable desde la tabla.
     * @param bool $multilinea Permite mostrar contenido multilínea.
     * @param bool $date Formato de fecha corta (sin hora).
     * @param bool $datetime Formato de fecha y hora corta.
     * @param bool $html Elimina etiquetas HTML al mostrar.
     * @param bool $copyable Habilita el botón para copiar el valor.
     * @param bool $limitable Habilita que se limite el tamaño del TextColumn y se muestre el contenido en tooltip.
     */
    public function __construct(
        public string $make,
        public string|null $label = null,
        public bool $placeholder = true,
        public bool $badge = false,
        public bool $money = false,
        public bool $searchable = false,
        public bool $sortable = false,
        public bool $toggleable = false,
        public bool $multilinea = false,
        public bool $date = false,
        public bool $datetime = false,
        public bool $html = false,
        public bool $copyable = false,
        public bool $limitable = false,
        public bool $filtrable = false
    ) {}
}


