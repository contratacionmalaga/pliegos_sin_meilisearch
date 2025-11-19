<?php

namespace App\Contracts;

use Filament\Actions\ActionGroup;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Tables\Enums\FiltersLayout;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

interface MiNavigationItemContract extends HasColor, HasIcon, HasLabel
{
    public function isNavigationItemPermisible(): bool;

    public function getPermisibleNavigationItems(): array;

    public function getFilters(): array;

    public function getListPageActions(): array;

    public function getTableRecordActions(): ActionGroup;

    public function getViewPageActions(): array;

    public function getTableHeaderActions(): ActionGroup;

    public function getTableBulkActions(): array;

    public function getRecordTitleAttribute(): ?string;

    public function getModel(): string;

    public function getResource(): string;

    public function getSlug(): string;

    public function getDefaultSort(): string;

    public function getDefaultSortDirection(): string;

    public function getTableHeading(): string;

    public function getTableDescription(): string;

    public function getInfolistHeading(): string;

    public function getInfolistDescription(): string;

    public function getModelLabel(): string;

    public function getFormHeading(): string;

    public function getFormDescription(): string;

    public function getSort(): int;

    public function getRegisterNavigation(): bool;

    public function getFilterLayout(): FiltersLayout;

    public function getMiNavigationGroup(): ?string;

    public function getTitle(Model $record): string|Htmlable;
}
