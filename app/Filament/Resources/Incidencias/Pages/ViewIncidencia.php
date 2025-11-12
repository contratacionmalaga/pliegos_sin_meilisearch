<?php

namespace App\Filament\Resources\Incidencias\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Resources\Incidencias\Schemas\IncidenciaInfolist;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ViewIncidencia extends BaseViewRecord
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_INCIDENCIA;


    /**
     * @param Schema $schema
     *
     * @return Schema
     */
//    public function infolist(Schema $schema): Schema
//    {
//        return new IncidenciaInfolist()->getSchema($schema);
//    }

    public  function infolist(Schema $schema): Schema
    {
        return $schema
            ->record($this->record)
            ->schema([
                RepeatableEntry::make('incidencias')
                    ->label('Productos')
                    ->schema([
                        TextEntry::make('titulo')->label('Titulo'),
                        TextEntry::make('descripcion')->label('Descripcion'),
                        TextEntry::make('estado')->label('Estado'),
                        TextEntry::make('email')->label('Email'),
                    ])
                    ->columns(3),
            ]);
    }

}
