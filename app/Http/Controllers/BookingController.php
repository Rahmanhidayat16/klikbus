<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        // Ambil jadwal yang statusnya masih 'scheduled'
        $schedules = Schedule::with(['bus', 'route'])->get();
        return view('bookings.index', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required',
            'seat_number' => 'required',
        ]);

        $schedule = Schedule::find($request->schedule_id);

        Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $request->schedule_id,
            'seat_number' => $request->seat_number,
            'total_price' => $schedule->route->base_price,
            'payment_status' => 'pending',
            'booking_status' => 'confirmed',
            'payment_method' => 'Cash'
        ]);

        return redirect()->route('dashboard')->with('success', 'Tiket berhasil dipesan!');
    }
}