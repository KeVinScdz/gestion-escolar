<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\InstitucionController;
use App\Http\Controllers\Api\AcademicStructureController;
use App\Http\Controllers\Api\BackupController;
use App\Http\Controllers\Api\InfoController;

// Info Routes
Route::post('/info', [InfoController::class, 'store']);

// Backup Routes
Route::get("/info", [BackupController::class, 'exportData']);

// User Routes
Route::get('/users', [UsuarioController::class, 'index']);
Route::post('/users', [UsuarioController::class, 'store']);
Route::put('/users/{id}', [UsuarioController::class, 'update']);
Route::delete('/users/{id}', [UsuarioController::class, 'destroy']);

// Enrollment Routes
Route::post('/enrollments', [AcademicStructureController::class, 'storeEnrollment']);
Route::put('/enrollments/{id}', [AcademicStructureController::class, 'updateEnrollment']);
Route::delete('/enrollments/{id}', [AcademicStructureController::class, 'destroyEnrollment']);

Route::post('/enrollments-requests', [AcademicStructureController::class, 'storeEnrollmentRequest']);
Route::put('/enrollments-requests/{id}', [AcademicStructureController::class, 'updateEnrollmentRequest']);

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
Route::put('/groups/{id}/assignments', [AcademicStructureController::class, 'updateGroupAssignments']);
Route::delete('/groups/{id}', [AcademicStructureController::class, 'destroyGroup']);

// Subjects Routes
Route::post('/subjects', [AcademicStructureController::class, 'storeSubject']);
Route::put('/subjects/{id}', [AcademicStructureController::class, 'updateSubject']);
Route::delete('/subjects/{id}', [AcademicStructureController::class, 'destroySubject']);

// Schedules Routes
Route::post('/blocks', [AcademicStructureController::class, 'storeBlock']);
Route::put('/blocks/{id}', [AcademicStructureController::class, 'updateBlock']);
Route::delete('/blocks/{id}', [AcademicStructureController::class, 'destroyBlock']);

Route::post('/schedules', [AcademicStructureController::class, 'storeSchedule']);
Route::put('/schedules/{id}', [AcademicStructureController::class, 'updateSchedule']);
Route::delete('/schedules/{id}', [AcademicStructureController::class, 'destroySchedule']);

// Observations Routes
Route::post('/observations', [AcademicStructureController::class, 'storeObservation']);
Route::put('/observations/{id}', [AcademicStructureController::class, 'updateObservation']);
Route::delete('/observations/{id}', [AcademicStructureController::class, 'destroyObservation']);

// Attendances Routes
Route::post('/attendances', [AcademicStructureController::class, 'storeAttendance']);
Route::put('/attendances/{id}', [AcademicStructureController::class, 'updateAttendance']);

// Grades Routes
Route::post('/grades', [AcademicStructureController::class, 'storeGrade']);

// Payments Routes
Route::post('/payments', [AcademicStructureController::class, 'storePayment']);