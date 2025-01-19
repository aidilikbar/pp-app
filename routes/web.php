<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HealthRecordController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;

/*
Route::get('/', function () {
    return view('homepage');
})->name('homepage');
*/
Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::resource('health-records', HealthRecordController::class);
Route::resource('appointments', AppointmentController::class);

Route::resource('profile', ProfileController::class)->only(['edit', 'update']);
