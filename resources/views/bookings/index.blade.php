<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow rounded-lg">
                <h2 class="text-xl font-bold mb-6">Pemesanan Tiket KlikBus</h2>

                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="block font-bold mb-2">Pilih Rute & Jadwal:</label>
                        <select name="schedule_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                            @foreach($schedules as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->bus->bus_name }} | {{ $item->route->departure }} - {{ $item->route->destination }} (Rp {{ number_format($item->route->base_price, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
    <label class="block font-bold mb-4">Pilih Kursi (Bisa lebih dari satu):</label>
    
    @php 
        $maxSeats = $schedules->first()->bus->total_seats ?? 40; 
    @endphp

    <div class="grid grid-cols-5 gap-3 bg-gray-50 p-4 rounded-lg">
        @for ($i = 1; $i <= $maxSeats; $i++)
            <label class="flex items-center p-2 border rounded cursor-pointer hover:bg-blue-50">
                <input type="checkbox" name="seat_numbers[]" value="{{ $i }}" class="rounded text-blue-600">
                <span class="ml-2 text-sm">{{ $i }}</span>
            </label>
        @endfor
    </div>
</div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg">Lanjut ke Pembayaran</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>