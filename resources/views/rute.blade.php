<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rute & Jadwal - KlikBus</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 relative min-h-screen">

    {{-- BACKGROUND IMAGE --}}
    <div class="fixed inset-0 -z-10 pointer-events-none opacity-5 bg-[url('/images/buss.png')] bg-cover bg-center bg-no-repeat bg-fixed"></div>

    {{-- PUBLIC NAVBAR --}}
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-yellow-400 flex items-center justify-center shadow-md shadow-yellow-200 group-hover:rotate-12 transition-transform">
                    <i class="fa-solid fa-bus text-blue-700"></i>
                </div>
                <span class="text-2xl font-black italic text-yellow-400 leading-none">KlikBus.</span>
            </a>
            
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 px-4 py-2 rounded-xl hover:bg-blue-50 transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 px-4 py-2 rounded-xl hover:bg-blue-50 transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2.5 rounded-xl text-sm transition-all shadow-md shadow-blue-200 active:scale-95">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="text-center mb-16">
            <span class="bg-blue-100 text-blue-600 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest mb-4 inline-block">Rute & Jadwal</span>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-4">Pilih Rute Perjalanan 🚌</h1>
            <p class="text-slate-500 text-lg max-w-2xl mx-auto">Temukan jadwal bus terbaik dan tiket termurah untuk perjalanan Anda di seluruh wilayah Lampung dan sekitarnya.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($schedules as $schedule)
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 overflow-hidden flex flex-col h-full group relative">
                    
                    {{-- Dekorasi Card --}}
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-blue-50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

                    <div class="p-8 flex-1 relative z-10">
                        <div class="flex justify-between items-start mb-6">
                            <span class="bg-blue-600 text-white text-[10px] font-black px-3 py-1.5 rounded-lg uppercase tracking-widest shadow-sm shadow-blue-200">
                                {{ $schedule->bus->type }}
                            </span>
                            
                            <p class="text-2xl font-black text-yellow-500">
                                Rp {{ number_format($schedule->route->base_price ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        
                        <div class="flex items-center gap-3 mb-6">
                            <div class="flex flex-col items-center gap-1">
                                <div class="w-2.5 h-2.5 rounded-full border-2 border-blue-600 bg-white"></div>
                                <div class="w-0.5 h-4 bg-slate-200"></div>
                                <div class="w-2.5 h-2.5 rounded-full bg-blue-600"></div>
                            </div>
                            <div>
                                <h4 class="text-lg font-black text-slate-800 leading-tight">{{ $schedule->route->departure }}</h4>
                                <h4 class="text-lg font-black text-slate-800 leading-tight mt-1">{{ $schedule->route->destination }}</h4>
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-2 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white text-slate-400 flex items-center justify-center shadow-sm"><i class="fa-solid fa-bus text-xs"></i></div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Armada</p>
                                    <p class="text-sm font-bold text-slate-700">{{ $schedule->bus->bus_name }}</p>
                                </div>
                            </div>
                            <div class="w-full h-px bg-slate-200/60 my-1"></div>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white text-slate-400 flex items-center justify-center shadow-sm"><i class="fa-solid fa-clock text-xs"></i></div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Berangkat</p>
                                    <p class="text-sm font-bold text-slate-700">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('H:i') }} WIB</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 pt-0 relative z-10">
                        <a href="{{ Auth::check() ? route('bookings.index', ['schedule_id' => $schedule->id]) : route('login') }}" 
                           class="block w-full text-center bg-slate-800 hover:bg-slate-900 text-white font-bold py-3.5 rounded-xl shadow-md transition-all active:scale-95 text-sm group-hover:bg-blue-600 group-hover:shadow-blue-200">
                            {{ Auth::check() ? 'Pesan Sekarang' : 'Login untuk Pesan' }}
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-route text-3xl text-slate-300"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-700 mb-2">Belum Ada Rute Tersedia</h3>
                    <p class="text-slate-500">Mohon maaf, saat ini belum ada jadwal dan rute bus yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- FOOTER --}}
    <footer class="bg-white border-t border-slate-200 mt-12 py-8 text-center text-slate-500 text-sm">
        <p>&copy; {{ date('Y') }} KlikBus Lampung. All rights reserved.</p>
    </footer>

</body>
</html>