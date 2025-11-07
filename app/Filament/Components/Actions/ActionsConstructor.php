<?php

namespace App\Filament\Components\Actions;

use App\Enums\Acciones\MiAccionEnum;
use App\Enums\Constantes\ConstantesString;
use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Resources\Incidencias\Schemas\IncidenciaForm;
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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Password;

class ActionsConstructor
{

    public function getCrearIncidencia(MiNavigationItem $miNavigationItem): Action
    {

//        return Action::make(MiAccionEnum::VerExpediente->value)
//            ->label(MiAccionEnum::VerExpediente->getLabel())
//            ->tooltip(MiAccionEnum::VerExpediente->getTooltip())
//            ->icon(MiAccionEnum::VerExpediente->getIcon())
//            ->color(MiAccionEnum::VerExpediente->getColor())
////            ->url(fn($record) => route('filament.admin.resources.expedientes.view', ['record' => $record->id_entry]))
//            ->url(fn($record) => route('filament.admin.resources.contratos-mayores.view', ['record' => $record->id_entry]))
//            ->visible(fn($record) => filled($record->id_entry));


//        ->actions([
//        Action::make('crearIncidencia')
//            ->label('Crear incidencia')
//            ->icon('heroicon-m-plus')
//            ->color('primary')
//            ->form(\App\Filament\Resources\Incidencias\Schemas\IncidenciaForm::schema())
//            ->mountUsing(function (Forms\ComponentContainer $form, Anuncio $record) {
//                $form->fill(['anuncio_id' => $record->id]);
//            })
//            ->action(function (array $data) {
//                Incidencia::create($data);
//            }),
//    ]);

//        Action::make('edit')
//            ->url(fn (): string => route('posts.edit', ['post' => $this->post]));

//        return Action::make(MiAccionEnum::CrearIncidencia->value)
//            ->label(MiAccionEnum::CrearIncidencia->getLabel())
//            ->tooltip(MiAccionEnum::CrearIncidencia->getTooltip())
//            ->icon(MiAccionEnum::CrearIncidencia->getIcon())
//            ->color(MiAccionEnum::CrearIncidencia->getColor())
//            ->modalWidth(Width::FourExtraLarge)
////            ->url(fn ($record): string => route('filament.admin.resources.incidencias.index', ['record' => $record->id]));
//            ->schema(function ($schema){ return new IncidenciaForm()->getForm($schema); })
//            ->action(function (array $data) {Incidencia::create($data); });


        return CreateAction::make(MiAccionEnum::CrearIncidencia->value)
                ->label(MiAccionEnum::CrearIncidencia->getLabel())
                ->tooltip(MiAccionEnum::CrearIncidencia->getTooltip())
                ->icon(MiAccionEnum::CrearIncidencia->getIcon())
                ->color(MiAccionEnum::CrearIncidencia->getColor())
                ->modalWidth(Width::FourExtraLarge)
                ->schema(function ($schema){ return new IncidenciaForm()->getForm($schema); })
                ->using(function (array $data, string $model): Model {
                    return Incidencia::create($data);
                })
                ->mutateDataUsing(function (array $data, $record) use($miNavigationItem): array {
                    $data['incidenciable_id'] = $record->id;
//                    $data['incidenciable_type'] = $miNavigationItem->value;
//                    $data['incidenciable_id'] = $record->getKey();
                    $data['incidenciable_type'] = $record->getMorphClass();
//                    $data['incidenciable_type'] = $miNavigationItem->value;

                    return $data;
                })
//                ->action(function (array $data) {Incidencia::create($data); })
            ;

    }

//    public function getCrearRespuestaIncidencia(MiNavigationItem $miNavigationItem): Action
    public function getCrearRespuestaIncidencia(): Action
    {

        return CreateAction::make(MiAccionEnum::CrearRespuestaIncidencia->value)
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


    public function getVerExpediente(): Action
    {

        return Action::make(MiAccionEnum::VerExpediente->value)
            ->label(MiAccionEnum::VerExpediente->getLabel())
            ->tooltip(MiAccionEnum::VerExpediente->getTooltip())
            ->icon(MiAccionEnum::VerExpediente->getIcon())
            ->color(MiAccionEnum::VerExpediente->getColor())
//            ->url(fn($record) => route('filament.admin.resources.expedientes.view', ['record' => $record->id_entry]))
            ->url(fn($record) => route('filament.admin.resources.contratos-mayores.view', ['record' => $record->id_entry]))
            ->visible(fn($record) => filled($record->id_entry));
    }

    public function getEnlaceDocumento(): Action
    {

        return Action::make(MiAccionEnum::AbrirEnlaceDocumento->value)
            ->label(MiAccionEnum::AbrirEnlaceDocumento->getLabel())
            ->tooltip(MiAccionEnum::AbrirEnlaceDocumento->getTooltip())
            ->icon(MiAccionEnum::AbrirEnlaceDocumento->getIcon())
            ->color(MiAccionEnum::AbrirEnlaceDocumento->getColor())
            ->url(fn($record) => $record->uri)
            ->openUrlInNewTab()
            ->visible(fn($record) => filled($record->uri));
    }

    public function getEnlacePlacsp(): Action
    {

        return Action::make(MiAccionEnum::AbrirEnlacePlacsp->value)
            ->label(MiAccionEnum::AbrirEnlacePlacsp->getLabel())
            ->tooltip(MiAccionEnum::AbrirEnlacePlacsp->getTooltip())
            ->icon(MiAccionEnum::AbrirEnlacePlacsp->getIcon())
            ->color(MiAccionEnum::AbrirEnlacePlacsp->getColor())
            ->url(fn($record) => $record->link)
            ->openUrlInNewTab()
            ->visible(fn($record) => filled($record->link));
    }

    public function getEnlaceInvente(): Action
    {

        return Action::make(MiAccionEnum::AbrirEnlaceInvente->value)
            ->label(MiAccionEnum::AbrirEnlaceInvente->getLabel())
            ->tooltip(MiAccionEnum::AbrirEnlaceInvente->getTooltip())
            ->icon(MiAccionEnum::AbrirEnlaceInvente->getIcon())
            ->color(MiAccionEnum::AbrirEnlaceInvente->getColor())
            ->url(fn($record) => ConstantesString::ENLACE_INVENTE->value . $record->codigo_invente)
            ->openUrlInNewTab()
            ->visible(fn($record) => !is_null($record->codigo_invente));
    }

//    public function getEstablecerRetirarLecturaAction(): EstablecerRetirarLecturaAction
//    {
//        return EstablecerRetirarLecturaAction::make(EstablecerRetirarLecturaAction::getDefaultName())
//            ->authorize(auth()->user()->esSuperAdmin());
//    }
//
//    public function getEstablecerRetirarSuperAdminAction(): EstablecerRetirarSuperAdminAction
//    {
//        return EstablecerRetirarSuperAdminAction::make(EstablecerRetirarSuperAdminAction::getDefaultName())
//            ->authorize(auth()->user()->esSuperAdmin());
//    }
//
//    public function getActivarDesactivarAction(): EstablecerRetirarActivoAction
//    {
//
//        return EstablecerRetirarActivoAction::make(EstablecerRetirarActivoAction::getDefaultName())
//            ->authorize(auth()->user()->esSuperAdmin());
//    }
//
//    public function getActivarDesactivarDobleFactorAction(): EstablecerRetirarDobleFactorAction
//    {
//
//        return EstablecerRetirarDobleFactorAction::make(EstablecerRetirarDobleFactorAction::getDefaultName())
//            ->authorize(auth()->user()->esSuperAdmin());
//    }

    public function getGoToListAction(MiNavigationItem $miNavigationItem): Action
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
    public function getDeleteAction(): DeleteActionPage
    {

        return DeleteActionPage::make(MiAccionEnum::Deleted->name)
            ->label(MiAccionEnum::Deleted->getLabel())
            ->tooltip(MiAccionEnum::Deleted->getTooltip())
            ->color(MiAccionEnum::Deleted->getColor())
            ->icon(MiAccionEnum::Deleted->getIcon())
            ->modalHeading(fn($record) => 'Eliminar ' . $record->getTitle())
            ->visible(fn($record) => empty($record->getAttribute('deleted_at')))
            ->authorize(auth()->user()->esSuperAdmin());
    }

    public function getEditAction(): EditActionPage
    {

        return EditActionPage::make(MiAccionEnum::Edit->name)
            ->label(MiAccionEnum::Edit->getLabel())
            ->tooltip(MiAccionEnum::Edit->getTooltip())
            ->color(MiAccionEnum::Edit->getColor())
            ->icon(MiAccionEnum::Edit->getIcon())
            ->failureNotification(null)
            ->successNotification(null)
            ->modalWidth(Width::Full)
            ->authorize(!auth()->user()?->esLectura());
    }

    public function getCreateAction(): CreateActionPage
    {

        return CreateActionPage::make(MiAccionEnum::Create->name)
            ->label(MiAccionEnum::Create->getLabel())
            ->tooltip(MiAccionEnum::Create->getTooltip())
            ->color(MiAccionEnum::Create->getColor())
            ->icon(MiAccionEnum::Create->getIcon())
            ->failureNotification(null)
            ->successNotification(null)
            ->modalWidth(Width::Full)
            ->createAnother(false)
            ->authorize(!auth()->user()?->esLectura());
    }

    public function getAssociateAction(): AssociateAction
    {

        return AssociateAction::make(MiAccionEnum::Associate->name)
            ->authorize(true)
            ->label(MiAccionEnum::Associate->getLabel())
            ->tooltip(MiAccionEnum::Associate->getTooltip())
            ->color(MiAccionEnum::Associate->getColor())
            ->icon(MiAccionEnum::Associate->getIcon())
            ->failureNotification(null)
            ->successNotification(null)
            ->modalWidth(Width::Full)
            ->authorize(!auth()->user()?->esLectura());
    }

    public function getViewAction(): ViewAction
    {

        return ViewAction::make()
            ->label(MiAccionEnum::View->getLabel())
            ->tooltip(MiAccionEnum::View->getTooltip())
            ->color(MiAccionEnum::View->getColor())
            ->icon(MiAccionEnum::View->getIcon())
            ->modalWidth(Width::Full)
            ->authorize(true);
    }

    public function getForceDeleteAction(): ForceDeleteActionPage
    {

        return ForceDeleteActionPage::make(MiAccionEnum::ForceDelete->name)
            ->label(MiAccionEnum::ForceDelete->getLabel())
            ->tooltip(MiAccionEnum::ForceDelete->getTooltip())
            ->color(MiAccionEnum::ForceDelete->getColor())
            ->icon(MiAccionEnum::ForceDelete->getIcon())
            ->modalHeading(fn($record) => 'Eliminar definitivamente ' . $record->getTitle())
            ->visible(fn($record) => !empty($record->getAttribute('deleted_at')))
            ->authorize(auth()->user()->esSuperAdmin());
    }

    public function getRestoreAction(): RestoreActionPage
    {

        return RestoreActionPage::make(MiAccionEnum::Restore->name)
            ->label(MiAccionEnum::Restore->getLabel())
            ->tooltip(MiAccionEnum::Restore->getTooltip())
            ->color(MiAccionEnum::Restore->getColor())
            ->icon(MiAccionEnum::Restore->getIcon())
            ->modalHeading(fn($record) => 'Restaurar ' . $record->getTitle())
            ->visible(fn($record) => !empty($record->getAttribute('deleted_at')))
            ->authorize(!auth()->user()->esSuperAdmin());
    }

    public function getBulkActionDelete(MiNavigationItem $miNavigationItem): DeleteBulkAction
    {

        return DeleteBulkAction::make(MiAccionEnum::BulkActionDelete->name)
            ->label(MiAccionEnum::BulkActionDelete->getLabel())
            ->pluralModelLabel($miNavigationItem->getLabel())
            ->tooltip(MiAccionEnum::BulkActionDelete->getTooltip())
            ->color(MiAccionEnum::BulkActionDelete->getColor())
            ->icon(MiAccionEnum::BulkActionDelete->getIcon())
            ->modalHeading(MiAccionEnum::BulkActionDelete->getDescription())
            ->authorize(auth()->user()->esSuperAdmin());
    }

    public function getBulkActionForceDelete(MiNavigationItem $miNavigationItem): ForceDeleteBulkAction
    {

        return ForceDeleteBulkAction::make(MiAccionEnum::BulkActionForceDelete->name)
            ->label(MiAccionEnum::BulkActionForceDelete->getLabel())
            ->pluralModelLabel($miNavigationItem->getLabel())
            ->tooltip(MiAccionEnum::BulkActionForceDelete->getTooltip())
            ->color(MiAccionEnum::BulkActionForceDelete->getColor())
            ->icon(MiAccionEnum::BulkActionForceDelete->getIcon())
            ->modalHeading(MiAccionEnum::BulkActionForceDelete->getDescription())
            ->authorize(auth()->user()->esSuperAdmin());
    }

    public function getBulkActionRestore(MiNavigationItem $miNavigationItem): RestoreBulkAction
    {

        return RestoreBulkAction::make(MiAccionEnum::BulkActionRestore->name)
            ->label(MiAccionEnum::BulkActionRestore->getLabel())
            ->pluralModelLabel($miNavigationItem->getLabel())
            ->tooltip(MiAccionEnum::BulkActionRestore->getTooltip())
            ->color(MiAccionEnum::BulkActionRestore->getColor())
            ->icon(MiAccionEnum::BulkActionRestore->getIcon())
            ->modalHeading(MiAccionEnum::BulkActionRestore->getDescription())
            ->authorize(auth()->user()->esSuperAdmin());
    }

    public function getSendPasswordAction():  Action
    {

        return Action::make('send-password-action')
            ->authorize(auth()->user()->esSuperAdmin())
            ->label('Enviar email clave')
            ->icon('heroicon-o-envelope')
            ->action(

                function (User $record) {

                    // Enviar el enlace de recuperación
                    $status = Password::sendResetLink(['email' => $record->email]);

                    // Mostrar notificación según el resultado
                    if ($status === Password::RESET_LINK_SENT) {
                        Notification::make()
                            ->title('Enlace de restablecimiento enviado')
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('No se pudo enviar el enlace')
                            ->danger()
                            ->send();
                    }
                });
    }
    public function getReset2FA(): Action
    {

        return Action::make('reset-2FA')
            ->authorize(auth()->user()->esSuperAdmin())
            ->label('Resetear 2FA')
            ->icon('heroicon-s-finger-print')
            ->action(

                function (User $record) {

                    $record->setAttribute('app_authentication_secret', null);
                    $record->setAttribute('app_authentication_recovery_codes', null);

                    Notification::make()
                        ->title('Se ha borrado el 2FA para el usuario '. $record->getTitle())
                        ->success()
                        ->send();
                });
    }
//
//    public function getExportarExcel(): ExportAction
//    {
//        return ExportAction::make(MiAccionEnum::ExportarExcel->value)
//            ->authorize(true)
//            ->label(MiAccionEnum::ExportarExcel->getLabel())
//            ->icon(MiAccionEnum::ExportarExcel->getIcon())
//            ->tooltip(MiAccionEnum::ExportarExcel->getTooltip())
//            ->color(MiAccionEnum::ExportarExcel->getColor())
//            ->exporter(OrganoContratacionExporter::class);
//    }
}
