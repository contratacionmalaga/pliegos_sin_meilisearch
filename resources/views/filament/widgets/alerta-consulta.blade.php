<div class="filament-simple-alert bg-blue-50 dark:bg-gray-800 border border-blue-200 dark:border-gray-700 p-4 rounded-md shadow-sm">
    <div class="text-base font-semibold text-blue-800 dark:text-blue-200">
        Consulta #{{ $expediente  ?? 'N/D' }}
    </div>
    <div class="text-sm text-gray-700 dark:text-gray-300">
        {{ $objeto }}
    </div>
    <div class="mt-2">
        <a
                href="{{ $link }}"
                target="_blank"
                class="inline-flex items-center px-3 py-1.5 bg-primary-600 text-white text-xs font-medium rounded hover:bg-primary-700 transition"
        >
            Ver en Plataforma de Contratación
            <x-heroicon-o-arrow-top-right-on-square class="ml-1 w-4 h-4" />
        </a>
    </div>
</div>
