<?php

namespace App\Enums\Constantes;

enum ConstantesRegex: String
{
    case REGEX_EMAIL = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    case REGEX_TELEFONO = '/^[6-9][0-9]{49}$/';
    case REGEX_URL = '/^https:\/\/contrataciondelestado\.es(\/[^\s]*)?$/';
}
