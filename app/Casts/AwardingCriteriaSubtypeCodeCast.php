<?php

namespace App\Casts;

use App\Enums\Placsp\PLACSP_AwardingCriteriaAutomaticallyEvaluatedSubTypeCode;
use App\Enums\Placsp\PLACSP_AwardingCriteriaNotAutomaticallyEvaluatedSubTypeCode;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class AwardingCriteriaSubtypeCodeCast implements CastsAttributes
{
    /**
     * Convierte el valor del atributo de la base de datos a su tipo Enum.
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     *
     * @return string|null
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        // Verificamos el valor de awarding_criteria_type_code y decidimos qué enum usar
        if ($model->getAttribute('awarding_criteria_type_code') === 'OBJ') {
            // Si es 'Objetivo', usamos el enum PLACSP_AwardingCriteriaAutomaticallyEvaluatedSubTypeCode
            return PLACSP_AwardingCriteriaAutomaticallyEvaluatedSubTypeCode::from($value)?->getLabel();
        }

        if ($model->getAttribute('awarding_criteria_type_code') === 'SUBJ') {
            // Si es 'Subjetivo', usamos el enum PLACSP_AwardingCriteriaNotAutomaticallyEvaluatedSubTypeCode
            return PLACSP_AwardingCriteriaNotAutomaticallyEvaluatedSubTypeCode::from($value)?->getLabel();
        }

        return null;
    }

    /**
     * Convierte el valor del Enum a su representación en la base de datos.
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        // Al guardar, guardamos el valor del enum como su valor literal (ejemplo: '1', '99')
        return $value ? $value->value : null;
    }
}
