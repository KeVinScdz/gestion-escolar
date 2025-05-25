<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\InstitucionController;

// User Routes
Route::get('/users', [UsuarioController::class, 'index']);
Route::post('/users', [UsuarioController::class, 'store']);
Route::put('/users/{id}', [UsuarioController::class, 'update']);
Route::delete('/users/{id}', [UsuarioController::class, 'destroy']);

// Institution Routes
Route::post('/institutions', [InstitucionController::class, 'store']);
Route::put('/institutions/{id}', [InstitucionController::class, 'update']);
Route::delete('/institutions/{id}', [InstitucionController::class, 'destroy']);
