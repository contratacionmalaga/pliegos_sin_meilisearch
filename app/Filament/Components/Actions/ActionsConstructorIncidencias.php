<?php

namespace App\Filament\Components\Actions;

use App\Contracts\MiNavigationItemContract;
use App\Enums\Acciones\MiAccionEnum;
use App\Enums\Constantes\ConstantesString;
use App\Enums\NavigationMenus\MiNavigationItem;
use App\Enums\NavigationMenus\MiNavigationItemIncidencias;
use App\Filament\Resources\Incidencias\Schemas\IncidenciaForm;
use App\Filament\Resources\Incidencias\Schemas\IncidenciaInfolist;
use App\Filament\Resources\Incidencias\Schemas\IncidenciaSimpleInfolist;
use App\Filament\Resources\RespuestasIncidencia\Schemas\RespuestasIncidenciaForm;
use App\Models\Incidencia;
use App\Models\RespuestasIncidencia;
use App\Models\User;
use Exception;
use Filament\Actions\Action;
use Filament\Actions\AssociateAction;
use Filament\Actions\CreateAction;
use Filament\Actions\CreateAction as CreateActionPage;
use Filament\Actions\DeleteAction as DeleteActionPage;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction as EditActionPage;
use Filament\Actions\ForceDeleteAction as ForceDeleteActionPage;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction as RestoreActionPage;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Width;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Password;
use Livewire\Livewire;

class ActionsConstructorIncidencias
{

    public function getCrearIncidencia(MiNavigationItemContract $miNavigationItem): Action
    {

//        return Action::make(MiAccionEnum::CrearIncidencia->value)
//            ->label(MiAccionEnum::CrearIncidencia->getLabel())
//            ->tooltip(MiAccionEnum::CrearIncidencia->getTooltip())
//            ->icon(MiAccionEnum::CrearIncidencia->getIcon())
//            ->color(MiAccionEnum::CrearIncidencia->getColor())
//            ->modalWidth(Width::FourExtraLarge)
////            ->url(fn ($record): string => route('filament.admin.resources.incidencias.index', ['record' => $record->id]));
//            ->schema(function ($schema){ return new IncidenciaForm()->getForm($schema); })
//            ->action(function (array $data) {Incidencia::create($data); });


        return CreateActionPage::make(MiAccionEnum::CrearIncidencia->value)
                ->label(MiAccionEnum::CrearIncidencia->getLabel())
                ->tooltip(MiAccionEnum::CrearIncidencia->getTooltip())
                ->icon(MiAccionEnum::CrearIncidencia->getIcon())
                ->color(MiAccionEnum::CrearIncidencia->getColor())
                ->modalWidth(Width::FourExtraLarge)
                ->schema(function ($schema){ return new IncidenciaForm()->getForm($schema); })
                ->using(function (array $data, string $model, $record): Model {
                     return Incidencia::create($data);
//                    return $record->addIncidencia($data['titulo'], $record->getModel());
                })
                ->mutateDataUsing(function (array $data, $record) use($miNavigationItem): array {
                    $data['incidenciable_id'] = $record->id;
                    $data['incidenciable_type'] = $record->getMorphClass();
//                    $data['incidenciable_id'] = $record->getKey();
//                    $data['incidenciable_type'] = $miNavigationItem->value;

                    return $data;
                })
                ->slideOver() // 👈 Esto hace que el formulario se abra desde la derecha
//                ->action(function (array $data) {Incidencia::create($data); })
            ;

    }

//    public function getCrearRespuestaIncidencia(MiNavigationItem $miNavigationItem): Action
    public function getCrearRespuestaIncidencia(): Action
    {

        return CreateActionPage::make(MiAccionEnum::CrearRespuestaIncidencia->value)
                ->label(MiAccionEnum::CrearRespuestaIncidencia->getLabel())
                ->tooltip(MiAccionEnum::CrearRespuestaIncidencia->getTooltip())
                ->icon(MiAccionEnum::CrearRespuestaIncidencia->getIcon())
                ->color(MiAccionEnum::CrearRespuestaIncidencia->getColor())
                ->modalWidth(Width::FourExtraLarge)
                ->schema(function ($schema){ return new RespuestasIncidenciaForm()->getForm($schema); })
                ->using(function (array $data, string $model): Model {
                    return RespuestasIncidencia::create($data);
                })
//                ->mutateDataUsing(function (array $data, $record) use($miNavigationItem): array {
                ->mutateDataUsing(function (array $data, $record): array {
                    $data['incidencia_id'] = $record->id;

                    return $data;
                })
            ;

    }



