<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfUnauthorizedToWelcome
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Aquí defines tu lógica de restricción, por ejemplo:
        $user = auth()->user();

        // Si no está autenticado, déjalo pasar a que Filament lo mande al login
        if (! $user) {
            return $next($request);
        }

        // 🔐 Lógica personalizada, por ejemplo: si tiene 'es_lectura' activado, denegar
        if (!$user->esSuperAdmin()) {
            return redirect('/'); // Redirige al welcome
        }

        return $next($request);
    }
}
