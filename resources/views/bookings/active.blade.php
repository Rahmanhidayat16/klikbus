@extends('layouts.dashboard')

@section('title', 'Tiket Aktif - KlikBus')

@section('content')
<div class="max-w-6xl mx-auto">
    
    {{-- HEADER --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-blue-600 font-bold text-sm flex items-center gap-2 transition-colors inline-block mb-4">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
            <h1 class="text-3xl font-black text-slate-900 mb-1">
                Tiket Saya
            </h1>
            <p class="text-slate-500 text-sm">
                Daftar tiket aktif yang sedang menunggu pembayaran atau siap untuk perjalanan.
            </p>
        </div>
        <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-xl text-sm transition-all shadow-md flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Pesan Tiket Baru
        </a>
    </div>

    {{-- TICKET GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($bookings as $booking)
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all flex flex-col justify-between relative overflow-hidden group">
                
                {{-- Decorative background shape --}}
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-slate-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 pointer-events-none"></div>

                <div>
                    {{-- Status Badge & Booking ID --}}
                    <div class="flex justify-between items-start mb-5 relative z-10">
                        @if(strtolower($booking->payment_status) == 'paid')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-green-200 shadow-sm shadow-green-100 flex items-center gap-1.5">
                                <div class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></div> Lunas
                            </span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border border-yellow-200 shadow-sm shadow-yellow-100 flex items-center gap-1.5">
                                <div class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></div> Menunggu
                            </span>
                        @endif
                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest">#KB-{{ $booking->id }}</span>
                    </div>

                    {{-- Route Info --}}
                    <div class="mb-5 relative z-10">
                        <div class="flex items-center gap-3 mb-1">
                            <h3 class="text-lg font-black text-slate-800">{{ $booking->schedule->route->departure }}</h3>
                            <i class="fa-solid fa-arrow-right text-slate-300 text-xs"></i>
                            <h3 class="text-lg font-black text-slate-800">{{ $booking->schedule->route->destination }}</h3>
                        </div>
                        <p class="text-sm font-bold text-slate-500">{{ $booking->schedule->bus->bus_name }} ({{ $booking->schedule->bus->type }})</p>
                    </div>

                    {{-- Details Grid --}}
                    <div class="grid grid-cols-2 gap-3 mb-6 relative z-10">
                        <div class="bg-slate-50 rounded-2xl p-3 border border-slate-100">
                            <p class="text-[10px] font-black uppercase text-slate-400 mb-1 tracking-widest">Jadwal</p>
                            <h4 class="text-sm font-bold text-slate-800">{{ \Carbon\Carbon::parse($booking->schedule->departure_time)->translatedFormat('d M') }}</h4>
                            <p class="text-[10px] font-bold text-slate-500">{{ \Carbon\Carbon::parse($booking->schedule->departure_time)->format('H:i') }} WIB</p>
                        </div>
                        <div class="bg-slate-50 rounded-2xl p-3 border border-slate-100">
                            <p class="text-[10px] font-black uppercase text-slate-400 mb-1 tracking-widest">Nomor Kursi</p>
                            <h4 class="text-lg font-black text-blue-600">{{ $booking->seat_number }}</h4>
                        </div>
                    </div>
                </div>

                {{-- Action Button --}}
                <div class="relative z-10">
                    @if(strtolower($booking->payment_status) == 'paid')
                        <a href="{{ route('bookings.show', $booking->id) }}" class="w-full flex justify-center items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white font-bold py-3 rounded-xl text-sm transition-all shadow-md active:scale-95">
                            <i class="fa-solid fa-qrcode"></i> Lihat E-Tiket
                        </a>
                    @else
                        <a href="{{ route('bookings.checkout', $booking->id) }}" class="w-full flex justify-center items-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-black py-3 rounded-xl text-sm transition-all shadow-md active:scale-95">
                            <i class="fa-solid fa-wallet"></i> Bayar Sekarang
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-3xl p-12 text-center border border-dashed border-slate-300">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-ticket text-3xl text-slate-300"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-700 mb-2">
                        Belum Ada Tiket Aktif
                    </h3>
                    <p class="text-slate-500 text-sm mb-6 max-w-md mx-auto">
                        Anda belum memiliki tiket yang aktif atau menunggu pembayaran. Yuk cari jadwal dan pesan tiket sekarang!
                    </p>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-xl text-sm transition-all shadow-md shadow-blue-200">
                        <i class="fa-solid fa-magnifying-glass"></i> Cari Tiket Bus
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
