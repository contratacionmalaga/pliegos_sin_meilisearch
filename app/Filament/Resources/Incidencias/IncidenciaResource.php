<?php

namespace App\Filament\Resources\Incidencias;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Abstracts\BaseResourceNavigationItem;
use App\Filament\RelationManagers\RespuestasIncidenciaRelationManager;
use App\Filament\Resources\Incidencias\Pages\ListIncidencias;
use App\Filament\Resources\Incidencias\Pages\ViewIncidencia;
use App\Filament\Resources\Incidencias\Pages\ViewIncidenciaPage;
use App\Filament\Resources\Incidencias\Pages\ViewIncidenciaSimple;
use App\Filament\Resources\Incidencias\Pages\ViewIncidenciaTable;
use App\Filament\Resources\Incidencias\Schemas\IncidenciaForm;


use Filament\Schemas\Schema;


use Filament\Tables;


class IncidenciaResource extends BaseResourceNavigationItem
{

    /**
     * @var MiNavigationItem
     */
    protected static MiNavigationItem $miNavigationItem = MiNavigationItem::PLACSP_INCIDENCIA;

    public static function getPages(): array
    {
        return [
            'index' => ListIncidencias::route('/'),
            'view' => ViewIncidencia::route('/{record}/view'),
//            'view' => ViewIncidenciaPage::route('/{record}'),
//            'view' => ViewIncidenciaTable::route('/{record}'),
//            'view-simple' => ViewIncidenciaSimple::route('/{record}/view-simple'),
        ];
    }

//    public static function form(Schema $schema): Schema
//    {
//        return new IncidenciaForm()->getForm($schema);
//    }



    /**
     * Metodo reutilizable para obtener las columnas de la tabla.
     */
    public static function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('titulo')
                ->label('Título')
                ->searchable(),

            Tables\Columns\TextColumn::make('descripcion')
                ->label('Descripcion')
                ->sortable(),

            Tables\Columns\TextColumn::make('estado')
                ->label('Estado')
                ->badge(),
//                ->color(fn (string $state) => match ($state) {
//                    'Abierta' => 'success',
//                    'En proceso' => 'warning',
//                    'Cerrada' => 'danger',
//                    default => 'gray',
//                }),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Creado')
                ->dateTime('d/m/Y H:i')
                ->sortable(),
        ];
    }


    /**
     * @return class-string[]
     */
    public static function getRelations(): array
    {

        return [
            RespuestasIncidenciaRelationManager::class,

        ];
    }
}
