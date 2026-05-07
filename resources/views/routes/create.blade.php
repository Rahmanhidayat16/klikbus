<h1>Tambah Rute Baru</h1>

<form action="{{ route('routes.store') }}" method="POST">
    @csrf
    <div>
        <label>Kota Asal (Departure):</label><br>
        <input type="text" name="departure" placeholder="Contoh: Bandar Lampung" required>
    </div>
    <br>
    <div>
        <label>Kota Tujuan (Destination):</label><br>
        <input type="text" name="destination" placeholder="Contoh: Metro" required>
    </div>
    <br>
    <div>
        <label>Harga Dasar:</label><br>
        <input type="number" name="base_price" placeholder="Contoh: 25000" required>
    </div>
    <br>
    <button type="submit">Simpan Rute</button>
</form>
<br>
<a href="{{ route('routes.index') }}">Kembali ke Daftar</a>