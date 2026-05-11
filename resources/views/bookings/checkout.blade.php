@extends('layouts.dashboard')

@section('title', 'Pembayaran - KlikBus')

@section('content')
<div class="max-w-5xl mx-auto">
    
    {{-- HEADER --}}
    <div class="mb-8">
        <a href="{{ route('bookings.index') }}" class="text-slate-400 hover:text-blue-600 font-bold text-sm flex items-center gap-2 transition-colors inline-block mb-4">
            <i class="fa-solid fa-arrow-left"></i> Kembali Pilih Kursi
        </a>
        <h1 class="text-3xl font-black text-slate-900 mb-1">
            Selesaikan Pembayaran
        </h1>
        <p class="text-slate-500 text-sm">
            Pilih metode pembayaran dan selesaikan transaksi Anda.
        </p>
    </div>

    {{-- Progress Stepper --}}
    <div class="flex items-center mb-10 gap-4">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center font-black shadow-md shadow-green-200 text-sm"><i class="fa-solid fa-check"></i></div>
            <span class="font-bold text-slate-400 text-sm">Pilih Kursi</span>
        </div>
        <div class="w-16 h-1 bg-green-500 rounded-full"></div>
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-black shadow-md shadow-blue-200 text-sm">2</div>
            <span class="font-black text-blue-600 text-sm">Bayar</span>
        </div>
        <div class="w-16 h-1 bg-slate-200 rounded-full"></div>
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-white text-slate-300 border-2 border-slate-200 flex items-center justify-center font-black text-sm">3</div>
            <span class="font-bold text-slate-400 text-sm">E-Tiket</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {{-- PANEL KIRI: Detail Pesanan --}}
        <div class="lg:col-span-7 space-y-6">
            <div class="bg-white p-6 shadow-sm rounded-3xl border border-slate-100">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <i class="fa-solid fa-ticket text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-black text-slate-800">Detail Perjalanan</h2>
                        <p class="text-[10px] uppercase font-bold text-slate-400 tracking-widest">ID Booking: #KB-{{ $booking->id }}</p>
                    </div>
                </div>

                <div class="space-y-5">
                    <div class="flex items-start gap-4">
                        <div class="w-8 flex flex-col items-center gap-1 mt-1">
                            <div class="w-3 h-3 rounded-full border-2 border-blue-600 bg-white"></div>
                            <div class="w-0.5 h-6 bg-slate-200"></div>
                            <div class="w-3 h-3 rounded-full bg-blue-600"></div>
                        </div>
                        <div class="flex-1 space-y-4">
                            <div>
                                <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-0.5">Keberangkatan</p>
                                <h4 class="font-bold text-slate-800">{{ $booking->schedule->route->departure }}</h4>
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-0.5">Tujuan</p>
                                <h4 class="font-bold text-slate-800">{{ $booking->schedule->route->destination }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[10px] font-black uppercase text-slate-400 mb-1">Bus & Kelas</p>
                            <p class="font-bold text-sm text-slate-800">{{ $booking->schedule->bus->bus_name }}</p>
                            <p class="text-xs font-semibold text-slate-500">{{ $booking->schedule->bus->type }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase text-slate-400 mb-1">Jadwal</p>
                            <p class="font-bold text-sm text-slate-800">{{ \Carbon\Carbon::parse($booking->schedule->departure_time)->translatedFormat('d M Y') }}</p>
                            <p class="text-xs font-semibold text-slate-500">{{ \Carbon\Carbon::parse($booking->schedule->departure_time)->format('H:i') }} WIB</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 shadow-sm rounded-3xl border border-slate-100">
                <h3 class="text-sm font-black text-slate-800 mb-4 uppercase tracking-wider">Metode Pembayaran</h3>
                
                <form action="{{ route('bookings.process', $booking->id) }}" method="POST" id="paymentForm">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="payment_method" value="Transfer Bank" class="peer hidden" checked>
                            <div class="border-2 border-slate-100 rounded-2xl p-4 hover:border-blue-200 transition-all peer-checked:border-blue-600 peer-checked:bg-blue-50">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                                        <i class="fa-solid fa-building-columns"></i>
                                    </div>
                                    <span class="font-bold text-sm text-slate-700 peer-checked:text-blue-700">Transfer Bank</span>
                                </div>
                                <p class="text-xs text-slate-500 font-medium ml-11">BCA, Mandiri, BNI, BRI</p>
                            </div>
                        </label>

                        <label class="relative cursor-pointer group">
                            <input type="radio" name="payment_method" value="E-Wallet" class="peer hidden">
                            <div class="border-2 border-slate-100 rounded-2xl p-4 hover:border-blue-200 transition-all peer-checked:border-blue-600 peer-checked:bg-blue-50">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                                        <i class="fa-solid fa-wallet"></i>
                                    </div>
                                    <span class="font-bold text-sm text-slate-700 peer-checked:text-blue-700">E-Wallet</span>
                                </div>
                                <p class="text-xs text-slate-500 font-medium ml-11">GoPay, OVO, Dana, LinkAja</p>
                            </div>
                        </label>
                    </div>
                </form>
            </div>
        </div>

        {{-- PANEL KANAN: Ringkasan --}}
        <div class="lg:col-span-5">
            <div class="bg-blue-600 rounded-3xl p-6 shadow-lg shadow-blue-200/50 text-white sticky top-24">
                <h3 class="text-lg font-black mb-6">Ringkasan Pembayaran</h3>

                <div class="space-y-4 mb-6 text-sm">
                    <div class="flex justify-between items-center pb-4 border-b border-blue-500/50">
                        <span class="text-blue-100 font-medium">Nomor Kursi</span>
                        <div class="flex gap-2">
                            @foreach($seats as $seat)
                                <span class="bg-white/20 px-2 py-1 rounded font-bold text-xs">{{ $seat }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-blue-500/50">
                        <span class="text-blue-100 font-medium">Harga Tiket (x{{ count($seats) }})</span>
                        <span class="font-bold">Rp {{ number_format($booking->schedule->route->base_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-blue-500/50">
                        <span class="text-blue-100 font-medium">Biaya Layanan</span>
                        <span class="font-bold text-green-300">Gratis</span>
                    </div>
                </div>

                <div class="flex justify-between items-end mb-8 bg-blue-700/50 p-4 rounded-2xl">
                    <span class="text-sm font-bold text-blue-100 uppercase tracking-widest">Total Bayar</span>
                    <span class="text-3xl font-black italic">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <button type="button" onclick="document.getElementById('paymentForm').submit();" class="w-full flex items-center justify-center gap-3 bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-black px-6 py-4 rounded-xl text-sm transition-all shadow-md active:scale-95">
                    <i class="fa-solid fa-lock text-xs"></i>
                    BAYAR SEKARANG
                </button>
            </div>
        </div>
    </div>
</div>
@endsection