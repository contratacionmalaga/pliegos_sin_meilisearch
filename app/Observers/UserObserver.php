<?php

// App\Observers\UserObserver.php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating(User $user): void
    {
        if (empty($user->password)) {
            $user->password = Str::random(30);
        }
        if (empty($user->puesto_trabajo)) {
            $user->setAttribute('puesto_trabajo',  null);
        }
        if (empty($user->cod_personal)) {
            $user->setAttribute('cod_personal',  null);
        }
    }
}
