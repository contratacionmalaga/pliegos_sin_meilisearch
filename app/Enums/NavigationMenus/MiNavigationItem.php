<?php

namespace App\Enums\NavigationMenus;

//use App\Enums\Acciones\Roles;
use App\Enums\Constantes\ConstantesString;
use App\Filament\Components\Actions\ActionsConstructor;
use App\Filament\Components\Actions\ActionsConstructorIncidencias;
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

enum MiNavigationItem: string implements MiNavigationItemContract
{



    case PLACSP_ADJUDICACION = 'adjudicacion';
    case PLACSP_ANUNCIO = 'anuncio';
    case PLACSP_CONDICION_ESPECIAL_EJECUCION = 'condiciones-especiales-ejecucion';
    case PLACSP_CONTRATO_MAYOR = 'contrato-mayor';

    case PLACSP_CONSULTA_PRELIMINAR_MERCADO = 'consulta-preliminar-mercado';
    case PLACSP_CPV = 'cpv';
    case PLACSP_CRITERIO_ADJUDICACION = 'criterios-adjudicacion';
    case PLACSP_DOCUMENTO = 'documento';
    case PLACSP_LOTE = 'lote';
    case PLACSP_MODIFICACION = 'modificacion';
    case PLACSP_REQUISITO_PREVIO_PARTICIPACION = 'requisito-previo-participacion';
    // case PLACSP_INCIDENCIA = 'incidencia';
    // case PLACSP_RESPUESTAS_INCIDENCIA = 'respuestas-incidencia';


    /**
     * @return bool
     */
    public function isNavigationItemPermisible(): bool
    {

        return match ($this) {

            self::PLACSP_ANUNCIO,
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION,
            self::PLACSP_CPV,
            self::PLACSP_CRITERIO_ADJUDICACION,
            self::PLACSP_LOTE,
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION,
            self::PLACSP_DOCUMENTO,
            self::PLACSP_MODIFICACION,
            self::PLACSP_CONTRATO_MAYOR,
            self::PLACSP_ADJUDICACION => true,

            default => false,
        };
    }

