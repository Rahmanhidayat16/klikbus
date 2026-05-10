<table class="table">
  <thead>
    <tr>
      <th>Asal</th>
      <th>Tujuan</th>
      <th>Jarak (km)</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($routes as $route)
    <tr>
      <td>{{ $route->origin }}</td>
      <td>{{ $route->destination }}</td>
      <td>{{ $route->distance }}</td>
      <td><a href="#" class="btn btn-sm btn-warning">Edit</a></td>
    </tr>
    @endforeach
  </tbody>
</table>