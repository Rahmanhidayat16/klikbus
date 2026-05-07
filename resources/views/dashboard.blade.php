<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - KlikBus</title>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Nunito+Sans:wght@400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-brand { font-family: 'Righteous', cursive; }
        body { font-family: 'Nunito Sans', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body class="antialiased text-gray-800">

    <div class="min-h-screen flex">
        <aside class="w-72 bg-blue-700 text-white flex flex-col shadow-xl z-20">
            <div class="p-8">
                <h1 class="font-brand text-3xl tracking-wide italic text-white">KlikBus</h1>
                <p class="text-blue-200 text-xs mt-1 font-bold uppercase tracking-widest">Passenger Panel</p>
            </div>

            <nav class="flex-1 px-4 space-y-2">
                <a href="#" class="flex items-center gap-4 bg-white/10 p-4 rounded-2xl font-bold transition-all border-l-4 border-white">
                    <span>🏠</span> Dashboard
                </a>
                <a href="#" class="flex items-center gap-4 hover:bg-white/5 p-4 rounded-2xl font-semibold transition-all">
                    <span>🎫</span> Pesanan Saya
                </a>
                <a href="#" class="flex items-center gap-4 hover:bg-white/5 p-4 rounded-2xl font-semibold transition-all">
                    <span>📍</span> Rute & Jadwal
                </a>
                <a href="#" class="flex items-center gap-4 hover:bg-white/5 p-4 rounded-2xl font-semibold transition-all">
                    <span>👤</span> Profil Akun
                </a>
            </nav>

            <div class="p-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full bg-red-500/20 hover:bg-red-500 hover:text-white text-red-200 py-3 rounded-xl font-bold transition-all flex items-center justify-center gap-2 text-sm">
                        🚪 Keluar Sesi
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-y-auto">
            
            <header class="bg-white/70 backdrop-blur-md border-b border-gray-100 sticky top-0 z-10 px-8 py-4 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-extrabold text-gray-800">Selamat Pagi, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-gray-400 text-xs font-semibold">Lampung, {{ date('d M Y') }}</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-bold text-gray-700">Akun Verifikasi</p>
                        <p class="text-[10px] text-green-500 font-black uppercase tracking-tighter italic">Member Gold</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-2xl border-2 border-white shadow-sm flex items-center justify-center text-xl">
                        👤
                    </div>
                </div>
            </header>

            <div class="p-8 space-y-8">
                <section class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 opacity-5 font-brand text-9xl -rotate-12 pointer-events-none">
                        BUS
                    </div>
                    
                    <h3 class="text-lg font-black mb-6 flex items-center gap-3 text-blue-700">
                        <span class="bg-blue-100 p-2 rounded-xl">🚌</span>
                        Cari Tiket Perjalanan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative z-10">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Dari Kota</label>
                            <select class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 outline-none font-bold text-sm">
                                <option>Bandar Lampung</option>
                                <option>Metro</option>
                                <option>Kalianda</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Ke Kota</label>
                            <select class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 outline-none font-bold text-sm">
                                <option>Bakauheni</option>
                                <option>Pringsewu</option>
                                <option>Bandar Jaya</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Pergi</label>
                            <input type="date" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 focus:ring-2 focus:ring-blue-500 outline-none font-bold text-sm">
                        </div>
                        <div class="flex items-end">
                            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-600/30 transition-all active:scale-95">
                                CARI JADWAL
                            </button>
                        </div>
                    </div>
                </section>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-blue-600 rounded-[2rem] p-6 text-white shadow-xl shadow-blue-600/20 relative overflow-hidden">
                         <div class="relative z-10">
                            <p class="text-blue-100 text-xs font-bold uppercase">Poin KlikBus</p>
                            <h4 class="text-4xl font-black mt-2 italic">2.450 <span class="text-sm font-normal not-italic text-blue-200">pts</span></h4>
                            <p class="text-[10px] mt-4 bg-white/20 inline-block px-3 py-1 rounded-full font-bold">Tukar dengan Diskon Tiket</p>
                         </div>
                         <div class="absolute -right-4 -bottom-4 text-8xl opacity-10 font-brand italic">KB</div>
                    </div>

                    <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase">Tiket Aktif</p>
                            <h4 class="text-3xl font-black text-gray-800 mt-1">01</h4>
                            <a href="#" class="text-blue-600 text-xs font-bold mt-2 inline-block hover:underline">Lihat E-Tiket →</a>
                        </div>
                        <div class="text-5xl">🎟️</div>
                    </div>

                    <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase">Riwayat</p>
                            <h4 class="text-3xl font-black text-gray-800 mt-1">12</h4>
                            <p class="text-gray-400 text-[10px] font-bold mt-2">Perjalanan Selesai</p>
                        </div>
                        <div class="text-5xl">🛣️</div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>