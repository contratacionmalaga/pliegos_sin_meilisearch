<?php

namespace App\DTOs;

class ToogleConfig
{
    /**
     * @param string $make
     * @param int $columnSpan
     * @param string|null $label
     * @param bool|null   $default
     */
    public function __construct(
        public string $make,
        public int $columnSpan,
        public ?string $label = null,
        public ?bool $default = false,
    ) {}
}
