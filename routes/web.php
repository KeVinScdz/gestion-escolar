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
Route::middleware(['auth', 'rol:1'])->group(function () {
    Route::get("/dashboard/instituciones", [ViewsController::class, 'institutions']);
    Route::get("/dashboard/usuarios", [ViewsController::class, 'users']);
});

Route::middleware(['auth', 'rol:2'])->group(function () {
    Route::middleware('permiso:1')->get("/dashboard/institucion", [ViewsController::class, 'institucion']);
    Route::middleware('permiso:2')->get("/dashboard/estudiantes", [ViewsController::class, 'students']);
    Route::middleware('permiso:3')->get("/dashboard/docentes", [ViewsController::class, 'docentes']);
    Route::middleware('permiso:4')->get("/dashboard/administrativos", [ViewsController::class, 'administrativos']);
    Route::middleware('permiso:5')->get("/dashboard/matriculas", [ViewsController::class, 'matriculas']);
    Route::middleware('permiso:6')->get("/dashboard/permisos", [ViewsController::class, 'permisos']);
    Route::middleware('permiso:7')->get("/dashboard/cursos", [ViewsController::class, 'cursos']);
    Route::middleware('permiso:8')->get("/dashboard/materias", [ViewsController::class, 'materias']);
    Route::middleware('permiso:9')->get("/dashboard/horarios", [ViewsController::class, 'horarios']);
    Route::middleware('permiso:10')->get("/dashboard/periodos", [ViewsController::class, 'periodos']);
    Route::middleware('permiso:11')->get("/dashboard/inasistencias", [ViewsController::class, 'inasistencias']);
    Route::middleware('permiso:12')->get("/dashboard/observaciones", [ViewsController::class, 'observaciones']);
    Route::middleware('permiso:13')->get("/dashboard/pagos", [ViewsController::class, 'pagos']);
    
});