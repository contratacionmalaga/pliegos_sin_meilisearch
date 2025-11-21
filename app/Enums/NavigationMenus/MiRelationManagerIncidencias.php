<?php

namespace App\Enums\NavigationMenus;

use App\Enums\Constantes\ConstantesString;
use App\Filament\Components\Actions\ActionsConstructor;
use App\Filament\Components\Filters\Admin\EnumsSelectFilters;
use App\Filament\Components\Filters\Admin\EnumsTernaryFilters;
use Exception;
use Filament\Support\Colors\Color;
use App\Contracts\MiRelationManagerContract;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;

enum MiRelationManagerIncidencias: string implements MiRelationManagerContract
{


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
            $acciones = [],
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

        return match ($this) {

            default => [],
        };
    }

    /**
     * @return BulkAction[]
     */
    public function getTableBulkActions(): array
    {

        return [];
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
        return match ($this) {

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
            $acciones = []
        };

        return ActionGroup::make($acciones)
            ->color(Color::Amber)
            ->button()
            ->label('Acciones disponibles');
    }
}
