<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard(name: 'sanctum')->check()) {
            $response = [
                'success' => true,
                'message' => 'El usuario ya está logeado',
                'data' => $data
            ];
            return response()->json($response); 

        }else if (Auth::attempt($data)) {
            return Auth::user()->createToken("token");
        } 

        return response()->json([
            'success' => false,
            'message' => 'El usuario no está logeado',
            'data' => $data
        ]);
    }

    public function userData(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
    
        $response = [
            'success' => true,
            'message' => 'Estos son tus datos ¡¡¡NO COMPARTAS!!!',
            'data' => $user
        ];

        return response()->json($response);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard(name: 'sanctum')->user();
        $user->tokens()->delete();

        $response = [
            'success' => true,
            'message' => 'El usuario ha cerrado sesión',
            'data' => $user
        ];
        
        return response()->json($response);
    }


    public function random(Request $request)
    {
        $response = [
            'success' => true,
            'message' => 'hola holaaaa, esta es una ruta aleatoriaaa',
            'data' => 'aquí no hay nada lolololo'
        ];

        return response()->json($response); 
    }
}
