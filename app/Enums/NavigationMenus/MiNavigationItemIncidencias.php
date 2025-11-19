<?php

namespace App\Enums\NavigationMenus;

//use App\Enums\Acciones\Roles;
use App\Enums\Constantes\ConstantesString;
use App\Filament\Components\Actions\ActionsConstructor;
use App\Filament\Components\Filters\Admin\EnumsSelectFilters;
use App\Filament\Components\Filters\Admin\EnumsTernaryFilters;
use App\Filament\Components\Filters\Admin\OrganoContratacionFilter;
use App\Filament\Components\Filters\MiDateRangeFilter;
use App\Filament\Resources\Incidencias\IncidenciaResource;
use App\Filament\Resources\PLACSP\Adjudicaciones\AdjudicacionResource;
use App\Filament\Resources\PLACSP\Anuncios\AnuncioResource;
use App\Filament\Resources\PLACSP\CondicionesEspecialesAdjudicacion\CondicionEspecialEjecucionResource;
use App\Filament\Resources\PLACSP\ContratosMayores\ContratoMayorResource;
use App\Filament\Resources\PLACSP\Cpvs\CpvResource;
use App\Filament\Resources\PLACSP\CriteriosAdjudicacion\CriterioAdjudicacionResource;
use App\Filament\Resources\PLACSP\Documentos\DocumentoResource;
use App\Filament\Resources\PLACSP\Lotes\LoteResource;
use App\Filament\Resources\PLACSP\Modificaciones\ModificacionResource;
use App\Filament\Resources\PLACSP\RequisitosPreviosParticipacion\RequisitoPrevioParticipacionResource;
use App\Filament\Resources\RespuestasIncidencia\RespuestasIncidenciaResource;
use App\Filament\Resources\RespuestasIncidencia\Tables\RespuestasIncidenciaTable;
use App\Models\Incidencia;
use App\Models\PLACSP\Adjudicacion;
use App\Models\PLACSP\Anuncio;
use App\Models\PLACSP\CondicionEspecialEjecucion;
use App\Models\PLACSP\ContratoMayor;
use App\Models\PLACSP\Cpv;
use App\Models\PLACSP\CriterioAdjudicacion;
use App\Models\PLACSP\Documento;
use App\Models\PLACSP\Lote;
use App\Models\PLACSP\Modificacion;
use App\Models\PLACSP\RequisitoPrevioParticipacion;
use App\Models\RespuestasIncidencia;
use Exception;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use phpDocumentor\Reflection\Types\Self_;

use App\Contracts\MiNavigationItemContract;

enum MiNavigationItemIncidencias: string implements MiNavigationItemContract
{



//    case PLACSP_ADJUDICACION = 'adjudicacion';
//    case PLACSP_ANUNCIO = 'anuncio';
//    case PLACSP_CONDICION_ESPECIAL_EJECUCION = 'condiciones-especiales-ejecucion';
//    case PLACSP_CONTRATO_MAYOR = 'contrato-mayor';
//
//    case PLACSP_CONSULTA_PRELIMINAR_MERCADO = 'consulta-preliminar-mercado';
//    case PLACSP_CPV = 'cpv';
//    case PLACSP_CRITERIO_ADJUDICACION = 'criterios-adjudicacion';
//    case PLACSP_DOCUMENTO = 'documento';
//    case PLACSP_LOTE = 'lote';
//    case PLACSP_MODIFICACION = 'modificacion';
//    case PLACSP_REQUISITO_PREVIO_PARTICIPACION = 'requisito-previo-participacion';
    case PLACSP_INCIDENCIA = 'incidencia';
    case PLACSP_RESPUESTAS_INCIDENCIA = 'respuestas-incidencia';


    /**
     * @return bool
     */
    public function isNavigationItemPermisible(): bool
    {
        return match ($this) {
            self::PLACSP_INCIDENCIA => true,
            default => false,
        };
    }

    public function getPermisibleNavigationItems(): array
    {
        return array_filter(
            self::cases(),
            static fn (self $item) => $item->isNavigationItemPermisible()
        );
    }

//    public function getRolByNavigationItem(): array
//    {
//        if (! $this->isNavigationItemPermisible()) {
//            return []; // o lanza una excepción, según tu necesidad
//        }
//
//        return match ($this) {
//            self::PLACSP_CONTRATO_MAYOR => [Roles::LEER, Roles::ESCRIBIR],
//            self::PLACSP_ADJUDICACION => [Roles::LEER],
//
//            // solo cases permisibles
//            default => [],
//        };
//    }

