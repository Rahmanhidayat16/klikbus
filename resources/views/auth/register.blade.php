<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join KlikBus - Reservasi Tiket Lampung</title>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Lobster+Two:ital,wght@1,700&family=Nunito+Sans:wght@400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-brand   { font-family: 'Righteous', cursive; }
        .font-welcome { font-family: 'Lobster Two', cursive; }
        body { font-family: 'Nunito Sans', sans-serif; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
        .fade-up { animation: fadeUp 0.55s cubic-bezier(.22,.68,0,1.2) both; }
    </style>
</head>
<body class="antialiased overflow-hidden">
    <div class="relative h-screen w-full flex items-center justify-center">
        {{-- Background (Sama dengan Login) --}}
        <div class="absolute inset-0">
            <img src="{{ asset('images/bus.png') }}" class="w-full h-full object-cover filter blur-[1.2px] scale-105">
            <div class="absolute inset-0 bg-white/40 mix-blend-overlay"></div>
        </div>

        <div class="relative z-10 w-full max-w-md px-6 fade-up">
            <div class="bg-white/45 backdrop-blur-2xl border border-white/60 p-9 rounded-[2rem] shadow-2xl">
                
                <h3 class="text-gray-900 text-2xl font-extrabold mb-6 text-center">Create Account</h3>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required 
                           class="w-full bg-white/65 border border-white/80 px-4 py-3 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none text-sm font-semibold">
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />

                    {{-- Email --}}
                    <input type="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required 
                           class="w-full bg-white/65 border border-white/80 px-4 py-3 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none text-sm font-semibold">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />

                    {{-- Password --}}
                    <input type="password" name="password" placeholder="Password" required 
                           class="w-full bg-white/65 border border-white/80 px-4 py-3 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none text-sm font-semibold">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />

                    {{-- Confirm Password --}}
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required 
                           class="w-full bg-white/65 border border-white/80 px-4 py-3 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none text-sm font-semibold">

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl shadow-lg transition-all mt-4">
                        Daftar Sekarang
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600 text-sm font-medium">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-blue-600 font-extrabold hover:underline">Log in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>