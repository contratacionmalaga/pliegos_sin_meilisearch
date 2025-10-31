<?php

namespace App\DTOs;

class TextInputConfig
{
    /**
     * @param string      $make
     * @param int         $columnSpan
     * @param int         $characterLimit ,
     * @param bool        $required
     * @param string|null $table
     * @param string|null $column
     * @param bool        $email
     * @param string|null $class
     * @param bool        $numerico
     * @param bool        $link
     * @param bool        $invente
     * @param ?string     $label
     */
    public function __construct(
        public string $make,
        public int $columnSpan,
        public int $characterLimit,
        public bool $required = false,
        public ?string $table = null,
        public ?string $column = null,
        public ?string $class = null,
        public bool $email = false,
        public bool $numerico = false,
        public bool $link = false,
        public bool $invente = false,
        public ?string $label = null,
    ) {}
}
