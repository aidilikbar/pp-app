<?php

use App\Http\Controllers\HealthRecordController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('health-records')->group(function () {
    Route::get('/', [HealthRecordController::class, 'apiIndex']);
    Route::post('/', [HealthRecordController::class, 'apiStore']);
    Route::get('/{id}', [HealthRecordController::class, 'apiShow']);
    Route::put('/{id}', [HealthRecordController::class, 'apiUpdate']);
    Route::delete('/{id}', [HealthRecordController::class, 'apiDestroy']);
});

Route::prefix('appointments')->group(function () {
    Route::get('/', [AppointmentController::class, 'apiIndex']);
    Route::post('/', [AppointmentController::class, 'apiStore']);
    Route::get('/{id}', [AppointmentController::class, 'apiShow']);
    Route::put('/{id}', [AppointmentController::class, 'apiUpdate']);
    Route::delete('/{id}', [AppointmentController::class, 'apiDestroy']);
});