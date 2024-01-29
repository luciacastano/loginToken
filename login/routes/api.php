<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// ruta de autenticación
Route::post('/login', [AuthController::class, 'login']);

// ruta sin necesidad de estar logeado
Route::get('/hello', function () { 
    return response()->json(['message' => 'Estás dentro!!!']);
});

// rutas para usuarios identificados
Route::middleware(['checkLogin'])->group(function () {
    Route::get('/userData', [AuthController::class, 'userData']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

   