    public function getGoToListAction(MiNavigationItemContract $miNavigationItem): Action
    {

        /*
         * Obtengo el recurso asociado a MiNavigationItem
         */
        $resourceClass = $miNavigationItem->getResource();

        /*
         * Creo una instancia de la clase de recurso
         */
        $resourceInstance = new $resourceClass;

        /*
         * Obtengo la URL del listado de registros
         */
        return Action::make(MiAccionEnum::VolverAlListado->name)
            ->label(MiAccionEnum::VolverAlListado->getLabel())
            ->color(MiAccionEnum::VolverAlListado->getColor())
            ->icon(MiAccionEnum::VolverAlListado->getIcon())
            ->tooltip(MiAccionEnum::VolverAlListado->getTooltip())
            ->url(fn() => $resourceInstance->getUrl('index'));
    }

    /**
     * @throws Exception
     */

    public function getViewIncidencia_ViewAction_Infolist(): ViewAction
    {
        return ViewAction::make()
            ->label(MiAccionEnum::View->getLabel())
            ->tooltip(MiAccionEnum::View->getTooltip())
            ->color(MiAccionEnum::View->getColor())
            ->icon(MiAccionEnum::View->getIcon())
            ->slideOver() // 👈 esto lo hace abrir desde el borde derecho
            ->schema(function ($schema){ return new IncidenciaInfolist()->getSchema($schema); })
            ->modalHeading('Detalles 222 de la incidencia')
            ->modalSubmitAction(false) // sin botón de "Guardar"
            ->modalCancelActionLabel('Cerrar')
            ->modalWidth(Width::FourExtraLarge)
            ->requiresConfirmation();
    }

    public function getViewIncidencia_Action_Infolist(): Action
    {
        return Action::make('view-incidencia-action-infolist')
            ->label('View')
            ->tooltip('View')
            ->color(MiAccionEnum::View->getColor())
            ->icon(MiAccionEnum::View->getIcon())
            ->slideOver() // 👈 esto lo hace abrir desde el borde derecho
            ->schema(function ($schema){ return new IncidenciaInfolist()->getSchema($schema); })
            ->modalHeading('Detalles de la incidencia ( MODAL)')
            ->modalSubmitAction(false) // sin botón de "Guardar"
            ->modalCancelActionLabel('Cerrar')
            ->modalWidth(Width::FourExtraLarge);
    }

    public function getViewIncidencia_Action_SimpleInfolist(): Action
    {
        return Action::make('view-incidencia-action-simpleinfolist')
            ->label('View--Modal-SimpleInfolist')
            ->tooltip('View-Modal-SimpleInfolist')
            ->color(MiAccionEnum::View->getColor())
            ->icon(MiAccionEnum::View->getIcon())
            ->slideOver() // 👈 esto lo hace abrir desde el borde derecho
            ->schema(function ($schema){ return new IncidenciaSimpleInfolist()->getSchema($schema); })
            ->modalHeading('Detalles de la incidencia ( MODAL)')
            ->modalSubmitAction(false) // sin botón de "Guardar"
            ->modalCancelActionLabel('Cerrar')
            ->modalWidth(Width::FourExtraLarge);
    }

    public function getViewIncidencia_Action_Infolist_Ori(): Action
    {
        return Action::make('view-incidencia-action-infolist')
            ->label('View-Modal-Infolist')
            ->tooltip('View-Modal-Infolist')
            ->color(MiAccionEnum::View->getColor())
            ->icon(MiAccionEnum::View->getIcon())
            ->slideOver() // 👈 esto lo hace abrir desde el borde derecho
//            ->schema(function ($schema){ return new IncidenciaSimpleInfolist()->getSchema($schema); })
            ->schema(function ($schema){ return new IncidenciaInfolist()->getSchema($schema); })
            ->modalHeading('Detalles de la incidencia ( MODAL)')
            ->modalSubmitAction(false) // sin botón de "Guardar"
            ->modalCancelActionLabel('Cerrar')
            ->modalWidth(Width::FourExtraLarge)
//            ->requiresConfirmation()
            //            ->slideOver() // 👈 esto lo hace abrir desde el borde derecho
//            ->modalContent(fn (Incidencia $record): View => view('filament.admin.resources.incidencias.view-simple', ['record' => $record]));
//            ->modalContent(function (Incidencia $record): View {
//                $viewPath = 'filament.admin.resources.incidencias.view-simple';
//
//                // Debug: ver la ruta real que busca Laravel
//                ds('Buscando vista... ' );
//                ds(view()->getFinder()->find($viewPath));
//
//                return view($viewPath, ['record' => $record]);
//            })
              ;
//            ->modalContent(fn (Incidencia $record): View => view('app.filament.resources.incidencias.pages.view-incidencia-simple', ['record' => $record]));
    }


}
