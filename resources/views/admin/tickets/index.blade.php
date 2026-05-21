<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>KlikBus - Data Tiket Penumpang</title>
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
    html, body { width: 100vw; height: 100vh; overflow: hidden; font-family: 'DM Sans', sans-serif; background: #000; }
    .kb-shell { display: flex; width: 100vw; height: 100vh; background: var(--bg-main); }

    /* SIDEBAR */
    .kb-sidebar { width: 280px; flex-shrink: 0; background: #fff; border-right: 1px solid var(--color-border); display: flex; flex-direction: column; }
    .kb-logo { padding: 30px 24px; border-bottom: 1px solid var(--color-border); display: flex; align-items: center; gap: 12px; }
    .kb-logo-icon { width: 40px; height: 40px; background: #1a1a2e; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px; }
    .kb-logo-text { font-family: 'Sora', sans-serif; font-size: 26px; font-weight: 700; color: #1a1a2e; }
    .kb-nav { padding: 15px 10px; flex: 1; overflow-y: auto; }
    .kb-nav-label { font-size: 13px; font-weight: 600; color: var(--color-text-tertiary); text-transform: uppercase; padding: 12px 15px 8px; }
    .kb-nav-item { display: flex; align-items: center; gap: 12px; padding: 14px 18px; border-radius: 12px; font-size: 18px; color: var(--color-text-secondary); cursor: pointer; margin-bottom: 6px; transition: 0.2s; text-decoration: none; }
    .kb-nav-item.active { background: #1a1a2e; color: #fff; font-weight: 500; }
    .kb-nav-item:hover:not(.active) { background: #f9fafb; }
    
    .kb-badge { margin-left: auto; background: #eff6ff; color: #3b82f6; font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 20px; }
    .active .kb-badge { background: rgba(255,255,255,0.2); color: #fff; }

    /* SIDEBAR FOOTER */
    .kb-sidebar-footer { padding: 20px; border-top: 1px solid var(--color-border); display: flex; align-items: center; gap: 12px; }
    .kb-avatar { width: 42px; height: 42px; background: var(--accent-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 600; }
    .kb-profile-info { flex: 1; overflow: hidden; }
    .kb-profile-name { font-size: 15px; font-weight: 600; color: #1a1a2e; }

    /* MAIN CONTENT */
    .kb-main { flex: 1; display: flex; flex-direction: column; height: 100vh; }
    .kb-topbar { background: #fff; height: 75px; padding: 0 40px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--color-border); flex-shrink: 0; }
    .kb-topbar-title { font-family: 'Sora', sans-serif; font-size: 25px; font-weight: 600; }
    .kb-content { padding: 25px 40px; display: flex; flex-direction: column; gap: 20px; flex: 1; overflow: hidden; }

    /* TABLE CONTAINER */
    .kb-table-container { background: #fff; border-radius: 18px; padding: 22px; border: 1px solid var(--color-border); flex: 1; overflow: hidden; display: flex; flex-direction: column; box-shadow: 0 10px 25px rgba(0,0,0,0.02); }
    .kb-card-title { font-size: 20px; font-weight: 700; margin-bottom: 5px; }
    .kb-card-subtitle { color: var(--color-text-secondary); font-size: 14px; }
    .kb-table-scroll { flex: 1; overflow-y: auto; margin-top: 10px; }
    .kb-table { width: 100%; border-collapse: collapse; }
    .kb-table thead th { position: sticky; top: 0; background: #fff; z-index: 10; text-align: left; padding: 12px 15px; font-size: 14px; color: var(--color-text-tertiary); border-bottom: 2px solid var(--color-border); text-transform: uppercase; font-weight: 600; }
    .kb-table td { padding: 16px 15px; font-size: 15px; border-bottom: 1px solid var(--color-border); color: var(--color-text-primary); }
    
    .kb-status { padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: 600; display: inline-block;}
    .s-success { background: #f0fdf4; color: #16a34a; }
    .s-warning { background: #fffbeb; color: #d97706; }
    
    .btn-action { color: var(--accent-blue); background: #eff6ff; padding: 6px 12px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 13px; display: inline-block; transition: 0.2s; }
    .btn-action:hover { background: #dbeafe; }
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
      <a href="{{ route('admin.dashboard') }}" style="text-decoration: none;"><div class="kb-nav-item"><i class="ti ti-layout-dashboard"></i> Dashboard</div></a>
      <a href="{{ route('admin.bus.index') }}" style="text-decoration: none;"><div class="kb-nav-item"><i class="ti ti-bus"></i> Kelola Bus</div></a>
      <a href="{{ route('admin.routes.index') }}" style="text-decoration: none;"><div class="kb-nav-item"><i class="ti ti-route"></i> Atur Rute</div></a>
      <a href="{{ route('admin.schedules.index') }}" style="text-decoration: none;"><div class="kb-nav-item"><i class="ti ti-calendar-event"></i> Jadwal</div></a>

      <div class="kb-nav-label">Laporan & Keuangan</div>
      <a href="{{ route('admin.reports.index') }}" style="text-decoration: none;"><div class="kb-nav-item"><i class="ti ti-file-analytics"></i> Laporan Pemesanan</div></a>
      
      <a href="{{ route('admin.tickets.index') }}" style="text-decoration: none;">
        <div class="kb-nav-item active"><i class="ti ti-ticket"></i> Data Tiket <span class="kb-badge">{{ $pesanan_hari_ini ?? 0 }}</span></div>
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
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" style="background: none; border: none; cursor: pointer; color: #ef4444;">
          <i class="ti ti-logout"></i>
        </button>
      </form>
    </div>
  </aside>

  <main class="kb-main">
    <div class="kb-topbar">
      <div class="kb-topbar-title">MASTER DATA TIKET</div>
    </div>

    <div class="kb-content">
      <div class="kb-table-container">
        
        {{-- Header & Fitur Pencarian --}}
        <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
          <div>
            <div class="kb-card-title">Daftar Tiket Penumpang</div>
            <div class="kb-card-subtitle">Kelola dan verifikasi tiket perjalanan penumpang KlikBus.</div>
          </div>
          
          {{-- KOTAK PENCARIAN --}}
          <form action="{{ route('admin.tickets.index') }}" method="GET" style="display: flex; gap: 10px;">
            <div style="position: relative;">
              <i class="ti ti-search" style="position: absolute; left: 12px; top: 12px; color: var(--color-text-tertiary); font-size: 18px;"></i>
              <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari ID atau Nama..." 
                     style="padding: 10px 15px 10px 38px; border-radius: 10px; border: 1px solid var(--color-border); font-family: 'DM Sans'; outline: none; background: #f9fafb; min-width: 250px;">
            </div>
            <button type="submit" style="background: #1a1a2e; color: #fff; border: none; padding: 10px 20px; border-radius: 10px; font-weight: 600; cursor: pointer; transition: 0.2s;">
              Cari Data
            </button>
            @if($search)
              <a href="{{ route('admin.tickets.index') }}" style="background: #fee2e2; color: #ef4444; text-decoration: none; padding: 10px 20px; border-radius: 10px; font-weight: 600; display: flex; align-items: center;">Reset</a>
            @endif
          </form>
        </div>

        {{-- Tabel Data Tiket --}}
        <div class="kb-table-scroll">
          <table class="kb-table">
            <thead>
              <tr>
                <th>ID Tiket</th>
                <th>Tgl Pesan</th>
                <th>Penumpang</th>
                <th>Bus & Kursi</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($tickets as $ticket)
              <tr>
                <td><strong>#KB-{{ str_pad($ticket->id, 4, '0', STR_PAD_LEFT) }}</strong></td>
                <td>{{ $ticket->created_at->format('d/m/Y') }}<br><small style="color: #6b7280;">{{ $ticket->created_at->format('H:i') }} WIB</small></td>
                <td>
                  <strong>{{ $ticket->user->name ?? 'User Dihapus' }}</strong><br>
                  <small style="color: #6b7280;">{{ $ticket->schedule->route->departure ?? '-' }} &rarr; {{ $ticket->schedule->route->destination ?? '-' }}</small>
                </td>
                <td>
                  {{ $ticket->schedule->bus->bus_name ?? '-' }}<br>
                  <span style="font-weight: 600; color: var(--accent-blue);">Kursi: {{ $ticket->seat_number ?? '-' }}</span>
                </td>
                <td>
                  <span class="kb-status {{ $ticket->booking_status == 'confirmed' ? 's-success' : 's-warning' }}">
                    {{ $ticket->booking_status == 'confirmed' ? 'Lunas' : 'Menunggu' }}
                  </span>
                </td>
                <td>
                  <a href="#" class="btn-action"><i class="ti ti-eye"></i> Detail</a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" style="text-align: center; padding: 50px; color: var(--color-text-tertiary);">
                  <i class="ti ti-ticket-off" style="font-size: 40px; display: block; margin-bottom: 10px;"></i>
                  @if($search)
                    Data tiket dengan kata kunci "<strong>{{ $search }}</strong>" tidak ditemukan.
                  @else
                    Belum ada data tiket yang tersimpan.
                  @endif
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

</body>
</html>