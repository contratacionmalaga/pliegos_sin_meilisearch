<?php

namespace App\Enums\Constantes;

enum ConstantesString: string
{
    case INFORMACION_NO_DISPONIBLE = 'Información no disponible';
    case NO_FIGURA = '-';

    case FORM_SECTION_AUDITORIA_HEADING = 'Datos de auditoria';
    case FORM_SECTION_AUDITORIA_DESCRIPTION = 'Trazabilidad del registro';

    case FORM_SECTION_OBSERVACIONES_HEADING = 'Información ampliada del registro (Opcional)';
    case FORM_SECTION_OBSERVACIONES_DESCRIPTION = 'Introduzca una descripción detallada';

    case INFOLIST_SECTION_OBSERVACIONES_HEADING = 'Información ampliada del registro';
    case INFOLIST_SECTION_OBSERVACIONES_DESCRIPTION = 'Información adicional sobre el registro';

    case ERROR = 'Error. :causa';

    case FILTER_PLACEHOLDER = 'Todos';

    case ACCIONES_DIPONIBLES = 'Acciones disponibles';
    case ENLACE_INVENTE = 'https://www.pap.hacienda.gob.es/invente2/pagDetalleEnteSPI.aspx?codInvente=';
    case ABRIR_ENLACE = 'Abrir enlace en nueva pestaña';

    case NIF_DIPUTACION = 'P2900000G';

    case PASSWORD_LOCAL = 'local';
}
