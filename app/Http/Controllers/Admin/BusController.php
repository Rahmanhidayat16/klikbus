<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus; // Pastikan model Bus sudah dibuat
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        // Jika sudah ada database: $buses = Bus::all();
        return view('admin.bus.index');
    }

    public function create()
    {
        return view('admin.bus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_armada' => 'required',
            'kapasitas' => 'required|numeric',
            'tipe' => 'required'
        ]);

        // Logika simpan ke database
        // Bus::create($request->all());

        return redirect()->route('admin.bus.index')->with('success', 'Armada berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        // Logika hapus
        // Bus::find($id)->delete();
        return redirect()->route('admin.bus.index');
    }
}