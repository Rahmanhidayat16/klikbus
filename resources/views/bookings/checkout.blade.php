<!DOCTYPE html>
<html lang="id">
<head>
        <script src="https://cdn.tailwindcss.com"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Tiket - KlikBus</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8faff; }
        
        /* Efek klik untuk metode pembayaran */
        input[type="radio"]:checked + div {
            border-color: #2563eb; /* text-blue-600 */
            background-color: #eff6ff; /* bg-blue-50 */
        }
        input[type="radio"]:checked + div .radio-dot {
            background-color: #2563eb;
        }
    </style>
</head>
<body class="antialiased min-h-screen pb-20">

    {{-- NAVBAR --}}
    <nav class="bg-blue-600 text-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center max-w-5xl">
            <a href="{{ route('bookings.index') }}" class="font-bold text-sm hover:text-yellow-200 transition bg-white/10 px-4 py-2 rounded-xl flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Batal / Kembali
            </a>
            <div class="text-xl font-black text-yellow-400 italic flex items-center gap-2">
                <i class="fa-solid fa-bus"></i> KlikBus.
            </div>
        </div>
    </nav>

    <main class="container mx-auto max-w-5xl px-6 py-10">
        
        <div class="mb-8 text-center">
            <h1 class="text-3xl md:text-4xl font-black text-slate-900 mb-2">Selesaikan Pembayaran 💳</h1>
            <p class="text-slate-500 font-medium">Satu langkah lagi tiket bus akan menjadi milikmu.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- KIRI: METODE PEMBAYARAN --}}
            <div class="flex-1 space-y-6">
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
                    <h2 class="text-xl font-bold text-slate-800 mb-6 border-b border-slate-100 pb-4">Pilih Metode Pembayaran</h2>
                    
                    {{-- Form Proses Pembayaran --}}
                    {{-- Ganti $booking->id sesuai variabel yang dikirim dari controller Rahman --}}
                    <form action="{{ route('bookings.process', $booking->id ?? 1) }}" method="POST" id="paymentForm">
                        @csrf
                        
                        <div class="space-y-4">
                            {{-- Pilihan 1: Transfer Bank --}}
                            <label class="block cursor-pointer">
                                <input type="radio" name="payment_method" value="bank_transfer" class="hidden" checked>
                                <div class="flex items-center justify-between border-2 border-slate-200 p-5 rounded-2xl transition-all hover:border-blue-300">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-blue-600 text-xl shadow-sm">
                                            <i class="fa-solid fa-building-columns"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">Transfer Bank (Virtual Account)</p>
                                            <p class="text-xs text-slate-500 font-medium mt-1">BCA, Mandiri, BNI, BRI</p>
                                        </div>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border-2 border-slate-300 flex items-center justify-center">
                                        <div class="radio-dot w-2.5 h-2.5 rounded-full transition-all"></div>
                                    </div>
                                </div>
                            </label>

                            {{-- Pilihan 2: E-Wallet --}}
                            <label class="block cursor-pointer">
                                <input type="radio" name="payment_method" value="ewallet" class="hidden">
                                <div class="flex items-center justify-between border-2 border-slate-200 p-5 rounded-2xl transition-all hover:border-blue-300">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-green-500 text-xl shadow-sm">
                                            <i class="fa-solid fa-wallet"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">E-Wallet / QRIS</p>
                                            <p class="text-xs text-slate-500 font-medium mt-1">Gopay, OVO, Dana, ShopeePay</p>
                                        </div>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border-2 border-slate-300 flex items-center justify-center">
                                        <div class="radio-dot w-2.5 h-2.5 rounded-full transition-all"></div>
                                    </div>
                                </div>
                            </label>

                            {{-- Pilihan 3: Minimarket --}}
                            <label class="block cursor-pointer">
                                <input type="radio" name="payment_method" value="retail" class="hidden">
                                <div class="flex items-center justify-between border-2 border-slate-200 p-5 rounded-2xl transition-all hover:border-blue-300">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-red-500 text-xl shadow-sm">
                                            <i class="fa-solid fa-shop"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">Minimarket</p>
                                            <p class="text-xs text-slate-500 font-medium mt-1">Alfamart, Indomaret</p>
                                        </div>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border-2 border-slate-300 flex items-center justify-center">
                                        <div class="radio-dot w-2.5 h-2.5 rounded-full transition-all"></div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </form>
                </div>
            </div>

            {{-- KANAN: RINGKASAN PESANAN --}}
            <div class="w-full lg:w-[400px]">
                <div class="bg-blue-600 p-8 rounded-[2rem] shadow-xl text-white sticky top-24 relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-500 rounded-full opacity-30 pointer-events-none"></div>
                    
                    <h3 class="text-xl font-black mb-6 border-b border-blue-500 pb-4 relative z-10">Ringkasan Pesanan</h3>
                    
                    <div class="space-y-4 mb-6 relative z-10">
                        {{-- Data di bawah ini contoh, nanti diisi pakai variabel dari Backend --}}
                        <div class="bg-blue-700/50 p-4 rounded-xl">
                            <p class="text-blue-200 text-[10px] font-bold uppercase tracking-wider mb-1">Rute Perjalanan</p>
                            <p class="font-bold text-sm">{{ $booking->schedule->route->departure ?? 'Bandar Lampung' }} ➔ {{ $booking->schedule->route->destination ?? 'Metro' }}</p>
                        </div>
                        
                        <div class="flex justify-between items-center bg-blue-700/50 p-4 rounded-xl">
                            <div>
                                <p class="text-blue-200 text-[10px] font-bold uppercase tracking-wider mb-1">Tanggal</p>
                                <p class="font-bold text-sm">15 Mei 2026</p>
                            </div>
                            <div class="text-right">
                                <p class="text-blue-200 text-[10px] font-bold uppercase tracking-wider mb-1">Jam</p>
                                <p class="font-bold text-sm">08:00 WIB</p>
                            </div>
                        </div>

                        <div class="bg-blue-700/50 p-4 rounded-xl">
                            <p class="text-blue-200 text-[10px] font-bold uppercase tracking-wider mb-1">Nomor Kursi</p>
                            <div class="flex flex-wrap gap-2 mt-2">
                                {{-- Contoh kursi terpilih --}}
                                <span class="bg-yellow-400 text-blue-900 font-black text-xs px-3 py-1 rounded-lg">1A</span>
                                <span class="bg-yellow-400 text-blue-900 font-black text-xs px-3 py-1 rounded-lg">1B</span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-blue-500 pt-6 mb-6 relative z-10">
                        <div class="flex justify-between items-center mb-2 text-blue-100">
                            <span class="font-medium text-sm">Harga Tiket (x2)</span>
                            <span class="font-bold">Rp 90.000</span>
                        </div>
                        <div class="flex justify-between items-center mb-4 text-blue-100">
                            <span class="font-medium text-sm">Biaya Layanan</span>
                            <span class="font-bold">Rp 2.000</span>
                        </div>
                        <div class="flex justify-between items-center text-xl">
                            <span class="font-black">Total Bayar</span>
                            <span class="font-black text-yellow-400">Rp 92.000</span>
                        </div>
                    </div>

                    <button onclick="document.getElementById('paymentForm').submit()" class="w-full bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-black py-4 rounded-xl transition-all active:scale-95 shadow-lg relative z-10">
                        Bayar Sekarang <i class="fa-solid fa-lock ml-2"></i>
                    </button>
                    
                    <p class="text-center text-blue-200 text-[10px] mt-4 font-medium relative z-10">
                        <i class="fa-solid fa-shield-halved mr-1"></i> Pembayaran aman dan terenkripsi
                    </p>
                </div>
            </div>

        </div>
    </main>

</body>
</html>