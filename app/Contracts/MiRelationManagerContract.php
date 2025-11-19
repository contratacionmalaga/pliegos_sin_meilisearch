<?php

namespace App\Contracts;

use Exception;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

interface MiRelationManagerContract extends HasIcon, HasColor, HasLabel
{

    /**
     * @return ActionGroup
     * @throws Exception
     */
    public function getTableRecordActions(): ActionGroup;


    /**
     * @return Filter[]
     * @throws Exception
     */
    public function getFilters(): array;


    /**
     * @return BulkAction[]
     */
    public function getTableBulkActions(): array;


    /**
     * @return string
     * @throws Exception
     */
    public function getModel(): string;


    /**
     * @return string
     */
    public function getSlug(): string;


    /**
     * @return string
     * @throws Exception
     */
    public function getLabel(): string;


    /**
     * @return string
     */
    public function getBadgeTooltip(): string;


    /**
     * @return string
     */
    public function getBadgeColor(): string;


    /**
     * @return string
     */
    public function getRelationshipName(): string;


    /**
     * @return string
     */
    public function getTableDescription(): string;


    /**
     * @return string
     * @throws Exception
     */
    public function getDefaultSort(): string;


    /**
     * @return string
     * @throws Exception
     */
    public function getDefaultSortDirection(): string;


    /**
     * @return string
     * @throws Exception
     */
    public function getInfolistDescription(): string;


    /**
     * @return string
     * @throws Exception
     */
    public function getInfolistHeading(): string;


    /**
     * @return array<int, string>
     * @throws Exception
     */
    public function getColor(): array;


    /**
     * @return string
     * @throws Exception
     */
    public function getIcon(): string;


    /**
     * @return FiltersLayout
     */
    public function getFilterLayout(): FiltersLayout;


    /**
     * @return ActionGroup
     * @throws Exception
     */
    public function getTableHeaderActions(): ActionGroup;

}
