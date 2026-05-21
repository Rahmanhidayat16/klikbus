<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>KlikBus - Kelola Bus</title>
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
      width: 100vw; height: 100vh;
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
    .kb-nav-label { font-size: 13px; font-weight: 600; color: var(--color-text-tertiary); text-transform: uppercase; padding: 12px 15px 6px; }
    
    /* Sidebar Links */
    .kb-nav a { text-decoration: none; display: block; }
    .kb-nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 14px 18px; border-radius: 12px;
      font-size: 18px; color: var(--color-text-secondary);
      cursor: pointer; margin-bottom: 6px; transition: 0.2s;
    }
    .kb-nav-item.active { background: #1a1a2e; color: #fff; font-weight: 500; }
    .kb-nav-item:hover:not(.active) { background: #f9fafb; color: var(--color-text-primary); }

    .kb-badge {
      margin-left: auto; background: #eff6ff; color: #3b82f6;
      font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 20px;
    }
    .active .kb-badge { background: rgba(255,255,255,0.2); color: #fff; }

    /* SIDEBAR FOOTER */
    .kb-sidebar-footer { padding: 20px; border-top: 1px solid var(--color-border); display: flex; align-items: center; gap: 12px; }
    .kb-avatar { width: 42px; height: 42px; background: var(--accent-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 600; }
    .kb-profile-info { flex: 1; overflow: hidden; }
    .kb-profile-name { font-size: 15px; font-weight: 600; color: #1a1a2e; }
    .kb-logout-btn { color: #ef4444; font-size: 20px; cursor: pointer; padding: 8px; border-radius: 8px; }

    /* MAIN CONTENT */
    .kb-main { flex: 1; display: flex; flex-direction: column; height: 100vh; }
    .kb-topbar { background: #fff; height: 75px; padding: 0 40px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--color-border); flex-shrink: 0; }
    .kb-topbar-title { font-family: 'Sora', sans-serif; font-size: 25px; font-weight: 600; text-transform: uppercase; }

    .kb-content { padding: 30px 40px; display: flex; flex-direction: column; gap: 20px; flex: 1; overflow: hidden; }

    /* TABLE STYLING */
    .kb-table-container { background: #fff; border-radius: 18px; padding: 24px; border: 1px solid var(--color-border); flex: 1; overflow: hidden; display: flex; flex-direction: column; }
    .kb-table-scroll { flex: 1; overflow-y: auto; }
    .kb-table { width: 100%; border-collapse: collapse; }
    .kb-table thead th { 
      position: sticky; top: 0; background: #fff; z-index: 10;
      text-align: left; padding: 15px; font-size: 14px; color: var(--color-text-tertiary); border-bottom: 2px solid var(--color-border);
    }
    .kb-table td { padding: 18px 15px; font-size: 16px; border-bottom: 1px solid var(--color-border); }
    
    .kb-status { padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
    .s-active { background: #f0fdf4; color: #16a34a; }
    .s-maintenance { background: #fef2f2; color: #ef4444; }
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
          <span class="kb-badge">{{ $semua_bus->count() }}</span>
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
      <div class="kb-topbar-title">KELOLA ARMADA BUS</div>
      <div style="display:flex; align-items:center; gap:20px;">
        <div style="font-size: 14px; color: #666;"><i class="ti ti-calendar"></i> Mei 2026</div>
        <i class="ti ti-bell" style="font-size: 22px; cursor:pointer;"></i>
      </div>
    </div>

    <div class="kb-content">
      <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 5px;">
        <div>
            <h2 style="font-family: 'Sora', sans-serif; font-size: 28px; font-weight: 700; color: #1a1a2e; margin-bottom: 5px;">Daftar Armada</h2>
            <p style="color: #9ca3af; font-size: 16px;">Manajemen unit bus untuk operasional wilayah Lampung dan sekitarnya.</p>
        </div>
        <a href="{{ route('admin.bus.create') }}" style="background: #1a1a2e; color: #fff; padding: 14px 24px; border-radius: 12px; text-decoration: none; font-weight: 600; font-size: 16px; display: flex; align-items: center; gap: 10px;">
            <i class="ti ti-plus"></i> Tambah Armada
        </a>
      </div>

      <div class="kb-table-container">
        <div class="kb-table-scroll">
          <table class="kb-table">
            <thead>
              <tr>
                <th>Nama Armada</th>
                <th>Kapasitas</th>
                <th>Tipe</th>
                <th>Status</th>
                <th style="text-align: right;">Aksi</th>
              </tr>
            </thead>
            <tbody>
  @foreach($semua_bus as $bus)
  <tr>
    <td><b>{{ $bus->bus_name }}</b></td>
    <td><i class="ti ti-users"></i> {{ $bus->total_seats }} Kursi</td>
    <td>{{ $bus->type }}</td>
    <td>
      <span class="kb-status {{ $bus->status === 'active' ? 's-active' : 's-maintenance' }}">
        {{ $bus->status === 'active' ? 'Aktif' : 'Perbaikan' }}
      </span>
    </td>
    <td style="text-align:right;">
      <a href="{{ route('admin.bus.edit', $bus->id) }}"><i class="ti ti-edit"></i></a>
      <form action="{{ route('admin.bus.destroy', $bus->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" style="background:none; border:none; cursor:pointer;" onclick="return confirm('Yakin hapus armada ini?')">
          <i class="ti ti-trash"></i>
        </button>
      </form>
    </td>
  </tr>
  @endforeach
</tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</div>

</body>
</html>