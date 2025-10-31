<?php

namespace App\Filament\Abstracts;

use App\Filament\Abstracts\Traits\ComunTrait;
use Filament\Resources\Pages\CreateRecord;

abstract class BaseCreateRecord extends CreateRecord
{
    // Incorporo los métodos comunes
    use ComunTrait;

    /**
     * Defino la variable para crear un único elemento cada vez
     */
    protected static bool $canCreateAnother = false;
}
