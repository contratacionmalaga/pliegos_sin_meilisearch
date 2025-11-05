<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Incidencia;

trait HasIncidencias
{
    /**
     *
     * Recupera las incidencias asociadas al modelo.
     *
     * @return MorphMany
     */
    public function incidencias(): MorphMany
    {

/*
    public function morphMany(
        string $related,      // Clase del modelo relacionado
        string $name,         // Nombre del campo polimórfico (sin _id ni _type)
        string|null $type = null,  // (Opcional) columna type si es diferente
        string|null $id = null,    // (Opcional) columna id si es diferente
        string|null $localKey = null // (Opcional) clave local
    ): \Illuminate\Database\Eloquent\Relations\MorphMany
*/

        return $this->morphMany(Incidencia::class,
                                'incidenciable',
                                'incidenciable_type',
                                'incidenciable_id',
                                'id')
                    ->orderBy('created_at');

//        return $this->morphMany(Incidencia::class, 'incidenciable')
//                    ->orderBy('created_at');

//                    ->orderBy(config('notable.order_by_column', 'created_at'),
//                              config('notable.order_by_direction', 'desc'));
    }

    /**
     *
     * Agrega una nueva incidencia sobre el modelo.
     *
     * @param string $titulo
     * @param Model $creator
     * @return Incidencia
     */
    public function addIncidencia(string $titulo, Model $creator): Incidencia
    {
        $data = ['titulo' => $titulo];

        if ($creator) {
            $data['incidenciable_type'] = $creator->getMorphClass();
            $data['incidenciable_id'] = $creator->getKey();
        }

        return $this->incidencias()->create($data);
    }

    /**
     *
     * Recupera todas las incidencias asociadas al modelo.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getIncidencias()
    {
        return $this->incidencias()
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    /**
     *
     * Recupera la última incidencia asociada al modelo.
     *
     * @return Incidencia|null
     */
    public function getLatestIncidencia(): ?Incidencia
    {
        return $this->incidencias()
                    ->orderBy('created_at', 'desc')
                    ->first();
    }

    /**
     *
     * Comprueba si el modelo tiene incidencias asociadas.
     *
     * @return bool
     */
    public function hasIncidencias(): bool
    {
        return $this->incidencias()
                    ->exists();
    }

    /**
     *
     * Obtiene el número de incidencias asociadas al modelo.
     *
     * @return int
     */
    public function IncidenciasCount(): int
    {
        return $this->incidencias()
                    ->count();
    }

//    public function getIncidenciasByCreator(Model $creator)
//    {
//        return $this->incidencias()
//            ->where('creator_type', $creator->getMorphClass())
//            ->where('creator_id', $creator->getKey())
//            ->orderBy('created_at', 'desc')
//            ->get();
//    }
//
//    public function getIncidenciasWithCreator()
//    {
//        return $this->incidencias()
//            ->with('creator')
//            ->orderBy('created_at', 'desc')
//            ->get();
//    }

    /**
     *
     * Elimina una incidencia por su ID.
     *
     * @param int $incidenciaId
     * @return bool
     */
    public function deleteIncidencia(int $incidenciaId): bool
    {
        return $this->incidencias()
            ->where('id', $incidenciaId)
            ->delete();
    }

    /**
     *
     * Actualiza una incidencia por su ID.
     *
     * @param int $incidenciaId
     * @param string $titulo
     * @return bool
     */
    public function updateIncidencia(int $incidenciaId, string $titulo): bool
    {
        return $this->incidencias()
            ->where('id', $incidenciaId)
            ->update(['titulo' => $titulo]); // TODO: update other fields as necessary
    }

    /**
     *
     * Busca incidencias que contengan el término de búsqueda.
     *
     * @param string $searchTerm
     * @return mixed
     */
    public function searchIncidencias(string $searchTerm)
    {
        return $this->incidencias()
            ->search($searchTerm)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     *
     * Obtiene las incidencias creadas hoy.
     *
     * @return mixed
     */
    public function getIncidenciasToday()
    {
        return $this->incidencias()
            ->today()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     *
     * Obtiene las incidencias creadas esta semana.
     *
     * @return mixed
     */
    public function getIncidenciasThisWeek()
    {
        return $this->incidencias()
            ->thisWeek()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     *
     * Obtiene las incidencias creadas este mes.
     *
     * @return mixed
     */
    public function getIncidenciasThisMonth()
    {
        return $this->incidencias()
            ->thisMonth()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     *
     * Obtiene las incidencias creadas en un rango de fechas.
     *
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public function getIncidenciasInRange($startDate, $endDate)
    {
        return $this->incidencias()
            ->betweenDates($startDate, $endDate)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
