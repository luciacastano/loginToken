<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard(name: 'sanctum')->check()) {
            // guard -> determinar la autentificación de usuarios
            // guard'sanctum' -> autentificación por token

            $response = [
                'success' => false,
                'message' => '¡ALTO! El usuario no está logueado',
                'data' => null
            ];
            return response()->json($response);
        }

        return $next($request);
    }
}
