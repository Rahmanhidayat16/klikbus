<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Bus;   // Butuh ini buat pilihan di form
use App\Models\Route; // Butuh ini juga
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        // Eager Loading: ambil jadwal sekalian sama data bus dan rutenya
        $schedules = Schedule::with(['bus', 'route'])->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        // Kirim data bus dan rute ke view biar Ledi bisa bikin dropdown
        $buses = Bus::all();
        $routes = Route::all();
        return view('schedules.create', compact('buses', 'routes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bus_id' => 'required',
            'route_id' => 'required',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'status' => 'required',
        ]);

        // Cuma ambil data yang memang ada di kolom database saja
Schedule::create($request->only([
    'bus_id', 
    'route_id', 
    'departure_time', 
    'arrival_time', 
    'status'
]));

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dibuat!');
    }
}