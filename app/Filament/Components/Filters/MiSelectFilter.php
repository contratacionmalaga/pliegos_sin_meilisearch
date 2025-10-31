<?php

namespace App\Filament\Components\Filters;

use App\Enums\Constantes\ConstantesString;
use Exception;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class MiSelectFilter
{
    /**
     * @param array{
     *       make: string,
     *       label: string,
     *       column: string,
     *  } $params
     *
     * @throws Exception
     */
    public function getSelectFilterBaseNulo(array $params): SelectFilter
    {

        return $this->getSelectFilterBase($params)
            ->query(function ($query, $data) use ($params) {

                if ($data['value'] === null) {
                    return $query;
                }
                if ($data['value'] === -1) {
                    return $query->whereNull($params['column']);
                }

                return $query->where($params['column'], $data);
            });
    }

    /**
     * @param array{
     *       make: string,
     *       label: string,
     *  } $params
     *
     * @throws Exception
     */
    public function getSelectFilterBase(array $params): SelectFilter
    {

        return SelectFilter::make($params['make'])
            ->label($params['label'])
            ->placeholder(ConstantesString::FILTER_PLACEHOLDER->value)
            ->preload()
            ->columnSpan(1);
    }

    /**
     * @param array{
     *       make: string,
     *       label: string,
     *  } $params
     *
     * @throws Exception
     */
    public function getSelectFilterBaseByJson(array $params): SelectFilter
    {

        return $this->getSelectFilterBase($params)
            ->query(function (Builder $query, SelectFilter $filter) use ($params) {
                $value = $filter->getState()['value'] ?? null;

                if ($value === null || $value === '') {
                    return $query;
                }

                // 👇 detectar si el campo es un atributo JSON
                if (str_starts_with($params['make'], 'datos_json.')) {
                    $jsonKey = substr($params['make'], strlen('datos_json.')); // ej: "uo_id"

                    return $query->whereRaw(
                        "JSON_UNQUOTE(JSON_EXTRACT(datos_json, '$.\"{$jsonKey}\"')) = ?",
                        [$value]
                    );
                }

                // 👇 fallback a columna normal
                return $query->where($params['make'], $value);
            });
    }
}
