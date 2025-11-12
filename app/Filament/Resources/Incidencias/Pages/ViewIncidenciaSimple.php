<?php

namespace App\Filament\Resources\Incidencias\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Resources\Incidencias\Schemas\IncidenciaSimpleInfolist;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ViewIncidenciaSimple extends BaseViewRecord
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_INCIDENCIA;

    public function infolist(Schema $schema): Schema
    {

        return new IncidenciaSimpleInfolist()->getSchema($schema);

//        $miTextEntry = new MiTextEntry();
//
//        return $schema
//            ->schema([
//                RepeatableEntry::make('items')
//                    ->label('Productos')
//                    ->schema([
////                        TextEntry::make('name')->label('Nombre'),
////                        TextEntry::make('price')->label('Precio'),
////                        TextEntry::make('quantity')->label('Cantidad'),
//
//                        $miTextEntry->getTextEntry('titulo', 5, 'Titulo'),
//                        $miTextEntry->getTextEntry('descripcion', 5, 'Descripcion'),
//                        $miTextEntry->getBadgeTextEntry('estado', 5, 'Estado'),
//                        $miTextEntry->getTextEntry('email', 5, 'email'),
//
//                    ])
//                    ->columns(4),
//            ]);

    }

    /**
     * Forzar que esta vista no muestre RelationManagers.
     *
     * @return array
     */
    public function getRelationManagers(): array
    {
        return [];
    }
}


