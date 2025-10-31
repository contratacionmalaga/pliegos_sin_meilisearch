<?php

namespace App\Filament\Abstracts;

use App\Filament\Abstracts\Traits\ComunTrait;
use Filament\Resources\Pages\EditRecord;

abstract class BaseEditRecord extends EditRecord
{
    // Incorporo los métodos comunes
    use ComunTrait;
}
