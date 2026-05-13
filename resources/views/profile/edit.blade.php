<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - KlikBus</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .fade-up {
            animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="antialiased text-slate-800 relative min-h-screen overflow-x-hidden flex flex-col">

    {{-- ===== BACKGROUND (Fixed agar tidak ikut terscroll) ===== --}}
    <div class="fixed inset-0 z-0">
        <img src="{{ asset('images/bus.png') }}"
             class="w-full h-full object-cover filter blur-[5px] scale-105"
             alt="Background KlikBus">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/50 via-blue-50/80 to-white/90"></div>
        <div class="absolute inset-0 bg-white/30 backdrop-blur-sm"></div>
    </div>

{{-- ===== NAVBAR ===== --}}
<nav class="relative z-20 bg-white/70 backdrop-blur-md border-b border-blue-100/50 shadow-md shadow-blue-900/5 sticky top-0">
    <!-- Menggunakan max-w-full agar benar-base ke ujung kiri dan kanan -->
    <div class="container mx-auto px-8 py-4 flex justify-between items-center max-w-full">
        
{{-- LOGO (Paling Kiri) --}}
<div class="text-2xl font-black tracking-tight flex items-center gap-3">
    
    {{-- Kotak background putih agar mobil biru terlihat kontras dan jelas --}}
    <div class="bg-blue p-2 rounded-xl shadow-lg border border-blue-500">
        {{-- Ikon mobil warna biru --}}
        <i class="fa-solid fa-bus text-yellow-600 text-lg"></i>
    </div>

    {{-- Tulisan KlikBus warna kuning dan miring --}}
    <span class="italic text-yellow-500">KlikBus.</span>
    
</div>

        {{-- TOMBOL (Paling Kanan) --}}
        <a href="{{ route('dashboard') }}" 
           class="font-bold text-sm text-blue-800 hover:text-white hover:bg-blue-600 transition-all duration-300 bg-white border border-blue-100 px-6 py-2.5 rounded-xl shadow-sm flex items-center gap-2 group">
            <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> 
            Kembali ke Dashboard
        </a>

    </div>
</nav>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="relative z-10 container mx-auto max-w-3xl px-6 py-10 space-y-8 pb-20">
        
        <div class="mb-8 fade-up text-center">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Pengaturan Profil <span class="text-blue-600"></span></h1>
            <p class="text-slate-600 font-medium mt-2">Kelola informasi data diri, kata sandi, dan keamanan akun kamu di sini.</p>
        </div>

        {{-- 1. BAGIAN INFO PROFIL --}}
        <section class="bg-white/60 backdrop-blur-2xl p-8 rounded-[2rem] shadow-xl shadow-blue-900/5 border border-white fade-up delay-100">
            <h2 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-user-pen text-blue-600"></i> Informasi Pribadi
            </h2>
            
            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                {{-- Visual Avatar Tetap Ada --}}
                <div class="flex items-center gap-5 mb-8 bg-white/50 border border-white/80 p-4 rounded-2xl w-fit shadow-sm">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-800 text-white rounded-2xl flex items-center justify-center text-2xl font-black shadow-lg shadow-blue-400/40 ring-4 ring-white/50">
                        {{ substr(Auth::user()->name ?? 'KB', 0, 1) }}
                    </div>
                    <div class="pr-4">
                        <p class="text-[10px] font-black text-green-600 uppercase tracking-widest flex items-center gap-1 mb-1">
                            <i class="fa-solid fa-circle-check"></i> Akun Aktif
                        </p>
                        <p class="text-sm font-black text-slate-800">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    {{-- Input Nama --}}
                    <div class="group">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-wider mb-2 ml-1">Nama Lengkap</label>
                        <div class="relative">
                            <i class="fa-solid fa-user absolute left-5 top-1/2 -translate-y-1/2 text-blue-600"></i>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                                   class="w-full bg-white/70 focus:bg-white border border-white shadow-inner text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-2 focus:ring-blue-500 outline-none font-bold transition-all">
                        </div>
                    </div>

                    {{-- Input Email --}}
                    <div class="group">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-wider mb-2 ml-1">Alamat Email</label>
                        <div class="relative">
                            <i class="fa-solid fa-envelope absolute left-5 top-1/2 -translate-y-1/2 text-blue-600"></i>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                                   class="w-full bg-white/70 focus:bg-white border border-white shadow-inner text-slate-900 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-2 focus:ring-blue-500 outline-none font-bold transition-all">
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-white/50 mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-black py-3.5 px-8 rounded-2xl transition-all active:scale-95 shadow-xl shadow-blue-600/20 text-sm flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                    @if (session('status') === 'profile-updated')
                        <p class="text-sm font-bold text-green-600 bg-green-50 px-4 py-2 rounded-xl border border-green-100 flex items-center gap-2">
                            <i class="fa-solid fa-check-circle"></i> Berhasil disimpan.
                        </p>
                    @endif
                </div>
            </form>
        </section>

        {{-- 2. BAGIAN UBAH PASSWORD --}}
        <section class="bg-white/60 backdrop-blur-2xl p-8 rounded-[2rem] shadow-xl shadow-blue-900/5 border border-white fade-up delay-200">
            <h2 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-lock text-slate-700"></i> Ubah Kata Sandi
            </h2>
            
            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-wider mb-2 ml-1">Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" required placeholder="Masukkan sandi lama..."
                           class="w-full bg-white/70 focus:bg-white border border-white shadow-inner text-slate-900 rounded-2xl px-5 py-3.5 focus:ring-2 focus:ring-blue-500 outline-none font-bold transition-all">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-wider mb-2 ml-1">Kata Sandi Baru</label>
                        <input type="password" name="password" required placeholder="Minimal 8 karakter..."
                               class="w-full bg-white/70 focus:bg-white border border-white shadow-inner text-slate-900 rounded-2xl px-5 py-3.5 focus:ring-2 focus:ring-blue-500 outline-none font-bold transition-all">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-wider mb-2 ml-1">Konfirmasi Sandi Baru</label>
                        <input type="password" name="password_confirmation" required placeholder="Ulangi sandi baru..."
                               class="w-full bg-white/70 focus:bg-white border border-white shadow-inner text-slate-900 rounded-2xl px-5 py-3.5 focus:ring-2 focus:ring-blue-500 outline-none font-bold transition-all">
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-white/50 mt-6">
                    <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white font-black py-3.5 px-8 rounded-2xl transition-all active:scale-95 shadow-xl shadow-slate-900/20 text-sm flex items-center gap-2">
                        <i class="fa-solid fa-key"></i> Perbarui Sandi
                    </button>
                </div>
            </form>
        </section>

        {{-- 3. BAGIAN HAPUS AKUN --}}
        <section class="bg-red-50/80 backdrop-blur-2xl p-8 rounded-[2rem] shadow-xl shadow-red-900/5 border border-red-100 fade-up delay-300">
            <h2 class="text-xl font-black text-red-600 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i> Zona Berbahaya
            </h2>
            <p class="text-sm text-red-500/80 font-bold mb-6">
                Peringatan: Setelah akun dihapus, semua data pesanan tiket dan riwayat Anda akan hilang secara permanen.
            </p>
            
            <form method="post" action="{{ route('profile.destroy') }}" class="flex flex-col md:flex-row items-start md:items-center gap-4">
                @csrf
                @method('delete')
                
                <div class="flex-1 w-full relative">
                    <i class="fa-solid fa-shield-halved absolute left-5 top-1/2 -translate-y-1/2 text-red-400"></i>
                    <input type="password" name="password" placeholder="Konfirmasi sandi untuk menghapus akun" required
                           class="w-full bg-white focus:bg-white border border-red-200 text-slate-900 placeholder-red-300 rounded-2xl pl-12 pr-4 py-3.5 focus:ring-2 focus:ring-red-500 outline-none font-bold transition-all">
                </div>
                
                <button type="submit" onclick="return confirm('Apakah Anda sangat yakin ingin menghapus akun ini secara permanen?')" 
                        class="bg-red-600 hover:bg-red-700 text-white font-black py-3.5 px-8 rounded-2xl transition-all active:scale-95 shadow-xl shadow-red-600/20 text-sm w-full md:w-auto whitespace-nowrap flex justify-center items-center gap-2 border border-red-500">
                    <i class="fa-solid fa-trash-can"></i> Hapus Akun
                </button>
            </form>
        </section>

    </main>
</body>
</html>