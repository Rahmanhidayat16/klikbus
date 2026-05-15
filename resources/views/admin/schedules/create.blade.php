<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>KlikBus - Tambah Jadwal Baru</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Sora:wght@400;600;700&display=swap');

    :root {
      --color-border: #e5e7eb;
      --color-text-primary: #1a1a2e;
      --color-text-secondary: #4b5563;
      --bg-main: #f7f6f3;
      --accent-blue: #3b82f6;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { width: 100vw; height: 100vh; overflow: hidden; font-family: 'DM Sans', sans-serif; background: #fff; }
    .kb-shell { display: flex; width: 100vw; height: 100vh; background: var(--bg-main); }

    /* SIDEBAR */
    .kb-sidebar { width: 280px; flex-shrink: 0; background: #fff; border-right: 1px solid var(--color-border); display: flex; flex-direction: column; }
    .kb-logo { padding: 30px 24px; border-bottom: 1px solid var(--color-border); display: flex; align-items: center; gap: 12px; }
    .kb-logo-icon { width: 40px; height: 40px; background: #1a1a2e; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; }
    .kb-logo-text { font-family: 'Sora', sans-serif; font-size: 26px; font-weight: 700; color: #1a1a2e; }
    .kb-nav { padding: 15px 10px; flex: 1; }
    .kb-nav a { text-decoration: none; display: block; }
    .kb-nav-item { display: flex; align-items: center; gap: 12px; padding: 14px 18px; border-radius: 12px; font-size: 18px; color: var(--color-text-secondary); margin-bottom: 6px; }
    .kb-nav-item.active { background: #1a1a2e; color: #fff; }

    /* FORM AREA */
    .kb-main { flex: 1; display: flex; flex-direction: column; height: 100vh; }
    .kb-topbar { background: #fff; height: 75px; padding: 0 40px; display: flex; align-items: center; border-bottom: 1px solid var(--color-border); }
    .kb-content { padding: 40px; flex: 1; display: flex; justify-content: center; align-items: flex-start; overflow-y: auto; }
    
    .kb-form-card { background: #fff; width: 100%; max-width: 650px; padding: 40px; border-radius: 20px; border: 1px solid var(--color-border); box-shadow: 0 10px 25px rgba(0,0,0,0.02); }
    .kb-form-title { font-family: 'Sora', sans-serif; font-size: 24px; font-weight: 700; margin-bottom: 10px; color: #1a1a2e; }
    
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-size: 15px; font-weight: 600; color: var(--color-text-secondary); margin-bottom: 8px; }
    .form-group input, .form-group select { 
      width: 100%; padding: 14px; border-radius: 12px; border: 1px solid var(--color-border); font-size: 16px; font-family: 'DM Sans', sans-serif; outline: none; transition: 0.2s;
    }
    .form-group input:focus, .form-group select:focus { border-color: var(--accent-blue); box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }

    .btn-save { 
      width: 100%; background: #1a1a2e; color: #fff; padding: 16px; border: none; border-radius: 12px; font-size: 16px; font-weight: 600; cursor: pointer; transition: 0.3s; margin-top: 10px;
    }
    .btn-save:hover { background: #2a2a4e; transform: translateY(-2px); }
    .btn-back { display: block; text-align: center; margin-top: 20px; color: #9ca3af; text-decoration: none; font-size: 14px; font-weight: 500;}
    .btn-back:hover { color: #1a1a2e; }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
</head>
<body>

<div class="kb-shell">
  <aside class="kb-sidebar">
    <div class="kb-logo">
      <div class="kb-logo-icon"><i class="ti ti-bus"></i></div>
      <div class="kb-logo-text">KlikBus</div>
    </div>
    <nav class="kb-nav">
      <a href="{{ route('admin.dashboard') }}"><div class="kb-nav-item"><i class="ti ti-layout-dashboard"></i> Dashboard</div></a>
      <a href="{{ route('admin.bus.index') }}"><div class="kb-nav-item"><i class="ti ti-bus"></i> Kelola Bus</div></a>
      <a href="#"><div class="kb-nav-item"><i class="ti ti-route"></i> Atur Rute</div></a>
      <a href="{{ route('admin.schedules.index') }}"><div class="kb-nav-item active"><i class="ti ti-calendar-event"></i> Jadwal</div></a>
    </nav>
  </aside>

  <main class="kb-main">
    <div class="kb-topbar">
      <div style="font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 600;">TAMBAH JADWAL BARU</div>
    </div>

    <div class="kb-content">
      <div class="kb-form-card">
        <div class="kb-form-title">Informasi Jadwal</div>
        <p style="color: #9ca3af; margin-bottom: 30px;">Tentukan rute, armada bus, dan waktu keberangkatan.</p>
        
        <form action="{{ route('admin.schedules.store') }}" method="POST">
          @csrf
          
          <div class="form-group">
            <label>Pilih Rute Perjalanan</label>
            <select name="route_id" required>
              <option value="" disabled selected>-- Pilih Rute --</option>
              @foreach($routes as $route)
                <option value="{{ $route->id }}">{{ $route->departure }} &rarr; {{ $route->destination }} (Rp {{ number_format($route->base_price, 0, ',', '.') }})</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Pilih Armada Bus</label>
            <select name="bus_id" required>
              <option value="" disabled selected>-- Pilih Armada Bus --</option>
              @foreach($buses as $bus)
                <option value="{{ $bus->id }}">{{ $bus->bus_name }} ({{ $bus->type }}) - {{ $bus->total_seats }} Kursi</option>
              @endforeach
            </select>
          </div>

          <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
              <label>Waktu Berangkat</label>
              <input type="datetime-local" name="departure_time" required>
            </div>
            <div>
              <label>Kiraan Waktu Tiba</label>
              <input type="datetime-local" name="arrival_time" required>
            </div>
          </div>

          <div class="form-group">
            <label>Status Jadwal</label>
            <select name="status" required>
              <option value="scheduled">Scheduled (Terjadwal)</option>
              <option value="completed">Completed (Selesai)</option>
              <option value="cancelled">Cancelled (Batal)</option>
            </select>
          </div>

          <button type="submit" class="btn-save">Simpan Jadwal</button>
          <a href="{{ route('admin.schedules.index') }}" class="btn-back">Batal & Kembali ke Daftar Jadwal</a>
        </form>
      </div>
    </div>
  </main>
</div>

</body>
</html>