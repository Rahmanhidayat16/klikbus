<?php

namespace App\Http\Controllers;

use App\Models\Bus; 
use Illuminate\Http\Request;
use App\Models\Schedule;

class BusController extends Controller
{

    public function index()
{
    $semua_bus = Bus::all();
    $total_bus     = Bus::count();
    $total_rute    = \App\Models\Route::count();
    $total_jadwal  = Schedule::count();

    return view('admin.bus.index', compact(
        'semua_bus',
        'total_bus',
        'total_rute',
        'total_jadwal'
    )); 
}

    public function create()
    {
        return view('admin.bus.create');
    }

    public function store(Request $request)
    {
        $pesan = [
            'bus_name.required' => 'Nama bus wajib diisi.',
            'type.required' => 'Tipe bus wajib diisi.',
            'total_seats.required' => 'Jumlah kursi wajib diisi.',
            'total_seats.numeric' => 'Jumlah kursi harus berupa angka.',
        ];

       $request->validate([
            'bus_name' => 'required',
            'type' => 'required',
            'total_seats' => 'required|numeric',
            'status' => 'required', 
        ], $pesan);

        Bus::create($request->all());

        return redirect()->route('admin.bus.index')->with('success', '...');
    }

    public function edit($id)
    {
        $bus = Bus::findOrFail($id);
        return view('admin.bus.edit', compact('bus'));
    }

    public function update(Request $request, $id)
    {
        $pesan = [
            'bus_name.required' => 'Nama bus wajib diisi.',
            'type.required' => 'Tipe bus wajib diisi.',
            'total_seats.required' => 'Jumlah kursi wajib diisi.',
            'total_seats.numeric' => 'Jumlah kursi harus berupa angka.',
        ];

        $request->validate([
            'bus_name' => 'required',
            'type' => 'required',
            'total_seats' => 'required|numeric',
            'status' => 'required',
        ], $pesan);

        $bus = Bus::findOrFail($id);
        $bus->update($request->all());

       return redirect()->route('admin.bus.index')->with('success', '...');
    }

    public function destroy($id)
    {
        $bus = Bus::findOrFail($id);
        $bus->delete();

        return redirect()->route('admin.bus.index')->with('success', '...');
    }
}