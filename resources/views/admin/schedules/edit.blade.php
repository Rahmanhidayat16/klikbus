<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>KlikBus - Edit Jadwal</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Sora:wght@400;600;700&display=swap');

    :root {
      --color-border: #e5e7eb;
      --color-text-primary: #1a1a2e;
      --color-text-secondary: #4b5563;
      --color-text-tertiary: #9ca3af;
      --bg-main: #f7f6f3;
      --accent-blue: #3b82f6;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { 
      width: 100vw; height: 100vh; 
      overflow: hidden; 
      font-family: 'DM Sans', sans-serif; 
      background: #000; 
    }

    .kb-shell {
      display: flex; width: 100vw; height: 100vh;
      background: var(--bg-main);
    }

    /* SIDEBAR */
    .kb-sidebar {
      width: 280px; flex-shrink: 0;
      background: #fff; border-right: 1px solid var(--color-border);
      display: flex; flex-direction: column;
    }
    .kb-logo {
      padding: 30px 24px; border-bottom: 1px solid var(--color-border);
      display: flex; align-items: center; gap: 12px;
    }
    .kb-logo-icon {
      width: 40px; height: 40px; background: #1a1a2e; border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-size: 18px;
    }
    .kb-logo-text { font-family: 'Sora', sans-serif; font-size: 26px; font-weight: 700; color: #1a1a2e; }
    .kb-nav { padding: 15px 10px; flex: 1; overflow-y: auto; }
    .kb-nav-label { font-size: 13px; font-weight: 600; color: var(--color-text-tertiary); text-transform: uppercase; padding: 12px 15px 8px; }
    .kb-nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 14px 18px; border-radius: 12px;
      font-size: 18px; color: var(--color-text-secondary);
      cursor: pointer; margin-bottom: 6px; transition: 0.2s;
    }
    .kb-nav-item.active { background: #1a1a2e; color: #fff; font-weight: 500; }
    .kb-nav-item:hover:not(.active) { background: #f9fafb; }
    .kb-badge {
      margin-left: auto; background: #eff6ff; color: #3b82f6;
      font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 20px;
    }
    .active .kb-badge { background: rgba(255,255,255,0.2); color: #fff; }
    .kb-sidebar-footer {
      padding: 20px; border-top: 1px solid var(--color-border);
      display: flex; align-items: center; gap: 12px;
    }
    .kb-avatar {
      width: 42px; height: 42px; background: var(--accent-blue); border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-weight: 600; flex-shrink: 0;
    }
    .kb-profile-info { flex: 1; overflow: hidden; }
    .kb-profile-name { font-size: 15px; font-weight: 600; color: #1a1a2e; }
    .kb-profile-role { font-size: 13px; color: var(--color-text-tertiary); }
    .kb-logout-btn { color: #ef4444; font-size: 20px; cursor: pointer; padding: 8px; border-radius: 8px; background: none; border: none; }

    /* MAIN */
    .kb-main { flex: 1; display: flex; flex-direction: column; height: 100vh; }
    .kb-topbar {
      background: #fff; height: 75px; padding: 0 40px;
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 1px solid var(--color-border); flex-shrink: 0;
    }
    .kb-topbar-title { font-family: 'Sora', sans-serif; font-size: 25px; font-weight: 600; }
    .kb-content { padding: 25px 40px; flex: 1; overflow-y: auto; }

    /* FORM CARD */
    .kb-form-card {
      background: #fff; border-radius: 18px; padding: 32px;
      border: 1px solid var(--color-border);
      box-shadow: 0 10px 25px rgba(0,0,0,0.02);
      max-width: 750px;
    }

    .kb-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .kb-form-group { display: flex; flex-direction: column; gap: 6px; }
    .kb-form-group.full { grid-column: 1 / -1; }

    label { font-size: 14px; font-weight: 600; color: var(--color-text-secondary); }

    input, select {
      padding: 12px 14px; border-radius: 10px;
      border: 1.5px solid var(--color-border);
      font-size: 15px; font-family: 'DM Sans', sans-serif;
      color: var(--color-text-primary);
      transition: border-color 0.2s, box-shadow 0.2s;
      background: #fff;
      width: 100%;
    }
    input:focus, select:focus {
      outline: none;
      border-color: #1a1a2e;
      box-shadow: 0 0 0 3px rgba(26,26,46,0.08);
    }

    .kb-form-actions {
      display: flex; gap: 12px; align-items: center;
      margin-top: 28px; padding-top: 24px;
      border-top: 1px solid var(--color-border);
    }
    .kb-btn-save {
      background: #1a1a2e; color: #fff;
      padding: 12px 28px; border-radius: 10px;
      font-size: 15px; font-weight: 600;
      border: none; cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      transition: background 0.2s;
    }
    .kb-btn-save:hover { background: #2d2d4e; }
    .kb-btn-back {
      color: var(--color-text-secondary);
      text-decoration: none; font-size: 15px; font-weight: 500;
      padding: 12px 20px; border-radius: 10px;
      border: 1.5px solid var(--color-border);
      transition: background 0.2s;
    }
    .kb-btn-back:hover { background: #f9fafb; }

    .kb-error {
      background: #fef2f2; color: #ef4444;
      padding: 12px 16px; border-radius: 8px;
      margin-bottom: 20px; font-weight: 500;
      border: 1px solid #fecaca; font-size: 14px;
    }
    .kb-field-error { font-size: 13px; color: #ef4444; margin-top: 4px; }
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
      <div class="kb-nav-label">Utama</div>

      <a href="{{ route('admin.dashboard') }}" style="text-decoration: none;">
        <div class="kb-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <i class="ti ti-layout-dashboard"></i> Dashboard
        </div>
      </a>

      <a href="{{ route('admin.bus.index') }}" style="text-decoration: none;">
        <div class="kb-nav-item {{ request()->routeIs('admin.bus.*') ? 'active' : '' }}">
          <i class="ti ti-bus"></i> Kelola Bus
        </div>
      </a>

      <a href="{{ route('admin.routes.index') }}" style="text-decoration: none;">
        <div class="kb-nav-item {{ request()->routeIs('admin.routes.*') ? 'active' : '' }}">
          <i class="ti ti-route"></i> Atur Rute
        </div>
      </a>

      <a href="{{ route('admin.schedules.index') }}" style="text-decoration: none;">
        <div class="kb-nav-item {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}">
          <i class="ti ti-calendar-event"></i> Jadwal
        </div>
      </a>

      <div class="kb-nav-label">Laporan & Keuangan</div>
      <div class="kb-nav-item"><i class="ti ti-file-analytics"></i> Laporan Pemesanan</div>
      <div class="kb-nav-item"><i class="ti ti-ticket"></i> Data Tiket</div>

      <div class="kb-nav-label">Sistem</div>
      <div class="kb-nav-item"><i class="ti ti-users"></i> Pengguna</div>
      <div class="kb-nav-item"><i class="ti ti-settings"></i> Pengaturan</div>
    </nav>

    <div class="kb-sidebar-footer">
      <div class="kb-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
      <div class="kb-profile-info">
        <div class="kb-profile-name">{{ auth()->user()->name }}</div>
        <div class="kb-profile-role">Super Admin</div>
      </div>
      <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit" class="kb-logout-btn" title="Keluar">
          <i class="ti ti-logout"></i>
        </button>
      </form>
    </div>
  </aside>

  <main class="kb-main">
    <div class="kb-topbar">
      <div class="kb-topbar-title">EDIT JADWAL</div>
      <div style="display:flex; align-items:center; gap:20px;">
        <div style="font-size: 14px; color: #666;"><i class="ti ti-calendar"></i> {{ date('F Y') }}</div>
        <i class="ti ti-bell" style="font-size: 22px; cursor:pointer;"></i>
      </div>
    </div>

    <div class="kb-content">
      <div class="kb-form-card">

        @if($errors->any())
          <div class="kb-error">
            <i class="ti ti-alert-circle"></i>
            {{ $errors->first() }}
          </div>
        @endif

        <form method="POST" action="{{ route('admin.schedules.update', $schedule->id) }}">
          @csrf
          @method('PUT')

          <div class="kb-form-grid">

            {{-- Armada Bus --}}
            <div class="kb-form-group">
              <label for="bus_id">Armada Bus</label>
              <select name="bus_id" id="bus_id">
                <option value="">-- Pilih Bus --</option>
                @foreach($buses as $bus)
                  <option value="{{ $bus->id }}" {{ old('bus_id', $schedule->bus_id) == $bus->id ? 'selected' : '' }}>
                    {{ $bus->bus_name }} ({{ $bus->type }})
                  </option>
                @endforeach
              </select>
              @error('bus_id') <span class="kb-field-error">{{ $message }}</span> @enderror
            </div>

            {{-- Rute --}}
            <div class="kb-form-group">
              <label for="route_id">Rute Perjalanan</label>
              <select name="route_id" id="route_id">
                <option value="">-- Pilih Rute --</option>
                @foreach($routes as $route)
                  <option value="{{ $route->id }}" {{ old('route_id', $schedule->route_id) == $route->id ? 'selected' : '' }}>
                    {{ $route->departure }} → {{ $route->destination }}
                  </option>
                @endforeach
              </select>
              @error('route_id') <span class="kb-field-error">{{ $message }}</span> @enderror
            </div>

            {{-- Waktu Berangkat --}}
            <div class="kb-form-group">
              <label for="departure_time">Waktu Berangkat</label>
              <input type="datetime-local" name="departure_time" id="departure_time"
                value="{{ old('departure_time', \Carbon\Carbon::parse($schedule->departure_time)->format('Y-m-d\TH:i')) }}">
              @error('departure_time') <span class="kb-field-error">{{ $message }}</span> @enderror
            </div>

            {{-- Waktu Tiba --}}
            <div class="kb-form-group">
              <label for="arrival_time">Waktu Tiba</label>
              <input type="datetime-local" name="arrival_time" id="arrival_time"
                value="{{ old('arrival_time', \Carbon\Carbon::parse($schedule->arrival_time)->format('Y-m-d\TH:i')) }}">
              @error('arrival_time') <span class="kb-field-error">{{ $message }}</span> @enderror
            </div>

            {{-- Status --}}
            <div class="kb-form-group">
              <label for="status">Status</label>
              <select name="status" id="status">
                <option value="scheduled"  {{ old('status', $schedule->status) == 'scheduled'  ? 'selected' : '' }}>Scheduled</option>
                <option value="on_trip"    {{ old('status', $schedule->status) == 'on_trip'    ? 'selected' : '' }}>On Trip</option>
                <option value="completed"  {{ old('status', $schedule->status) == 'completed'  ? 'selected' : '' }}>Completed</option>
                <option value="cancelled"  {{ old('status', $schedule->status) == 'cancelled'  ? 'selected' : '' }}>Cancelled</option>
              </select>
              @error('status') <span class="kb-field-error">{{ $message }}</span> @enderror
            </div>

          </div>

          <div class="kb-form-actions">
            <button type="submit" class="kb-btn-save">
              <i class="ti ti-device-floppy"></i> Simpan Perubahan
            </button>
            <a href="{{ route('admin.schedules.index') }}" class="kb-btn-back">
              Batal
            </a>
          </div>
        </form>

      </div>
    </div>
  </main>
</div>

</body>
</html>