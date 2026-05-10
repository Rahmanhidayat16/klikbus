<table class="table">
  <thead>
    <tr>
      <th>No</th>
      <th>Plat Nomor</th>
      <th>Kapasitas Kursi</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($buses as $bus)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $bus->plate_number }}</td>
      <td>{{ $bus->seat_capacity }}</td>
      <td>
        <a href="{{ route('admin.bus.edit', $bus->id) }}" class="btn btn-sm btn-warning">Edit</a>
        <form action="{{ route('admin.bus.destroy', $bus->id) }}" method="POST" style="display:inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<a href="{{ route('admin.bus.create') }}" class="btn btn-primary">+ Tambah Bus</a>