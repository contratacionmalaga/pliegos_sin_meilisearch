<?php

namespace App\DTOs;

use Filament\Support\Colors\Color;

class SectionConfig
{
    /**
     * @param string  $description
     * @param string  $icon
     * @param int     $columnSpan
     * @param ?array  $color
     * @param ?string $heading
     */
    public function __construct(
        public string  $description,
        public string  $icon,
        public int     $columnSpan = 12,
        public ?array  $color = Color::Blue,
        public ?string $heading = null,
    ) {}
}
