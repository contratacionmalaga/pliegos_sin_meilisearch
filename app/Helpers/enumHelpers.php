<?php

/**
 * Ordena un array de objetos por su valor.
 */
if (! function_exists('sortEnumByValue')) {
    /**
     * @param  array<string, mixed>  $opciones
     * @return array<string, mixed>
     */
    function sortEnumByValue(array $opciones): array
    {
        usort($opciones, static function ($a, $b) {
            return strcmp($a->value, $b->value);
        });

        return $opciones; // Devuelve los objetos enum, no un array asociativo

        // Devolvemos el array de opciones ordenadas
//        return array_combine(
//            array_map(static fn ($case) => $case->value, $opciones),          // Valor
//            array_map(static fn ($case) => $case->getLabel(), $opciones)      // Etiqueta
//        );
    }
}

/**
 * Ordena un array de objetos por su valor.
 */
if (! function_exists('sortEnumByLabel')) {
    /**
     * @param  array<string, mixed>  $opciones
     * @return array<string, mixed>
     */
    function sortEnumByLabel(array $opciones): array
    {
        usort($opciones, static function ($a, $b) {
            return strcmp($a->getLabel(), $b->getLabel());
        });

        return $opciones; // Devuelve los objetos enum, no un array asociativo

        // Devolvemos el array de opciones ordenadas
//        return array_combine(
//            array_map(static fn ($case) => $case->value, $opciones),          // Valor
//            array_map(static fn ($case) => $case->getLabel(), $opciones)      // Etiqueta
//        );
    }
}

/**
 * Ordena un array de objetos por su orden de clasificación.
 */
if (! function_exists('sortEnumBySortOrder')) {
    /**
     * @param  array<string, mixed>  $opciones
     * @return array<string, mixed>
     */
    function sortEnumBySortOrder(array $opciones): array
    {
        usort($opciones, static function ($a, $b) {
            return $a->getSortOrder() - $b->getSortOrder();
        });

        // Devolvemos el array de opciones ordenadas
        return array_combine(
            array_map(static fn ($case) => $case->value, $opciones),          // Valor
            array_map(static fn ($case) => $case->getLabel(), $opciones)      // Etiqueta
        );
    }
}
