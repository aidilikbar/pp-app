<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HealthRecordController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Redirect root route based on authentication status
Route::get('/', function () {
    return Auth::check() ? view('homepage') : redirect()->route('login');
})->name('root');

// Default Laravel Breeze Dashboard (optional if not needed)
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/

// Feature Routes (Requires Authentication)
Route::middleware('auth')->group(function () {
    // Homepage route for logged-in users
    Route::get('/homepage', function () {
        return view('homepage');
    })->name('homepage');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Health Records routes
    Route::resource('health-records', HealthRecordController::class);

    // Appointments routes
    Route::resource('appointments', AppointmentController::class);
});


require __DIR__.'/auth.php';
