<h1>Daftar Bus Lampung</h1>
<table border="1">
    <thead>
        <tr>
            <th>Nama Bus</th>
            <th>Tipe</th>
            <th>Kapasitas</th>
        </tr>
    </thead>
    <tbody>
       @foreach($semua_bus as $bus)
<tr>
    <td>{{ $bus->bus_name }}</td>
    <td>{{ $bus->type }}</td>
    <td>{{ $bus->total_seats }}</td>
</tr>
@endforeach
    </tbody>
</table>