<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus; // tambah ini

class AdminController extends Controller
{
    public function index()
    {
        $semua_bus = Bus::all(); // tambah ini

        return view('admin.dashboard', compact('semua_bus')); // ubah ini
    }
}