<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 text-center">
            
            <h1 class="text-5xl font-black text-slate-800 mb-4">Pilih Rute Perjalanan 🚌</h1>
            <p class="text-slate-500 text-lg mb-12">Temukan jadwal bus terbaik untuk wilayah Lampung dan sekitarnya.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($schedules as $schedule)
                    <div class="bg-white rounded-[3rem] border border-slate-100 shadow-xl overflow-hidden hover:-translate-y-2 transition-all">
                        <div class="p-10">
                            <div class="flex justify-between items-start mb-8">
                                <span class="bg-blue-50 text-blue-600 text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest">
                                    {{ $schedule->bus->type }}
                                </span>
                                
                                {{-- HARGA: Ngambil 'base_price' dari relasi route --}}
                                <p class="text-2xl font-black text-blue-600">
                                    Rp {{ number_format($schedule->route->base_price ?? 0, 0, ',', '.') }}
                                </p>
                            </div>
                            
                            <h4 class="text-2xl font-bold text-slate-800 mb-2 text-left">
                                {{ $schedule->route->departure }} ➔ {{ $schedule->route->destination }}
                            </h4>
                            
                            <div class="flex flex-col items-start gap-1 mb-10">
                                <p class="text-sm font-bold text-slate-400">
                                    <i class="fa-solid fa-bus text-blue-500 mr-2"></i> {{ $schedule->bus->bus_name }}
                                </p>
                                <p class="text-xs font-medium text-slate-400">
                                    <i class="fa-solid fa-clock text-blue-500 mr-2"></i> {{ \Carbon\Carbon::parse($schedule->departure_time)->format('H:i') }} WIB
                                </p>
                            </div>

                            {{-- Tombol: Kalau sudah login bisa langsung ke booking, kalau belum ke login --}}
                            <a href="{{ Auth::check() ? route('bookings.index', ['schedule_id' => $schedule->id]) : route('login') }}" 
                               class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-5 rounded-[2rem] shadow-lg shadow-blue-100 transition-all active:scale-95">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>