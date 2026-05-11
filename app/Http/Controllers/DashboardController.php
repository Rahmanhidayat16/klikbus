<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // kalau admin → dashboard admin
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // ambil semua schedule + relasi
        $query = Schedule::with(['bus', 'route']);

        // filter asal
        if ($request->filled('asal')) {
            $query->whereHas('route', function ($q) use ($request) {
                $q->where('departure', $request->asal);
            });
        }

        // filter tujuan
        if ($request->filled('tujuan')) {
            $query->whereHas('route', function ($q) use ($request) {
                $q->where('destination', $request->tujuan);
            });
        }

        // filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('departure_time', $request->tanggal);
        }

        $schedules = $query->latest()->get();

        return view('dashboard', compact('schedules'));
    }
}