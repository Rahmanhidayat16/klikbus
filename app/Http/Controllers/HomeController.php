<?php

namespace App\Http\Controllers;

use App\Models\Schedule; // Pakai model Schedule bawaan lu
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function rute()
    {
        // Ambil jadwal beserta data bus dan rutenya (Eager Loading)
        $schedules = Schedule::with(['bus', 'route'])->get();
        return view('rute', compact('schedules'));
    }
}