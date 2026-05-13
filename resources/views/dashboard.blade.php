@extends('layouts.dashboard')

@section('title', 'Dashboard - KlikBus')

@section('content')
<div class="relative h-screen w-full flex overflow-hidden font-sans">
    {{-- BACKGROUND --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/bus.png') }}" class="w-full h-full object-cover filter blur-[1px] scale-105">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/40 via-white/20 to-transparent"></div>
        <div class="absolute inset-0 bg-white/10 backdrop-blur-[2px]"></div>
    </div>

    {{-- SIDEBAR --}}
    <aside class="relative z-20 w-72 bg-white/40 backdrop-blur-3xl border-r border-white/50 flex flex-col shadow-2xl">
        <div class="p-8">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 p-2 rounded-lg shadow-lg"><i class="fa-solid fa-bus text-white text-xl"></i></div>
                <div>
                    <h1 class="font-black text-2xl tracking-tight text-blue-800 leading-none">KlikBus</h1>
                    <p class="text-[10px] text-blue-900/60 font-black uppercase tracking-[0.2em] mt-1">Travel Lampung</p>
                </div>
            </div>
        </div>
        <nav class="flex-1 px-4 space-y-2 mt-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-4 bg-blue-600 shadow-lg p-4 rounded-2xl font-bold text-white transition-all">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
            <a href="{{ route('bookings.active') }}" class="flex items-center gap-4 hover:bg-white/40 p-4 rounded-2xl font-semibold text-slate-700 transition-all group">
                <i class="fa-solid fa-ticket text-blue-600 group-hover:scale-110"></i> Tiket Saya
            </a>
            <a href="{{ route('bookings.history') }}" class="flex items-center gap-4 hover:bg-white/40 p-4 rounded-2xl font-semibold text-slate-700 transition-all group">
                <i class="fa-solid fa-clock-rotate-left text-blue-600 group-hover:scale-110"></i> Riwayat Pemesanan
            </a>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-4 hover:bg-white/40 p-4 rounded-2xl font-semibold text-slate-700 transition-all group">
                <i class="fa-solid fa-user-gear text-blue-600 group-hover:scale-110"></i> Edit Profil
            </a>
        </nav>
        <div class="p-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-500/10 hover:bg-red-600 hover:text-white text-red-600 py-3.5 rounded-2xl font-bold transition-all flex items-center justify-center gap-2 text-sm border border-red-200/50 shadow-sm">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar Sesi
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="relative z-10 flex-1 flex flex-col h-screen overflow-y-auto custom-scroll p-10">
        {{-- TOPBAR --}}
        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-black text-slate-800">Halo, {{ Auth::user()->name }}! 👋</h2>
                <p class="text-slate-500 font-medium">Cari tiket bus untuk perjalananmu selanjutnya.</p>
            </div>
            <div class="flex items-center gap-4 bg-white/60 backdrop-blur-md p-2 pr-6 rounded-full border border-white shadow-sm">
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold shadow-md">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <a href="{{ route('profile.edit') }}" class="text-sm font-bold text-slate-700 hover:text-blue-600 transition-colors">
                    Edit Profil
                </a>
            </div>
        </div>

        {{-- SEARCH BAR --}}
        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-blue-900/5 border border-white mb-10">
            <form action="{{ route('dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Keberangkatan</label>
                    <div class="relative">
                        <i class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-blue-600"></i>
                        <input type="text" name="departure" placeholder="Asal Kota" value="{{ request('departure') }}"
                               class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-100 font-bold text-slate-700 shadow-inner">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Tujuan</label>
                    <div class="relative">
                        <i class="fa-solid fa-map-pin absolute left-4 top-1/2 -translate-y-1/2 text-red-500"></i>
                        <input type="text" name="destination" placeholder="Tujuan Kota" value="{{ request('destination') }}"
                               class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-100 font-bold text-slate-700 shadow-inner">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Tanggal</label>
                    <div class="relative">
                        <i class="fa-solid fa-calendar-day absolute left-4 top-1/2 -translate-y-1/2 text-blue-600"></i>
                        <input type="date" name="date" value="{{ request('date', date('Y-m-d')) }}"
                               class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-100 font-bold text-slate-700 shadow-inner">
                    </div>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-black py-4 rounded-2xl transition-all shadow-lg shadow-yellow-200 active:scale-95 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-magnifying-glass"></i> CARI JADWAL
                    </button>
                </div>
            </form>
        </div>

        {{-- RUTE POPULER --}}
        <div class="mb-10">
            <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6 flex items-center gap-2">
                <span class="w-8 h-px bg-slate-200"></span> Rute Populer
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach(['B. Lampung - Bakauheni', 'Metro - B. Lampung', 'Pringsewu - Rajabasa', 'Kalianda - Panjang'] as $route)
                <div class="bg-white/60 hover:bg-white p-4 rounded-3xl border border-white shadow-sm transition-all cursor-pointer group">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-3 group-hover:bg-blue-600 group-hover:text-white transition-all">
                        <i class="fa-solid fa-star text-xs"></i>
                    </div>
                    <p class="font-bold text-slate-700 text-sm">{{ $route }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- DAFTAR JADWAL --}}
        <div>
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-8 h-px bg-slate-200"></span> Jadwal Tersedia
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Pastikan variabel $schedules dikirim dari DashboardController --}}
                @forelse($schedules ?? [] as $schedule)
                    <div class="bg-white rounded-[2rem] border border-white shadow-xl shadow-blue-900/5 overflow-hidden group hover:-translate-y-1 transition-all">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest">
                                    {{ $schedule->bus->type }}
                                </span>
                                <p class="font-black text-blue-800 text-lg">Rp {{ number_format($schedule->route->base_price, 0, ',', '.') }}</p>
                            </div>
                            
                            <div class="flex items-center gap-3 mb-6">
                                <div class="flex flex-col items-center gap-1">
                                    <div class="w-2 h-2 rounded-full border-2 border-blue-600"></div>
                                    <div class="w-0.5 h-6 bg-slate-100"></div>
                                    <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-slate-800 leading-none mb-4">{{ $schedule->route->departure }}</h4>
                                    <h4 class="font-bold text-slate-800 leading-none">{{ $schedule->route->destination }}</h4>
                                </div>
                            </div>

                            <div class="flex justify-between items-center pt-5 border-t border-slate-50">
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $schedule->bus->bus_name }}</p>
                                    <p class="text-sm font-bold text-slate-700">
                                        <i class="fa-regular fa-clock mr-1 text-blue-600"></i> 
                                        {{ \Carbon\Carbon::parse($schedule->departure_time)->format('H:i') }} WIB
                                    </p>
                                </div>
                                {{-- Diarahkan ke halaman pilih kursi --}}
                                <a href="{{ route('bookings.index', ['schedule_id' => $schedule->id]) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold text-xs transition-all shadow-md shadow-blue-200">
                                    PESAN
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 bg-white/40 backdrop-blur-sm rounded-[3rem] border border-dashed border-slate-300 flex flex-col items-center justify-center">
                        <i class="fa-solid fa-bus-simple text-4xl text-slate-300 mb-4"></i>
                        <p class="font-bold text-slate-400">Jadwal belum tersedia atau tidak ditemukan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
</div>
@endsection