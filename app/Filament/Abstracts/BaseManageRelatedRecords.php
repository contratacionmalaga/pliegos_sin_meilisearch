<?php

namespace App\Filament\Abstracts;

use App\Filament\Abstracts\Traits\ComunTrait;
use Filament\Resources\Pages\ManageRelatedRecords;

abstract class BaseManageRelatedRecords extends ManageRelatedRecords
{
    // Incorporo los métodos comunes
    use ComunTrait;
}
