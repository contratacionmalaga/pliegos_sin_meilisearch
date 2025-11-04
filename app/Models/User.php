<?php

namespace App\Models;

use App\Enums\Flags\ActivoEnum;
use App\Enums\Flags\DobleFactorEnum;
use App\Enums\Flags\LecturaEnum;
use App\Enums\Flags\SuperAdminEnum;
//use App\Enums\PuestosDeTrabajo;
use App\Traits\HasActivo;
use App\Traits\HasDobleFactor;
use App\Traits\HasLectura;
use App\Traits\HasSuperAdmin;
use Database\Factories\UserFactory;
use Exception;
use Filament\Auth\MultiFactor\App\Contracts\HasAppAuthentication;
use Filament\Auth\MultiFactor\App\Contracts\HasAppAuthenticationRecovery;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail, HasAppAuthentication, HasAppAuthenticationRecovery
{
    use HasActivo;
    use HasSuperAdmin;
    use HasLectura;
    use HasDobleFactor;

    use Notifiable;

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'cod_personal',
        'entidad_nif',
        'es_activo',
        'es_super_admin',
        'es_lectura',
        'observaciones',
        'telefono',
        'extension',
        'puesto_trabajo',
        'puesto_trabajo_id',
        'entidad_nif',
        '2fa'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'app_authentication_secret',
        'app_authentication_recovery_codes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'es_activo' => ActivoEnum::class,
            'es_super_admin' => SuperAdminEnum::class,
            'es_lectura' => LecturaEnum::class,
//            'puesto_trabajo_id' => PuestosDeTrabajo::class,
            '2fa' => DobleFactorEnum::class,
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'app_authentication_secret' => 'encrypted',
            'app_authentication_recovery_codes' => 'encrypted:array',
        ];
    }

    public function getAppAuthenticationSecret(): ?string
    {
        // This method should return the user's saved app authentication secret.

        return $this->app_authentication_secret;
    }

    public function saveAppAuthenticationSecret(?string $secret): void
    {
        // This method should save the user's app authentication secret.

        $this->app_authentication_secret = $secret;
        $this->save();
    }

    public function getAppAuthenticationHolderName(): string
    {
        // In a user's authentication app, each account can be represented by a "holder name".
        // If the user has multiple accounts in your app, it might be a good idea to use
        // their email address as then they are still uniquely identifiable.

        return $this->email;
    }

    /**
     * @return ?array<string>
     */
    public function getAppAuthenticationRecoveryCodes(): ?array
    {
        // This method should return the user's saved app authentication recovery codes.

        return $this->app_authentication_recovery_codes;
    }

    /**
     * @param  array<string> | null  $codes
     */
    public function saveAppAuthenticationRecoveryCodes(?array $codes): void
    {
        // This method should save the user's app authentication recovery codes.

        $this->app_authentication_recovery_codes = $codes;
        $this->save();
    }


    /**
     * Función para determinar los usuarios que pueden acceder a un determinado Panel
     *
     * @throws Exception
     */
    public function canAccessPanel(Panel $panel): bool
    {

        // Ahora mismo todos los usuarios tendrán acceso a este panel
        return true;
    }

    //---------------------------------------------------------
    // FUNCIONES
    //---------------------------------------------------------
    public function getTitle(): string{

        return $this->getAttribute('name') . ' (' . $this->getAttribute('email') . ')';
    }
}
