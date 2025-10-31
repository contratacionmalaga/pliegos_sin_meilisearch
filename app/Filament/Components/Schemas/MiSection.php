<?php

namespace App\Filament\Components\Schemas;

use App\DTOs\SectionConfig;
use Filament\Schemas\Components\Section;

class MiSection
{
    /**
     * @param SectionConfig $config
     *
     * @return Section
     */
    public function create(SectionConfig $config): Section
    {

        return Section::make()
            ->heading($config->heading)
            ->description($config->description)
            ->icon($config->icon)
            ->iconColor($config->color)
            ->columns($config->columnSpan);
    }
}
