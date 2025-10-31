<?php

namespace App\Enums\Constantes;

enum ConstantesFormato: String
{
    case FORMATO_FECHA_HORA_LARGA = 'd \\d\\e F \\d\\e Y \\a \\l\\a\\s H:i:s';
    case FORMATO_FECHA_LARGA = 'd \\d\\e F \\d\\e Y';

    case FORMATO_FECHA_HORA_CORTA = 'd-m-Y H:i:s';
    case FORMATO_FECHA_CORTA = 'd-m-Y';
}
