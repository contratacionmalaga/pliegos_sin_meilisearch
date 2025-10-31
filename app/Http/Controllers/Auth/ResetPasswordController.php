<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

        public function update(Request $request): RedirectResponse
        {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            static function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                ])->save();
                $usuario = User::where('email', $request->email)
                    ->whereNull('email_verified_at')
                    ->first();

                if ($usuario) {
                    $usuario->email_verified_at = now();
                    $usuario->save();
                }
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('filament.dashboard.auth.login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}

