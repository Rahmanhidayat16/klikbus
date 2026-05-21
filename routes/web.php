<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;       // <-- INI DITAMBAHIN
use App\Http\Controllers\SettingController;    // <-- INI DITAMBAHIN

// PUBLIC
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rute', [HomeController::class, 'rute'])->name('rute.index');

// DASHBOARD USER
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// AUTH USER GROUP
Route::middleware(['auth'])->group(function () {
    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // BOOKING ALUR
    Route::get('/booking', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/booking', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/booking/checkout/{id}', [BookingController::class, 'checkout'])->name('bookings.checkout');
    Route::post('/booking/process/{id}', [BookingController::class, 'processPayment'])->name('bookings.process');
    Route::get('/booking/ticket/{id}', [BookingController::class, 'show'])->name('bookings.show');

    // INI YANG TADI NYASAR (Sekarang udah di luar Admin)
    Route::get('/history', [BookingController::class, 'history'])->name('bookings.history');
    Route::get('/active-tickets', [BookingController::class, 'activeTickets'])->name('bookings.active');
});

// ADMIN GROUP
Route::middleware([\App\Http\Middleware\IsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
        
        Route::resource('bus', \App\Http\Controllers\BusController::class);
        Route::resource('routes', \App\Http\Controllers\Admin\RouteController::class);
        Route::resource('schedules', \App\Http\Controllers\Admin\ScheduleController::class);
        Route::get('/reports/booking', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
        
        // --- INI YANG BIKIN ERROR TADI KARENA MENGHILANG ---
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');        
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });

require __DIR__.'/auth.php';