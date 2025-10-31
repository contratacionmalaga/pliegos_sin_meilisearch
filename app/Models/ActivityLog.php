<?php

namespace App\Models;

use App\Enums\ActivityLog\ActivityLogEvent;
use App\Enums\ActivityLog\ActivityLogName;
use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Activity
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'log_name' => ActivityLogName::class,
            'event' => ActivityLogEvent::class,
            'properties' => 'array',
        ];
    }
}
