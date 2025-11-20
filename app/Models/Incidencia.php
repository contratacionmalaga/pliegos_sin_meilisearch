<?php

namespace App\Models;

use App\Enums\Incidencias\EstadoIncidenciaEnum;
use App\Models\PLACSP\Anuncio;
use App\Models\PLACSP\ContratoMayor;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Notifications\Notifiable;

class Incidencia extends Model
{

    use HasUuids;
    use Notifiable;

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
        'estado' => EstadoIncidenciaEnum::class,
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


    public function getincidenciableIdentificadorAttribute()
    {
        return $this->incidenciable?->obtenerIdentificadorIncidenciable() ?? 'Sin Identificador';
    }


    public function getincidenciableDescripcionAttribute()
    {
        return $this->incidenciable?->obtenerDescripcionIncidenciable() ?? 'Sin Descripción';
    }


    public function getincidenciableTipoAttribute()
    {
        return $this->incidenciable?->obtenerTypeIncidenciable() ?? 'Sin Tipo';
    }

    public function scopeBuscarPorIdentificador($query, $value)
    {

        return $query->whereHasMorph(
            'incidenciable',
            [
                Anuncio::class,
                ContratoMayor::class,
            ],
            function ($q, $type) use ($value) {

                $campo = match ($type) {
                    Anuncio::class => 'contract_folder_id',
                    ContratoMayor::class => 'contract_folder_id',
                    default => 'contract_folder_id',
                };

                $q->whereRaw('LOWER('.$campo.') LIKE ?', ['%'.strtolower($value).'%']);
            }
        );

    }

    public function scopeBuscarPorDescripcion($query, $value)
    {

        return $query->whereHasMorph(
            'incidenciable',
            [
                Anuncio::class,
                ContratoMayor::class,
            ],
            function ($q, $type) use ($value) {

                $campo = match ($type) {
                    Anuncio::class => 'name_objeto',
                    ContratoMayor::class => 'name_objeto',
                    default => 'name_objeto',
                };

                $q->whereRaw('LOWER('.$campo.') LIKE ?', ['%'.strtolower($value).'%']);
            }
        );

    }

    public function scopeBuscarPorTipo($query, $value)
    {

        return $query
                    ->whereRaw('LOWER(incidenciable_type) LIKE ?', ['%' . strtolower($value) . '%']);

    }

}
