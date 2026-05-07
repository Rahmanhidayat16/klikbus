<h1>Daftar Jadwal Bus Lampung</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Nama Bus</th>
            <th>Tipe</th>
            <th>Rute (Asal - Tujuan)</th>
            <th>Waktu Berangkat</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($schedules as $sch)
        <tr>
            <td>{{ $sch->bus->bus_name }}</td>
            <td>{{ $sch->bus->type }}</td>
            <td>{{ $sch->route->departure }} - {{ $sch->route->destination }}</td>
            <td>{{ $sch->departure_time }}</td>
            <td>Rp {{ number_format($sch->route->base_price, 0, ',', '.') }}</td>
            <td>
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="schedule_id" value="{{ $sch->id }}">
                    <input type="number" name="seat_number" placeholder="No Kursi" required style="width: 60px;">
                    <button type="submit">Pesan</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>
<a href="{{ route('dashboard') }}">Kembali ke Dashboard</a>