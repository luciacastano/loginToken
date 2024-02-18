<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario registrado correctamente',
            'data' => $user,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        if (Auth::attempt(['name' => $request->username, 'password' => $request->password]) ||
            Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
    
            $token = Auth::user()->createToken("accessToken")->accessToken;
            return response()->json(['accessToken' => $token]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Las credenciales son incorrectas',
        ]);
    }

    public function userData(Request $request)
    {
        $user = Auth::guard('api')->user();
    
        $response = [
            'success' => true,
            'message' => 'Estos son tus datos ¡¡¡NO COMPARTAS!!!',
            'data' => $user
        ];

        return response()->json($response);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard(name: 'api')->user();
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
