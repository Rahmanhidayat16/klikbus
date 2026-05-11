<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookingController extends Controller
{
    // 1. Tampilkan daftar jadwal (Kalau perlu)
    public function index(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Admin tidak bisa pesan tiket.');
        }

        $schedules = Schedule::with(['bus', 'route'])->get();
        if ($schedules->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'Belum ada jadwal tersedia.');
        }

        $selectedScheduleId = $request->schedule_id ?? $schedules->first()->id;
        $selectedSchedule = $schedules->where('id', $selectedScheduleId)->first();
        
        // Ambil kursi yang sudah di-booking untuk jadwal ini
        $bookedSeats = Booking::where('schedule_id', $selectedScheduleId)
            ->whereIn('payment_status', ['paid', 'pending'])
            ->pluck('seat_number')
            ->toArray();

        return view('bookings.index', compact('schedules', 'selectedSchedule', 'bookedSeats'));
    }

    // 2. Simpan pesanan awal (Status: Pending)
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required',
            'seat_numbers' => 'required|array',
            'seat_numbers.*' => 'numeric',
        ]);

        $schedule = Schedule::with('route')->findOrFail($request->schedule_id);
        $lastId = null;

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

    // 3. Halaman Bayar (Sudah digabung & Aman)
    public function checkout($id)
    {
        $booking = Booking::with(['schedule.bus', 'schedule.route'])->findOrFail($id);

        // Security Check: Biar nggak bisa stalk tiket orang lain
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Waduh, mau ngintip pesanan siapa nih? Gak boleh ya!');
        }

        // Ambil semua kursi yang dipesan dalam satu sesi (status pending)
        $allBookings = Booking::where('user_id', Auth::id())
                              ->where('schedule_id', $booking->schedule_id)
                              ->where('payment_status', 'pending')
                              ->get();

        $total = $allBookings->sum('total_price');
        
        // Kita kirim dua versi: string buat tampilan, array buat logic kalau perlu
        $seats_text = $allBookings->pluck('seat_number')->implode(', '); 
        $seats = $allBookings->pluck('seat_number')->toArray();

        return view('bookings.checkout', compact('booking', 'total', 'seats', 'seats_text'));
    }

    // 4. Proses Bayar (Simulasi)
    public function processPayment(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        Booking::where('user_id', Auth::id())
                ->where('schedule_id', $booking->schedule_id)
                ->where('payment_status', 'pending')
                ->update([
                    'payment_status' => 'paid',
                    'paid_at' => now(),
                    'payment_method' => $request->payment_method ?? 'Transfer Bank'
                ]);

        return redirect()->route('bookings.show', $booking->id);
    }

    // 5. Tampilan E-Tiket Akhir
    public function show($id)
    {
        $booking = Booking::with(['user', 'schedule.bus', 'schedule.route'])->findOrFail($id);
        
        // Ambil list kursi yang sudah PAID
        $seats = Booking::where('user_id', $booking->user_id)
                        ->where('schedule_id', $booking->schedule_id)
                        ->where('payment_status', 'paid')
                        ->pluck('seat_number')
                        ->toArray();

        // Generate QR Code otomatis
        $qrcode = QrCode::size(200)->generate('CLICKBUS-' . $booking->id);

        return view('bookings.show', compact('booking', 'qrcode', 'seats'));
    }
    public function history()
    {
        // Narik data booking punya user yang login + relasinya (biar gak Rp 0)
        $bookings = Auth::user()->bookings()
                    ->with(['schedule.route', 'schedule.bus'])
                    ->latest()
                    ->get();

        return view('bookings.history', compact('bookings'));
    }

    // 6. Tiket Aktif (Belum Berangkat)
    public function activeTickets()
    {
        // Narik data booking yang statusnya paid atau pending
        $bookings = Auth::user()->bookings()
                    ->whereIn('payment_status', ['paid', 'pending'])
                    ->with(['schedule.route', 'schedule.bus'])
                    ->latest()
                    ->get();

        return view('bookings.active', compact('bookings'));
    }
}