<?php

namespace App\Http\Controllers;

use App\Models\Bus; // Pastikan memanggil Model Bus
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel buses
        $semua_bus = Bus::all();

        // Kirim data ke tampilan (view) bernama 'bus.index'
        return view('bus.index', compact('semua_bus'));
    }
}