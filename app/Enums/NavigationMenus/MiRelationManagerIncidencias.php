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

enum MiRelationManagerIncidencias: string implements HasIcon, HasColor, HasLabel
{


//    case PLACSP_ADJUDICACION = 'adjudicacion';
//    case PLACSP_ANUNCIO = 'anuncio';
//    case PLACSP_CONDICION_ESPECIAL_EJECUCION = 'condiciones-especiales-ejecucion';
//    case PLACSP_CPV = 'cpv';
//    case PLACSP_CRITERIO_ADJUDICACION = 'criterios-adjudicacion';
//    case PLACSP_DOCUMENTO = 'documento';
//    case PLACSP_CONTRATO_MAYOR = 'contrato-mayor';
//    case PLACSP_LOTE = 'lote';
//    case PLACSP_MODIFICACION = 'modificacion';
//    case PLACSP_REQUISITO_PREVIO_PARTICIPACION = 'requisito-previo-participacion';
    case PLACSP_INCIDENCIA = 'incidencia';
    case PLACSP_RESPUESTAS_INCIDENCIA = 'respuestas-incidencia';


    /**
     * @return ActionGroup
     * @throws Exception
     */
    public function getTableRecordActions(): ActionGroup
    {

        $miActiosConstructor = new ActionsConstructor;

        match ($this) {


            self::PLACSP_INCIDENCIA =>
            $acciones = [
                $miActiosConstructor->getViewIncidencia_ViewAction_Infolist(),
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

        return MiNavigationItemIncidencias::getMiNavigationItemFromMiRelationManager($this)->getModel();
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

        return MiNavigationItemIncidencias::getMiNavigationItemFromMiRelationManager($this)->getLabel();

    }



    /**
     * @return string
     */
    public function getBadgeTooltip(): string
    {

        return match ($this) {


            self::PLACSP_INCIDENCIA => 'Número de indidencias',
        };
    }

    /**
     * @return string
     */
    public function getBadgeColor(): string
    {
        // $badgeColor to either danger, gray, info, primary, success or warning
        return match ($this) {

            self::PLACSP_INCIDENCIA => 'warning',

        };
    }

    /**
     * @return string
     */
    public function getRelationshipName(): string
    {

        return match ($this) {

            self::PLACSP_RESPUESTAS_INCIDENCIA => 'respuestas',
            self::PLACSP_INCIDENCIA => 'incidencias',
        };
    }

    /**
     * @return string
     */
    public function getTableDescription(): string
    {
        return match($this) {

            self::PLACSP_INCIDENCIA => 'Listado de incidencias',
            self::PLACSP_RESPUESTAS_INCIDENCIA => 'Listado de respuestas a incidencias',

            default => 'Listado',
        };
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getDefaultSort(): string
    {

        return MiNavigationItemIncidencias::getMiNavigationItemFromMiRelationManager($this)->getDefaultSort();
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getDefaultSortDirection(): string
    {

        return MiNavigationItemIncidencias::getMiNavigationItemFromMiRelationManager($this)->getDefaultSortDirection();
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getInfolistDescription(): string
    {

        return MiNavigationItemIncidencias::getMiNavigationItemFromMiRelationManager($this)->getInfolistDescription();
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getInfolistHeading(): string
    {

        return MiNavigationItemIncidencias::getMiNavigationItemFromMiRelationManager($this)->getInfolistHeading();
    }

    /**
     * @return array<int, string>
     * @throws Exception
     */
    public function getColor(): array
    {

        return MiNavigationItemIncidencias::getMiNavigationItemFromMiRelationManager($this)->getColor();
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getIcon(): string
    {
        return MiNavigationItemIncidencias::getMiNavigationItemFromMiRelationManager($this)->getIcon();
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
