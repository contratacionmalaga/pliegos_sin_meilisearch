<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_SchemaName: string implements HasLabel, HasColor, HasIcon, HasDescription
{

    case NIF = 'NIF';
    case NIE = 'NIE';
    case UTE = 'UTE';
    case ID_PLATAFORMA = 'ID_PLATAFORMA';

    /**
     * @return array<string>
     */
    public static function getSchemeNameEmpresa(): array
    {

        $values = [
            self::NIF
        ];

        return sortEnumByValue($values);
    }

    /**
     * @return array<string, string>
     */
    public static function ordenar(): array
    {
        // Obtener todos los casos del enum y ordenarlos por la etiqueta
        return sortEnumByValue(self::cases());
    }

    /**
     * @return array<string>
     */
    public static function getSchemeNameEncargoMedioPropio(): array
    {
        return [
            self::ID_PLATAFORMA
        ];
    }

    /**
     * @return string|array|null
     */
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::NIF => Color::Purple,
            self::NIE => Color::Green,
            self::UTE => Color::Gray,
            self::ID_PLATAFORMA => Color::Blue,
        };
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return match ($this) {
            self::NIF => 'heroicon-o-identification',
            self::NIE => 'heroicon-s-identification',
            self::UTE => 'heroicon-o-users',
            self::ID_PLATAFORMA => 'heroicon-s-information-circle',
        };
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {

        return $this->getLabel();
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {

        return $this->value;
    }
}
