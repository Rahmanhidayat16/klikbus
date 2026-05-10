<form action="{{ route('admin.bus.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label>Plat Nomor</label>
    <input type="text" name="plate_number" class="form-control" placeholder="Contoh: BE 1234 AB" required>
  </div>
  <div class="mb-3">
    <label>Kapasitas Kursi</label>
    <input type="number" name="seat_capacity" class="form-control" placeholder="Contoh: 40" required>
  </div>
  <button type="submit" class="btn btn-success">Simpan</button>
</form>