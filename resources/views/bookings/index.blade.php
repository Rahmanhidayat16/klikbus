@extends('layouts.dashboard')

@section('title', 'Pilih Kursi - KlikBus')

@section('content')
<div class="max-w-5xl mx-auto">
    
    {{-- HEADER --}}
    <div class="mb-8">
        <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-blue-600 font-bold text-sm flex items-center gap-2 transition-colors inline-block mb-4">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>
        <h1 class="text-3xl font-black text-slate-900 mb-1">
            Pilih Kursi
        </h1>
        <p class="text-slate-500 text-sm">
            Pilih posisi duduk yang paling nyaman untuk perjalananmu.
        </p>
    </div>

    {{-- Progress Stepper --}}
    <div class="flex items-center mb-10 gap-4">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-black shadow-md shadow-blue-200 text-sm">1</div>
            <span class="font-black text-blue-600 text-sm">Pilih Kursi</span>
        </div>
        <div class="w-16 h-1 bg-slate-200 rounded-full"></div>
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-white text-slate-300 border-2 border-slate-200 flex items-center justify-center font-black text-sm">2</div>
            <span class="font-bold text-slate-400 text-sm">Bayar</span>
        </div>
        <div class="w-16 h-1 bg-slate-200 rounded-full"></div>
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-white text-slate-300 border-2 border-slate-200 flex items-center justify-center font-black text-sm">3</div>
            <span class="font-bold text-slate-400 text-sm">E-Tiket</span>
        </div>
    </div>

    <div class="bg-white p-8 shadow-sm rounded-3xl border border-slate-100 relative overflow-hidden">
        {{-- Dekorasi bus di background --}}
        <div class="absolute -right-20 -top-20 opacity-[0.02] pointer-events-none">
            <i class="fa-solid fa-bus text-[20rem]"></i>
        </div>

        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 relative z-10">
                
                {{-- PANEL KIRI: Detail & Input --}}
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        <label class="block text-[10px] font-black uppercase text-slate-400 mb-3 tracking-widest">Konfirmasi Jadwal</label>
                        
                        <div class="space-y-4">
                            <div class="relative">
                                <select name="schedule_id" onchange="window.location.href='?schedule_id='+this.value" class="w-full bg-white border-none rounded-xl shadow-sm font-bold text-slate-700 py-3 pl-10 focus:ring-2 focus:ring-blue-100 transition-all appearance-none cursor-pointer text-sm" required>
                                    @foreach($schedules as $item)
                                        <option value="{{ $item->id }}" {{ $selectedSchedule->id == $item->id ? 'selected' : '' }}>
                                            {{ $item->bus->bus_name }} ({{ $item->bus->type }})
                                        </option>
                                    @endforeach
                                </select>
                                <i class="fa-solid fa-bus-simple absolute left-4 top-1/2 -translate-y-1/2 text-blue-600 text-sm"></i>
                            </div>

                            <div class="flex flex-col gap-3 p-4 bg-white rounded-xl border border-slate-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center"><i class="fa-solid fa-map-location-dot text-sm"></i></div>
                                    <div>
                                        <p class="text-[9px] font-black text-slate-400 uppercase leading-none mb-1">Rute Perjalanan</p>
                                        <p class="font-bold text-sm text-slate-700">{{ $selectedSchedule->route->departure ?? '-' }} <i class="fa-solid fa-arrow-right mx-1 text-blue-600 text-xs"></i> {{ $selectedSchedule->route->destination ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-100 px-6 py-4 rounded-2xl flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-black uppercase text-yellow-600 tracking-tighter block mb-0.5">Harga per Kursi</span>
                            <span class="text-lg font-black text-yellow-600">Rp {{ number_format($selectedSchedule->route->base_price ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-500">
                            <i class="fa-solid fa-tag"></i>
                        </div>
                    </div>

                    <div class="p-6 bg-blue-600 rounded-2xl text-white shadow-md shadow-blue-100">
                        <h4 class="font-bold text-sm mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-circle-info"></i> Info Penting
                        </h4>
                        <ul class="text-xs font-medium text-blue-100 space-y-1.5 pl-5 list-disc">
                            <li>Pastikan datang 30 menit sebelum jadwal keberangkatan.</li>
                            <li>Anda dapat memilih lebih dari 1 kursi sekaligus.</li>
                            <li>Pembayaran harus diselesaikan dalam batas waktu.</li>
                        </ul>
                    </div>
                </div>

                {{-- PANEL KANAN: Denah Bus --}}
                <div class="lg:col-span-7 bg-slate-50 p-6 md:p-8 rounded-3xl border border-slate-100 flex flex-col items-center relative">
                    
                    {{-- Area Depan Bus --}}
                    <div class="w-full flex justify-between items-center mb-8 px-4">
                        <div class="flex flex-col items-center gap-1">
                            <div class="w-10 h-10 rounded-full bg-slate-200 border-2 border-white flex items-center justify-center text-slate-400 shadow-sm">
                                <i class="fa-solid fa-dharmachakra animate-[spin_5s_linear_infinite]"></i>
                            </div>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Supir</span>
                        </div>
                        <div class="h-1.5 w-24 bg-slate-200 rounded-full"></div>
                        <div class="w-10 h-10 rounded-xl bg-slate-200 border-2 border-white flex items-center justify-center text-slate-400">
                            <i class="fa-solid fa-door-open text-sm"></i>
                        </div>
                    </div>

                    @php 
                        $maxSeats = $selectedSchedule->bus->total_seats ?? 40; 
                        $booked = $bookedSeats ?? [];
                    @endphp
                    
                    {{-- Grid Kursi 2-2 --}}
                    <div class="grid grid-cols-5 gap-3 w-full max-w-[280px]">
                        @for ($i = 1; $i <= $maxSeats; $i++)
                            @php $isBooked = in_array($i, $booked); @endphp
                            
                            @if($isBooked)
                                <div class="relative h-12 cursor-not-allowed opacity-60">
                                    <div class="w-full h-full bg-slate-200 border border-slate-300 rounded-xl flex items-center justify-center font-bold text-sm text-slate-400 shadow-sm relative overflow-hidden">
                                        <div class="absolute inset-0 opacity-20" style="background-image: repeating-linear-gradient(45deg, #000 25%, transparent 25%, transparent 75%, #000 75%, #000); background-size: 8px 8px;"></div>
                                        <span class="relative z-10">{{ $i }}</span>
                                    </div>
                                    <div class="absolute -top-0.5 left-1/2 -translate-x-1/2 w-2/3 h-1 bg-slate-300 rounded-full"></div>
                                </div>
                            @else
                                <label class="relative group cursor-pointer h-12">
                                    <input type="checkbox" name="seat_numbers[]" value="{{ $i }}" class="hidden peer">
                                    <div class="w-full h-full bg-white border border-slate-200 rounded-xl flex items-center justify-center font-bold text-sm text-slate-400 transition-all peer-checked:bg-blue-600 peer-checked:border-blue-700 peer-checked:text-white peer-checked:shadow-md peer-checked:scale-105 group-hover:border-blue-300 shadow-sm">
                                        {{ $i }}
                                    </div>
                                    {{-- Efek 'sandaran kepala' --}}
                                    <div class="absolute -top-0.5 left-1/2 -translate-x-1/2 w-2/3 h-1 bg-slate-100 rounded-full group-hover:bg-blue-100 peer-checked:bg-blue-400 transition-colors"></div>
                                </label>
                            @endif
                            
                            {{-- Spasi Gang (Aisle) di kolom ke-3 --}}
                            @if ($i % 2 == 0 && $i % 4 != 0)
                                <div class="flex items-center justify-center">
                                    <div class="w-px h-full bg-slate-200/50"></div>
                                </div>
                            @endif
                        @endfor
                    </div>

                    {{-- Petunjuk Warna --}}
                    <div class="mt-8 flex flex-wrap justify-center gap-4 pt-6 border-t border-slate-200 w-full">
                        <div class="flex items-center gap-1.5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                            <div class="w-4 h-4 bg-white border border-slate-200 rounded shadow-sm"></div> Tersedia
                        </div>
                        <div class="flex items-center gap-1.5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                            <div class="w-4 h-4 bg-blue-600 rounded shadow-sm"></div> Terpilih
                        </div>
                        <div class="flex items-center gap-1.5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                            <div class="w-4 h-4 bg-slate-200 border border-slate-300 rounded shadow-sm relative overflow-hidden">
                                <div class="absolute inset-0 opacity-20" style="background-image: repeating-linear-gradient(45deg, #000 25%, transparent 25%, transparent 75%, #000 75%, #000); background-size: 8px 8px;"></div>
                            </div> Penuh
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Button --}}
            <div class="mt-8 flex justify-end border-t border-slate-100 pt-6">
                <button type="submit" class="group flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3.5 rounded-xl text-sm transition-all shadow-md shadow-blue-200 active:scale-95">
                    Lanjut ke Pembayaran
                    <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection