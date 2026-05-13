<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus; 
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
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


        return redirect()->route('admin.bus.index')->with('success', 'Armada berhasil ditambahkan!');
    }

    public function destroy($id)
    {
    
        return redirect()->route('admin.bus.index');
    }
}