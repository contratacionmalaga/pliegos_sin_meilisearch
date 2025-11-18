<?php

namespace App\Filament\Resources\Incidencias\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Resources\Incidencias\IncidenciaResource;
use App\Filament\Resources\Incidencias\Schemas\IncidenciaInfolist;
use App\Models\Incidencia;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

use Filament\Tables\Table;
use Filament\Tables;

class ViewIncidenciaOriginal extends BaseViewRecord
{
    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem | MiNavigationItemIncidencias $miNavigationItem = MiNavigationItemIncidencias::PLACSP_INCIDENCIA;


//    /**
//     * @param Schema $schema
//     *
//     * @return Schema
//     */
//    public function infolist(Schema $schema): Schema
//    {
//        return new IncidenciaInfolist()->getSchema($schema);
//    }

//    public  function infolist(Schema $schema): Schema
//    {
//        return $schema
//            ->record($this->record)
//            ->schema([
//                RepeatableEntry::make('incidencias')
//                    ->label('Productos')
//                    ->schema([
//                        TextEntry::make('titulo')->label('Titulo'),
//                        TextEntry::make('descripcion')->label('Descripcion'),
//                        TextEntry::make('estado')->label('Estado'),
//                        TextEntry::make('email')->label('Email'),
//                    ])
//                    ->columns(3),
//            ]);
//    }


    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Detalles de la Incidencia')
                    ->schema([
                        // Aquí podrías poner campos individuales, por ejemplo:
                        \Filament\Infolists\Components\TextEntry::make('titulo')->label('Título')
                        ->columnSpan(2),
                        \Filament\Infolists\Components\TextEntry::make('descripcion')->label('Descripcion')
                        ->columnSpan(2),
                        \Filament\Infolists\Components\TextEntry::make('estado')->label('Estado')
                        ->columnSpan(2),
//                        Tables\Columns\TextColumn::make('titulo')->label('Título'),
//                        Tables\Columns\TextColumn::make('descripcion')->label('Descripcion'),
//                        Tables\Columns\TextColumn::make('estado')->label('Estado'),
                    ])
                    ->columns(6),

                Section::make('Mis Incidencias')
                    ->schema([

//                        // Aquí reutilizamos la tabla del resource principal
//                        Tables\Table::make()
//                            ->query(Incidencia::query()) // puedes filtrar según tu necesidad
//                            ->columns(
//                                IncidenciaResource::table(app(Table::class))->getColumns()
//                            ),

                        RepeatableEntry::make('incidencias_relacionadas')
                            ->label('Incidencias similares')
                            ->columns(3)
                            ->extraAttributes(['class' => 'tabla-incidencias'])
                            ->schema([
                                \Filament\Infolists\Components\TextEntry::make('titulo')->label('Título'),
                                \Filament\Infolists\Components\TextEntry::make('descripcion')->label('Descripcion'),
                                \Filament\Infolists\Components\TextEntry::make('estado')->label('Estado'),
                            ])
                            ->state(
                                fn() => Incidencia::query()
//                                    ->where('id', $this->record->id)
                                    ->get()
                                    ->toArray()
                            ),


                    ]),
            ]);
    }
}
