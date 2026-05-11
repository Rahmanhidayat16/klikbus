<x-app-layout>
    <div class="py-12 bg-gray-100 min-h-screen flex flex-col items-center justify-center font-sans">
        
        <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            
            <div class="bg-blue-500 p-6 text-center text-white">
                <h1 class="text-2xl font-black italic tracking-tighter uppercase">KlikBus</h1>
                <p class="text-[10px] opacity-80 uppercase tracking-widest font-bold">Tiket Digital Bus Lampung</p>
            </div>

            <div class="p-8 flex flex-col items-center border-b border-dashed border-gray-200">
                <div class="bg-white p-4 border-2 border-gray-50 rounded-2xl mb-4">
                    {!! QrCode::size(180)->generate('CLICKBUS-'. $booking->id) !!}
                </div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Scan QR Code ini saat check-in</p>
            </div>

            <div class="p-8 grid grid-cols-2 gap-y-6">
                <div>
                    <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Penumpang</p>
                    <p class="font-bold text-gray-800">{{ $booking->user->name }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Nomor Kursi</p>
                    <p class="font-bold text-blue-600 text-lg">{{ implode(', ', $seats) }}</p>
                </div>

                <div class="col-span-2">
                    <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Bus</p>
                    <p class="font-bold text-gray-800">{{ $booking->schedule->bus->bus_name }} ({{ $booking->schedule->bus->type }})</p>
                </div>

                <div>
                    <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Keberangkatan</p>
                    <p class="font-bold text-gray-800">{{ $booking->schedule->route->departure }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Tujuan</p>
                    <p class="font-bold text-gray-800">{{ $booking->schedule->route->destination }}</p>
                </div>

                <div class="col-span-2 pt-4 flex justify-between items-center">
                    <p class="text-sm text-gray-500 font-medium">Status Pembayaran:</p>
                    <span class="bg-green-100 text-green-600 px-4 py-1 rounded-full text-xs font-black uppercase tracking-widest">
                        {{ $booking->payment_status == 'paid' ? 'Lunas' : 'Pending' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="mt-8 flex gap-4">
            <a href="{{ route('dashboard') }}" class="text-gray-500 font-bold text-sm hover:underline">Kembali ke Dashboard</a>
            <button onclick="window.print()" class="text-blue-600 font-bold text-sm hover:underline">Cetak PDF</button>
        </div>
    </div>
</x-app-layout>