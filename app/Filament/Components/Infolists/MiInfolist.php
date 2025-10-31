<?php

namespace App\Filament\Components\Infolists;

use App\Enums\Constantes\ConstantesInt;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class MiInfolist
{
    /**
     * @param Schema $schema
     * @param array  $arraySectionPrincipal
     * @param array  $arraySectionAuxiliar
     *
     * @return Schema
     */
    public function getInfolist(Schema $schema, array $arraySectionPrincipal, array $arraySectionAuxiliar): Schema
    {

        $hasAuxSection = !empty($arraySectionAuxiliar);


        $groups = [
            Group::make()
                ->schema($arraySectionPrincipal)
                ->columnSpan(
                    $hasAuxSection
                        ? ConstantesInt::TAMANO_10->value
                        : ConstantesInt::TAMANO_12->value
                )
        ];

        if ($hasAuxSection) {
            $groups[] = Group::make()
                ->schema($arraySectionAuxiliar)
                ->columnSpan(ConstantesInt::TAMANO_2->value);
        }

        return $schema
            ->schema($groups)
            ->columns(ConstantesInt::TAMANO_12->value);

    }
}





