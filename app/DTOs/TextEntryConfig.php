<?php

namespace App\DTOs;

class TextEntryConfig
{
    /**
     * @param string $make
     * @param int $columnSpan
     * @param string|null $label
     * @param bool $badge
     * @param bool $link
     * @param bool $money
     * @param string|null $dateFormat
     * @param bool $copyable
     */
    public function __construct(
        public string $make,
        public int $columnSpan,
        public string|null $label = null,
        public bool $badge = false,
        public bool $link = false,
        public bool $money = false,
        public ?string $dateFormat = null,
        public bool $copyable = false
    ) {}
}
