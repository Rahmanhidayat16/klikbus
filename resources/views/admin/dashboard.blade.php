@extends('layouts.dashboard')

@section('title', 'Dashboard - KlikBus')

@section('content')
    {{-- HEADER --}}
    <div class="flex justify-between items-start mb-8">
        <div>
            <p class="text-blue-600 font-bold text-sm mb-1">
                Selamat Datang 👋
            </p>
            <h1 class="text-3xl font-black text-slate-900 mb-1">
                Halo, {{ Auth::user()->name }}
            </h1>
            <p class="text-slate-500 text-sm">
                Mau pergi ke mana hari ini?
            </p>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('profile.edit') }}"
               class="bg-white border border-slate-200 px-4 py-2.5 rounded-xl font-bold text-slate-700 text-sm hover:bg-slate-50 shadow-sm flex items-center">
                <i class="fa-solid fa-user-pen mr-2 text-blue-600"></i>
                Edit Profil
            </a>
            <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center font-black text-xl shadow-lg shadow-blue-200">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>
    </div>

    {{-- SEARCH BOX --}}
    <section class="bg-blue-600 rounded-[2rem] p-8 relative overflow-hidden mb-10 shadow-lg shadow-blue-200/50">
        <div class="absolute right-[-60px] bottom-[-60px] w-64 h-64 rounded-full bg-blue-500 opacity-30"></div>

        <div class="flex items-center gap-4 mb-6 relative z-10">
            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center text-white text-xl">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div>
                <h2 class="text-white text-2xl font-black mb-1">
                    Cari Tiket Bus
                </h2>
                <p class="text-blue-100 text-sm">
                    Cari rute dan pesan tiket langsung.
                </p>
            </div>
        </div>

        <form action="{{ route('dashboard') }}" method="GET" class="grid grid-cols-1 lg:grid-cols-4 gap-4 relative z-10">
            {{-- ASAL --}}
            <div class="bg-white rounded-2xl px-4 py-3 flex items-center gap-3">
                <i class="fa-solid fa-location-dot text-blue-600"></i>
                <div class="flex-1">
                    <label class="text-[10px] font-black uppercase text-slate-400 block mb-1">
                        Kota Asal
                    </label>
                    <input type="text" name="asal" value="{{ request('asal') }}" placeholder="Bandar Lampung"
                           class="w-full text-sm font-bold text-slate-800 outline-none bg-transparent">
                </div>
            </div>

            {{-- TUJUAN --}}
            <div class="bg-white rounded-2xl px-4 py-3 flex items-center gap-3">
                <i class="fa-solid fa-paper-plane text-blue-600"></i>
                <div class="flex-1">
                    <label class="text-[10px] font-black uppercase text-slate-400 block mb-1">
                        Kota Tujuan
                    </label>
                    <input type="text" name="tujuan" value="{{ request('tujuan') }}" placeholder="Metro"
                           class="w-full text-sm font-bold text-slate-800 outline-none bg-transparent">
                </div>
            </div>

            {{-- TANGGAL --}}
            <div class="bg-white rounded-2xl px-4 py-3 flex items-center gap-3 relative">
                <i class="fa-solid fa-calendar text-blue-600"></i>
                <div class="flex-1">
                    <label class="text-[10px] font-black uppercase text-slate-400 block mb-1">
                        Tanggal
                    </label>
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                           class="w-full text-sm font-bold text-slate-800 outline-none bg-transparent relative z-10">
                </div>
                <i class="fa-solid fa-calendar-days absolute right-4 text-slate-300"></i>
            </div>

            {{-- BUTTON --}}
            <button type="submit"
                    class="bg-yellow-400 hover:bg-yellow-500 text-blue-900 rounded-2xl font-black text-sm transition-all active:scale-95 py-3 lg:py-0">
                CARI JADWAL
            </button>
        </form>
    </section>

    {{-- RUTE POPULER --}}
    <section class="mb-10">
        <h2 class="text-xl font-black text-slate-900 mb-1">
            Rute Populer
        </h2>
        <p class="text-slate-500 text-sm mb-5">
            Rute favorit pengguna KlikBus.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm hover:-translate-y-1 transition-all">
                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-[10px] font-black uppercase">
                    POPULER
                </span>
                <h3 class="text-lg font-black text-slate-900 mt-4 leading-tight">
                    Pringsewu → Bandar Lampung
                </h3>
                <p class="text-slate-400 text-xs mt-2">
                    Klik untuk langsung pilih tanggal.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm hover:-translate-y-1 transition-all">
                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-[10px] font-black uppercase">
                    FAVORIT
                </span>
                <h3 class="text-lg font-black text-slate-900 mt-4 leading-tight">
                    Bandar Lampung → Bakauheni
                </h3>
                <p class="text-slate-400 text-xs mt-2">
                    Jadwal tersedia setiap hari.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm hover:-translate-y-1 transition-all">
                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-[10px] font-black uppercase">
                    CEPAT
                </span>
                <h3 class="text-lg font-black text-slate-900 mt-4 leading-tight">
                    Metro → Bandar Lampung
                </h3>
                <p class="text-slate-400 text-xs mt-2">
                    Cocok untuk perjalanan harian.
                </p>
            </div>
        </div>
    </section>

    {{-- BUS TERSEDIA --}}
    <section class="mb-10">
        <div class="flex justify-between items-center mb-5">
            <div>
                <h2 class="text-xl font-black text-slate-900 mb-1">
                    Bus Tersedia
                </h2>
                <p class="text-slate-500 text-sm">
                    Jadwal bus sesuai pencarian Anda.
                </p>
            </div>
            <div class="bg-white px-4 py-2 rounded-xl border border-slate-200 shadow-sm flex items-center gap-3">
                <p class="text-slate-400 font-bold text-xs uppercase">
                    Total Jadwal
                </p>
                <h3 class="text-xl font-black text-blue-600">
                    {{ $schedules->count() }}
                </h3>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 items-stretch">
            @forelse($schedules as $schedule)
            <div class="bg-white rounded-3xl p-6 border border-blue-50 shadow-sm hover:-translate-y-1 transition-all h-full flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start mb-5">
                        <div>
                            <span class="bg-blue-600 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase">
                                {{ $schedule->bus->type }}
                            </span>
                            <h3 class="text-lg font-black text-slate-900 mt-3 leading-tight">
                                {{ $schedule->bus->bus_name }}
                            </h3>
                            <p class="text-slate-500 text-sm font-bold mt-1">
                                {{ $schedule->route->departure }} → {{ $schedule->route->destination }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 mb-5">
                        <div class="bg-slate-50 rounded-2xl p-3">
                            <p class="text-[10px] font-black uppercase text-slate-400 mb-1">Keberangkatan</p>
                            <h4 class="text-sm font-black text-slate-900">
                                {{ \Carbon\Carbon::parse($schedule->departure_time)->translatedFormat('d M Y') }}
                            </h4>
                            <p class="text-[10px] font-bold text-slate-500 mt-0.5">
                                Pukul {{ \Carbon\Carbon::parse($schedule->departure_time)->format('H:i') }} WIB
                            </p>
                        </div>
                        <div class="bg-slate-50 rounded-2xl p-3">
                            <p class="text-[10px] font-black uppercase text-slate-400 mb-1">Status</p>
                            <h4 class="text-sm font-black text-green-600 capitalize">
                                {{ $schedule->status }}
                            </h4>
                        </div>
                    </div>
                </div>
                <a href="{{ route('bookings.index', ['schedule_id' => $schedule->id]) }}"
                   class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl text-center font-bold text-sm transition-all active:scale-95">
                    Pesan Sekarang
                </a>
            </div>
            @empty
            <div class="col-span-full">
                <div class="bg-white rounded-3xl p-10 text-center border border-dashed border-slate-300">
                    <i class="fa-solid fa-bus text-4xl text-slate-300 mb-4"></i>
                    <h3 class="text-lg font-black text-slate-700 mb-2">
                        Jadwal Tidak Ditemukan
                    </h3>
                    <p class="text-slate-400 text-sm">
                        Coba ubah kota asal, tujuan, atau tanggal keberangkatan.
                    </p>
                </div>
            </div>
            @endforelse
        </div>
    </section>
@endsection
