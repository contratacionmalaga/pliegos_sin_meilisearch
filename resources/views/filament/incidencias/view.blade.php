{{--<x-filament::page>--}}
{{--    --}}{{-- Sección de detalles de la incidencia --}}
{{--    <x-filament::section heading="Detalles de la incidencia">--}}
{{--        <div class="grid grid-cols-2 gap-4">--}}
{{--            <div>--}}
{{--                <strong>ID:</strong> {{ $record->id }}--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <strong>Título:</strong> {{ $record->titulo }}--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <strong>Estado:</strong> {{ $record->estado }}--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <strong>Creado:</strong> {{ $record->created_at->format('d/m/Y H:i') }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </x-filament::section>--}}

{{--    --}}{{-- Sección de tabla --}}
{{--    <x-filament::section heading="Otras incidencias">--}}
{{--        --}}{{-- Renderiza la tabla aquí --}}
{{--        {{ $this->renderTable() }}--}}
{{--    </x-filament::section>--}}
{{--</x-filament::page>--}}


{{--<x-filament::page>--}}
{{--    <x-filament::section heading="Detalles de la incidencia">--}}
{{--        <div>--}}
{{--            <strong>ID:</strong> {{ $record->id }}<br>--}}
{{--            <strong>Título:</strong> {{ $record->titulo }}--}}
{{--        </div>--}}
{{--    </x-filament::section>--}}

{{--    <x-filament::section heading="Otras incidencias">--}}
{{--        --}}{{-- Tabla manual --}}
{{--        <livewire:filament-tables :table-class="\App\Filament\Resources\IncidenciaResource::class" />--}}
{{--    </x-filament::section>--}}
{{--</x-filament::page>--}}


<x-filament::page>
    <x-filament::section heading="Otras incidencias">
        {{ $this->table }}
    </x-filament::section>
</x-filament::page>
