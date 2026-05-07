<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\RouteController;
Route::get('/', function () {
    return view('welcome');
});
Route::resource('schedules', ScheduleController::class);
Route::resource('routes', RouteController::class);