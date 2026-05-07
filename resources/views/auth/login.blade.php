<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KlikBus - Reservasi Tiket Lampung</title>
    
    {{-- Nunito Sans for body, Righteous for brand name, Lobster Two for welcome --}}
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Lobster+Two:ital,wght@1,700&family=Nunito+Sans:wght@400;600;700;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-brand   { font-family: 'Righteous', cursive; }
        .font-welcome { font-family: 'Lobster Two', cursive; }
        body { font-family: 'Nunito Sans', sans-serif; }

        /* Shake animation for error */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%       { transform: translateX(-6px); }
            40%       { transform: translateX(6px); }
            60%       { transform: translateX(-4px); }
            80%       { transform: translateX(4px); }
        }
        .shake { animation: shake 0.45s ease; }

        /* Fade-in slide up for the card */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.55s cubic-bezier(.22,.68,0,1.2) both; }
    </style>
</head>
<body class="antialiased overflow-hidden">
    
    <div class="relative h-screen w-full flex items-center justify-center">
        
        {{-- Background --}}
        <div class="absolute inset-0">
            <img src="{{ asset('images/bus.png') }}" 
                 class="w-full h-full object-cover filter blur-[1.2px] scale-105" 
                 alt="Background KlikBus">
            <div class="absolute inset-0 bg-white/40 mix-blend-overlay"></div>
            <div class="absolute inset-0 bg-blue-500/10"></div>
        </div>

        <div class="relative z-10 w-full max-w-6xl px-6 flex flex-col md:flex-row items-center justify-between gap-12">
            
            {{-- ===== LOGIN CARD ===== --}}
            <div class="w-full md:w-[420px] order-2 md:order-1 fade-up">
                <div class="bg-white/45 backdrop-blur-2xl border border-white/60 p-9 rounded-[2rem] shadow-2xl shadow-blue-900/15">

                    {{-- Header --}}
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <h3 class="text-gray-900 text-2xl font-extrabold tracking-tight leading-tight">
                                Start Your Journey
                            </h3>
                            <p class="text-gray-500 text-sm font-medium mt-1">
                                Sign in to continue your booking
                            </p>
                        </div>
                        <a href="/" class="text-gray-400 hover:text-blue-600 transition mt-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    </div>

                    {{-- ===== ERROR ALERT ===== --}}
                    @if ($errors->any())
                    <div class="mb-6 shake flex items-start gap-3 bg-red-50/80 border border-red-200 text-red-700 px-4 py-3 rounded-2xl shadow-sm">
                        {{-- Icon --}}
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                        <div>
                            <p class="font-bold text-sm leading-snug">Login Failed!</p>
                            <p class="text-sm font-medium mt-0.5 text-red-600">
                                {{ $errors->first() ?? 'Email atau kata sandi yang kamu masukkan salah. Silakan coba lagi.' }}
                            </p>
                        </div>
                    </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('login') }}" method="POST" class="space-y-5">
                        @csrf

                        {{-- Email --}}
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <input type="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Alamat Email" required
                                   class="w-full bg-white/65 border {{ $errors->has('email') ? 'border-red-400 ring-1 ring-red-300' : 'border-white/80' }} text-gray-900 placeholder-gray-400 pl-12 pr-4 py-4 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm text-sm font-semibold">
                        </div>

                        {{-- Password --}}
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 11c0-1.1-.9-2-2-2s-2 .9-2 2 .9 2 2 2 2-.9 2-2zm6 0c0-3.31-2.69-6-6-6S6 7.69 6 11v1H4v9h16v-9h-2v-1z"/>
                                </svg>
                            </span>
                            <input type="password" name="password"
                                   placeholder="Password" required
                                   class="w-full bg-white/65 border {{ $errors->has('password') ? 'border-red-400 ring-1 ring-red-300' : 'border-white/80' }} text-gray-900 placeholder-gray-400 pl-12 pr-4 py-4 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm text-sm font-semibold">
                        </div>

{{-- Forgot password (Terhubung ke Backend) --}}
<div class="text-right -mt-1">
    @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" 
           class="text-xs text-blue-500 font-semibold hover:underline transition-all">
            Lupa kata sandi?
        </a>
    @endif
</div>

                        {{-- Submit --}}
                        <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 active:scale-95 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-600/30 transition-all text-base tracking-wide mt-2">
                            ✦ Login
                        </button>
                    </form>

                    {{-- Footer link — DITUKAR: sekarang mengarah ke register --}}
                    <div class="mt-8 pt-6 border-t border-gray-200/50 text-center">
                        <p class="text-gray-600 font-medium text-sm">
                            Don't have an account?&nbsp;
                            <a href="{{ route('register') }}" class="text-blue-600 font-extrabold hover:underline">
                                Sign In
                            </a>
                        </p>
                    </div>

                </div>
            </div>

            {{-- ===== HERO TEXT ===== --}}
            <div class="w-full md:w-1/2 order-1 md:order-2 flex flex-col md:-mt-64 md:text-left text-center">
                {{-- KlikBus brand + Welcome stacked tightly --}}
                <div class="mb-6 leading-none">
                    <h1 class="font-brand text-5xl md:text-6xl text-blue-700 tracking-wide drop-shadow mb-0"
                        style="text-shadow: 2px 3px 0px rgba(29,78,216,0.17);">
                        KlikBus
                    </h1>
                    <h2 class="font-welcome text-6xl md:text-4xl text-blue-600 italic leading-[1.3] py-2"
                        style="text-shadow: 3px 4px 0px rgba(29,78,216,0.13); line-height: 0.5;">
                        Welcome!
                    </h2>
                </div>
                
                <p class="text-xl text-gray-700 font-semibold leading-relaxed max-w-md">
                    Intercity travel in Lampung <br class="hidden md:block"> made easy.<br>
                    <span class="text-blue-600"> Reserve your bus tickets </span> <br class="hidden md:block"> in seconds.
                </p>

                <div class="mt-6 flex md:justify-start justify-center gap-6 text-sm text-gray-600 font-semibold">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Simple & Fast
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Simple & Fast
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Safe & Reliable
                    </div>
                </div>
            </div>

        </div>

        <div class="absolute bottom-8 left-10 text-gray-500 text-xs font-bold tracking-widest uppercase">
            &copy; 2026 KlikBus Team.
        </div>

    </div>
</body>
</html>