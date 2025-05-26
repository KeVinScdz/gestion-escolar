<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ViewsController;
use App\Http\Controllers\Web\AuthController;

// Public Routes
Route::get('/', [ViewsController::class, 'index']);

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [ViewsController::class, 'login'])->name('login');
    Route::get('/register', [ViewsController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ViewsController::class, 'dashboard']);

    Route::post('logout', [AuthController::class, 'logout']);
});

// Admin Dashboard
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get("/dashboard/instituciones", [ViewsController::class, 'institutions']);
    Route::get("/dashboard/usuarios", [ViewsController::class, 'users']);
});

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get("/dashboard/personal", [ViewsController::class, 'personal']);
    Route::get("/dashboard/matriculas", [ViewsController::class, 'students']);
});