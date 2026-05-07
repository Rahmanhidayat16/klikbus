<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Halaman & Proses Daftar
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Halaman & Proses Login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    // Tambahkan ini di dalam group middleware guest di routes/auth.php
Route::get('forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])->name('password.email');
});

Route::middleware('auth')->group(function () {
    // Proses Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});