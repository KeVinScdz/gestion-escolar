<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UsuarioController;

// User Routes
Route::get('/users', [UsuarioController::class, 'index']);
Route::get('/users/paginate', [UsuarioController::class, 'paginate']);
Route::get('/users/{id}', [UsuarioController::class, 'show']);
Route::post('/users', [UsuarioController::class, 'store']);
Route::put('/users/{id}', [UsuarioController::class, 'update']);
Route::delete('/users/{id}', [UsuarioController::class, 'destroy']);
