<?php

namespace App\Filament\Components\Infolists;

use Filament\Infolists\Components\IconEntry;

class MiIconEntry
{
    public function getBooleanIconEntry(string $make, string $label, int $columnSpam): IconEntry
    {

        $params = [
            'make' => $make,
            'label' => $label,
        ];

        return $this->constructIconEntry($params, $columnSpam)
            ->boolean();
    }

    /**
     * @param array{
     *     make: string,
     *     label: string,
     * } $params
     * @param int   $columnSpam
     *
     * @return IconEntry
     */
    private function constructIconEntry(array $params, int $columnSpam): IconEntry
    {

        return IconEntry::make($params['make'])
            ->label($params['label'])
            ->columnSpan($columnSpam);
    }
}
