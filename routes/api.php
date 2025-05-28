<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\InstitucionController;
use App\Http\Controllers\Api\AcademicStructureController;

// User Routes
Route::get('/users', [UsuarioController::class, 'index']);
Route::post('/users', [UsuarioController::class, 'store']);
Route::put('/users/{id}', [UsuarioController::class, 'update']);
Route::delete('/users/{id}', [UsuarioController::class, 'destroy']);

// Institution Routes
Route::post('/institutions', [InstitucionController::class, 'store']);
Route::put('/institutions/{id}', [InstitucionController::class, 'update']);
Route::delete('/institutions/{id}', [InstitucionController::class, 'destroy']);

// Periods Routes
Route::post('/periods', [AcademicStructureController::class, 'storePeriod']);
Route::put('/periods/{id}', [AcademicStructureController::class, 'updatePeriod']);
Route::delete('/periods/{id}', [AcademicStructureController::class, 'destroyPeriod']);

// Groups Routes
Route::post('/groups', [AcademicStructureController::class, 'storeGroup']);
Route::put('/groups/{id}', [AcademicStructureController::class, 'updateGroup']);
Route::delete('/groups/{id}', [AcademicStructureController::class, 'destroyGroup']);
