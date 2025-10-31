<?php

namespace App\Traits;

use Filament\Resources\Components\Tab;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait HasTabs
{
    /**
     * Genera tabs dinámicamente con filtros por enumeraciones.
     *
     * @param  string        $label       Etiqueta para la pestaña general ("Todos los...")
     * @param  string        $column      Nombre de la columna a filtrar
     * @param  class-string<Model> $modelClass  Clase del modelo Eloquent
     * @param  array         $cases       Lista de casos enum (e.g. TipoSindicacion::cases())
     * @param  callable|null $colorFn     Función para obtener el color
     * @return array<string, Tab>
     */
    public function generateTabs(
        string $label,
        string $column,
        string $modelClass,
        array $cases,
        ?callable $colorFn = null,
    ): array {
        $tabs = [];

        // Tab "Todas"
        $tabs['Todas'] = Tab::make("Todos los $label")
            ->modifyQueryUsing(fn (Builder $query) => $query) // sin filtro
            ->badge($this->formatBadgeCount($modelClass::query()->count()))
            ->badgeColor(Color::Pink);

        foreach ($cases as $case) {
            $etiqueta = $case->getLabel();
            $tabs[$etiqueta] = Tab::make($etiqueta)
                ->modifyQueryUsing(fn (Builder $query) => $query->where($column, $case))
                ->badge($this->formatBadgeCount(
                    $modelClass::query()->where($column, $case)->count()
                ))
                ->badgeColor($colorFn ? $colorFn($case) : Color::Gray);
        }

        return $tabs;
    }

    protected function formatBadgeCount(int $count): string
    {
        return number_format($count, 0, ',', '.');
    }
}

