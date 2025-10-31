<?php

namespace App\Enums\Acciones;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum AccionesImportarEntry: string implements HasLabel, HasColor, HasIcon, HasDescription
{
    case REGISTRAR = 'REGISTRAR';
    case PROPUESTO_INSERTAR = 'PROPUESTO_INSERTAR';
    case INSERTAR = 'INSERTAR';
    case ACTUALIZAR = 'ACTUALIZAR';
    case ELIMINAR = 'ELIMINAR';
    case RECHAZAR = 'RECHAZAR';

    public function getLabel(): string
    {
        return match ($this) {

            self::REGISTRAR => 'Registrar',
            self::PROPUESTO_INSERTAR => 'Propuesto insertar',
            self::INSERTAR => 'Insertar',
            self::ACTUALIZAR => 'Actualziar',
            self::ELIMINAR => 'Eliminar',
            self::RECHAZAR => 'Rechazar',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {

            self::REGISTRAR => 'heroicon-o-document-check',
            self::PROPUESTO_INSERTAR => 'heroicon-o-document-plus',
            self::INSERTAR => 'heroicon-o-plus-circle',
            self::ACTUALIZAR => 'heroicon-o-pencil-square',
            self::ELIMINAR => 'heroicon-o-minus-circle',
            self::RECHAZAR => 'heroicon-o-shield-exclamation',
        };
    }

    /**
     * @return string|array<int,string>
     */
    public function getColor(): string|array
    {
        return match ($this) {
            self::REGISTRAR => Color::Amber,
            self::PROPUESTO_INSERTAR => Color::Teal,
            self::INSERTAR => Color::Green,
            self::ACTUALIZAR => Color::Orange,
            self::ELIMINAR => Color::Red,
            self::RECHAZAR => Color::Gray,
        };
    }

    public function getDescription(): string
    {
        return match ($this) {

            self::REGISTRAR => 'Cuando el Entry en Base de Datos es mayor o igual que el Entry en Memoria',
            self::PROPUESTO_INSERTAR => 'quellos Entry que NO EXISTEN en el MAP de la ejecución pero pueden existir en la base de datos. Tiene sentido cuendo importamos desde INTERNET',
            self::INSERTAR => 'Aquellos Entry que NO EXISTEN en el MAP de la ejecución ni en la base de datos y por tanto se añaden a este',
            self::ACTUALIZAR => 'Actualización de los valores que existían por unos más recientes',
            self::ELIMINAR => 'Eliminar el registro de la base de datos',
            self::RECHAZAR => 'Se rechaza cuando el Entry no pertnece al filtro aplicado',
        };
    }

    /**
     * @return array<string, mixed>
     */
    public static function ordenar(): array
    {

        return sortEnumByLabel(self::cases());
    }
}

