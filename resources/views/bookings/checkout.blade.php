<x-app-layout>
    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
                <div class="p-6 bg-gray-50 border-b">
                    <h3 class="text-lg font-black text-gray-800">RINGKASAN PESANAN</h3>
                </div>

                <div class="p-6 space-y-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Bus:</span>
                        <span class="font-bold text-gray-800 text-right">{{ $booking->schedule->bus->bus_name }}</span>
                    </div>

                    <div class="flex justify-between text-sm items-center">
                        <span class="text-gray-500">Rute:</span>
                        <span class="font-bold text-gray-800 whitespace-nowrap">
                            {{ $booking->schedule->route->departure }} <span class="text-blue-500 px-1">→</span> {{ $booking->schedule->route->destination }}
                        </span>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Nomor Kursi:</span>
                        <span class="font-bold text-blue-600">{{ implode(', ', $seats) }}</span>
                    </div>

                    <hr class="border-dashed my-4">

                    <div class="flex justify-between items-center py-2">
                        <span class="text-lg font-medium text-gray-700">Total Bayar:</span>
                        <span class="text-2xl font-black text-blue-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('bookings.process', $booking->id) }}" method="POST" class="mt-8">
                        @csrf
                        <p class="text-xs font-bold text-gray-400 mb-3 uppercase tracking-widest">Pilih Pembayaran:</p>
                        <div class="space-y-3">
                            <label class="flex items-center p-4 border rounded-xl cursor-pointer hover:bg-blue-50">
                                <input type="radio" name="payment_method" value="QRIS" checked>
                                <span class="ml-4 font-bold text-gray-800">QRIS (OVO/Dana/Gopay)</span>
                            </label>
                            <label class="flex items-center p-4 border rounded-xl cursor-pointer hover:bg-blue-50">
                                <input type="radio" name="payment_method" value="VA">
                                <span class="ml-4 font-bold text-gray-800">Virtual Account Bank</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full mt-8 bg-green-600 text-white font-black py-4 rounded-xl shadow-lg">BAYAR SEKARANG</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>