<?php

namespace App\Services;

use App\Mail\LoginFallido;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginAlertService
{
    public function handle(User $user, array $properties): void
    {
        $key = 'login-fail-alert:' . Str::lower($user->email);

        if (! RateLimiter::tooManyAttempts($key, 1)) {
            Mail::to($user->email)->send(new LoginFallido($user, $properties));
            RateLimiter::hit($key, now()->addMinutes(1));
        }
    }
}

