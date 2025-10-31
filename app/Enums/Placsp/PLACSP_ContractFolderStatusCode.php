<?php

namespace App\Enums\Placsp;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PLACSP_ContractFolderStatusCode: string implements HasLabel, HasColor
{

    case Creada = 'CREA';
    case Anuncio_Previo = 'PRE';
    case Publicada = 'PUB';
    case Evaluacion_Previa = 'EV_PRE';
    case Evaluacion_Previa_Definitiva = 'EV_PRE_DEF';
    case Evaluacion = 'EV';
    case Evaluacion_Definitiva = 'EV_DEF';
    case Parcialmente_Adjudicada = 'ADJ_PAR';
//    case Adjudicada = 'ADJUDICADA';
    case Adjudicada = 'ADJ';
    case Resolucion_Provisional = 'PAR_RES';
    case Parcialmente_Resuelta = 'RES_PAR';
    case Resuelta = 'RES';
    case Anulada = 'ANUL';
    case Cerrada = 'CERR';


//    public function getLabel(): string
//    {
//        return $this->name;
//    }

    public function getLabel(): string
    {
        return match ($this) {
            self::Creada => 'Creada',
            self::Anuncio_Previo => 'Anuncio previo',
            self::Publicada => 'Publicada',
            self::Evaluacion_Previa => 'Evaluación previa',
            self::Evaluacion_Previa_Definitiva => 'Evaluación previa definitiva',
            self::Evaluacion => 'Evaluación',
            self::Evaluacion_Definitiva => 'Evaluación definitiva',
            self::Parcialmente_Adjudicada => 'Parcialmente adjudicada',
            self::Adjudicada => 'Adjudicada',
            self::Resolucion_Provisional => 'Resolución provisional',
            self::Parcialmente_Resuelta => 'Parcialmente resuelta',
            self::Resuelta => 'Resuelta',
            self::Anulada => 'Anulada',
            self::Cerrada => 'Cerrada',
        };
    }

    public function getShortLabel(): string
    {
        return match ($this) {
            self::Creada => 'Creada',
            self::Anuncio_Previo => 'Anuncio previo',
            self::Publicada => 'Publicada',
            self::Evaluacion_Previa => 'Evaluación previa',
            self::Evaluacion_Previa_Definitiva => 'Evaluación prev. def.',
            self::Evaluacion => 'Evaluación',
            self::Evaluacion_Definitiva => 'Evaluación definitiva',
            self::Parcialmente_Adjudicada => 'Parcialmente adjudicada',
            self::Adjudicada => 'Adjudicada',
            self::Resolucion_Provisional => 'Resolución provisional',
            self::Parcialmente_Resuelta => 'Parcialmente resuelta',
            self::Resuelta => 'Resuelta',
            self::Anulada => 'Anulada',
            self::Cerrada => 'Cerrada',
        };
    }

    public function getTinyLabel(): string
    {
        return match ($this) {
            self::Creada => 'Creada',
            self::Anuncio_Previo => 'Anuncio',
            self::Publicada => 'Pub.',
            self::Evaluacion_Previa => 'Ev. previa',
            self::Evaluacion_Previa_Definitiva => 'Ev. prev. def.',
            self::Evaluacion => 'Ev.',
            self::Evaluacion_Definitiva => 'Ev. def.',
            self::Parcialmente_Adjudicada => 'Adj. par.',
            self::Adjudicada => 'Adj.',
            self::Resolucion_Provisional => 'Res. prov.',
            self::Parcialmente_Resuelta => 'Res. par.',
            self::Resuelta => 'Res.',
            self::Anulada => 'Anul.',
            self::Cerrada => 'Cerr.',
        };
    }


    public function getLabelReducida(): string
    {

        return match ($this) {
            self::Creada => 'Creada',
            self::Anuncio_Previo => 'Anun. Prev.',
            self::Publicada => 'Publicada',
            self::Evaluacion_Previa => 'Eval. Previa',
            self::Evaluacion_Previa_Definitiva => 'Eval. Previa Def.',
            self::Evaluacion => 'Evaluacion',
            self::Evaluacion_Definitiva => 'Eval. Definitiva',
            self::Parcialmente_Adjudicada => 'Parc. Adjudicada',
            self::Adjudicada => 'Adjudicada',
            self::Resolucion_Provisional => 'Res. Provisional',
            self::Parcialmente_Resuelta => 'Parc. Resuelta',
            self::Resuelta => 'Resuelta',
            self::Anulada => 'Anulada',
            self::Cerrada => 'Cerrada',
//            self::Creada =>                         'Creada',
//            self::Anuncio_Previo =>                 'Anun. Prev.',
//            self::Publicada =>                      'Publicada',
//            self::Evaluacion_Previa =>              'Eval. Previa',
//            self::Evaluacion_Previa_Definitiva =>   'Eval. Previa Def.',
//            self::Evaluacion =>                     'Evaluacion',
//            self::Evaluacion_Definitiva =>          'Eval. Definitiva',
//            self::Parcialmente_Adjudicada =>        'Parc. Adjudicada',
//            self::Adjudicada =>                     'Adjudicada',
//            self::Resolucion_Provisional =>         'Res. Provisional',
//            self::Parcialmente_Resuelta =>          'Parc. Resuelta',
//            self::Resuelta =>                       'Resuelta',
//            self::Anulada =>                        'Anulada',
//            self::Cerrada =>                        'Cerrada',
        };

    }


    public static function ordenar(): array
    {

        return sortEnumByLabel(self::cases());
    }


    /**
     * @return string|array|null
     */
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Creada => Color::Lime,
            self::Anuncio_Previo => Color::Green,
            self::Publicada => Color::Emerald,
            self::Evaluacion_Previa => Color::Teal,
            self::Evaluacion_Previa_Definitiva => Color::Cyan,
            self::Evaluacion => Color::Sky,
            self::Evaluacion_Definitiva => Color::Blue,
            self::Parcialmente_Adjudicada => Color::Indigo,
            self::Adjudicada => Color::Violet,
            self::Resolucion_Provisional => Color::Purple,
            self::Parcialmente_Resuelta => Color::Fuchsia,
            self::Resuelta => Color::Pink,
            self::Anulada => Color::Rose,
            self::Cerrada => Color::Slate,
        };
    }

    /**
     * @return string|null
     */
    public function getColorHex(): ?string
    {
        return match ($this) {
            self::Creada => '#84cc16',   // Lime-500
            self::Anuncio_Previo => '#22c55e',   // Green-500
            self::Publicada => '#10b981',   // Emerald-500
            self::Evaluacion_Previa => '#14b8a6',   // Teal-500
            self::Evaluacion_Previa_Definitiva => '#06b6d4',   // Cyan-500
            self::Evaluacion => '#0ea5e9',   // Sky-500
            self::Evaluacion_Definitiva => '#3b82f6',   // Blue-500
            self::Parcialmente_Adjudicada => '#6366f1',   // Indigo-500
            self::Adjudicada => '#8b5cf6',   // Violet-500
            self::Resolucion_Provisional => '#a855f7',   // Purple-500
            self::Parcialmente_Resuelta => '#d946ef',   // Fuchsia-500
            self::Resuelta => '#ec4899',   // Pink-500
            self::Anulada => '#f43f5e',   // Rose-500
            self::Cerrada => '#64748b',   // Slate-500
            default => '#ef4444',   // Red-500
        };
    }

}


