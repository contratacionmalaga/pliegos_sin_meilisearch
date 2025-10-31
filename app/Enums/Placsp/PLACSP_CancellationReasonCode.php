<?php

namespace App\Enums\Placsp;

use Filament\Support\Contracts\HasLabel;

enum PLACSP_CancellationReasonCode: string implements HasLabel
{
    case ResolucionTribunalAdministrativo = '1';
    case AnuncioPublicadoPorError = '2';
    case Otro = '9999';

    public function getLabel(): string
    {
        return match ($this) {
            self::ResolucionTribunalAdministrativo => 'Resolución del Tribunal Administrativo',
            self::AnuncioPublicadoPorError => 'Anuncio publicado por error',
            self::Otro => 'Otro',
        };
    }

    public function getDescription(): string
    {

        return $this->getLabel();
    }

    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }
}
