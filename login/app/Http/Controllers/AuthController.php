<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function login(Request $request)
    {
        if (Auth::check()) {
            return response()->json(['message' => 'El usuario ya está logeado']);
        }

        $credentials = $request->only(['name', 'password']);

        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'Se ha iniciado sesión']);
        } else {
            return response()->json(['error' => 'Datos no válidos'], 401);
        }
    }

    public function userData()
    {
        if (Auth::check()) {
            return response()->json(['user' => Auth::user()]);
        } else {
            return response()->json(['error' => 'El usuario no está logeado'], 401);
        }
    }


    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return response()->json(['message' => 'Se ha cerrado sesión']);
        } else {
            return response()->json(['error' => 'El usuario no está logeado'], 401);
        }
    }
}
