<h1>Daftar Rute KlikBus</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<a href="{{ route('routes.create') }}">+ Tambah Rute Baru</a>

<table border="1" cellpadding="10" style="margin-top: 20px;">
    <thead>
        <tr>
            <th>Keberangkatan</th>
            <th>Tujuan</th>
            <th>Harga Dasar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($routes as $route)
        <tr>
            <td>{{ $route->departure }}</td>
            <td>{{ $route->destination }}</td>
            <td>Rp {{ number_format($route->base_price, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>