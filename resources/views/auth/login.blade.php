<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - KlikBus</title>

    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-[Poppins]">

    <div class="min-h-screen w-full flex items-center justify-center bg-cover bg-center bg-no-repeat p-4"
         style="background-image: url('{{ asset('images/buss.png') }}');">

        <!-- Overlay biar teks lebih jelas -->
        <div class="absolute inset-0 bg-gradient-to-r from-sky-100/40 to-blue-200/20 backdrop-blur-[1px]"></div>

        <div class="relative z-10 w-full max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-10">

            <!-- CARD LOGIN -->
            <div class="w-full md:w-[450px] bg-white/85 backdrop-blur-xl p-10 rounded-[45px] shadow-2xl border border-white/40">

                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-extrabold text-slate-800">
                        Mulai Perjalanan
                    </h2>

                    <a href="/" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </a>
                </div>

                <p class="text-slate-500 mb-8 font-medium">
                    Masuk untuk memesan tiket Anda
                </p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- EMAIL -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-600 mb-2">
                            Email
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="nama@email.com"
                            class="w-full px-5 py-4 rounded-2xl bg-white/80 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-sky-500 transition shadow-sm outline-none"
                        />

                        @if($errors->has('email'))
                            <p class="text-red-500 text-xs mt-2">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-4">

                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-sm font-semibold text-slate-600">
                                Kata Sandi
                            </label>

                            <a href="{{ route('password.request') }}"
                               class="text-xs text-sky-600 font-semibold hover:underline">
                                Lupa?
                            </a>
                        </div>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full px-5 py-4 rounded-2xl bg-white/80 border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-sky-500 transition shadow-sm outline-none"
                        />
                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="w-full bg-sky-600 hover:bg-sky-700 text-white font-extrabold py-5 rounded-2xl shadow-xl transition active:scale-95 mt-8 text-lg"
                    >
                        Masuk Sekarang
                    </button>

                    <p class="text-center text-sm text-slate-600 mt-10">
                        Belum punya akun?

                        <a href="{{ route('register') }}"
                           class="text-sky-600 font-bold hover:underline">
                            Daftar
                        </a>
                    </p>

                </form>
            </div>

            <!-- HERO TEXT -->
            <div class="hidden md:block w-full md:w-1/2 text-left relative"
                 style="top: -90px; left: -100px;">

                <!-- LOGO -->
                <h1 class="text-[105px] font-black text-yellow-400 leading-none tracking-tighter drop-shadow-xl">
                    KlikBus
                </h1>

                <!-- SUBTITLE -->
                <h2 class="text-5xl font-bold text-sky-700 mb-8">
                    Selamat Datang!
                </h2>

                <!-- DESCRIPTION -->
<p class="text-2xl font-medium leading-relaxed max-w-xl" style="color: #0369a1 !important;">
    Perjalanan antar kota di Lampung 
</p>
<p class="text-2xl font-medium leading-relaxed max-w-xl" style="color: #0369a1 !important;">
    jadi lebih mudah, nyaman, dan cepat
</p>
<p class="text-2xl font-medium leading-relaxed max-w-xl" style="color: #0369a1 !important;">
    bersama KlikBus.
</p>
                <!-- BADGES -->
<div class="flex flex-wrap gap-4 mt-12">

    <span class="px-6 py-3 rounded-full text-sm font-extrabold border border-blue-400/40 shadow-lg" 
          style="background-color: rgba(11, 92, 172, 0.7); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); color: #dfdfe6 !important;">
        ✓ Mudah & Cepat
    </span>

    <span class="px-6 py-3 rounded-full text-sm font-extrabold border border-blue-400/40 shadow-lg" 
          style="background-color: rgba(11, 92, 172, 0.7); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); color: #e8e8ec !important;">
        ✓ Aman & Terpercaya
    </span>

</div>

            </div>

        </div>
    </div>

</body>
</html>