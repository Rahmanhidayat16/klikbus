<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Schedule;

class RouteController extends Controller
{
    
    public function index()
{
    $routes = Route::withCount('schedules')->latest()->get();

    $total_bus     = \App\Models\Bus::count();
    $total_rute    = Route::count();
    $total_jadwal  = Schedule::count();

    return view('admin.routes.index', compact(
        'routes',
        'total_bus',
        'total_rute',
        'total_jadwal'
    ));
}
    public function store(Request $request)
    {
        $request->validate([
            'departure'   => 'required|string|max:100',
            'destination' => 'required|string|max:100',
            'base_price'  => 'required|numeric|min:0',
        ]);

        Route::create($request->only('departure', 'destination', 'base_price'));

        return redirect()->route('admin.routes.index')
            ->with('success', 'Rute berhasil ditambahkan.');
    }

    public function update(Request $request, Route $route)
    {
        $request->validate([
            'departure'   => 'required|string|max:100',
            'destination' => 'required|string|max:100',
            'base_price'  => 'required|numeric|min:0',
        ]);

        $route->update($request->only('departure', 'destination', 'base_price'));

        return redirect()->route('admin.routes.index')
            ->with('success', 'Rute berhasil diperbarui.');
    }

    public function destroy(Route $route)
    {
        $route->delete();

        return redirect()->route('admin.routes.index')
            ->with('success', 'Rute berhasil dihapus.');
    }

    // Tidak dipakai tapi wajib ada karena resource route
    public function create() { return redirect()->route('admin.routes.index'); }
    public function show(Route $route) { return redirect()->route('admin.routes.index'); }
    public function edit(Route $route) { return redirect()->route('admin.routes.index'); }
}