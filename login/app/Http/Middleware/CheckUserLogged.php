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
        if ($request->is('api/login') || $request->is('api/hello')) {
            return $next($request);
        }

        $userToken = $request->bearerToken(); // paso de token por postamn

        if (!$userToken) {
            return response()->json([
                'status' => false,
                'message' => 'El token no ha sido proporcionado.',
            ], 401);
        }

        $validToken = DB::table('personal_access_tokens')->where('token', $userToken)->exists();

        if ($validToken) {
            $user = DB::table('personal_access_tokens')->where('token', $userToken)->value('tokenable_id');

            Auth::onceUsingId($user); // para autentificarse por id, sin necesidad de contraseña

            return $next($request);
        }

        return response()->json([
            'status' => false,
            'message' => 'El token proporcionado no es válido.',
        ], 401);
    }
}
