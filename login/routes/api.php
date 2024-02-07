<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
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
Route::post('/login', [LoginController::class, 'login']);

// ruta sin necesidad de estar logeado
Route::get('/random', [LoginController::class, 'random']);

// rutas para usuarios identificados
Route::middleware(['checkLogin'])->group(function () {
    Route::get('/me', [LoginController::class, 'userData']);
    Route::post('/logout', [LoginController::class, 'logout']);
});

   