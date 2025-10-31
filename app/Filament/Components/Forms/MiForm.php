<?php

namespace App\Filament\Components\Forms;

use App\Enums\Constantes\ConstantesInt;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class MiForm
{

    /**
     * @param Schema $schema
     * @param array  $arraySectionPrincipal
     * @param array  $arraySectionAuxiliar
     *
     * @return Schema
     */
    public function getForm(Schema $schema, array $arraySectionPrincipal, array $arraySectionAuxiliar): Schema
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
}