    public function getPermisibleNavigationItems(): array
    {
        return array_filter(
            self::cases(),
            static fn(self $item) => $item->isNavigationItemPermisible()
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

        //        $organismoFilter = new OrganismoFilter();
        //        $entidadFilter = new EntidadFilter();

        $enumsSelectFilters = new EnumsSelectFilters();
        $enumsTernaryFilters = new EnumsTernaryFilters();

        $miDateRangeFilter = new MiDateRangeFilter();

        $organoContratacionFilter = new OrganoContratacionFilter();

        return match ($this) {

            self::PLACSP_CONTRATO_MAYOR => [
                $organoContratacionFilter->getOrganoContratacionSelectFilter('id_plataforma_organo_contratacion', true),
                $enumsSelectFilters->getContractFolderStatusCodeSelectFilter(),
                $enumsSelectFilters->getTypeCodeSelectFilter(),
                $enumsSelectFilters->getProcedureCodeSelectFilter(),
                //                $miDateRangeFilter->getDateRangeFilterByUpdaded(),
            ],

            self::PLACSP_ADJUDICACION => [
                $organoContratacionFilter->getOrganoContratacionSelectFilter('id_plataforma_organo_contratacion', true),
                $enumsSelectFilters->getTypeCodeSelectFilter(),
                $enumsSelectFilters->getProcedureCodeSelectFilter(),
                $enumsSelectFilters->getResultCodeSelectFilter(),
                $enumsTernaryFilters->getPymeTernaryFilter(),
                //                $miDateRangeFilter->getDateRangeFilterByUpdaded(),
            ],

            self::PLACSP_MODIFICACION => [
                $enumsSelectFilters->getContractFolderStatusCodeSelectFilter(),
                $enumsSelectFilters->getTypeCodeSelectFilter(),
                $enumsSelectFilters->getProcedureCodeSelectFilter(),
                $organoContratacionFilter->getOrganoContratacionSelectFilter('id_plataforma_organo_contratacion', true),
                //                $miDateRangeFilter->getDateRangeFilterByUpdaded(),
            ],

            self::PLACSP_ANUNCIO => [
                $enumsSelectFilters->getTipoAnuncio(),
                $enumsSelectFilters->getContractFolderStatusCodeSelectFilter(),
                $enumsSelectFilters->getTypeCodeSelectFilter(),
                $enumsSelectFilters->getProcedureCodeSelectFilter(),
                $organoContratacionFilter->getOrganoContratacionSelectFilter('id_plataforma_organo_contratacion', true),
                $miDateRangeFilter->getDateRangeFilterByIssueDate(),
                //                $miDateRangeFilter->getDateRangeFilterByUpdaded(),
            ],

            self::PLACSP_DOCUMENTO => [
                $enumsSelectFilters->getTipoDocumento(),
                $enumsSelectFilters->getContractFolderStatusCodeSelectFilter(),
                $enumsSelectFilters->getTypeCodeSelectFilter(),
                $enumsSelectFilters->getProcedureCodeSelectFilter(),
                $organoContratacionFilter->getOrganoContratacionSelectFilter('id_plataforma_organo_contratacion', true),
                //                $miDateRangeFilter->getDateRangeFilterByUpdaded(),
            ],

            self::PLACSP_CRITERIO_ADJUDICACION => [
                $enumsSelectFilters->getTipoCriterio(),
                //                $enumsSelectFilters->getSubtipoCriterio(),
                $enumsSelectFilters->getContractFolderStatusCodeSelectFilter(),
                $enumsSelectFilters->getTypeCodeSelectFilter(),
                $enumsSelectFilters->getProcedureCodeSelectFilter(),
                $organoContratacionFilter->getOrganoContratacionSelectFilter('id_plataforma_organo_contratacion', true),
                //                $miDateRangeFilter->getDateRangeFilterByUpdaded(),
            ],

            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => [
                $enumsSelectFilters->getTipoRequisitoPrevioParticipacion(),
                $enumsSelectFilters->getContractFolderStatusCodeSelectFilter(),
                $enumsSelectFilters->getTypeCodeSelectFilter(),
                $enumsSelectFilters->getProcedureCodeSelectFilter(),
                $organoContratacionFilter->getOrganoContratacionSelectFilter('id_plataforma_organo_contratacion', true),
                //                $miDateRangeFilter->getDateRangeFilterByUpdaded(),
            ],

            self::PLACSP_CPV,
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION,
            self::PLACSP_LOTE => [
                $enumsSelectFilters->getContractFolderStatusCodeSelectFilter(),
                $enumsSelectFilters->getTypeCodeSelectFilter(),
                $enumsSelectFilters->getProcedureCodeSelectFilter(),
                $organoContratacionFilter->getOrganoContratacionSelectFilter('id_plataforma_organo_contratacion', true),
                //                $miDateRangeFilter->getDateRangeFilterByUpdaded(),
            ],

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
        $actionsIncidencias = new ActionsConstructorIncidencias();


        match ($this) {

            self::PLACSP_ANUNCIO => $array = [
                $actions->getVerExpediente(),
                $actions->getEnlacePlacsp(),
            ],

            self::PLACSP_CONDICION_ESPECIAL_EJECUCION,
            self::PLACSP_CONSULTA_PRELIMINAR_MERCADO,
            self::PLACSP_CPV,
            self::PLACSP_CRITERIO_ADJUDICACION,
            //            self::PLACSP_CONTRATO_MAYOR,
            self::PLACSP_LOTE,
            self::PLACSP_ADJUDICACION,
            self::PLACSP_MODIFICACION,
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => $array = [
                $actions->getVerExpediente(),
                $actions->getEnlacePlacsp()
            ],

            self::PLACSP_CONTRATO_MAYOR => $array = [
                //                $actions->getViewAction(),
                $actions->getVerExpediente(),
                $actions->getEnlacePlacsp(),
            ],

            //             self::PLACSP_RESPUESTAS_INCIDENCIA => $array = [
            // //                $actions->getCreateAction(),
            //                 $actions->getViewAction(),
            //             ],

            //             self::PLACSP_INCIDENCIA => $array = [
            // //                $actions->getCreateAction(),
            //                 $actionsIncidencias->getViewIncidencia_ViewAction_Infolist(),
            //                 $actionsIncidencias->getViewIncidencia_Action_Infolist(),
            // //                $actionsIncidencias->getViewIncidencia_Action_SimpleInfolist(),
            //                 $actionsIncidencias->getCrearRespuestaIncidencia(),
            //             ],

            self::PLACSP_DOCUMENTO => $array = [
                $actions->getEnlaceDocumento(),
                $actions->getVerExpediente(),
                $actions->getEnlacePlacsp()
            ],

            default => $array = [
                $actions->getViewAction(),

            ],
        };

        if (in_array(\App\Traits\HasIncidencias::class, class_uses_recursive($this->getModel()))) {
            $array[] = $actionsIncidencias->getCrearIncidencia($this);
        }

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

            self::PLACSP_ADJUDICACION,
            self::PLACSP_ANUNCIO,
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION,
            self::PLACSP_CONSULTA_PRELIMINAR_MERCADO,
            self::PLACSP_CPV,
            self::PLACSP_CRITERIO_ADJUDICACION,
            self::PLACSP_DOCUMENTO,
            self::PLACSP_CONTRATO_MAYOR,
            self::PLACSP_LOTE,
            self::PLACSP_MODIFICACION,
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => [],

            default => [
                $constructor->getEditAction(),
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

            //             self::PLACSP_RESPUESTAS_INCIDENCIA => $acciones = [
            // //                $actionsConstructor->getCreateAction(),
            //             ],

            //             self::PLACSP_INCIDENCIA => $acciones = [
            // //                $actionsConstructor->getCreateAction(),
            //             ],

            default =>

            $acciones = [],
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

            self::PLACSP_CONSULTA_PRELIMINAR_MERCADO => Color::Violet,
            self::PLACSP_CONTRATO_MAYOR => Color::Purple,
            self::PLACSP_ADJUDICACION => Color::Fuchsia,
            self::PLACSP_MODIFICACION => Color::Stone,
            self::PLACSP_DOCUMENTO => Color::Rose,
            self::PLACSP_ANUNCIO => Color::Slate,

            default => Color::Neutral,
        };
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {

        return match ($this) {

            self::PLACSP_ADJUDICACION => 'heroicon-o-sparkles',
            self::PLACSP_ANUNCIO => 'heroicon-o-megaphone',
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION => 'heroicon-o-truck',
            self::PLACSP_CONSULTA_PRELIMINAR_MERCADO => 'heroicon-o-phone',
            self::PLACSP_CPV => 'heroicon-o-numbered-list',
            self::PLACSP_CRITERIO_ADJUDICACION => 'heroicon-o-check-circle',
            self::PLACSP_DOCUMENTO => 'heroicon-o-document',
            self::PLACSP_CONTRATO_MAYOR => 'heroicon-o-truck',
            self::PLACSP_LOTE => 'heroicon-o-puzzle-piece',
            self::PLACSP_MODIFICACION => 'heroicon-o-pencil-square',
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => 'heroicon-o-user-plus',
            // self::PLACSP_INCIDENCIA => 'heroicon-o-user-plus',
            // self::PLACSP_RESPUESTAS_INCIDENCIA => 'heroicon-o-user-plus',

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


            self::PLACSP_ADJUDICACION => Adjudicacion::class,
            self::PLACSP_ANUNCIO => Anuncio::class,
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION => CondicionEspecialEjecucion::class,
            //            self::PLACSP_CONSULTA_PRELIMINAR_MERCADO => ConsultaPreliminarMercado::class,
            self::PLACSP_CPV => Cpv::class,
            self::PLACSP_CRITERIO_ADJUDICACION => CriterioAdjudicacion::class,
            self::PLACSP_DOCUMENTO => Documento::class,
            self::PLACSP_CONTRATO_MAYOR => ContratoMayor::class,
            self::PLACSP_LOTE => Lote::class,
            self::PLACSP_MODIFICACION => Modificacion::class,
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => RequisitoPrevioParticipacion::class,
            // self::PLACSP_INCIDENCIA => Incidencia::class,
            // self::PLACSP_RESPUESTAS_INCIDENCIA => RespuestasIncidencia::class,
        };
    }

    /**
     * @return class-string
     */
    public function getResource(): string
    {

        return match ($this) {

            self::PLACSP_ADJUDICACION => AdjudicacionResource::class,
            self::PLACSP_ANUNCIO => AnuncioResource::class,
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION => CondicionEspecialEjecucionResource::class,
            self::PLACSP_CPV => CpvResource::class,
            self::PLACSP_CRITERIO_ADJUDICACION => CriterioAdjudicacionResource::class,
            self::PLACSP_DOCUMENTO => DocumentoResource::class,
            self::PLACSP_CONTRATO_MAYOR => ContratoMayorResource::class,
            self::PLACSP_LOTE => LoteResource::class,
            self::PLACSP_MODIFICACION => ModificacionResource::class,
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => RequisitoPrevioParticipacionResource::class,
            // self::PLACSP_INCIDENCIA => IncidenciaResource::class,
            // self::PLACSP_RESPUESTAS_INCIDENCIA => RespuestasIncidenciaResource::class,

        };
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {

        return match ($this) {

            self::PLACSP_ADJUDICACION => 'adjudicaciones',
            self::PLACSP_ANUNCIO => 'anuncios',
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION => 'condiciones-especiales-ejecucion',
            self::PLACSP_CONSULTA_PRELIMINAR_MERCADO => 'consultas-preliminares-mercado',
            self::PLACSP_CPV => 'cpvs',
            self::PLACSP_CRITERIO_ADJUDICACION => 'criterios-adjudicacion',
            self::PLACSP_DOCUMENTO => 'documentos',
            self::PLACSP_CONTRATO_MAYOR => 'contratos-mayores',
            self::PLACSP_LOTE => 'lotes',
            self::PLACSP_MODIFICACION => 'modificaciones',
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => 'requisitos-previos-participacion',
            // self::PLACSP_INCIDENCIA => 'incidencias',
            // self::PLACSP_RESPUESTAS_INCIDENCIA => 'respuestas-incidencia',

            default => 'getSlug() - No implementado'
        };
    }

    /**
     * @return string
     */
    public function getDefaultSort(): string
    {
        return match ($this) {

            self::PLACSP_ADJUDICACION,
            self::PLACSP_ANUNCIO,
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION,
            self::PLACSP_CONSULTA_PRELIMINAR_MERCADO,
            self::PLACSP_CPV,
            self::PLACSP_CRITERIO_ADJUDICACION,
            self::PLACSP_DOCUMENTO,
            self::PLACSP_CONTRATO_MAYOR,
            self::PLACSP_LOTE,
            self::PLACSP_MODIFICACION,
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => 'updated',

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

            self::PLACSP_ADJUDICACION => 'Listado de adjudicaciones',
            self::PLACSP_CONTRATO_MAYOR => 'Listado de Contratos Mayores',

            default => 'getTableHeading - no implementado'
        };
    }

    /**
     * @return string
     */
    public function getTableDescription(): string
    {
        return match ($this) {

            self::PLACSP_ADJUDICACION,
            self::PLACSP_CONTRATO_MAYOR,
            self::PLACSP_MODIFICACION,

            self::PLACSP_ANUNCIO,
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION,
            self::PLACSP_CPV,
            self::PLACSP_CRITERIO_ADJUDICACION,
            self::PLACSP_DOCUMENTO,
            self::PLACSP_LOTE,
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => '',

            default => 'getTableDescription - no implementado'
        };
    }

    /**
     * @return string
     */
    public function getInfolistHeading(): string
    {
        return match ($this) {



            self::PLACSP_ADJUDICACION => 'Ficha de una adjudicación',
            self::PLACSP_CONTRATO_MAYOR => 'Ficha de un contrato mayor',

            default => 'getInfolistHeading - no implementado'
        };
    }

    /**
     * @return string
     */
    public function getInfolistDescription(): string
    {
        return match ($this) {

            self::PLACSP_ADJUDICACION => 'Información ampliada de una adjudicación',
            self::PLACSP_CONTRATO_MAYOR => 'Información ampliada de un contrato mayor',
            self::PLACSP_MODIFICACION => 'Información ampliada de una modificación',

            self::PLACSP_ANUNCIO => 'Información ampliada de un anuncio',
            self::PLACSP_DOCUMENTO => 'Información ampliada de un documento',

            // self::PLACSP_INCIDENCIA => 'Información ampliada de una incidencia',
            // self::PLACSP_RESPUESTAS_INCIDENCIA => 'Información ampliada de una respuesta a una incidencia',

            default => 'getInfolistDescription - no implementado'
        };
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {

        return match ($this) {

            self::PLACSP_ADJUDICACION => 'Adjudicaciones',
            self::PLACSP_ANUNCIO => 'Anuncios publicados',
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION => 'Condiciones de ejecución',
            //            self::PLACSP_CONSULTA_PRELIMINAR_MERCADO => 'Consultas de mercado',
            self::PLACSP_CPV => 'Códigos CPV',
            self::PLACSP_CRITERIO_ADJUDICACION => 'Criterios de adjudicación',
            self::PLACSP_DOCUMENTO => 'Documentos',
            self::PLACSP_CONTRATO_MAYOR => 'Expedientes Contratación',
            self::PLACSP_LOTE => 'Lotes',
            self::PLACSP_MODIFICACION => 'Modificaciones',
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => 'Requisitos previos',
            // self::PLACSP_INCIDENCIA => 'Incidencias',
            // self::PLACSP_RESPUESTAS_INCIDENCIA => 'Respuestas a Incidencias',

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

            self::PLACSP_ADJUDICACION => 51,
            self::PLACSP_ANUNCIO => 52,
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION => 53,
            self::PLACSP_CONSULTA_PRELIMINAR_MERCADO => 54,
            self::PLACSP_CPV => 55,
            self::PLACSP_CRITERIO_ADJUDICACION => 56,
            self::PLACSP_DOCUMENTO => 57,
            self::PLACSP_CONTRATO_MAYOR => 58,
            self::PLACSP_LOTE => 59,
            self::PLACSP_MODIFICACION => 60,
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => 61,
            // self::PLACSP_INCIDENCIA => 62,
            // self::PLACSP_RESPUESTAS_INCIDENCIA => 63,

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

            self::PLACSP_ADJUDICACION,
            self::PLACSP_ANUNCIO,
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION,
            self::PLACSP_CONSULTA_PRELIMINAR_MERCADO,
            self::PLACSP_CPV,
            self::PLACSP_CRITERIO_ADJUDICACION,
            self::PLACSP_DOCUMENTO,
            self::PLACSP_LOTE,
            self::PLACSP_MODIFICACION,
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => MiNavigationGroup::PLACSP->getLabel(),

            // self::PLACSP_RESPUESTAS_INCIDENCIA => null, // No se muestra en ningún grupo
            // self::PLACSP_INCIDENCIA => null, // No se muestra en ningún grupo
            self::PLACSP_CONTRATO_MAYOR => null, // No se muestra en ningún grupo

        };
    }

    /**
     * @throws Exception
     */
    public static function getMiNavigationItemFromMiRelationManager(MiRelationManager $miRelationManager): MiNavigationItem
    {
        return match ($miRelationManager) {

            MiRelationManager::PLACSP_ADJUDICACION => self::PLACSP_ADJUDICACION,
            MiRelationManager::PLACSP_ANUNCIO => self::PLACSP_ANUNCIO,
            MiRelationManager::PLACSP_CONDICION_ESPECIAL_EJECUCION => self::PLACSP_CONDICION_ESPECIAL_EJECUCION,
            MiRelationManager::PLACSP_CPV => self::PLACSP_CPV,
            MiRelationManager::PLACSP_CRITERIO_ADJUDICACION => self::PLACSP_CRITERIO_ADJUDICACION,
            MiRelationManager::PLACSP_DOCUMENTO => self::PLACSP_DOCUMENTO,
            MiRelationManager::PLACSP_CONTRATO_MAYOR => self::PLACSP_CONTRATO_MAYOR,
            MiRelationManager::PLACSP_LOTE => self::PLACSP_LOTE,
            MiRelationManager::PLACSP_MODIFICACION => self::PLACSP_MODIFICACION,
            MiRelationManager::PLACSP_REQUISITO_PREVIO_PARTICIPACION => self::PLACSP_REQUISITO_PREVIO_PARTICIPACION,
            // MiRelationManager::PLACSP_INCIDENCIA => self::PLACSP_INCIDENCIA,
            // MiRelationManager::PLACSP_RESPUESTAS_INCIDENCIA => self::PLACSP_RESPUESTAS_INCIDENCIA,

        };
    }

    public function getTitle(Model $record): string|Htmlable
    {
        return match ($this) {
            self::PLACSP_CONSULTA_PRELIMINAR_MERCADO => 'Consulta #' . $record->getAttribute('preliminary_market_consultation_id'),
            default => $this->getLabel(),
        };
    }
}
