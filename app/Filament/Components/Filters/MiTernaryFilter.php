<?php

namespace App\Filament\Components\Filters;

use App\Enums\Constantes\ConstantesString;
use Exception;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;

class MiTernaryFilter
{
    /**
     * @param array{
     *      make: string,
     *      label: string,
     *      trueLabel: string,
     *      falseLabel: string
     *  } $params
     *
     * @throws Exception
     */
    public function getTernaryFilterConstructor(array $params, string $enumClass): TernaryFilter
    {
        // Asegúrate de que el enumClass proporcionado sea una clase enum válida
        if (!enum_exists($enumClass)) {
            throw new \InvalidArgumentException("La clase {$enumClass} no es un enum válido.");
        }

        // Obtener el valor del enumerado (por ejemplo, 'es_activo')
        $enumValue = $params['make'];

        // Asumiendo que el valor 'enumClass' será una instancia del enum o el nombre del enum
        $trueEnum = $enumClass::TRUE;  // Por ejemplo, ActivoEnum::TRUE
        $falseEnum = $enumClass::FALSE; // Por ejemplo, ActivoEnum::FALSE

        // Recuperar el label para el filtro usando getLabel del Enum
        $trueLabel = $trueEnum->getLabel();
        $falseLabel = $falseEnum->getLabel();


        return TernaryFilter::make($enumValue)
            ->label($params['label'])
            ->placeholder(ConstantesString::FILTER_PLACEHOLDER->value)
            ->trueLabel($trueLabel)      // Usamos el label del enum para true
            ->falseLabel($falseLabel)    // Usamos el label del enum para false
            ->queries(
                true: fn (Builder $query) => $query->where($params['make'], $trueEnum->value),
                false: fn (Builder $query) => $query->where($params['make'], $falseEnum->value),
                blank: fn (Builder $query) => $query,
            );
    }

}
