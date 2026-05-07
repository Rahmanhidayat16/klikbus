<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KlikBus - Lupa Kata Sandi</title>
    
    {{-- Font Setup --}}
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Lobster+Two:ital,wght@1,700&family=Nunito+Sans:wght@400;600;700;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-brand   { font-family: 'Righteous', cursive; }
        .font-welcome { font-family: 'Lobster Two', cursive; }
        body { font-family: 'Nunito Sans', sans-serif; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.55s cubic-bezier(.22,.68,0,1.2) both; }
    </style>
</head>
<body class="antialiased overflow-hidden">
    
    <div class="relative h-screen w-full flex items-center justify-center">
        
        {{-- 1. BACKGROUND (Sama dengan Login) --}}
        <div class="absolute inset-0">
            <img src="{{ asset('images/bus.png') }}" 
                 class="w-full h-full object-cover filter blur-[1.2px] scale-105" 
                 alt="Background KlikBus">
            <div class="absolute inset-0 bg-white/40 mix-blend-overlay"></div>
            <div class="absolute inset-0 bg-blue-500/10"></div>
        </div>

        {{-- 2. CONTENT CONTAINER --}}
        <div class="relative z-10 w-full max-w-6xl px-6 flex flex-col md:flex-row items-center justify-between gap-12">
            
            {{-- ===== FORGOT PASSWORD CARD (LEFT) ===== --}}
            <div class="w-full md:w-[420px] order-2 md:order-1 fade-up">
                <div class="bg-white/45 backdrop-blur-2xl border border-white/60 p-9 rounded-[2rem] shadow-2xl shadow-blue-900/15">

                    {{-- Back to Login --}}
                    <a href="{{ route('login') }}" class="text-blue-600 text-xs font-black flex items-center gap-1.5 mb-6 hover:underline group">
                        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/>
                        </svg>
                        KEMBALI KE LOGIN
                    </a>

                    {{-- Card Header --}}
                    <div class="mb-8">
                        <h3 class="text-gray-900 text-2xl font-extrabold tracking-tight">Atur Ulang Sandi</h3>
                        <p class="text-gray-500 text-sm font-medium mt-1">Masukkan email terdaftar untuk menerima link reset.</p>
                    </div>

                    {{-- Form Reset --}}
                    <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- Email Input --}}
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Alamat Email" required
                                   class="w-full bg-white/65 border border-white/80 text-gray-900 placeholder-gray-400 pl-12 pr-4 py-4 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm text-sm font-semibold">
                        </div>

                        {{-- Success Message (Muncul setelah klik tombol) --}}
                        @if (session('status'))
                            <div class="bg-green-50 text-green-700 p-4 rounded-xl text-xs font-bold border border-green-100 italic">
                                Link reset sudah dikirim ke email kamu!
                            </div>
                        @endif

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 active:scale-95 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-600/30 transition-all text-base mt-2">
                            ✦ Kirim Link Reset
                        </button>
                    </form>

                    <div class="mt-8 pt-6 border-t border-gray-200/50 text-center">
                        <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest leading-relaxed">
                            Butuh bantuan lebih lanjut?<br>
                            <span class="text-blue-600">Hubungi Admin KlikBus</span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- ===== HERO TEXT (RIGHT - Sama persis agar tidak berubah) ===== --}}
            <div class="w-full md:w-1/2 order-1 md:order-2 flex flex-col md:-mt-40 md:text-left text-center">
                <div class="mb-6 leading-none">
                    <h1 class="font-brand text-5xl md:text-6xl text-blue-700 tracking-wide mb-1"
                        style="text-shadow: 2px 3px 0px rgba(29,78,216,0.12);">
                        KlikBus
                    </h1>
                    <h2 class="font-welcome text-7xl md:text-9xl text-blue-600 italic leading-[1.1] py-2 relative"
                        style="text-shadow: 3px 4px 0px rgba(29,78,216,0.1); left: -0.2cm; top: 0.1cm;">
                        Welcome!
                    </h2>
                </div>
                
                <p class="text-xl text-gray-700 font-semibold leading-relaxed max-w-md">
                    Perjalanan antar kota di Lampung<br class="hidden md:block"> jadi lebih praktis.<br>
                    <span class="text-blue-600">Pesan tiket bus</span> favoritmu<br class="hidden md:block"> dalam hitungan detik.
                </p>

                <div class="mt-8 flex flex-wrap md:justify-start justify-center gap-x-6 gap-y-3 text-sm text-gray-600 font-semibold">
                    <div class="flex items-center gap-1.5 whitespace-nowrap">
                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                        Mudah & Cepat
                    </div>
                    <div class="flex items-center gap-1.5 whitespace-nowrap">
                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                        Aman & Terpercaya
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-8 left-10 text-gray-400 text-xs font-bold tracking-widest uppercase">
            &copy; 2026 KlikBus Team.
        </div>
    </div>
</body>
</html>
