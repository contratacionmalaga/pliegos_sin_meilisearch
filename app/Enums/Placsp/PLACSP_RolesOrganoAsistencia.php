<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_RolesOrganoAsistencia: string implements HasLabel
{

    case SECRETARIO = 'secretario';
    case VOCAL = 'vocal';
    case VOCAL_JURIDICO = 'vocal-juridico';
    case VOCAL_INTERVENCION = 'vocal-intervencion';
    case GESTOR_OA = 'gestor-oa';
    case PRESIDENTE = 'presidente';

    public function getLabel(): string
    {
        return match ($this) {
            self::SECRETARIO => 'Secretario',
            self::VOCAL => 'Vocal',
            self::VOCAL_JURIDICO => 'Vocal Jurídico',
            self::VOCAL_INTERVENCION => 'Vocal de la Intervención',
            self::GESTOR_OA => 'Gestor',
            self::PRESIDENTE => 'Presidente',
        };
    }

    public function getObligatorio(): bool
    {

        return match ($this) {
            self::SECRETARIO => true,

            self::VOCAL,
            self::VOCAL_JURIDICO,
            self::VOCAL_INTERVENCION,
            self::GESTOR_OA,
            self::PRESIDENTE => false,
        };
    }

    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }
}
