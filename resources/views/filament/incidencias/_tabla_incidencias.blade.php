@php
    use Filament\Tables\Columns\Column;
@endphp

<title >Vista de Incidencias PAGE</title>
<table class="min-w-full divide-y divide-gray-300 border border-gray-200 rounded-md">
    <thead class="bg-gray-50">
    <tr>
        @foreach ($columns as $column)
            @if ($column instanceof Column)
                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">
                    {{ $column->getLabel() ?? $column->getName() }}
                </th>
            @endif
        @endforeach
    </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-white">
    @foreach ($registros as $record)
        <tr>
            @foreach ($columns as $column)
                @if ($column instanceof Column)
                    <td class="px-4 py-2 text-sm text-gray-800">
                        {{ $column->getState($record) }}
                    </td>
                @endif
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
