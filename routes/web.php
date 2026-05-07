<?php

use App\Http\Controllers\ProfileController;
<<<<<<< HEAD
=======
use App\Http\Controllers\BusController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BookingController;
>>>>>>> origin/fitur-booking-user
use Illuminate\Support\Facades\Route;


// 1. Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
=======
// 2. Dashboard (Hanya bisa diakses kalau sudah login)
>>>>>>> origin/fitur-booking-user
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

<<<<<<< HEAD
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
=======
// 3. Grup Fitur yang butuh Login
Route::middleware('auth')->group(function () {
    // Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen Admin (Bus, Rute, Jadwal)
    Route::resource('bus', BusController::class);
    Route::resource('routes', RouteController::class);
    Route::resource('schedules', ScheduleController::class);

    // Fitur Booking untuk User
    Route::get('/booking', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/booking', [BookingController::class, 'store'])->name('bookings.store');
});

// 4. KUNCI UTAMA: Panggil rute Login/Register bawaan Breeze
require __DIR__.'/auth.php';
>>>>>>> origin/fitur-booking-user