    /**
     * @return array<SelectFilter|DateRangeFilter|Filter>
     *
     * @throws Exception
     */
    public function getFilters(): array
    {
        return match ($this) {
            default => []
        };
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getListPageActions(): array
    {
        return [];
    }

    /**
     * @return ActionGroup
     * @throws Exception
     */
    public function getTableRecordActions(): ActionGroup
    {
        $actions = new ActionsConstructor;

        match ($this) {

//            self::PLACSP_ANUNCIO => $array = [
//                $actions->getVerExpediente(),
//                $actions->getEnlacePlacsp(),
//                $actions->getCrearIncidencia(self::PLACSP_ANUNCIO),
//            ],
//
//            self::PLACSP_CONTRATO_MAYOR => $array = [
////                $actions->getViewAction(),
//                $actions->getVerExpediente(),
//                $actions->getEnlacePlacsp(),
//                $actions->getCrearIncidencia(self::PLACSP_CONTRATO_MAYOR),
//            ],

            self::PLACSP_RESPUESTAS_INCIDENCIA => $array = [
//                $actions->getCreateAction(),
                $actions->getViewAction(),
            ],

            self::PLACSP_INCIDENCIA => $array = [
//                $actions->getCreateAction(),
                $actions->getViewIncidencia_ViewAction_Infolist(),
                $actions->getViewIncidencia_Action_Infolist(),
//                $actions->getViewIncidencia_Action_SimpleInfolist(),
                $actions->getCrearRespuestaIncidencia(),
            ],

            default => $array = [
                $actions->getViewAction(),

            ],
        };

        return ActionGroup::make(array_merge($array))
            ->tooltip(ConstantesString::ACCIONES_DIPONIBLES->value)
            ->color(Color::Blue);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getViewPageActions(): array
    {
        $constructor = new ActionsConstructor;

        // Acciones específicas por modelo
        return  match ($this) {

//            self::PLACSP_ADJUDICACION,
//            self::PLACSP_ANUNCIO,
//            self::PLACSP_CONDICION_ESPECIAL_EJECUCION,
//            self::PLACSP_CONSULTA_PRELIMINAR_MERCADO,
//            self::PLACSP_CPV,
//            self::PLACSP_CRITERIO_ADJUDICACION,
//            self::PLACSP_DOCUMENTO,
//            self::PLACSP_CONTRATO_MAYOR,
//            self::PLACSP_LOTE,
//            self::PLACSP_MODIFICACION,
//            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => [
//
//            ],

            default => [
//                $constructor->getEditAction(),
//                $constructor->getCreateAction(),
            ],
        };
    }

    /**
     * @return ActionGroup
     */
    public function getTableHeaderActions(): ActionGroup
    {

        $actionsConstructor = new ActionsConstructor;

        match ($this) {

            self::PLACSP_RESPUESTAS_INCIDENCIA => $acciones = [
//                $actionsConstructor->getCreateAction(),
            ],

            self::PLACSP_INCIDENCIA => $acciones = [
//                $actionsConstructor->getCreateAction(),
            ],

            default => $acciones = [ ],

        };

        return ActionGroup::make(array_merge($acciones))
            ->color(Color::Green)
            ->button()
            ->label(ConstantesString::ACCIONES_DIPONIBLES->value);
    }

    /**
     * @return BulkAction[]
     */
    public function getTableBulkActions(): array
    {
        return [];
    }

    /**
     * @return array<int,string>
     */
    public function getColor(): array
    {

        return match ($this) {

            default => Color::Neutral,
        };
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {

        return match ($this) {

            self::PLACSP_INCIDENCIA => 'heroicon-o-user-plus',
            self::PLACSP_RESPUESTAS_INCIDENCIA => 'heroicon-o-user-plus',

            default => 'heroicon-o-no-symbol'
        };
    }

    /**
     * @return string|null
     */
    public function getRecordTitleAttribute(): ?string
    {

        return match ($this) {

            default => null
        };
    }

    /**
     * @return string
     */
    public function getModel(): string
    {

        return match ($this) {

            self::PLACSP_INCIDENCIA => Incidencia::class,
            self::PLACSP_RESPUESTAS_INCIDENCIA => RespuestasIncidencia::class,
        };
    }

    /**
     * @return class-string
     */
    public function getResource(): string
    {

        return match ($this) {

            self::PLACSP_INCIDENCIA => IncidenciaResource::class,
            self::PLACSP_RESPUESTAS_INCIDENCIA => RespuestasIncidenciaResource::class,

        };
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {

        return match ($this) {

            self::PLACSP_INCIDENCIA => 'incidencias',
            self::PLACSP_RESPUESTAS_INCIDENCIA => 'respuestas-incidencia',

            default => 'getSlug() - No implementado'
        };
    }

    /**
     * @return string
     */
    public function getDefaultSort(): string
    {
        return match ($this) {

            self::PLACSP_INCIDENCIA,
            self::PLACSP_RESPUESTAS_INCIDENCIA => 'updated_at',

            default => 'created_at',
        };
    }


    /**
     * @return String
     */
    public function getDefaultSortDirection(): string
    {

        return match ($this) {

            default => 'desc',
        };
    }

    /**
     * @return string
     */
    public function getTableHeading(): string
    {
        return match ($this) {

            self::PLACSP_INCIDENCIA => 'Listado de incidencias',
            self::PLACSP_RESPUESTAS_INCIDENCIA => 'Listado de respuestas a incidencias',

            default => 'getTableHeading - no implementado'
        };
    }

    /**
     * @return string
     */
    public function getTableDescription(): string
    {
        return match ($this) {

            self::PLACSP_INCIDENCIA => 'Tabla de incidencias',
            self::PLACSP_RESPUESTAS_INCIDENCIA => 'Tabla de respuestas a incidencias',

            default => 'getTableDescription - no implementado'
        };
    }

    /**
     * @return string
     */
    public function getInfolistHeading(): string
    {
        return match ($this) {


            self::PLACSP_INCIDENCIA => 'Ficha de una incidencia',
            self::PLACSP_RESPUESTAS_INCIDENCIA => 'Ficha de una respuesta a incidencia',

            default => 'getInfolistHeading - no implementado'
        };
    }

    /**
     * @return string
     */
    public function getInfolistDescription(): string
    {
        return match ($this) {

            self::PLACSP_INCIDENCIA => 'Información ampliada de una incidencia',
            self::PLACSP_RESPUESTAS_INCIDENCIA => 'Información ampliada de una respuesta a una incidencia',

            default => 'getInfolistDescription - no implementado'
        };
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {

        return match ($this) {

            self::PLACSP_INCIDENCIA => 'Incidencias',
            self::PLACSP_RESPUESTAS_INCIDENCIA => 'Respuestas a Incidencias',

            default => 'getLabel - no implementado'

        };
    }

    /**
     * @return string
     */
    public function getModelLabel(): string
    {

        return $this->getLabel();
    }

    /**
     * @return string
     */
    public function getFormHeading(): string
    {
        return 'Formulario para crear / editar registros.';
    }

    /**
     * @return string
     */
    public function getFormDescription(): string
    {
        return 'Los campos marcados con * son obligatorios.';
    }

    /**
     * @return int
     */
    public function getSort(): int
    {

        return match ($this) {

            // TODO: Que orden ponemos
            self::PLACSP_INCIDENCIA => 62,
            self::PLACSP_RESPUESTAS_INCIDENCIA => 63,

        };
    }

    public function getRegisterNavigation(): bool
    {

        return match ($this) {

            default => true,
        };
    }

    /**
     * @return FiltersLayout
     */
    public function getFilterLayout(): FiltersLayout
    {

        return FiltersLayout::AboveContent;
    }

    /**
     * @return string
     */
    public function getMiNavigationGroup(): ?string
    {

        return match ($this) {

            self::PLACSP_RESPUESTAS_INCIDENCIA => null, // No se muestra en ningún grupo
            self::PLACSP_INCIDENCIA => null, // No se muestra en ningún grupo

        };
    }

    /**
     * @throws Exception
     */
    public static function getMiNavigationItemFromMiRelationManager (MiRelationManagerIncidencias $miRelationManager): MiNavigationItemIncidencias
    {
        return match ($miRelationManager) {

            MiRelationManagerIncidencias::PLACSP_INCIDENCIA => self::PLACSP_INCIDENCIA,
            MiRelationManagerIncidencias::PLACSP_RESPUESTAS_INCIDENCIA => self::PLACSP_RESPUESTAS_INCIDENCIA,

        };
    }

    public function getTitle(Model $record): string|Htmlable
    {
        return match($this) {
//            self::PLACSP_CONSULTA_PRELIMINAR_MERCADO => 'Consulta #' . $record->getAttribute('preliminary_market_consultation_id'),
            default => $this->getLabel(),
        };
    }
}
