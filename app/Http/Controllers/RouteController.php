<?php

namespace App\Http\Controllers;

use App\Models\Route; // Pastikan nama model kamu benar Route
use Illuminate\Http\Request;

class RouteController extends Controller
{
    // 1. Tampilkan Semua Rute
    public function index()
    {
        $semua_rute = Route::all();
        return view('routes.index', compact('semua_rute'));
    }

    // 2. Tampilkan Form Tambah
    public function create()
    {
        return view('routes.create');
    }

    // 3. Simpan Rute Baru
    public function store(Request $request)
    {
        $pesan = [
            'departure.required' => 'Kota asal wajib diisi.',
            'destination.required' => 'Kota tujuan wajib diisi.',
            'base_price.required' => 'Harga dasar tiket wajib diisi.',
            'base_price.numeric' => 'Harga dasar tiket harus berupa angka.',
        ];

        $request->validate([
            'departure' => 'required',
            'destination' => 'required',
            'base_price' => 'required|numeric',
        ], $pesan);

        Route::create($request->all());

        return redirect()->route('routes.index')->with('success', 'Data rute berhasil ditambahkan.');
    }

    // 4. Tampilkan Form Edit
    public function edit($id)
    {
        $rute = Route::findOrFail($id);
        return view('routes.edit', compact('rute'));
    }

    // 5. Update Data Rute
    public function update(Request $request, $id)
    {
        $pesan = [
            'departure.required' => 'Kota asal wajib diisi.',
            'destination.required' => 'Kota tujuan wajib diisi.',
            'base_price.required' => 'Harga dasar tiket wajib diisi.',
            'base_price.numeric' => 'Harga dasar tiket harus berupa angka.',
        ];

        $request->validate([
            'departure' => 'required',
            'destination' => 'required',
            'base_price' => 'required|numeric',
        ], $pesan);

        $rute = Route::findOrFail($id);
        $rute->update($request->all());

        return redirect()->route('routes.index')->with('success', 'Data rute berhasil diperbarui.');
    }

    // 6. Hapus Rute
    public function destroy($id)
    {
        $rute = Route::findOrFail($id);
        $rute->delete();

        return redirect()->route('routes.index')->with('success', 'Data rute berhasil dihapus.');
    }
}