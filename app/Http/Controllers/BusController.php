<?php

namespace App\Http\Controllers;

use App\Models\Bus; 
use Illuminate\Http\Request;

class BusController extends Controller
{
    // 1. Tampilkan Semua Bus
    public function index()
{
    $semua_bus = Bus::all();
    return view('admin.bus.index', compact('semua_bus')); // Rahman taruh file di resources/views/admin/bus/
}

    // 2. Tampilkan Form Tambah
    public function create()
    {
        return view('admin.bus.create');
    }

    // 3. Simpan Bus Baru
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

    // 4. Tampilkan Form Edit
    public function edit($id)
    {
        $bus = Bus::findOrFail($id);
        return view('admin.bus.edit', compact('bus'));
    }

    // 5. Update Data Bus
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

    // 6. Hapus Bus
    public function destroy($id)
    {
        $bus = Bus::findOrFail($id);
        $bus->delete();

        return redirect()->route('admin.bus.index')->with('success', '...');
    }
}