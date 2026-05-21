<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>KlikBus - Jadwal Keberangkatan</title>
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
      display: flex;
      width: 100vw;
      height: 100vh;
      background: var(--bg-main);
    }

    /* SIDEBAR */
    .kb-sidebar {
      width: 280px;
      flex-shrink: 0;
      background: #fff;
      border-right: 1px solid var(--color-border);
      display: flex;
      flex-direction: column;
    }

    .kb-logo {
      padding: 30px 24px;
      border-bottom: 1px solid var(--color-border);
      display: flex; align-items: center; gap: 12px;
    }

    .kb-logo-icon {
      width: 40px; height: 40px;
      background: #1a1a2e; border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-size: 18px;
    }

    .kb-logo-text { font-family: 'Sora', sans-serif; font-size: 26px; font-weight: 700; color: #1a1a2e; }

    .kb-nav { padding: 15px 10px; flex: 1; overflow-y: auto; }
    .kb-nav-label { font-size: 13px; font-weight: 600; color: var(--color-text-tertiary); text-transform: uppercase; padding: 12px 15px 8px; }
    .kb-nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 14px 18px; border-radius: 12px;
      font-size: 15px; color: var(--color-text-secondary);
      cursor: pointer; margin-bottom: 6px; transition: 0.2s;
      position: relative;
    }
    .kb-nav-item.active { background: #1a1a2e; color: #fff; font-weight: 500; }
    .kb-nav-item:hover:not(.active) { background: #f9fafb; }

    /* BADGE STYLE */
    .kb-badge {
      margin-left: auto; background: #eff6ff; color: #3b82f6;
      font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px;
    }
    .active .kb-badge { background: rgba(255,255,255,0.2); color: #fff; }

    .kb-sidebar-footer {
      padding: 20px;
      border-top: 1px solid var(--color-border);
      display: flex; align-items: center; gap: 12px;
    }
    .kb-avatar {
      width: 42px; height: 42px;
      background: var(--accent-blue); border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-weight: 600; flex-shrink: 0;
    }
    .kb-profile-info { flex: 1; overflow: hidden; }
    .kb-profile-name { font-size: 14px; font-weight: 600; color: #1a1a2e; }
    .kb-profile-role { font-size: 12px; color: var(--color-text-tertiary); }
    .kb-logout-btn { color: #ef4444; font-size: 20px; cursor: pointer; padding: 8px; border-radius: 8px; background: none; border: none; }

    /* MAIN CONTENT */
    .kb-main { flex: 1; display: flex; flex-direction: column; height: 100vh; }
    .kb-topbar {
      background: #fff; height: 75px; padding: 0 40px;
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 1px solid var(--color-border); flex-shrink: 0;
    }
    .kb-topbar-title { font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 600; }

    .kb-content { padding: 25px 40px; display: flex; flex-direction: column; gap: 20px; flex: 1; overflow: hidden; }

    .kb-table-container { 
      background: #fff; border-radius: 18px; padding: 22px; 
      border: 1px solid var(--color-border); flex: 1; overflow: hidden; 
      display: flex; flex-direction: column; 
      box-shadow: 0 10px 25px rgba(0,0,0,0.02); 
    }
    .kb-card-title { font-size: 18px; font-weight: 700; margin-bottom: 12px; }
    .kb-table-scroll { flex: 1; overflow-y: auto; margin-top: 10px; }
    .kb-table { width: 100%; border-collapse: collapse; }
    .kb-table thead th { 
      position: sticky; top: 0; background: #fff; z-index: 10;
      text-align: left; padding: 12px 15px; font-size: 12px; 
      color: var(--color-text-tertiary); border-bottom: 2px solid var(--color-border);
      text-transform: uppercase; font-weight: 600;
    }
    .kb-table td { padding: 16px 15px; font-size: 14px; border-bottom: 1px solid var(--color-border); color: var(--color-text-primary); }
    
    .kb-status { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block; }
    .s-scheduled  { background: #fffbeb; color: #d97706; }
    .s-completed  { background: #f0fdf4; color: #16a34a; }
    .s-on_trip    { background: #eff6ff; color: #3b82f6; }
    .s-cancelled  { background: #fef2f2; color: #ef4444; }

    /* MODAL */
    .kb-modal-overlay {
      display: none; position: fixed; inset: 0;
      background: rgba(0,0,0,0.4); z-index: 1000;
      align-items: center; justify-content: center;
    }
    .kb-modal-overlay.open { display: flex; }
    .kb-modal {
      background: #fff; border-radius: 18px; padding: 32px;
      width: 420px; max-width: 90vw;
      box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    .kb-modal-icon { 
      width: 56px; height: 56px; border-radius: 50%;
      background: #fef2f2; color: #ef4444;
      display: flex; align-items: center; justify-content: center;
      font-size: 26px; margin-bottom: 16px;
    }
    .kb-modal-title { font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 700; margin-bottom: 8px; }
    .kb-modal-desc { font-size: 15px; color: var(--color-text-secondary); margin-bottom: 24px; }
    .kb-modal-actions { display: flex; gap: 12px; justify-content: flex-end; }
    .kb-btn { padding: 10px 22px; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; border: none; font-family: 'DM Sans', sans-serif; }
    .kb-btn-cancel { background: #f3f4f6; color: var(--color-text-primary); }
    .kb-btn-danger { background: #ef4444; color: #fff; }
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
      
      <a href="{{ route('admin.reports.index') }}" style="text-decoration: none;">
        <div class="kb-nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
          <i class="ti ti-file-analytics"></i> Laporan Pemesanan
        </div>
      </a>
      
      <a href="{{ route('admin.tickets.index') }}" style="text-decoration: none;">
        <div class="kb-nav-item {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}">
          <i class="ti ti-ticket"></i> Data Tiket
        </div>
      </a>

      <div class="kb-nav-label">Sistem</div>
      
      <a href="{{ route('admin.users.index') }}" style="text-decoration: none;">
        <div class="kb-nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
          <i class="ti ti-users"></i> Pengguna
        </div>
      </a>
      
      <a href="{{ route('admin.settings.index') }}" style="text-decoration: none;">
        <div class="kb-nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
          <i class="ti ti-settings"></i> Pengaturan
        </div>
      </a>
    </nav>

    <div class="kb-sidebar-footer">
      <div class="kb-avatar">RH</div>
      <div class="kb-profile-info">
        <div class="kb-profile-name">Rahman Hidayat</div>
        <div class="kb-profile-role">Super Admin</div>
      </div>
      <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit" class="kb-logout-btn" title="Keluar" style="background:none; border:none; cursor:pointer;">
            <i class="ti ti-logout"></i>
        </button>
      </form>
    </div>
  </aside>

  <main class="kb-main">
    <div class="kb-topbar">
      <div class="kb-topbar-title">KELOLA JADWAL</div>
      <div style="display:flex; align-items:center; gap:20px;">
        <div style="font-size: 14px; color: #666;"><i class="ti ti-calendar"></i> {{ date('F Y') }}</div>
        <i class="ti ti-bell" style="font-size: 22px; cursor:pointer;"></i>
      </div>
    </div>

    <div class="kb-content">
      <div class="kb-table-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
          <div class="kb-card-title" style="margin-bottom: 0;">Daftar Jadwal Keberangkatan</div>
          <a href="{{ route('admin.schedules.create') }}" style="background: #1a1a2e; color: #fff; padding: 10px 20px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 14px;">
            + Tambah Jadwal Baru
          </a>
        </div>

        @if(session('success'))
          <div style="background: #f0fdf4; color: #16a34a; padding: 12px 16px; border-radius: 8px; margin-bottom: 15px; font-weight: 500; border: 1px solid #bbf7d0;">
            <i class="ti ti-check"></i> {{ session('success') }}
          </div>
        @endif

        <div class="kb-table-scroll">
          <table class="kb-table">
            <thead>
              <tr>
                <th>Armada Bus</th>
                <th>Tipe</th>
                <th>Rute Perjalanan</th>
                <th>Berangkat</th>
                <th>Tiba</th>
                <th>Harga Tiket</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($schedules as $schedule)
              <tr>
                <td><strong>{{ $schedule->bus->bus_name }}</strong></td>
                <td>{{ $schedule->bus->type }}</td>
                <td>{{ $schedule->route->departure }} &rarr; {{ $schedule->route->destination }}</td>
                <td>{{ \Carbon\Carbon::parse($schedule->departure_time)->format('d/m/Y H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($schedule->arrival_time)->format('d/m/Y H:i') }}</td>
                <td>Rp {{ number_format($schedule->route->base_price, 0, ',', '.') }}</td>
                <td>
                  @php
                    $statusClass = match($schedule->status) {
                      'completed'  => 's-completed',
                      'scheduled'  => 's-scheduled',
                      'on_trip'    => 's-on_trip',
                      'cancelled'  => 's-cancelled',
                      default      => 's-scheduled',
                    };
                  @endphp
                  <span class="kb-status {{ $statusClass }}">{{ ucfirst(str_replace('_', ' ', $schedule->status)) }}</span>
                </td>
                <td>
                  <a href="{{ route('admin.schedules.edit', $schedule->id) }}" 
                     style="color: var(--accent-blue); text-decoration: none; font-weight: 600; margin-right: 14px;">
                    Edit
                  </a>
                  <button 
                    onclick="confirmDelete({{ $schedule->id }}, '{{ $schedule->bus->bus_name }}')"
                    style="color: #ef4444; background: none; border: none; font-weight: 600; font-size: 15px; cursor: pointer;">
                    Hapus
                  </button>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="8" style="text-align: center; padding: 40px; color: var(--color-text-tertiary);">
                  Belum ada jadwal.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</div>

<div class="kb-modal-overlay" id="deleteModal">
  <div class="kb-modal">
    <div class="kb-modal-icon"><i class="ti ti-trash"></i></div>
    <div class="kb-modal-title">Hapus Jadwal?</div>
    <div class="kb-modal-desc" id="deleteModalDesc">Data tidak bisa dikembalikan.</div>
    <div class="kb-modal-actions">
      <button class="kb-btn kb-btn-cancel" onclick="closeModal()">Batal</button>
      <form id="deleteForm" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="kb-btn kb-btn-danger">Ya, Hapus</button>
      </form>
    </div>
  </div>
</div>

<script>
  function confirmDelete(id, label) {
    document.getElementById('deleteForm').action = '/admin/schedules/' + id;
    document.getElementById('deleteModal').classList.add('open');
  }
  function closeModal() {
    document.getElementById('deleteModal').classList.remove('open');
  }
</script>

</body>
</html>