<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

//
// ===================== PUBLIC =====================
//

// Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Rute
Route::get('/rute', [HomeController::class, 'rute'])->name('rute.index');



//
// ===================== DASHBOARD =====================
//

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



//
// ===================== AUTH USER =====================
//

Route::middleware(['auth'])->group(function () {

    //
    // ---------- PROFILE ----------
    //

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');



    //
    // ---------- BOOKING ----------
    //

    // Halaman booking / pencarian bus
    Route::get('/booking', [BookingController::class, 'index'])
        ->name('bookings.index');

    // Simpan booking
    Route::post('/booking', [BookingController::class, 'store'])
        ->name('bookings.store');



    //
    // ---------- CHECKOUT ----------
    //

    // Halaman checkout pembayaran
    Route::get('/booking/checkout/{id}', [BookingController::class, 'checkout'])
        ->name('bookings.checkout');

    // Proses pembayaran
    Route::post('/booking/process/{id}', [BookingController::class, 'processPayment'])
        ->name('bookings.process');



    //
    // ---------- TICKET ----------
    //

    // E-ticket user
    Route::get('/booking/ticket/{id}', [BookingController::class, 'show'])
        ->name('bookings.show');



    //
    // ---------- HISTORY & ACTIVE TICKETS ----------
    //

    // Riwayat booking user
    Route::get('/history', [BookingController::class, 'history'])
        ->name('history.index');
        
    // Tiket aktif user
    Route::get('/active-tickets', [BookingController::class, 'activeTickets'])
        ->name('bookings.active');



    //
    // ===================== ADMIN =====================
    //

    Route::middleware(\App\Http\Middleware\IsAdmin::class)
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            //
            // ---------- DASHBOARD ADMIN ----------
            //

            Route::get('/dashboard', function () {
                return view('admin.dashboard');
            })->name('dashboard');



            //
            // ---------- BUS ----------
            //

            Route::resource('bus', BusController::class);



            //
            // ---------- ROUTES ----------
            //

            Route::resource('routes', RouteController::class);



            //
            // ---------- SCHEDULES ----------
            //

            Route::resource('schedules', ScheduleController::class);



            //
            // ---------- REPORTS ----------
            //

            Route::get('/reports/bookings', [BookingController::class, 'adminReport'])
                ->name('reports.bookings');
            // Tambahin ini di file routes/web.php
Route::get('/riwayat', [App\Http\Controllers\BookingController::class, 'history'])->name('bookings.history');
        });
});



//
// ===================== AUTH BREEZE =====================
//

require __DIR__.'/auth.php';

