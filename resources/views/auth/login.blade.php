<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - KlikBus</title>
    
    <!-- Font Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased min-h-screen relative flex items-center justify-center p-6">

    <!-- BACKGROUND IMAGE (Terang agar Siger terlihat) -->
    <div class="fixed inset-0 z-0 bg-[url('/images/buss.png')] bg-cover bg-center bg-no-repeat"></div>
    <!-- Gradien putih di kiri agar form mudah dibaca, memudar ke kanan -->
    <div class="fixed inset-0 z-0 bg-gradient-to-r from-white/95 via-white/60 to-transparent backdrop-blur-[1px]"></div>

    <div class="relative z-10 w-full max-w-7xl mx-auto flex flex-col lg:flex-row items-center justify-start gap-8 lg:gap-16">

        <!-- CARD LOGIN (KIRI) -->
        <div class="w-full max-w-md bg-white/90 backdrop-blur-xl rounded-[2.5rem] p-8 md:p-10 shadow-2xl border border-white/60 relative overflow-hidden">
            
            <!-- Dekorasi background card -->
            <div class="absolute -left-10 -top-10 w-40 h-40 bg-blue-50 rounded-full opacity-50 pointer-events-none"></div>

            <div class="relative z-10">
                <div class="mb-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group mb-8">
                        <div class="w-10 h-10 rounded-xl bg-yellow-400 flex items-center justify-center shadow-sm group-hover:rotate-12 transition-transform">
                            <i class="fa-solid fa-bus text-blue-900"></i>
                        </div>
                        <span class="text-2xl font-black italic text-slate-800 leading-none">KlikBus.</span>
                    </a>
                    <h2 class="text-2xl font-black text-slate-800 mb-2">Selamat Datang! 👋</h2>
                    <p class="text-slate-500 text-sm font-medium">Masuk ke akun Anda untuk memesan tiket.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- EMAIL -->
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Email</label>
                        <div class="relative">
                            <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50/80 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none" />
                        </div>
                        @if($errors->has('email'))
                            <p class="text-red-500 text-xs font-bold mt-2 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-400">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors">Lupa sandi?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50/80 border border-slate-200 rounded-xl text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none" />
                        </div>
                    </div>

                    <!-- REMEMBER ME -->
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 bg-slate-50" name="remember">
                        <label for="remember_me" class="ml-2 text-sm font-medium text-slate-500 cursor-pointer">Ingat saya</label>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit" class="w-full flex justify-center items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl shadow-md shadow-blue-200 transition-all active:scale-95 text-sm">
                        Masuk Sekarang <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                    <p class="text-sm font-medium text-slate-500">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-blue-600 font-black hover:text-blue-800 transition-colors">Daftar di sini</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- HERO TEXT (KANAN) -->
        <div class="hidden lg:flex w-full lg:w-1/2 flex-col justify-center text-left space-y-6 lg:-mt-32 relative z-10">
            
            <h1 class="text-6xl font-black text-slate-800 drop-shadow-md leading-tight">
                Mulai Perjalanan<br>
                <span class="text-blue-700">Lebih Mudah</span>
            </h1>

            <p class="text-xl text-slate-700 font-bold max-w-sm leading-relaxed drop-shadow-sm">
                Pesan tiket bus ke seluruh wilayah Lampung dengan cepat, aman, dan nyaman.
            </p>

            <div class="flex flex-wrap items-center justify-start gap-4 pt-4">
                <span class="px-5 py-2.5 rounded-full text-sm font-extrabold bg-white/70 backdrop-blur-md text-slate-800 shadow-sm border border-white/50">
                    <i class="fa-solid fa-check text-blue-600 mr-1"></i> Praktis & Cepat
                </span>
                <span class="px-5 py-2.5 rounded-full text-sm font-extrabold bg-white/70 backdrop-blur-md text-slate-800 shadow-sm border border-white/50">
                    <i class="fa-solid fa-check text-blue-600 mr-1"></i> Aman Terpercaya
                </span>
            </div>
            
        </div>

    </div>

</body>
</html>