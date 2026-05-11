<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KlikBus - Lupa Kata Sandi</title>
    
    {{-- Mempertahankan Font Lama untuk Kotak & Font Poppins untuk Teks Hero --}}
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Lobster+Two:ital,wght@1,700&family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-brand-old   { font-family: 'Righteous', cursive; }
        .font-welcome-old { font-family: 'Lobster Two', cursive; }
        .font-poppins     { font-family: 'Poppins', sans-serif; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.55s cubic-bezier(.22,.68,0,1.2) both; }
    </style>
</head>
<body class="antialiased overflow-hidden font-poppins">
    
    <div class="relative h-screen w-full flex items-center justify-center">
        
        {{-- BACKGROUND --}}
        <div class="absolute inset-0">
            <img src="{{ asset('images/bus.png') }}" 
                 class="w-full h-full object-cover filter blur-[1.2px] scale-105" 
                 alt="Background KlikBus">
            <div class="absolute inset-0 bg-white/40 mix-blend-overlay"></div>
            <div class="absolute inset-0 bg-blue-500/10"></div>
        </div>

        <div class="relative z-10 w-full max-w-7xl px-6 flex flex-col md:flex-row items-center justify-between gap-12">
            
            {{-- ===== KOTAK FORGOT PASSWORD (TETAP GAYA LAMA) ===== --}}
            <div class="w-full md:w-[420px] order-2 md:order-1 fade-up">
                <div class="bg-white/45 backdrop-blur-2xl border border-white/60 p-9 rounded-[2rem] shadow-2xl shadow-blue-900/15">
                    <a href="{{ route('login') }}" class="text-blue-600 text-xs font-black flex items-center gap-1.5 mb-6 hover:underline group">
                        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/>
                        </svg>
                        KEMBALI KE LOGIN
                    </a>

                    <div class="mb-8">
                        <h3 class="text-gray-900 text-2xl font-extrabold tracking-tight">Atur Ulang Sandi</h3>
                        <p class="text-gray-500 text-sm font-medium mt-1">Masukkan email terdaftar untuk menerima link reset.</p>
                    </div>

                    <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Alamat Email" required
                                   class="w-full bg-white/65 border border-white/80 text-gray-900 placeholder-gray-400 pl-12 pr-4 py-4 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm text-sm font-semibold">
                        </div>

                        @if (session('status'))
                            <div class="bg-green-50 text-green-700 p-4 rounded-xl text-xs font-bold border border-green-100 italic">
                                Link reset sudah dikirim ke email kamu!
                            </div>
                        @endif

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 active:scale-95 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-600/30 transition-all text-base mt-2">
                            ✦ Kirim Link Reset
                        </button>
                    </form>
                </div>
            </div>

            {{-- ===== TULISAN HERO (DIUBAH KE GAYA LOGIN BARU) ===== --}}
            <div class="hidden md:block w-full md:w-1/2 text-left relative order-1 md:order-2"
                 style="top: -90px; left: -100px;">

                <h1 class="text-[105px] font-black text-yellow-400 leading-none tracking-tighter drop-shadow-xl font-poppins">
                    KlikBus
                </h1>

                <h2 class="text-5xl font-bold text-sky-700 mb-8 font-poppins">
                    Selamat Datang!
                </h2>

                <div class="font-poppins">
                    <p class="text-2xl font-medium leading-relaxed max-w-xl text-[#0369a1]">
                        Perjalanan antar kota di Lampung 
                    </p>
                    <p class="text-2xl font-medium leading-relaxed max-w-xl text-[#0369a1]">
                        jadi lebih mudah, nyaman, dan cepat
                    </p>
                    <p class="text-2xl font-medium leading-relaxed max-w-xl text-[#0369a1]">
                        bersama KlikBus.
                    </p>
                </div>

                <div class="flex flex-wrap gap-4 mt-12 font-poppins">
                    <span class="px-6 py-3 rounded-full text-sm font-extrabold border border-blue-400/40 shadow-lg" 
                          style="background-color: rgba(11, 92, 172, 0.7); backdrop-filter: blur(15px); color: #dfdfe6 !important;">
                        ✓ Mudah & Cepat
                    </span>

                    <span class="px-6 py-3 rounded-full text-sm font-extrabold border border-blue-400/40 shadow-lg" 
                          style="background-color: rgba(11, 92, 172, 0.7); backdrop-filter: blur(15px); color: #e8e8ec !important;">
                        ✓ Aman & Terpercaya
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>