<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Booking::with(['user', 'schedule.route', 'schedule.bus']);

        if ($search) {
            // Trik Sulap: Hapus huruf "#KB-" dan nol di depan biar jadi angka murni
            // Misal ngetik "#KB-0005" -> bakal diubah otomatis jadi angka "5"
            $searchId = (int) preg_replace('/[^0-9]/', '', $search);

            // Kita kurung pencariannya pakai function() biar nggak tabrakan
            $query->where(function($q) use ($search, $searchId) {
                // 1. Cari berdasarkan ID yang udah dibersihin (kalau dia ngetik ID)
                $q->where('id', $searchId)
                  // 2. ATAU cari berdasarkan nama (kalau dia ngetik nama)
                  ->orWhereHas('user', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $tickets = $query->latest()->get();
        $pesanan_hari_ini = Booking::whereDate('created_at', now()->today())->count();

        return view('admin.tickets.index', compact('tickets', 'search', 'pesanan_hari_ini'));
    }
}