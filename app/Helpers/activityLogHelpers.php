<?php

use App\Enums\Constantes\ConstantesString;
use App\Enums\NavigationMenus\MiNavigationItem;
use App\Repositories\UnidadOrganicaRepository;
use App\Repositories\UserRepository;

/**
 * Devuelve una etiqueta personalizada para el subject_id dependiendo del tipo
 *
 * @param string $type
 * @param int|string|null $id
 * @return string
 */
function resolveSubjectLabelByType(string $type, int|string|null $id): string
{
    return match ($type) {
        MiNavigationItem::USUARIO->getModel()
        => (new UserRepository())->getEmailById($id),
        MiNavigationItem::UNIDAD_ORGANICA->getModel()
        => (new UnidadOrganicaRepository())->getUnidadOrganicaById($id),
        default => $id,
    } ?? ConstantesString::NO_FIGURA->value;
}

/**
 * Devuelve una etiqueta personalizada para el causer_id dependiendo del tipo
 *
 * @param string $type
 * @param int|string|null $id
 * @return string
 */
function resolveCauserLabelByType(string $type, int|string|null $id): string
{
    return match ($type) {
        MiNavigationItem::USUARIO->getModel() => (new UserRepository())->getEmailById($id) ?? ConstantesString::NO_FIGURA->value,
        default => ConstantesString::INFORMACION_NO_DISPONIBLE->value,
    };
}
