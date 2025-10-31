<?php

namespace App\Exceptions;

use Mockery\Exception;

class UserNotFoundException extends Exception
{
    public function __construct(string $message = "Usuario no encontrado", int $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function report(): void
    {
        \Log::error($this->getMessage(), ['code' => $this->getCode()]);
    }
}
