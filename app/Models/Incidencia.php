<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class Incidencia extends Model
{

    use HasUuids;
    use Notifiable;

//    /**
//     * Route notifications for the mail channel.
//     *
//     * @return  array<string, string>|string
//     */
//    public function routeNotificationForMail(Notification $notification): array|string
//    {
//        // Return email address only...
//        return $this->email_address;
//
//        // Return email address and name...
//        return [$this->email_address => $this->name];
//    }


//    public function getTable()
//    {
//        return config('notable.table_name', 'notables');
//    }

    protected $fillable = [
        'titulo',
        'descripcion',
        'estado',
        'email',
        'incidenciable_type',
        'incidenciable_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];


    public function respuestas(): HasMany
    {
        return $this
            ->hasMany(RespuestasIncidencia::class, 'incidencia_id', 'id');
    }


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


    // Accessor para el título del incidenciable
    protected function incidenciableIdentificador(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getRelation('incidenciable')?->obtenerIdentificadorIncidenciable() ?? 'Sin Identificador',
//            get: fn () => $this->getRelation('incidenciable')?->contract_folder_id ?? 'Sin Identificador',
        );
    }

}
