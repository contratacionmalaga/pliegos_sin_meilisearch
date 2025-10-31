<?php

namespace App\Filament\Resources\ActivityLogs\Schemas;

use App\DTOs\SectionConfig;
use App\Enums\Constantes\ConstantesInt;
use App\Enums\NavigationMenus\MiNavigationItem;
use App\Filament\Components\Infolists\MiInfolist;
use App\Filament\Components\Infolists\MiKeyValueEntry;
use App\Filament\Components\Infolists\MiTextEntry;
use App\Filament\Components\Schemas\MiSectionSchema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Spatie\Activitylog\Models\Activity;

class ActivityLogInfolist
{

    public function getInfolist(Schema $schema): Schema
    {

        // Creación de los objetos MiInfoList, MiSectionInfolist, MiTextEntry
        $miInfoList = new MiInfolist();
        $misectionSchema = new MiSectionSchema();
        $miTextEntry = new MiTextEntry();

        // Asigno valores al array que contendrá las secciones principales del Infolist
        $arraySectionPrincipal = [
            $this->getInfolistSectionDatosLog($misectionSchema, $miTextEntry),
            $misectionSchema->getInfoListSectionObservaciones(),
        ];

        // Creo el array con las Secciones asociadas a la sección secundaria
        $arraySectionSecundaria = [
            $misectionSchema->getInfoListSectionFechasRegistro(),
            $misectionSchema->getInfoListSectionEstadoRegistro(),
        ];

        // Devuelvo el obtjeto Infolist según se define es el consturctor
        return $miInfoList->getInfolist($schema, $arraySectionPrincipal, $arraySectionSecundaria);
    }

    /**
     * Construye una sección principal reutilizable con un esquema dinámico
     */
    private function getInfolistSectionDatosLog(
        MiSectionSchema $misectionSchema,
        MiTextEntry       $miTextEntry
    ): Section
    {

        $miKeyValueEntry = new MiKeyValueEntry();

        $description = MiNavigationItem::AREA->getInfolistDescription();
        $icon = 'heroicon-o-information-circle';

        return $misectionSchema
            ->create(
                new SectionConfig(
                    description: $description,
                    icon: $icon,
                ))
            ->schema([
                $miTextEntry->getBadgeTextEntry('log_name', 2),
                $miTextEntry->getBadgeTextEntry('event', 4),
                $miTextEntry->getTextEntry('description', 4),
                $miTextEntry->getTextEntry('subject_type', 2),
                $miTextEntry->getTextEntry('subject_id', 3)
                    ->getStateUsing(function (Activity $record) {
                        if(!is_null($record->getAttribute('subject_type'))) {
                            return resolveSubjectLabelByType(
                                $record->getAttribute('subject_type'),
                                $record->getAttribute('subject_id')
                            );
                        }
                        return null;
                    }),
                $miTextEntry->getTextEntry('causer_type', 2),
                $miTextEntry->getTextEntry('causer_id', 3)
                    ->getStateUsing(function (Activity $record) {
                        if(!is_null($record->getAttribute('causer_type'))) {
                            return resolveSubjectLabelByType(
                                $record->getAttribute('causer_type'),
                                $record->getAttribute('causer_id')
                            );
                        }
                        return null;
                    }),
                $miKeyValueEntry->getKeyValueEntry('properties.attributes', 'Nuevos valores', ConstantesInt::TAMANO_10->value)
                    ->getStateUsing(fn($record) => $this->formatProperties($record, 'attributes')),

                $miKeyValueEntry->getKeyValueEntry('properties.old', 'Antiguos valores', ConstantesInt::TAMANO_10->value)
                    ->getStateUsing(fn($record) => $this->formatProperties($record, 'old'))
            ]);
    }

    /**
     * @param Activity $record
     * @param string   $propertyKey
     *
     * @return array<string, mixed>
     */
    private function formatProperties(Activity $record, string $propertyKey): array
    {
        /** @var array<string, mixed> $attributes */
        $attributes = $record->properties[$propertyKey] ?? [];

        return collect($attributes)
            ->mapWithKeys(fn($value, $key) => [__('fields.' . $key) => formatValue($value)])
            ->toArray();
    }
}
