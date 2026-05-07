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
        @foreach($schedules as $sch)
        <tr>
            <td>{{ $sch->bus->bus_name }}</td>
            <td>{{ $sch->bus->type }}</td>
            <td>{{ $sch->route->departure }} -> {{ $sch->route->destination }}</td>
            <td>{{ $sch->departure_time }}</td>
            <td>{{ $sch->arrival_time }}</td>
            <td>{{ $sch->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>