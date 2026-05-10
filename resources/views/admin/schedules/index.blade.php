<table class="table">
  <thead>
    <tr>
      <th>Rute</th>
      <th>Bus</th>
      <th>Jam Berangkat</th>
      <th>Harga</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($schedules as $schedule)
    <tr>
      <td>{{ $schedule->route->origin }} → {{ $schedule->route->destination }}</td>
      <td>{{ $schedule->bus->plate_number }}</td>
      <td>{{ $schedule->departure_time }}</td>
      <td>Rp {{ number_format($schedule->price) }}</td>
      <td><a href="#" class="btn btn-sm btn-warning">Edit</a></td>
    </tr>
    @endforeach
  </tbody>
</table>