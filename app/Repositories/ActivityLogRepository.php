<?php

namespace App\Repositories;

class ActivityLogRepository
{
    /**
     * @return array<string, string>
     */
    public function getArrayAllModels(): array
    {

        $models = getModelsByPanel();
        return $models->mapWithKeys(function ($panelModels, $panelId) {
            return $panelModels->mapWithKeys(fn ($label, $model) => [
                $model => "[$panelId] $label",
            ]);
        })->toArray();
    }
}
