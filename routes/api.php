<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// User Routes
Route::get('/users', [UsuarioController::class, 'getAll']);
Route::get('/users/paginate', [UsuarioController::class, 'paginate']);
Route::get('/users/{id}', [UsuarioController::class, 'getByPK']);
Route::post('/users', [UsuarioController::class, 'create']);
Route::put('/users/{id}', [UsuarioController::class, 'update']);
Route::delete('/users/{id}', [UsuarioController::class, 'destroy']);

// Auth Routes
Route::middleware('guest:sanctum')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
