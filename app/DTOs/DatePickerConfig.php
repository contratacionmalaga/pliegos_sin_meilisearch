<?php

namespace App\DTOs;

class DatePickerConfig
{
    /**
     * @param string $make
     * @param int    $columnSpan
     * @param bool   $required
     * @param ?string $label
    */
    public function __construct(
        public string $make,
        public int $columnSpan,
        public bool $required = false,
        public ?string $label = null,
    ) {}
}
