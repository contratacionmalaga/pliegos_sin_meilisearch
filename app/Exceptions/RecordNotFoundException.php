<?php

namespace App\Exceptions;

use Exception;

class RecordNotFoundException extends Exception
{
    public function __construct(string $message = "Registro no encontrado", int $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
