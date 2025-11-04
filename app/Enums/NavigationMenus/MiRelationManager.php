<?php

namespace App\Enums\NavigationMenus;

use App\Enums\Constantes\ConstantesString;
use App\Filament\Components\Actions\ActionsConstructor;
use App\Filament\Components\Filters\Admin\EnumsSelectFilters;
use App\Filament\Components\Filters\Admin\EnumsTernaryFilters;
use Exception;
use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;

enum MiRelationManager: string implements HasIcon, HasColor, HasLabel
{


    case PLACSP_ADJUDICACION = 'adjudicacion';
    case PLACSP_ANUNCIO = 'anuncio';
    case PLACSP_CONDICION_ESPECIAL_EJECUCION = 'condiciones-especiales-ejecucion';
    case PLACSP_CPV = 'cpv';
    case PLACSP_CRITERIO_ADJUDICACION = 'criterios-adjudicacion';
    case PLACSP_DOCUMENTO = 'documento';
    case PLACSP_CONTRATO_MAYOR = 'contrato-mayor';
    case PLACSP_LOTE = 'lote';
    case PLACSP_MODIFICACION = 'modificacion';
    case PLACSP_REQUISITO_PREVIO_PARTICIPACION = 'requisito-previo-participacion';


    /**
     * @return ActionGroup
     * @throws Exception
     */
    public function getTableRecordActions(): ActionGroup
    {

        $miActiosConstructor = new ActionsConstructor;

        match ($this) {

            self::PLACSP_DOCUMENTO =>
            $acciones = [
                $miActiosConstructor->getEnlaceDocumento(),
            ],


            default =>
                $acciones = [
                ],
        };

        return ActionGroup::make($acciones)
                ->color(Color::Purple)
                ->tooltip(ConstantesString::ACCIONES_DIPONIBLES->value);
    }

    /**
     * @return Filter[]
     * @throws Exception
     */
    public function getFilters(): array
    {

        $enumsSelectFilters = new EnumsSelectFilters;
        $enumsTernaryFilters = new EnumsTernaryFilters;

        return match ($this) {


//            self::ENTIDAD => [
//                $enumsTernaryFilters->getActivoInactivoTernaryFilter()
//            ],

            default => [

            ],
        };
    }

    /**
     * @return BulkAction[]
     */
    public function getTableBulkActions(): array
    {

        return [

        ];
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getModel(): string
    {

        return MiNavigationItem::getMiNavigationItemFromMiRelationManager($this)->getModel();
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {

        return ' ';
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getLabel(): string
    {

        return MiNavigationItem::getMiNavigationItemFromMiRelationManager($this)->getLabel();

    }



    /**
     * @return string
     */
    public function getBadgeTooltip(): string
    {

        return match ($this) {


            self::PLACSP_ADJUDICACION => 'Número de adjudicaciones',
            self::PLACSP_ANUNCIO => 'Número de anuncios publicados',
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION => 'Número de condiciones especiales de ejecución',
            self::PLACSP_CRITERIO_ADJUDICACION => 'Número de criterios de adjudicación',
            self::PLACSP_CPV => 'Número de códigos CPV asociados',
            self::PLACSP_DOCUMENTO => 'Número de documentos publicados',
            self::PLACSP_CONTRATO_MAYOR => 'Número de contratos mayores',
            self::PLACSP_LOTE => 'Número de lotes',
            self::PLACSP_MODIFICACION => 'Número de modificaciones publicadas',
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => 'Número de requisitos previos de participación',
        };
    }

    /**
     * @return string
     */
    public function getBadgeColor(): string
    {
        // $badgeColor to either danger, gray, info, primary, success or warning
        return match ($this) {

            self::PLACSP_ADJUDICACION,
            self::PLACSP_ANUNCIO,
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION,
            self::PLACSP_CPV,
            self::PLACSP_CRITERIO_ADJUDICACION,
            self::PLACSP_DOCUMENTO,
            self::PLACSP_CONTRATO_MAYOR,
            self::PLACSP_LOTE,
            self::PLACSP_MODIFICACION,
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => 'warning',


//            self::ENTIDAD => 'primary',
        };
    }

    /**
     * @return string
     */
    public function getRelationshipName(): string
    {

        return match ($this) {

            self::PLACSP_ADJUDICACION => 'adjudicaciones',
            self::PLACSP_ANUNCIO => 'anuncios',
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION => 'condiciones_especiales_ejecucion',
            self::PLACSP_CPV => 'cpvs',
            self::PLACSP_CRITERIO_ADJUDICACION => 'criterios_adjudicacion',
            self::PLACSP_DOCUMENTO => 'documentos',
            self::PLACSP_CONTRATO_MAYOR => 'contratos_mayores',
            self::PLACSP_LOTE => 'lotes',
            self::PLACSP_MODIFICACION => 'modificaciones',
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => 'requisitos_previos_participacion',
        };
    }

    /**
     * @return string
     */
    public function getTableDescription(): string
    {
        return match($this) {

//            self::ENTIDAD => 'Listado de las entidades asociadas al organismo',

            self::PLACSP_ADJUDICACION => 'Listado de adjudicaciones',
            self::PLACSP_ANUNCIO => 'Listados de anuncios publicados en la Plataforma de Contratación del Sector Público',
            self::PLACSP_CONDICION_ESPECIAL_EJECUCION => 'Listado de condiciones especiales de ejecución definidas en el expediente',
            self::PLACSP_CPV => 'Listado los códigos cpvs asignados al expediente',
            self::PLACSP_CRITERIO_ADJUDICACION => 'Listado de los criterios de adjudicación definidos en el expediente',
            self::PLACSP_DOCUMENTO => 'Listado de los documentos anexados al expediente',
            self::PLACSP_CONTRATO_MAYOR => 'Listados de Contratos Mayores',
            self::PLACSP_LOTE => 'Listado de los lotes definidos en el expediente',
            self::PLACSP_MODIFICACION => 'Listado de las modificaciones publicadas en el expediente',
            self::PLACSP_REQUISITO_PREVIO_PARTICIPACION => 'Listado de los requisitos previos de participación definidos en el expediente',

            default => 'Listado',
        };
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getDefaultSort(): string
    {

        return MiNavigationItem::getMiNavigationItemFromMiRelationManager($this)->getDefaultSort();
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getDefaultSortDirection(): string
    {

        return MiNavigationItem::getMiNavigationItemFromMiRelationManager($this)->getDefaultSortDirection();
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getInfolistDescription(): string
    {

        return MiNavigationItem::getMiNavigationItemFromMiRelationManager($this)->getInfolistDescription();
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getInfolistHeading(): string
    {

        return MiNavigationItem::getMiNavigationItemFromMiRelationManager($this)->getInfolistHeading();
    }

    /**
     * @return array<int, string>
     * @throws Exception
     */
    public function getColor(): array
    {

        return MiNavigationItem::getMiNavigationItemFromMiRelationManager($this)->getColor();
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getIcon(): string
    {

        return MiNavigationItem::getMiNavigationItemFromMiRelationManager($this)->getIcon();
    }

    /**
     * @return FiltersLayout
     */
    public function getFilterLayout(): FiltersLayout
    {
        return FiltersLayout::Dropdown;
    }

    /**
     * @return ActionGroup
     * @throws Exception
     */
    public function getTableHeaderActions(): ActionGroup
    {
        $actionsConstructor = new ActionsConstructor;

        match ($this) {

            default =>
                $acciones = [

                ]
        };

        return ActionGroup::make($acciones)
            ->color(Color::Amber)
            ->button()
            ->label('Acciones disponibles');
    }
}
