<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Route;
use App\Models\Bus;

class ScheduleController extends Controller
{

    public function index()
{
    $schedules = Schedule::with(['route', 'bus'])->latest()->get();
    $routes    = Route::all();
    $buses     = Bus::all();

    return view('admin.schedules.index', [
        'schedules'    => $schedules,
        'routes'       => $routes,
        'buses'        => $buses,
        'semua_bus'    => $buses, 
        'total_bus'    => $buses->count(),
        'total_rute'   => $routes->count(),
        'total_jadwal' => $schedules->count(),
    ]);
}

    public function store(Request $request)
    {
        $request->validate([
            'route_id'       => 'required|exists:routes,id',
            'bus_id'         => 'required|exists:buses,id',
            'departure_time' => 'required|date',
            'arrival_time'   => 'required|date|after:departure_time',
            'status'         => 'required|in:scheduled,on_trip,completed,cancelled',
        ], [
            'arrival_time.after' => 'Waktu tiba harus setelah waktu berangkat.',
        ]);

        Schedule::create($request->only(
            'route_id', 'bus_id', 'departure_time', 'arrival_time', 'status'
        ));

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'route_id'       => 'required|exists:routes,id',
            'bus_id'         => 'required|exists:buses,id',
            'departure_time' => 'required|date',
            'arrival_time'   => 'required|date|after:departure_time',
            'status'         => 'required|in:scheduled,on_trip,completed,cancelled',
        ], [
            'arrival_time.after' => 'Waktu tiba harus setelah waktu berangkat.',
        ]);

        $schedule->update($request->only(
            'route_id', 'bus_id', 'departure_time', 'arrival_time', 'status'
        ));

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }

    // Wajib ada karena resource route
    public function create()
    {
        // Narik data bus dan rute buat di tampilin di pilihan form (dropdown)
        $routes = Route::all();
        $buses = Bus::all();
        
        return view('admin.schedules.create', compact('routes', 'buses'));
    }

    public function show(Schedule $schedule) 
    { 
        return abort(404); // Kosongin aja dulu kalau ga dipake
    }

    public function edit(Schedule $schedule) 
    { 
        $routes = Route::all();
        $buses = Bus::all();
        return view('admin.schedules.edit', compact('schedule', 'routes', 'buses')); 
    }
}