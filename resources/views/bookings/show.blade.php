<x-app-layout>
    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                <div class="p-6 bg-blue-600 text-white text-center">
                    <h3 class="text-2xl font-black italic">KLIKBUS</h3>
                    <p class="text-xs opacity-80 uppercase tracking-tighter">Tiket Digital Bus Lampung</p>
                </div>

                <div class="p-8 text-center border-b-2 border-dashed border-gray-100">
                    <div class="flex justify-center mb-4">{!! $qrcode !!}</div>
                    <p class="text-xs text-gray-400 uppercase tracking-widest">Scan QR Code ini saat Check-in</p>
                </div>

                <div class="p-6 space-y-4">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-xs text-gray-400 uppercase">Penumpang</p>
                            <p class="font-bold text-gray-800 text-lg">{{ $booking->user->name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-400 uppercase">Nomor Kursi</p>
                            <p class="font-bold text-blue-600 text-2xl">{{ implode(', ', $seats) }}</p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-400 uppercase">Bus</p>
                        <p class="font-bold text-gray-800">{{ $booking->schedule->bus->bus_name }} ({{ $booking->schedule->bus->type }})</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase">Keberangkatan</p>
                            <p class="font-bold text-gray-800">{{ $booking->schedule->route->departure }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase">Tujuan</p>
                            <p class="font-bold text-gray-800">{{ $booking->schedule->route->destination }}</p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-sm text-gray-500 font-medium">Status Pembayaran:</span>
                        <span class="px-4 py-1 {{ $booking->payment_status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }} rounded-full text-xs font-black uppercase">
                            {{ $booking->payment_status == 'paid' ? 'LUNAS' : 'MENUNGGU PEMBAYARAN' }}
                        </span>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 text-center border-t border-gray-100">
                    <a href="{{ route('dashboard') }}" class="text-blue-600 font-bold text-sm">← Kembali ke Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>