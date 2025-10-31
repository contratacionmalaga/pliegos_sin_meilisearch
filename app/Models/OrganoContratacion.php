<?php

namespace App\Models;

use App\Enums\ActivityLog\ActivityLogName;
use App\Enums\Flags\ActivoOrganoContratacionEnum;
use App\Enums\Flags\MedioPropioEnum;
use App\Enums\RegistroContratos\RC_TiposDeOrganosContratacion;
use App\Models\PLACSP\Adjudicacion;
use App\Models\PLACSP\Expediente;
use App\Traits\HasActivo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @method static Builder|static activo()
 * @method static Builder|static inactivo()
 * @method static Builder|static huerfanos()
 * @method static Builder|static asignados()
 */
class OrganoContratacion extends Model
{
    use HasActivo;
    use HasUuids;
    use LogsActivity;
    use SoftDeletes;

    protected $table = 'placsp_organos_contratacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'entidad_id',
        'tipo_organo_contratacion_rc_id',
        'organo_contratacion',
        'nif',
        'codigo_dir3',
        'id_plataforma',
        'link',
        'direccion',
        'codigo_postal',
        'email',
        'telefono',
        'es_medio_propio',
        'ubicacion',
        'dependencia1',
        'dependencia2',
        'es_activo',
        'observaciones',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'es_medio_propio' => MedioPropioEnum::class,
            'es_activo' => ActivoOrganoContratacionEnum::class,
            'tipo_organo_contratacion_rc_id' => RC_TiposDeOrganosContratacion::class,
        ];
    }

    /**
     * Definición de la trazabilidad en ActivityLog
     */
    public function getActivitylogOptions(): LogOptions
    {

        return LogOptions::defaults()
            ->useLogName(ActivityLogName::SEGURIDAD->value)
            ->logAll()
            ->logOnlyDirty();
    }

    public function entidad(): BelongsTo
    {
        return $this->belongsTo(Entidad::class, 'nif', 'nif');
    }

    public function adjudicaciones(): HasMany
    {
        return $this->hasMany(Adjudicacion::class, 'id_plataforma', 'id_plataforma');
    }

    public function expedientes(): HasMany
    {
        return $this->hasMany(Expediente::class, 'id_plataforma', 'id_plataforma')
            ->orderBy('contract_folder_id', 'DESC');
    }

    public function organos_contratacion_historicos(): HasMany
    {
        return $this->hasMany(OrganoContratacionHistorico::class, 'id_plataforma', 'id_plataforma');
    }

    public function organizable(): MorphTo
    {
        return $this->morphTo();
    }

    // Scope en el modelo OrganoContratacion
    public function scopeAsignados(Builder $query): Builder
    {
        return $query
            ->whereHas('entidad');
    }

    // Scope en el modelo OrganoContratacion
    public function scopeHuerfanos(Builder $query): Builder
    {
        return $query->whereNotNull('nif') // opcional: solo los que tienen NIF
            ->whereDoesntHave('entidad');
    }
}
