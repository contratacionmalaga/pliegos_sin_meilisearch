<?php

namespace App\Filament\Components\Filters;

use App\Enums\Constantes\ConstantesString;
use Exception;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;

class MiTextFilter
{
    /**
     * @param array<string, string> $params
     *
     * @throws Exception
     */
    public static function getTernaryFilterConstructor(array $params): TernaryFilter
    {

        return TernaryFilter::make($params['make'])
            ->label($params['label'])
            ->placeholder(ConstantesString::FILTER_PLACEHOLDER->value)
            ->trueLabel($params['trueLabel'])
            ->falseLabel($params['falseLabel'])
            ->queries(
                true: fn (Builder $query) => $query->whereNotNull($params['make']),
                false: fn (Builder $query) => $query->whereNull($params['make']),
                blank: fn (Builder $query) => $query,
            );
    }
}
