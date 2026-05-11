<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController; 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 

// 1. Halaman Utama (Dinamis pakai Controller)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rute', [HomeController::class, 'rute'])->name('rute.index');

// 2. Dashboard (Lobi Utama)
Route::get('/dashboard', function () {
    // Jika yang login punya role 'admin', arahkan ke dashboard admin
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    
    // Selain admin (user biasa), arahkan ke dashboard user
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Grup Fitur yang butuh Login (Semua di dalam sini aman / terkunci)
Route::middleware('auth')->group(function () {
    
    // --- PROFIL USER ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- FITUR BOOKING (Pencarian & Pilih Kursi terpusat di sini) ---
    Route::get('/booking', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/booking', [BookingController::class, 'store'])->name('bookings.store');
    
    // Jalur untuk Simulasi Pembayaran
    Route::get('/booking/checkout/{id}', [BookingController::class, 'checkout'])->name('bookings.checkout');
    Route::post('/booking/process/{id}', [BookingController::class, 'processPayment'])->name('bookings.process');
    
    // Jalur untuk menampilkan E-Ticket
    Route::get('/booking/ticket/{id}', [BookingController::class, 'show'])->name('bookings.show');
    
    // --- KHUSUS ADMIN (Dijaga Middleware IsAdmin) ---
    Route::middleware(\App\Http\Middleware\IsAdmin::class)->prefix('admin')->name('admin.')->group(function () {
    
        // Dashboard Admin
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Resource Routes
        Route::resource('bus', BusController::class);
        Route::resource('routes', RouteController::class);
        Route::resource('schedules', ScheduleController::class);
        
        // Laporan Booking
        Route::get('/reports/bookings', [BookingController::class, 'adminReport'])->name('reports.bookings');
    });
});

// 4. Rute Login/Register bawaan Breeze
require __DIR__.'/auth.php';

// Menu kelola bus admin
Route::get('/admin/bus', [BusController::class, 'index'])->name('admin.bus.index');