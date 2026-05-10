<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookingController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['bus', 'route'])->get();
        return view('bookings.index', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required',
            'seat_numbers' => 'required|array',
            'seat_numbers.*' => 'numeric',
        ]);

        $schedule = Schedule::with('route')->findOrFail($request->schedule_id);
        $lastId = null;

        // Simpan tiap kursi jadi satu baris di database
        foreach ($request->seat_numbers as $seat) {
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'schedule_id' => $request->schedule_id,
                'seat_number' => $seat,
                'total_price' => $schedule->route->base_price,
                'payment_status' => 'pending',
                'booking_status' => 'confirmed',
                'payment_method' => 'Pending'
            ]);
            $lastId = $booking->id;
        }

        return redirect()->route('bookings.checkout', $lastId);
    }

    public function checkout($id)
    {
        $booking = Booking::with(['schedule.bus', 'schedule.route'])->findOrFail($id);

        // Ambil semua kursi yang dipesan barengan (status pending)
        $allBookings = Booking::where('user_id', Auth::id())
                              ->where('schedule_id', $booking->schedule_id)
                              ->where('payment_status', 'pending')
                              ->get();

        $total = $allBookings->sum('total_price');
        $seats = $allBookings->pluck('seat_number')->toArray();

        return view('bookings.checkout', compact('booking', 'total', 'seats'));
    }

    public function processPayment(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Update SEMUA tiket yang dipesan barengan jadi PAID
        Booking::where('user_id', Auth::id())
                ->where('schedule_id', $booking->schedule_id)
                ->where('payment_status', 'pending')
                ->update([
                    'payment_status' => 'paid',
                    'paid_at' => now(),
                    'payment_method' => $request->payment_method ?? 'VA' // Pakai kode pendek biar gak error data long
                ]);

        return redirect()->route('bookings.show', $booking->id);
    }

    public function show($id)
    {
        $booking = Booking::with(['user', 'schedule.bus', 'schedule.route'])->findOrFail($id);
        
        // Ambil list kursi yang sudah dibayar
        $seats = Booking::where('user_id', $booking->user_id)
                        ->where('schedule_id', $booking->schedule_id)
                        ->where('payment_status', 'paid')
                        ->pluck('seat_number')
                        ->toArray();

        $qrcode = QrCode::size(200)->generate('TICKET-' . $booking->id);

        return view('bookings.show', compact('booking', 'qrcode', 'seats'));
    }
}