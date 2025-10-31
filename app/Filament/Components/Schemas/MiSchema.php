<?php

namespace App\Filament\Components\Schemas;

use App\Enums\Constantes\ConstantesInt;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class MiSchema
{

    /**
     * @param Schema $schema
     * @param array  $arraySectionPrincipal
     * @param array  $arraySectionAuxiliar
     *
     * @return Schema
     */
    public function getSchema(Schema $schema, array $arraySectionPrincipal, array $arraySectionAuxiliar): Schema
    {

        $hasAuxSection = !empty($arraySectionAuxiliar);

        $grids = [
            Grid::make()
                ->schema($arraySectionPrincipal)
                ->columnSpan(
                    $hasAuxSection
                        ? ConstantesInt::TAMANO_10->value
                        : ConstantesInt::TAMANO_12->value
                )
        ];

        if ($hasAuxSection) {
            $grids[] = Grid::make()
                ->schema($arraySectionAuxiliar)
                ->columnSpan(ConstantesInt::TAMANO_2->value);
        }

        return $schema
            ->schema($grids)
            ->columns(ConstantesInt::TAMANO_12->value);
    }

    /**
     * @param Schema $schema
     * @param array $arraySectionPrincipal
     * @return Schema
     */
    public function getSchemaSinGrids(Schema $schema, array $arraySectionPrincipal): Schema
    {

        return $schema
            ->schema($arraySectionPrincipal)
            ->columns(ConstantesInt::TAMANO_12->value);
    }
}
