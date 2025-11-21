<?php

namespace App\Filament\Resources\Incidencias\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Resources\Incidencias\IncidenciaResource;
use App\Models\Incidencia;
use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ViewIncidenciaBlade extends BaseViewRecord
{
    /**
     * @var MiNavigationItem
     */
    protected static \App\Contracts\MiNavigationItemContract $miNavigationItem = MiNavigationItemIncidencias::PLACSP_INCIDENCIA;


    /**
     * @param Schema $schema
     *
     * @return Schema
     */
//    public function infolist(Schema $schema): Schema
//    {
//        return new IncidenciaInfolist()->getSchema($schema);
//    }



    protected static string $resource = IncidenciaResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Detalles de la Incidencia')
                    ->schema([
                        // Campos específicos de la incidencia actual
                    ]),

                Section::make('Otras Incidencias similares')
                    ->schema([
                        ViewEntry::make('tabla_incidencias')
                            ->label(false)
                            ->view('filament.incidencias._tabla_incidencias')
                            ->state(function () {
                                // Reutilizamos columnas del resource principal
                                $columns = IncidenciaResource::table(app(Table::class))->getColumns();

                                // Ejemplo de query: incidencias del mismo cliente (ajusta según tu modelo)
                                $registros = Incidencia::query()
                                    ->where('id', $this->record->id)
                                    ->get();

                                return compact('columns', 'registros');
                            }),
                    ]),
            ]);
    }


}
