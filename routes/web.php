<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ViewsController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Auth\GoogleController;

// Public Routes
Route::get('/', [ViewsController::class, 'index']);
Route::get('/funcionalidades', [ViewsController::class, 'features']);
Route::get('/info', [ViewsController::class, 'info']);
Route::get('/matricular', [ViewsController::class, 'enroll']);

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [ViewsController::class, 'login'])->name('login');
    Route::get('/register', [ViewsController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
    Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
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
    Route::get("/dashboard/estadisticas", [ViewsController::class, 'adminStatistics']);
});

// Administrative Dashboard
Route::middleware(['auth', 'rol:2'])->group(function () {
    Route::middleware('permiso:1')->get("/dashboard/institucion", [ViewsController::class, 'institution']);
    Route::middleware('permiso:1')->get("/dashboard/institucion/estadisticas", [ViewsController::class, 'institutionStatistics']);
    Route::middleware('permiso:2')->get("/dashboard/administrativos", [ViewsController::class, 'administratives']);
    Route::middleware('permiso:3')->get("/dashboard/docentes", [ViewsController::class, 'teachers']);
    Route::middleware('permiso:4')->get("/dashboard/estudiantes", [ViewsController::class, 'students']);
    Route::middleware('permiso:4')->get("/dashboard/solicitudes", [ViewsController::class, 'enrollmentsRequests']);
    Route::middleware('permiso:5')->get("/dashboard/cursos", [ViewsController::class, 'groups']);
    Route::middleware('permiso:6')->get("/dashboard/materias", [ViewsController::class, 'subjects']);
    Route::middleware('permiso:7')->get("/dashboard/horarios", [ViewsController::class, 'schedules']);
    Route::middleware('permiso:8')->get("/dashboard/periodos", [ViewsController::class, 'periods']);
    Route::middleware('permiso:9')->get("/dashboard/inasistencias", [ViewsController::class, 'absences']);
    Route::middleware('permiso:10')->get("/dashboard/observaciones", [ViewsController::class, 'observations']);
    Route::middleware('permiso:11')->get("/dashboard/pagos", [ViewsController::class, 'payments']);
});

// Teacher Dashboard
Route::middleware(['auth', 'rol:3'])->prefix('/dashboard/docente')->group(function () {
    Route::get("/horario", [ViewsController::class, 'teacherSchedule']);
    Route::get("/cursos", [ViewsController::class, 'teacherCourses']);
    Route::get("/cursos/{id}", [ViewsController::class, 'teacherCourseDetails']);
});

// Student Dashboard
Route::middleware(['auth', 'rol:4'])->prefix('/dashboard/estudiante')->group(function () {
    Route::get("/horario", [ViewsController::class, 'studentSchedule']);
    Route::get("/materias", [ViewsController::class, 'studentSubjects']);
    Route::get("/materias/{id}", [ViewsController::class, 'studentSubjectDetails']);
    Route::get("/inasistencias", [ViewsController::class, 'studentAbsences']);
    Route::get("/observaciones", [ViewsController::class, 'studentObservations']);
});

// Tutor Dashboard
Route::middleware(['auth', 'rol:5'])->prefix('/dashboard/tutor')->group(function () {
    Route::get('/estudiante', [ViewsController::class, 'tutorStudentProfile']);
    Route::get('/notas', [ViewsController::class, 'tutorGrades']);
    Route::get('/notas/export', [ViewsController::class, 'tutorGradesExport']);
    Route::get('/horario', [ViewsController::class, 'tutorSchedule']);
    Route::get('/inasistencias', [ViewsController::class, 'tutorAbsences']);
    Route::get('/observaciones', [ViewsController::class, 'tutorObservations']);
});

// Administrative, Teacher and Tutor Dashboard
Route::middleware(['auth', 'rol:2,3,5'])->prefix('/dashboard')->group(function () {
    Route::get('/estudiantes/{id}', [ViewsController::class, 'studentProfile']);
});