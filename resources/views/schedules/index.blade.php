<h1>Daftar Jadwal Keberangkatan</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ route('schedules.create') }}">+ Tambah Jadwal Baru</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Bus</th>
            <th>Tipe</th>
            <th>Rute</th>
            <th>Berangkat</th>
            <th>Tiba</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($schedules as $schedule)
    <tr>
      {{-- Ganti origin jadi departure --}}
      <td>{{ $schedule->route->departure }} → {{ $schedule->route->destination }}</td>
      
      {{-- Ganti plate_number jadi bus_name --}}
      <td>{{ $schedule->bus->bus_name }}</td>
      
      <td>{{ $schedule->departure_time }}</td>
      
      {{-- Kasih nilai default 0 kalau harganya kosong biar nggak error --}}
      <td>Rp {{ number_format($schedule->price ?? 0) }}</td>
      
      <td><a href="#" class="btn btn-sm btn-warning">Edit</a></td>
    </tr>
    @endforeach
    </tbody>
</table>