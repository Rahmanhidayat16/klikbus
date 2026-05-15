<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Route; 
use App\Models\Schedule;
use App\Models\Booking;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $semua_bus    = Bus::all();
        $total_bus = Bus::count();
        $schedules = Schedule::all();
        $jumlah_rute  = Route::count(); 
        $total_jadwal = Schedule::count();

        $pesanan_hari_ini = Booking::whereDate(
        'created_at',
        Carbon::today()
        )->count();

        $total_pendapatan = Booking::where(
        'booking_status',
        'confirmed'
         )->sum('total_price');

         $pesanan_terbaru = Booking::with([
        'user',
        'schedule.route'
         ])
            ->latest()
            ->take(10)
            ->get();
        
        $rute_populer = Booking::join('schedules', 'bookings.schedule_id', '=', 'schedules.id')
        ->join('routes', 'schedules.route_id', '=', 'routes.id')
        ->select(
        DB::raw("CONCAT(routes.departure, ' - ', routes.destination) as nama_rute"),
        DB::raw('COUNT(bookings.id) as total')
        )
            ->groupBy('routes.departure', 'routes.destination')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $chart_labels = $rute_populer->pluck('nama_rute');
        $chart_data   = $rute_populer->pluck('total');

        $penjualan_mingguan = Booking::select(
        DB::raw('DATE(created_at) as tanggal'),
        DB::raw('COUNT(*) as total')
        )
            ->whereDate('created_at', '>=', now()->subDays(6))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        
        $line_labels = $penjualan_mingguan->map(function ($item) {
            return \Carbon\Carbon::parse($item->tanggal)
            ->translatedFormat('D (d/m)');
        });
        $line_data   = $penjualan_mingguan->pluck('total');
        
        return view('admin.dashboard', compact(
            'semua_bus',
            'total_bus',
            'schedules',
            'jumlah_rute',
            'total_jadwal',
            'pesanan_hari_ini',
            'total_pendapatan',
            'pesanan_terbaru',
            'chart_labels',
            'chart_data',
            'line_labels',
            'line_data'
        ));
    }
}