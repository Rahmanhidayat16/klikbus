<h4>Laporan Booking Hari Ini — {{ now()->format('d M Y') }}</h4>
<table class="table">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Penumpang</th>
      <th>Rute</th>
      <th>Kursi</th>
      <th>Total Bayar</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach($bookings as $booking)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $booking->user->name }}</td>
      <td>{{ $booking->schedule->route->origin }} → {{ $booking->schedule->route->destination }}</td>
      <td>{{ $booking->seat_number }}</td>
      <td>Rp {{ number_format($booking->total_price) }}</td>
      <td>
        <span class="badge bg-{{ $booking->booking_status == 'confirmed' ? 'success' : 'warning' }}">
          {{ $booking->booking_status }}
        </span>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>