<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_SubmissionMethodCode: string implements HasLabel, HasColor, HasIcon
{

    case Electronica = '1';
    case Manual = '2';
    case Manual_Y_O_Electronica = '3';

    public static function ordenarContratoMenor(): array
    {
        $valores = [];

        foreach (self::cases() as $case) {
            if ($case->getActivo()) {
                $valores[] = $case;
            }
        }

        return sortEnumByValue($valores);
    }

    public function getActivo(): bool
    {
        return match ($this) {

            self::Manual => true,

            self::Electronica,
            self::Manual_Y_O_Electronica => false,
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Electronica => Color::Gray,
            self::Manual => Color::Green,
            self::Manual_Y_O_Electronica => Color::Purple,
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Electronica => 'heroicon-o-rocket-launch',
            self::Manual => 'heroicon-o-hand-raised',
            self::Manual_Y_O_Electronica => 'heroicon-o-chat-bubble-left-ellipsis',
        };
    }

    public function getDescription(): string
    {

        return $this->getLabel();
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::Electronica => 'Electrónica',
            self::Manual => 'Manual',
            self::Manual_Y_O_Electronica => 'Manual y/o Electrónica',
        };
    }
}


