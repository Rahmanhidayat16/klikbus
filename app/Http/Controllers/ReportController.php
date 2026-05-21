<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class ReportController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        // 1. Ambil pilihan range dari URL, default-nya 'today' (Hari Ini)
        $range = $request->input('range', 'today');

        // 2. Siapkan query dasar pengambilan data booking beserta relasinya
        $query = \App\Models\Booking::with(['user', 'schedule.route', 'schedule.bus']);

        // 3. Saring data berdasarkan tombol range yang diklik
        switch ($range) {
            case 'today':
                $query->whereDate('created_at', now()->today());
                $label = 'Hari Ini (' . now()->translatedFormat('d M Y') . ')';
                break;
            case 'this_week':
                // Saring transaksi dari hari senin sampai minggu di pekan ini
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                $label = 'Minggu Ini (' . now()->startOfWeek()->translatedFormat('d M') . ' - ' . now()->endOfWeek()->translatedFormat('d M Y') . ')';
                break;
            case 'this_month':
                $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
                $label = 'Bulan Ini (' . now()->translatedFormat('F Y') . ')';
                break;
            case 'this_year':
                $query->whereYear('created_at', now()->year);
                $label = 'Tahun Ini (' . now()->format('Y') . ')';
                break;
            default:
                $query->whereDate('created_at', now()->today());
                $label = 'Hari Ini';
                break;
        }

        // 4. Eksekusi data ke database
        $bookings = $query->latest()->get();
        
        // 5. Hitung total pendapatan dari hasil saringan (hanya status confirmed/lunas)
        $total_pendapatan = $bookings->where('booking_status', 'confirmed')->sum('total_price');

        // 6. Lempar semua variabel ke halaman view admin
        return view('admin.reports.bookings', compact('bookings', 'total_pendapatan', 'range', 'label'));
    }
}