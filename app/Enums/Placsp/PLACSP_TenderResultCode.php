<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_TenderResultCode: string implements HasLabel, HasColor
{

    case AdjudicadoProvisionalmente = '1';
    case AdjudicadoDefinitivamente = '2';
    case Desierto = '3';
    case Desistimiento = '4';
    case Renuncia = '5';
    case DesiertoProvisionalmente = '6';
    case DesiertoDefinitivamente = '7';
    case Adjudicado = '8';
    case Formalizado = '9';
    case LicitadorMejorValorado = '10';
    case EncargoFormalizado = '11';

    public function getLabel(): string
    {
        return match ($this) {
            self::AdjudicadoProvisionalmente => 'Adjudicado Provisionalmente',
            self::AdjudicadoDefinitivamente => 'Adjudicado Definitivamente',
            self::Desierto => 'Desierto',
            self::Desistimiento => 'Desistimiento',
            self::Renuncia => 'Renuncia',
            self::DesiertoProvisionalmente => 'Desierto Provisionalmente',
            self::DesiertoDefinitivamente => 'Desierto Definitivamente',
            self::Adjudicado => 'Adjudicado',
            self::Formalizado => 'Formalizado',
            self::LicitadorMejorValorado => 'Licitador mejor valorado',
            self::EncargoFormalizado => 'Encargo Formalizado',
        };
    }

    public function getLabelTab(): string
    {
        return match ($this) {
            self::AdjudicadoProvisionalmente => 'Adj. Prov.',
            self::AdjudicadoDefinitivamente => 'Adj. Def.',
            self::Desierto => 'Desierto',
            self::Desistimiento => 'Desistimiento',
            self::Renuncia => 'Renuncia',
            self::DesiertoProvisionalmente => 'Des. Prov.',
            self::DesiertoDefinitivamente => 'Des. Def.',
            self::Adjudicado => 'Adjudicado',
            self::Formalizado => 'Formalizado',
            self::LicitadorMejorValorado => 'Mejor valorado',
            self::EncargoFormalizado => 'Encargo',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::AdjudicadoProvisionalmente => Color::Fuchsia,
            self::AdjudicadoDefinitivamente => Color::Orange,
            self::Desierto => Color::Slate,
            self::Desistimiento => Color::Yellow,
            self::Renuncia => Color::Lime,
            self::DesiertoProvisionalmente => Color::Green,
            self::DesiertoDefinitivamente => Color::Emerald,
            self::Adjudicado => Color::Teal,
            self::Formalizado => Color::Cyan,
            self::LicitadorMejorValorado => Color::Sky,
            self::EncargoFormalizado => Color::Blue,
        };
    }

    public static function ordenar(): array
    {

        return sortEnumByLabel(self::cases());
    }
}
