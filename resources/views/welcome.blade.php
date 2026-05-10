<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KlikBus - Reservasi Tiket Lampung</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Lobster+Two:ital,wght@1,700&family=Nunito+Sans:wght@400;600;700;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-brand { font-family: 'Righteous', cursive; }
        .font-welcome { font-family: 'Lobster Two', cursive; }
        body { font-family: 'Nunito Sans', sans-serif; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.8s ease-out forwards; }
    </style>
</head>
<body class="antialiased bg-gray-100 overflow-x-hidden">
    
    <div class="relative min-h-screen w-full flex items-center justify-center py-12 px-4">
        
        <div class="fixed inset-0 z-0">
            <img src="{{ asset('images/bus.png') }}" 
                 class="w-full h-full object-cover filter blur-[2px] brightness-90 scale-105" 
                 alt="Background">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-black/40"></div>
        </div>

        <div class="relative z-10 w-full max-w-6xl flex flex-col md:flex-row items-center justify-between gap-12">
            
            <div class="w-full md:w-1/2 text-white text-center md:text-left fade-up" style="animation-delay: 0.2s">
                <div class="mb-4">
                    <h1 class="font-brand text-6xl md:text-8xl drop-shadow-lg text-yellow-400">
                        KlikBus
                    </h1>
                    <h2 class="font-welcome text-4xl md:text-5xl mt-[-10px] text-white italic drop-shadow-md">
                        Welcome!
                    </h2>
                </div>
                
                <p class="text-lg md:text-2xl font-semibold leading-relaxed mb-8 drop-shadow-md">
                    Perjalanan antar kota di Lampung <br class="hidden md:block"> jadi lebih mudah dan cepat.
                </p>

                <div class="flex flex-wrap justify-center md:justify-start gap-4">
                    <span class="bg-white/20 backdrop-blur-md px-4 py-2 rounded-full text-sm font-bold border border-white/30">
                        ✓ Simple & Fast
                    </span>
                    <span class="bg-white/20 backdrop-blur-md px-4 py-2 rounded-full text-sm font-bold border border-white/30">
                        ✓ Safe & Reliable
                    </span>
                </div>
            </div>

            <div class="w-full md:w-[450px] fade-up" style="animation-delay: 0.4s">
                <div class="bg-white/80 backdrop-blur-xl border border-white p-8 md:p-10 rounded-[2.5rem] shadow-2xl">
                    <div class="text-center mb-8">
                        <h3 class="text-gray-900 text-3xl font-black tracking-tight">Mulai Perjalanan</h3>
                        <p class="text-gray-600 font-medium mt-2">Masuk untuk memesan tiket Anda</p>
                    </div>

                    <form action="{{ route('login') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-1">
                            <label class="text-sm font-bold text-gray-700 ml-2">Email</label>
                            <input type="email" name="email" placeholder="nama@email.com" required
                                class="w-full bg-white border border-gray-200 px-6 py-4 rounded-2xl focus:ring-4 focus:ring-blue-500/20 outline-none transition-all font-semibold">
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between items-center px-2">
                                <label class="text-sm font-bold text-gray-700">Password</label>
                                <a href="#" class="text-xs text-blue-600 font-bold hover:underline">Lupa?</a>
                            </div>
                            <input type="password" name="password" placeholder="••••••••" required
                                class="w-full bg-white border border-gray-200 px-6 py-4 rounded-2xl focus:ring-4 focus:ring-blue-500/20 outline-none transition-all font-semibold">
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 hover:shadow-blue-500/50 text-white font-bold py-5 rounded-2xl shadow-xl transition-all transform active:scale-95 text-lg">
                            Login Sekarang
                        </button>
                    </form>

                    <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                        <p class="text-gray-500 font-medium">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-blue-600 font-black hover:underline ml-1">Daftar</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <div class="fixed bottom-6 text-white/70 text-xs font-bold tracking-widest uppercase z-10">
            &copy; 2026 KlikBus Team Lampung.
        </div>
    </div>

</body>
</html>