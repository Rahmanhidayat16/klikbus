<!DOCTYPE html>
<html lang="id">
<head>
        <script src="https://cdn.tailwindcss.com"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KlikBus - Dashboard Terintegrasi</title>
    
    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    {{-- Pastikan Vite berjalan --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8faff; }
        .active-nav { background-color: #2563eb; color: white; } 
        
        /* 1. Sembunyikan panah untuk input Kota (datalist) */
        input[list]::-webkit-calendar-picker-indicator { 
            display: none !important; 
        } 
        
        /* 2. Trik untuk Input Tanggal: 
           Bikin tombol klik kalender bawaan browser jadi transparan dan menutupi SELURUH area input */
        input[type="date"]::-webkit-calendar-picker-indicator {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: auto;
            height: auto;
            color: transparent;
            background: transparent;
            cursor: pointer;
        }
    </style>
</head>
<body class="min-h-screen flex">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-72 bg-white border-r border-blue-100 flex flex-col p-6 sticky h-screen top-0 hidden lg:flex z-20">
        <div class="text-2xl font-black text-yellow-400 italic mb-10 flex items-center gap-2 drop-shadow-sm">
            <i class="fa-solid fa-bus"></i> KlikBus.
        </div>
        <nav class="space-y-2 flex-1">
            <a href="{{ route('dashboard') }}" class="active-nav flex items-center gap-4 px-5 py-3.5 rounded-2xl font-bold shadow-lg shadow-blue-200">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
            <a href="#" class="flex items-center gap-4 px-5 py-3.5 rounded-2xl font-bold text-slate-500 hover:bg-blue-50 hover:text-blue-600 transition-all">
                <i class="fa-solid fa-ticket"></i> Tiket Saya
            </a>
            <a href="#" class="flex items-center gap-4 px-5 py-3.5 rounded-2xl font-bold text-slate-500 hover:bg-blue-50 hover:text-blue-600 transition-all">
                <i class="fa-solid fa-clock-rotate-left"></i> Riwayat
            </a>
        </nav>
        <div class="pt-6 border-t border-slate-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-4 px-5 py-3.5 rounded-2xl font-bold text-red-500 hover:bg-red-50 transition-all cursor-pointer">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="flex-1 p-6 lg:p-10 h-screen overflow-y-auto relative z-10">
        
        {{-- HEADER --}}
        <header class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900">Halo, {{ Auth::user()->name ?? 'Penumpang' }}! 👋</h1>
                <p class="text-slate-500 font-medium italic">Waktunya menjelajah Lampung hari ini.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('profile.edit') }}" class="flex items-center bg-white border border-slate-200 px-5 py-2.5 rounded-2xl font-bold text-slate-700 hover:bg-slate-50 transition-all active:scale-95 shadow-sm">
                    <i class="fa-solid fa-user-pen mr-2 text-blue-600"></i> Edit Profil
                </a>
                
                <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-bold shadow-lg shadow-blue-200">
                    {{ substr(Auth::user()->name ?? 'KB', 0, 1) }}
                </div>
            </div>
        </header>

        {{-- FORM PENCARIAN JADWAL --}}
        <form action="#" method="GET" class="bg-blue-600 p-8 rounded-[2.5rem] shadow-2xl shadow-blue-200/50 mb-10 relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-500 rounded-full opacity-30 pointer-events-none"></div>
            
            <h2 class="text-white text-xl font-bold mb-6 flex items-center gap-2 relative z-10">
                <i class="fa-solid fa-magnifying-glass"></i> Cari Jadwal Bus Lampung
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 relative z-10">
                
                <div class="bg-white p-3 rounded-2xl flex items-center gap-3 focus-within:ring-2 focus-within:ring-yellow-400 transition-all">
                    <i class="fa-solid fa-location-dot text-blue-600 ml-2"></i>
                    <div class="flex-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase block">Kota Asal</label>
                        <input type="text" name="asal" list="kota-lampung" placeholder="Ketik/Pilih Asal" autocomplete="off"
                               class="text-sm font-bold text-slate-800 outline-none w-full bg-transparent placeholder-slate-300 cursor-pointer">
                    </div>
                </div>

                <div class="bg-white p-3 rounded-2xl flex items-center gap-3 focus-within:ring-2 focus-within:ring-yellow-400 transition-all">
                    <i class="fa-solid fa-paper-plane text-blue-600 ml-2"></i>
                    <div class="flex-1">
                        <label class="text-[10px] font-bold text-slate-400 uppercase block">Kota Tujuan</label>
                        <input type="text" name="tujuan" list="kota-lampung" placeholder="Ketik/Pilih Tujuan" autocomplete="off"
                               class="text-sm font-bold text-slate-800 outline-none w-full bg-transparent placeholder-slate-300 cursor-pointer">
                    </div>
                </div>

                {{-- TANGGAL (SUDAH DITAMBAHKAN IKON KALENDER DI POJOK) --}}
                <div class="bg-white p-3 rounded-2xl flex items-center gap-3 focus-within:ring-2 focus-within:ring-yellow-400 transition-all">
                    <i class="fa-solid fa-calendar text-blue-600 ml-2"></i>
                    <div class="flex-1 relative">
                        <label class="text-[10px] font-bold text-slate-400 uppercase block">Tanggal</label>
                        <input type="date" name="tanggal" class="text-sm font-bold text-slate-800 outline-none w-full bg-transparent uppercase cursor-pointer relative z-10 pr-6">
                        
                        {{-- Ikon custom kalender diletakkan di kanan --}}
                        <i class="fa-solid fa-calendar-days text-slate-400 absolute right-1 bottom-0.5 z-0 pointer-events-none"></i>
                    </div>
                </div>

                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-black rounded-2xl transition-all active:scale-95 shadow-lg flex justify-center items-center h-full min-h-[60px]">
                    CARI JADWAL
                </button>
            </div>

            <datalist id="kota-lampung">
                <option value="Bandar Lampung">
                <option value="Metro">
                <option value="Kalianda (Lampung Selatan)">
                <option value="Bakauheni (Lampung Selatan)">
                <option value="Pringsewu">
                <option value="Kotabumi (Lampung Utara)">
                <option value="Bandar Jaya (Lampung Tengah)">
                <option value="Menggala (Tulang Bawang)">
                <option value="Krui (Pesisir Barat)">
                <option value="Liwa (Lampung Barat)">
            </datalist>
        </form>

        {{-- INFO SECTION --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
            <div class="lg:col-span-2">
                <h3 class="text-lg font-extrabold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-ticket-simple text-blue-600"></i> Tiket Aktif
                </h3>
                <div class="space-y-4">
                    <div class="bg-white p-5 rounded-3xl border border-slate-100 flex justify-between items-center shadow-sm">
                        <div class="flex gap-4 items-center">
                            <div class="bg-blue-50 p-4 rounded-2xl text-blue-600 text-xl"><i class="fa-solid fa-bus-simple"></i></div>
                            <div>
                                <h4 class="font-bold text-slate-900">B. Lampung ➔ Metro</h4>
                                <p class="text-xs text-slate-400 font-bold">12 Mei • 08:00 WIB • Puspa Jaya</p>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-600 text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest">Lunas</span>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-extrabold text-slate-800 mb-4">Rute Populer</h3>
                <div class="grid grid-cols-1 gap-2">
                    <button class="text-left w-full bg-white p-4 rounded-2xl border border-slate-100 hover:border-blue-300 hover:bg-blue-50 transition-all font-bold text-sm text-slate-700 flex justify-between items-center group">
                        Pringsewu - B. Lampung
                        <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-blue-600 transition-all"></i>
                    </button>
                    <button class="text-left w-full bg-white p-4 rounded-2xl border border-slate-100 hover:border-blue-300 hover:bg-blue-50 transition-all font-bold text-sm text-slate-700 flex justify-between items-center group">
                        B. Lampung - Bakauheni
                        <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-blue-600 transition-all"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- REKOMENDASI BUS --}}
        <section class="mb-10">
            <h3 class="text-lg font-extrabold text-slate-800 mb-4 italic text-blue-600">Bus Tersedia untuk Anda</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-[2.5rem] border border-blue-50 shadow-xl shadow-blue-100/20 hover:-translate-y-1 transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-blue-600 text-white text-[10px] font-black px-3 py-1 rounded-lg uppercase">Executive</span>
                        <p class="text-xl font-black text-blue-600">Rp 45.000</p>
                    </div>
                    <h4 class="text-lg font-extrabold text-slate-800">Puspa Jaya Trans</h4>
                    <p class="text-xs font-bold text-slate-400 mb-6 italic"><i class="fa-solid fa-clock mr-1"></i> Berangkat: 08:30 WIB</p>
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl transition-all active:scale-95">
                        Pesan Sekarang
                    </button>
                </div>
            </div>
        </section>

    </main>

</body>
</html>