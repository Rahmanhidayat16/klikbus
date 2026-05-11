@extends('layouts.dashboard')

@section('title', 'Riwayat Pemesanan - KlikBus')

@section('content')
<div class="max-w-6xl mx-auto">
    
    {{-- HEADER --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 mb-1">
                Riwayat Pemesanan
            </h1>
            <p class="text-slate-500 text-sm">
                Daftar seluruh transaksi dan perjalanan yang pernah Anda lakukan.
            </p>
        </div>
    </div>

    {{-- DATA TABLE --}}
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="py-4 px-6 text-[10px] font-black uppercase text-slate-400 tracking-widest whitespace-nowrap">ID Booking</th>
                        <th class="py-4 px-6 text-[10px] font-black uppercase text-slate-400 tracking-widest whitespace-nowrap">Rute</th>
                        <th class="py-4 px-6 text-[10px] font-black uppercase text-slate-400 tracking-widest whitespace-nowrap">Jadwal</th>
                        <th class="py-4 px-6 text-[10px] font-black uppercase text-slate-400 tracking-widest whitespace-nowrap">Kursi</th>
                        <th class="py-4 px-6 text-[10px] font-black uppercase text-slate-400 tracking-widest whitespace-nowrap">Total Harga</th>
                        <th class="py-4 px-6 text-[10px] font-black uppercase text-slate-400 tracking-widest whitespace-nowrap">Status</th>
                        <th class="py-4 px-6 text-[10px] font-black uppercase text-slate-400 tracking-widest whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-700 text-sm">#KB-{{ $booking->id }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <p class="font-bold text-slate-800 text-sm">{{ $booking->schedule->route->departure }} <i class="fa-solid fa-arrow-right text-[10px] text-blue-400 mx-1"></i> {{ $booking->schedule->route->destination }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $booking->schedule->bus->bus_name }}</p>
                            </td>
                            <td class="py-4 px-6">
                                <p class="font-bold text-slate-800 text-sm">{{ \Carbon\Carbon::parse($booking->schedule->departure_time)->translatedFormat('d M Y') }}</p>
                                <p class="text-xs text-slate-500 mt-0.5">{{ \Carbon\Carbon::parse($booking->schedule->departure_time)->format('H:i') }} WIB</p>
                            </td>
                            <td class="py-4 px-6">
                                <span class="bg-slate-100 text-slate-600 px-2.5 py-1 rounded-md text-xs font-bold">{{ $booking->seat_number }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-800 text-sm">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                            </td>
                            <td class="py-4 px-6">
                                @if(strtolower($booking->payment_status) == 'paid')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-green-200">Lunas</span>
                                @elseif(strtolower($booking->payment_status) == 'pending')
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-yellow-200">Tertunda</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-red-200">{{ $booking->payment_status }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if(strtolower($booking->payment_status) == 'paid')
                                    <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs bg-blue-50 hover:bg-blue-100 px-3 py-2 rounded-lg transition-colors inline-block whitespace-nowrap border border-blue-100">
                                        <i class="fa-solid fa-ticket mr-1"></i> E-Tiket
                                    </a>
                                @elseif(strtolower($booking->payment_status) == 'pending')
                                    <a href="{{ route('bookings.checkout', $booking->id) }}" class="text-yellow-600 hover:text-yellow-800 font-bold text-xs bg-yellow-50 hover:bg-yellow-100 px-3 py-2 rounded-lg transition-colors inline-block whitespace-nowrap border border-yellow-100">
                                        <i class="fa-solid fa-wallet mr-1"></i> Bayar
                                    </a>
                                @else
                                    <span class="text-slate-400 text-xs">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 px-6 text-center">
                                <div class="flex flex-col items-center justify-center opacity-50">
                                    <i class="fa-solid fa-clock-rotate-left text-4xl mb-4 text-slate-300"></i>
                                    <p class="font-bold text-slate-500">Belum ada riwayat pemesanan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection