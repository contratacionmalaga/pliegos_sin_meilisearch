<?php

namespace App\Filament\Components\Infolists;

use Filament\Infolists\Components\KeyValueEntry;

class MiKeyValueEntry
{
    /**
     * @param string $make
     * @param string $label
     * @param int    $columnSpan
     *
     * @return KeyValueEntry
     */
    public function getKeyValueEntry(string $make, string $label, int $columnSpan): KeyValueEntry
    {

        return KeyValueEntry::make($make)
            ->label($label)
            ->columnSpan($columnSpan);
    }
}
