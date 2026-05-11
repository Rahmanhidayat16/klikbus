<!DOCTYPE html>
<html lang="id">
<head>
        <script src="https://cdn.tailwindcss.com"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - KlikBus</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8faff; }
    </style>
</head>
<body class="antialiased text-slate-800">

    {{-- NAVBAR TOP --}}
    <nav class="bg-blue-600 text-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center max-w-5xl">
            <div class="text-xl font-black text-yellow-400 italic flex items-center gap-2">
                <i class="fa-solid fa-bus"></i> KlikBus.
            </div>
            <a href="{{ route('dashboard') }}" class="font-bold text-sm hover:text-yellow-200 transition bg-white/10 px-4 py-2 rounded-xl">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </a>
        </div>
    </nav>

    <main class="container mx-auto max-w-3xl px-6 py-10 space-y-8">
        
        <div class="mb-8">
            <h1 class="text-3xl font-black text-slate-900">Pengaturan Profil ⚙️</h1>
            <p class="text-slate-500 font-medium mt-1">Kelola informasi data diri, kata sandi, dan keamanan akun kamu di sini.</p>
        </div>

        {{-- 1. BAGIAN INFO PROFIL (Tanpa Input Gambar) --}}
        <section class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h2 class="text-xl font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Informasi Pribadi</h2>
            
            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                {{-- Visual Avatar Tetap Ada (Hanya Inisial, Tanpa Tombol Ganti) --}}
                <div class="flex items-center gap-4 mb-8 bg-blue-50 p-4 rounded-2xl w-fit">
                    <div class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center text-2xl font-black shadow-lg shadow-blue-200">
                        {{ substr(Auth::user()->name ?? 'KB', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-xs font-bold text-blue-600 uppercase tracking-widest">Akun Aktif</p>
                        <p class="text-sm font-extrabold text-slate-700">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    {{-- Input Nama --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                                   class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none font-semibold transition-all">
                        </div>
                    </div>

                    {{-- Input Email --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Alamat Email</label>
                        <div class="relative">
                            <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                                   class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none font-semibold transition-all">
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl transition-all active:scale-95 shadow-lg shadow-blue-200">
                        Simpan Perubahan
                    </button>
                    @if (session('status') === 'profile-updated')
                        <p class="text-sm font-bold text-green-500"><i class="fa-solid fa-check-circle mr-1"></i> Tersimpan.</p>
                    @endif
                </div>
            </form>
        </section>

        {{-- 2. BAGIAN UBAH PASSWORD --}}
        <section class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h2 class="text-xl font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Ubah Kata Sandi</h2>
            
            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" required
                           class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none font-semibold transition-all">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Kata Sandi Baru</label>
                        <input type="password" name="password" required
                               class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none font-semibold transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Konfirmasi Sandi Baru</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full bg-slate-50 border border-slate-200 text-slate-900 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none font-semibold transition-all">
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white font-bold py-3 px-8 rounded-xl transition-all active:scale-95 shadow-md">
                        Perbarui Sandi
                    </button>
                </div>
            </form>
        </section>

        {{-- 3. BAGIAN HAPUS AKUN --}}
        <section class="bg-red-50 p-8 rounded-[2rem] shadow-sm border border-red-100">
            <h2 class="text-xl font-bold text-red-600 mb-2">Hapus Akun</h2>
            <p class="text-sm text-red-500/80 font-medium mb-6">
                Peringatan: Setelah akun dihapus, semua data akan hilang secara permanen.
            </p>
            
            <form method="post" action="{{ route('profile.destroy') }}" class="flex flex-col md:flex-row items-start md:items-center gap-4">
                @csrf
                @method('delete')
                
                <div class="flex-1 w-full">
                    <input type="password" name="password" placeholder="Konfirmasi sandi untuk menghapus" required
                           class="w-full bg-white border border-red-200 text-slate-900 placeholder-red-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 outline-none font-semibold transition-all">
                </div>
                
                <button type="submit" onclick="return confirm('Yakin ingin menghapus akun?')" 
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-xl transition-all active:scale-95 shadow-md shadow-red-200 w-full md:w-auto whitespace-nowrap">
                    <i class="fa-solid fa-trash mr-2"></i> Hapus Akun
                </button>
            </form>
        </section>

    </main>
</body>
</html>