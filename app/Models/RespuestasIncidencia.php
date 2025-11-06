<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RespuestasIncidencia extends Model
{

    use HasUuids;

    protected $fillable = [
        'respuesta',
    ];

    protected $casts = [
        'id' => 'string',
        'incidencia_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function incidencia(): BelongsTo
    {
        return $this
            ->belongsTo(Incidencia::class, 'incidencia_id', 'id');
    }

}
