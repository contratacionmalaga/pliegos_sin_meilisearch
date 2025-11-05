<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Incidencia extends Model
{
//    public function getTable()
//    {
//        return config('notable.table_name', 'notables');
//    }

    protected $fillable = [
        'titulo',
        'descripcion',
        'estado',
        'descripcion',
        'incidenciable_type',
        'incidenciable_id',
//        'creator_type',
//        'creator_id',
        'created_bye',
        'updated_bye',
        'deleted_bye',
    ];

    protected $casts = [
        'id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     *
     * Get the parent incidenciable model (ContratoMayor, Adjudicacion, etc.).
     *
     * @return MorphTo
     */
    public function incidenciable(): MorphTo
    {
        return $this->morphTo();
    }

//    public function creator(): MorphTo
//    {
//        return $this->morphTo();
//    }
//
//    public function scopeByCreator($query, Model $creator)
//    {
//        return $query->where('creator_type', $creator->getMorphClass())
//            ->where('creator_id', $creator->getKey());
//    }
//
//    public function scopeWithoutCreator($query)
//    {
//        return $query->whereNull('creator_type');
//    }

    public function scopeRecent($query, int $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeOlderThan($query, int $days = 30)
    {
        return $query->where('created_at', '<=', now()->subDays($days));
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', now()->toDateString());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek(),
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year);
    }

    public function scopeThisYear($query)
    {
        return $query->whereYear('created_at', now()->year);
    }

    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    public function scopeContainingText($query, string $text)
    {
        return $query->where('descripcion', 'LIKE', '%'.$text.'%');
    }

    public function scopeSearch($query, string $searchTerm)
    {
        return $query->where('descripcion', 'LIKE', '%'.$searchTerm.'%');
    }
}
