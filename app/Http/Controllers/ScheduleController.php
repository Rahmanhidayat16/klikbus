<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Bus;   // Wajib dipanggil untuk dropdown form
use App\Models\Route; // Wajib dipanggil untuk dropdown form
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // 1. Tampilkan Semua Jadwal
    public function index()
    {
        // 1. Koki masak data: Ambil semua jadwal dari database, sekalian narik data bus & rute
        $schedules = \App\Models\Schedule::with(['bus', 'route'])->latest()->get();
        
        // 2. Koki ngirim makanan: Buka halaman index dan bawa data $schedules tadi (pake compact)
        return view('admin.schedules.index', compact('schedules'));
    }

    // 2. Tampilkan Form Tambah
    public function create()
{
    $buses = Bus::all();
    $routes = Route::all();
    return view('admin.schedules.create', compact('buses', 'routes'));
}
    // 3. Simpan Jadwal Baru
    public function store(Request $request)
    {
        $pesan = [
            'bus_id.required' => 'Pilihan bus wajib diisi.',
            'route_id.required' => 'Pilihan rute wajib diisi.',
            'departure_time.required' => 'Waktu keberangkatan wajib diisi.',
            'departure_time.date' => 'Format waktu keberangkatan tidak valid.',
        ];

        $request->validate([
            'bus_id' => 'required',
            'route_id' => 'required',
            'departure_time' => 'required|date',
            // Kalau ada arrival_time (waktu tiba), tambahin aja di sini
        ], $pesan);

        Schedule::create($request->all());

       return redirect()->route('admin.schedules.index')->with('success', 'Jadwal Berhasil Ditambahkan!');
    }

    // 4. Tampilkan Form Edit
    public function edit($id)
    {
        $jadwal = Schedule::findOrFail($id);
        $buses = Bus::all();
        $routes = Route::all();
        
        return view('schedules.edit', compact('jadwal', 'buses', 'routes'));
    }

    // 5. Update Data Jadwal
    public function update(Request $request, $id)
    {
        $pesan = [
            'bus_id.required' => 'Pilihan bus wajib diisi.',
            'route_id.required' => 'Pilihan rute wajib diisi.',
            'departure_time.required' => 'Waktu keberangkatan wajib diisi.',
            'departure_time.date' => 'Format waktu keberangkatan tidak valid.',
        ];

        $request->validate([
            'bus_id' => 'required',
            'route_id' => 'required',
            'departure_time' => 'required|date',
        ], $pesan);

        $jadwal = Schedule::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('admin.schedules.index')->with('success', '...');
    }

    // 6. Hapus Jadwal
    public function destroy($id)
    {
        $jadwal = Schedule::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.schedules.index')->with('success', '...');
    }
}