<?php

namespace App\Filament\Resources\Incidencias\Pages;

use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Abstracts\BaseListRecords;
use App\Filament\Abstracts\BaseViewRecord;
use App\Filament\Components\Forms\MiTextInput;
use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Resources\Incidencias\IncidenciaResource;
use App\Filament\Resources\Incidencias\Schemas\IncidenciaInfolist;
use App\Filament\Resources\Incidencias\Tables\IncidenciaTable;
use App\Models\Incidencia;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

use Filament\Support\Contracts\TranslatableContentDriver;
use Filament\Tables\Table;
use Filament\Tables;

//use App\Filament\Resources\IncidenciaResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

//class ViewIncidenciaTable extends ViewRecord implements HasTable
//class ViewIncidencia extends ViewRecord implements HasTable
class ViewIncidenciaPage extends BaseListRecords implements HasTable
{
    use InteractsWithTable;

    protected static MiNavigationItem | MiNavigationItemIncidencias $miNavigationItem = MiNavigationItemIncidencias::PLACSP_INCIDENCIA;

    protected static string $resource = IncidenciaResource::class;

//    protected static string $view = 'filament.incidencias.viewpage';



    // 🔹 Tabla que se mostrará en la vista
    public function table(Table $table): Table
    {

        ds('Entrando en ViewIncidenciaTable::table()');

//        return app(IncidenciaTable::class)->getTable($table);

        return $table
            ->query(\App\Models\Incidencia::query()) // puedes cambiar esta query según el contexto
            ->columns(IncidenciaResource::getTableColumns())
//            ->columns(IncidenciaResource::table(app(Table::class))->getColumns())
            ->paginated([10, 25])
            ->striped()
            ->defaultSort('id', 'desc');

    }

    public function getView(): string
    {
        // Ruta del Blade desde resources/views
        return 'filament.incidencias.viewpage';
    }


    /**
     * Columnas para la tabla (reutiliza las del resource).
     */
    protected function getTableColumns(): array
    {
        ds('Entrando en ViewIncidenciaTable::getTableColumns()');

        return IncidenciaResource::getTableColumns();
    }


//    // 🔹 Contenido principal del ViewRecord
//    protected function getViewData(): array
//    {
//        return [
//            'record' => $this->record,
//        ];
//    }


//    public function getTitle(): string
//    {
//        return "Detalle de incidencia #{$this->record->id}";
//    }


    public function makeFilamentTranslatableContentDriver(): ?TranslatableContentDriver
    {
        // TODO: Implement makeFilamentTranslatableContentDriver() method.

        return null;
    }
}
