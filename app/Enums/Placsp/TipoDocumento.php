<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TipoDocumento: string implements HasLabel, HasIcon, HasColor, HasDescription
{

    // Tipos de criterios de adjudicación

    case ADDICIONAL = 'ADDICIONAL';
    case GENERAL = 'GENERAL';
    case PCAP = 'PCAP';
    case PPT = 'PPT';

    public function getLabel(): string
    {
        return match ($this) {
            self::ADDICIONAL => 'Anexos a los pliegos',
            self::GENERAL => 'Documento general',
            self::PCAP => 'PCAP',
            self::PPT => 'PPT',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::ADDICIONAL => 'heroicon-o-document-plus',
            self::GENERAL => 'heroicon-o-document-duplicate',
            self::PCAP => 'heroicon-o-document-check',
            self::PPT => 'heroicon-o-document-text',
        };
    }

    /**
     * @return array
     */
    public function getColor(): array
    {
        return match ($this) {
            self::ADDICIONAL => Color::Amber,
            self::GENERAL => Color::Green,
            self::PCAP => Color::Blue,
            self::PPT => Color::Purple,
        };
    }

    public function getDescription(): string
    {

        return match ($this) {
            self::ADDICIONAL => 'Documento con anexos a los pliegos',
            self::GENERAL => 'Docuemnto general',
            self::PCAP => 'Pliego de cláusulas administrativas particulares',
            self::PPT => 'Pliego de prescripciones técnicas',
        };
    }

    public static function ordenar(): array
    {

        return sortEnumByValue(self::cases());
    }
}
