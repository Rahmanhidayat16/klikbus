@extends('layouts.dashboard')

@section('title', 'E-Tiket - KlikBus')

@section('content')
<div class="max-w-4xl mx-auto">
    
    {{-- HEADER --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-blue-600 font-bold text-sm flex items-center gap-2 transition-colors inline-block mb-4">
                <i class="fa-solid fa-house"></i> Kembali ke Dashboard
            </a>
            <h1 class="text-3xl font-black text-slate-900 mb-1">
                E-Tiket Anda
            </h1>
            <p class="text-slate-500 text-sm">
                Tunjukkan QR Code ini kepada petugas saat boarding.
            </p>
        </div>
        
        <button onclick="window.print()" class="bg-slate-800 hover:bg-slate-900 text-white font-bold px-6 py-3 rounded-xl text-sm transition-all shadow-md flex items-center gap-2 print:hidden">
            <i class="fa-solid fa-print"></i> Cetak Tiket
        </button>
    </div>

    {{-- Progress Stepper --}}
    <div class="flex items-center mb-10 gap-4 print:hidden">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center font-black shadow-md shadow-green-200 text-sm"><i class="fa-solid fa-check"></i></div>
            <span class="font-bold text-slate-400 text-sm">Pilih Kursi</span>
        </div>
        <div class="w-16 h-1 bg-green-500 rounded-full"></div>
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center font-black shadow-md shadow-green-200 text-sm"><i class="fa-solid fa-check"></i></div>
            <span class="font-bold text-slate-400 text-sm">Bayar</span>
        </div>
        <div class="w-16 h-1 bg-green-500 rounded-full"></div>
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-black shadow-md shadow-blue-200 text-sm">3</div>
            <span class="font-black text-blue-600 text-sm">E-Tiket</span>
        </div>
    </div>

    {{-- TICKET CARD --}}
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden relative print:shadow-none print:border-2 print:border-slate-800">
        
        {{-- TICKET HEADER --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
            <div class="absolute -right-20 -top-20 opacity-10 pointer-events-none">
                <i class="fa-solid fa-bus text-[15rem]"></i>
            </div>
            
            <div class="relative z-10 w-full md:w-auto text-center md:text-left">
                <p class="text-blue-200 text-xs font-black uppercase tracking-widest mb-1">Tiket Resmi</p>
                <h2 class="text-3xl font-black italic">KlikBus.</h2>
            </div>
            
            <div class="relative z-10 flex flex-col items-center md:items-end w-full md:w-auto">
                <p class="text-blue-200 text-xs font-black uppercase tracking-widest mb-1">Kode Booking</p>
                <div class="bg-white/20 backdrop-blur-md px-6 py-2 rounded-xl border border-white/30">
                    <span class="font-black text-xl tracking-wider">KB-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
        </div>

        {{-- TICKET BODY --}}
        <div class="p-8 md:p-12 flex flex-col md:flex-row gap-12 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px] print:bg-none">
            
            {{-- QR Code Section --}}
            <div class="flex flex-col items-center justify-center w-full md:w-1/3 border-b-2 md:border-b-0 md:border-r-2 border-dashed border-slate-200 pb-8 md:pb-0 md:pr-12 relative">
                {{-- Pemotong Pinggiran ala Tiket (Semi Circle) --}}
                <div class="hidden md:block absolute -right-4 -top-16 w-8 h-8 bg-slate-50 rounded-full border-b border-slate-200"></div>
                <div class="hidden md:block absolute -right-4 -bottom-16 w-8 h-8 bg-slate-50 rounded-full border-t border-slate-200"></div>
                
                <div class="bg-white p-4 rounded-3xl shadow-lg border border-slate-100 mb-4 print:shadow-none print:border-2">
                    {!! $qrcode !!}
                </div>
                
                <p class="text-[10px] font-bold text-slate-400 text-center uppercase tracking-widest">
                    Scan saat boarding
                </p>
                <span class="mt-4 bg-green-100 text-green-700 px-4 py-1.5 rounded-lg text-xs font-black uppercase tracking-widest border border-green-200">
                    Lunas
                </span>
            </div>

            {{-- Detail Section --}}
            <div class="w-full md:w-2/3 space-y-8">
                
                {{-- Penumpang & Kursi --}}
                <div class="flex flex-col sm:flex-row justify-between gap-6">
                    <div>
                        <p class="text-[10px] font-black uppercase text-slate-400 mb-1 tracking-widest">Penumpang</p>
                        <h4 class="font-black text-lg text-slate-800">{{ $booking->user->name }}</h4>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase text-slate-400 mb-1 tracking-widest sm:text-right">Nomor Kursi</p>
                        <div class="flex flex-wrap gap-2 sm:justify-end">
                            @foreach($seats as $seat)
                                <span class="bg-blue-50 border border-blue-200 text-blue-700 px-3 py-1 rounded-lg font-black text-sm">{{ $seat }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="w-full h-px bg-slate-100"></div>

                {{-- Rute --}}
                <div class="flex items-center gap-4">
                    <div class="flex flex-col items-center gap-1">
                        <div class="w-3 h-3 rounded-full border-2 border-blue-600 bg-white"></div>
                        <div class="w-0.5 h-8 bg-slate-200"></div>
                        <div class="w-3 h-3 rounded-full bg-blue-600"></div>
                    </div>
                    <div class="flex-1 space-y-4">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Berangkat Dari</p>
                            <h4 class="font-black text-slate-800">{{ $booking->schedule->route->departure }}</h4>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Tujuan</p>
                            <h4 class="font-black text-slate-800">{{ $booking->schedule->route->destination }}</h4>
                        </div>
                    </div>
                </div>

                <div class="w-full h-px bg-slate-100"></div>

                {{-- Bus & Waktu --}}
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-[10px] font-black uppercase text-slate-400 mb-1 tracking-widest">Armada Bus</p>
                        <h4 class="font-bold text-sm text-slate-800 mb-0.5">{{ $booking->schedule->bus->bus_name }}</h4>
                        <p class="text-xs font-semibold text-slate-500">{{ $booking->schedule->bus->type }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase text-slate-400 mb-1 tracking-widest">Waktu Berangkat</p>
                        <h4 class="font-bold text-sm text-slate-800 mb-0.5">{{ \Carbon\Carbon::parse($booking->schedule->departure_time)->translatedFormat('d M Y') }}</h4>
                        <p class="text-xs font-semibold text-slate-500">{{ \Carbon\Carbon::parse($booking->schedule->departure_time)->format('H:i') }} WIB</p>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="bg-slate-50 p-6 text-center border-t border-slate-100 print:hidden">
            <p class="text-xs font-semibold text-slate-500">Terima kasih telah mempercayakan perjalanan Anda bersama KlikBus.</p>
        </div>
    </div>
</div>
@endsection