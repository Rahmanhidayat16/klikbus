<h1>Buat Jadwal Baru</h1>

<form action="{{ route('schedules.store') }}" method="POST">
    @csrf
    
    <div>
        <label>Pilih Bus:</label>
        <select name="bus_id">
            @foreach($buses as $bus)
                <option value="{{ $bus->id }}">{{ $bus->bus_name }} ({{ $bus->type }})</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Pilih Rute:</label>
        <select name="route_id">
            @foreach($routes as $route)
                <option value="{{ $route->id }}">{{ $route->departure }} - {{ $route->destination }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Waktu Berangkat:</label>
        <input type="datetime-local" name="departure_time">
    </div>

    <div>
        <label>Waktu Tiba:</label>
        <input type="datetime-local" name="arrival_time">
    </div>

    <div>
        <label>Status:</label>
        <select name="status">
            <option value="scheduled">Scheduled</option>
            <option value="on_trip">On Trip</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>

    <button type="submit">Simpan Jadwal</button>
</form>