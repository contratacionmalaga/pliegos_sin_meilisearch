<?php

namespace App\Filament\Exports;

use App\Models\OrganoContratacion;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class OrganoContratacionExporter extends Exporter
{
    protected static ?string $model = OrganoContratacion::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('entidad.name'),
            ExportColumn::make('tipo_organo_contratacion_rc_id'),
            ExportColumn::make('nif'),
            ExportColumn::make('dir3'),
            ExportColumn::make('id_plataforma'),
            ExportColumn::make('link'),
            ExportColumn::make('direccion'),
            ExportColumn::make('codigo_postal'),
            ExportColumn::make('email'),
            ExportColumn::make('telefono'),
            ExportColumn::make('observaciones'),
            ExportColumn::make('es_activo'),
            ExportColumn::make('es_medio_propio'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('deleted_at'),
            ExportColumn::make('organo_contratacion'),
            ExportColumn::make('ubicacion'),
            ExportColumn::make('dependencia1'),
            ExportColumn::make('dependencia2'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your organo contratacion export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
