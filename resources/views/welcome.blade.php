<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KlikBus - Tiket Bus Lampung Terpercaya</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased m-0 p-0 overflow-x-hidden">
    
    <div class="relative h-screen w-screen flex flex-col items-center justify-center overflow-hidden bg-black">
        
        <video autoplay loop muted playsinline class="absolute inset-0 min-w-full min-h-full w-full h-full object-cover z-0 transform scale-[1.10] md:scale-105 pointer-events-none">
            <source src="{{ asset('videos/klikbus lampung2.mp4') }}" type="video/mp4">
        </video>

        <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-transparent to-black/80 z-10 pointer-events-none"></div>

        <div class="container mx-auto px-6 relative z-20 flex flex-col items-center text-center -mt-20">
            
            <h1 class="text-7xl md:text-9xl font-black text-yellow-400 drop-shadow-[0_5px_10px_rgba(0,0,0,0.9)] mb-4 tracking-tighter">
                KlikBus
            </h1>
            
            <h2 class="text-2xl md:text-5xl font-bold text-white mb-8 italic drop-shadow-lg">
                Solusi Perjalanan Nyaman se-Lampung
            </h2>

            <p class="text-lg md:text-2xl text-gray-100 max-w-3xl mb-16 leading-relaxed drop-shadow-md font-medium">
                Pesan tiket bus tanpa antre. Cepat, aman, dan langsung dapat e-tiket.
            </p>

            <div class="flex flex-col md:flex-row gap-6 mb-24">
                <a href="{{ route('login') }}" 
                   class="px-12 py-6 bg-blue-600 border border-blue-400 hover:bg-blue-700 text-white font-black text-xl rounded-3xl shadow-[0_15px_25px_rgba(0,0,0,0.6)] transition transform hover:scale-105 active:scale-95">
                    Mulai Pesan Tiket 🚌
                </a>
                
                <a href="{{ route('rute.index') }}" 
                   class="px-12 py-6 bg-black/40 backdrop-blur-md text-white font-bold text-xl rounded-3xl border border-white/50 hover:bg-black/60 transition shadow-[0_15px_25px_rgba(0,0,0,0.6)]">
                    Lihat Rute
                </a>
            </div>
        </div>

        <div class="absolute bottom-10 inset-x-0 w-full max-w-6xl mx-auto px-6 z-20">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                
                <div class="flex items-center justify-center gap-3 px-8 py-4 bg-white/10 backdrop-blur-xl rounded-full border border-white/20 text-white shadow-xl">
                    <div class="text-2xl">⚡</div>
                    <div class="text-left">
                        <h3 class="font-bold text-base">Cepat</h3>
                        <p class="text-xs opacity-80">Booking dalam 1 menit</p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-3 px-8 py-4 bg-white/10 backdrop-blur-xl rounded-full border border-white/20 text-white shadow-xl">
                    <div class="text-2xl">🛡️</div>
                    <div class="text-left">
                        <h3 class="font-bold text-base">Aman</h3>
                        <p class="text-xs opacity-80">Sistem terverifikasi</p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-3 px-8 py-4 bg-white/10 backdrop-blur-xl rounded-full border border-white/20 text-white shadow-xl">
                    <div class="text-2xl">🎫</div>
                    <div class="text-left">
                        <h3 class="font-bold text-base">E-Tiket</h3>
                        <p class="text-xs opacity-80">Praktis tanpa kertas</p>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-3 px-8 py-4 bg-white/10 backdrop-blur-xl rounded-full border border-white/20 text-white shadow-xl">
                    <div class="text-2xl">📍</div>
                    <div class="text-left">
                        <h3 class="font-bold text-base">Lokal</h3>
                        <p class="text-xs opacity-80">Fokus area Lampung</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>