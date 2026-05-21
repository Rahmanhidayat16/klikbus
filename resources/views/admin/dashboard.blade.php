<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>KlikBus Admin Dashboard</title>
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

    /* SIDEBAR FOOTER */
    .kb-sidebar-footer {
      padding: 20px;
      border-top: 1px solid var(--color-border);
      display: flex; align-items: center; gap: 12px;
    }
    .kb-avatar {
      width: 42px; height: 42px;
      background: var(--accent-blue); border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-weight: 600;
    }
    .kb-profile-info { flex: 1; overflow: hidden; }
    .kb-profile-name { font-size: 15px; font-weight: 600; color: #1a1a2e; }
    .kb-logout-btn { color: #ef4444; font-size: 20px; cursor: pointer; padding: 8px; border-radius: 8px; }

    /* MAIN CONTENT */
    .kb-main { flex: 1; display: flex; flex-direction: column; height: 100vh; }

    .kb-topbar {
      background: #fff; height: 75px; padding: 0 40px;
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 1px solid var(--color-border); flex-shrink: 0;
    }
    .kb-topbar-title { font-family: 'Sora', sans-serif; font-size: 25px; font-weight: 600; }

    .kb-content { padding: 25px 40px; display: flex; flex-direction: column; gap: 20px; flex: 1; overflow: hidden; }

    /* STATS */
    .kb-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; flex-shrink: 0; }
    .kb-stat-card { background: #fff; padding: 22px; border-radius: 18px; border: 1px solid var(--color-border); }
    .kb-stat-val { font-family: 'Sora', sans-serif; font-size: 42px; font-weight: 700; margin: 8px 0 2px; }
    .kb-stat-lbl { font-size: 16px; color: var(--color-text-secondary); }

    /* CHARTS */
    .kb-charts-row { display: grid; grid-template-columns: 1fr 450px; gap: 20px; height: 350px; flex-shrink: 0; }
    .kb-card { background: #fff; border-radius: 18px; padding: 20px; border: 1px solid var(--color-border); display: flex; flex-direction: column; min-height: 0; }
    .kb-card-title { font-size: 20px; font-weight: 700; margin-bottom: 12px; }

    /* TABLE SCROLLABLE */
    .kb-table-container { background: #fff; border-radius: 18px; padding: 22px; border: 1px solid var(--color-border); flex: 1; overflow: hidden; display: flex; flex-direction: column; }
    .kb-table-scroll { flex: 1; overflow-y: auto; margin-top: 10px; }
    .kb-table { width: 100%; border-collapse: collapse; }
    .kb-table thead th { 
      position: sticky; top: 0; background: #fff; z-index: 10;
      text-align: left; padding: 12px 15px; font-size: 15px; color: var(--color-text-tertiary); border-bottom: 2px solid var(--color-border);
    }
    .kb-table td { padding: 16px 15px; font-size: 17px; border-bottom: 1px solid var(--color-border); }
    
    .kb-status { padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: 600; }
    .s-confirmed { background: #f0fdf4; color: #16a34a; }
    .s-pending { background: #fffbeb; color: #d97706; }

    .ic-blue { background: #eff6ff; color: #3b82f6; }
    .ic-green { background: #f0fdf4; color: #16a34a; }
    .ic-amber { background: #fffbeb; color: #d97706; }
    .ic-purple { background: #faf5ff; color: #7c3aed; }
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
        <div class="kb-nav-item active"><i class="ti ti-layout-dashboard"></i> Dashboard</div>
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
          <span class="kb-badge">{{ $jumlah_rute }}</span>
        </div>
      </a>
      <a href="{{ route('admin.schedules.index') }}" style="text-decoration: none;">
        <div class="kb-nav-item {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}">
          <i class="ti ti-calendar-event"></i> Jadwal
          <span class="kb-badge">{{ $total_jadwal }}</span>
        </div>
      </a>

      <div class="kb-nav-label">Laporan & Keuangan</div>
      
      <a href="{{ route('admin.reports.index') }}" style="text-decoration: none;">
        <div class="kb-nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
          <i class="ti ti-file-analytics"></i> Laporan Pemesanan
        </div>
      </a>
      
      {{-- INI YANG UDAH DIBENERIN BIAR BISA DIKLIK --}}
      <a href="{{ route('admin.tickets.index') }}" style="text-decoration: none;">
        <div class="kb-nav-item {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}">
          <i class="ti ti-ticket"></i> Data Tiket <span class="kb-badge">{{ $pesanan_hari_ini }}</span>
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
      <div class="kb-topbar-title">DASHBOARD ADMIN KLIKBUS</div>
      <div style="display:flex; align-items:center; gap:20px;">
        <div style="font-size: 14px; color: #666;"><i class="ti ti-calendar"></i> Mei 2026</div>
        <i class="ti ti-bell" style="font-size: 22px; cursor:pointer;"></i>
      </div>
    </div>

    <div class="kb-content">
      <div class="kb-stats">
        <div class="kb-stat-card">
          <div class="ic-blue" style="width:36px; height:36px; border-radius:8px; display:flex; align-items:center; justify-content:center;"><i class="ti ti-bus"></i></div>
          <div class="kb-stat-val">{{ $semua_bus->count() }}</div>
          <div class="kb-stat-lbl">Total Armada Bus</div>
        </div>
        <div class="kb-stat-card" style="cursor:pointer;" onclick="window.location='{{ route('admin.routes.index') }}'">
          <div class="ic-green" style="width:36px; height:36px; border-radius:8px; display:flex; align-items:center; justify-content:center;"><i class="ti ti-route"></i></div>
          <div class="kb-stat-val">{{ $jumlah_rute }}</div>
          <div class="kb-stat-lbl">Rute Aktif</div>
        </div>
        <div class="kb-stat-card">
          <div class="ic-amber" style="width:36px; height:36px; border-radius:8px; display:flex; align-items:center; justify-content:center;"><i class="ti ti-ticket"></i></div>
          <div class="kb-stat-val">{{ $pesanan_hari_ini }}</div>
          <div class="kb-stat-lbl">Pesanan Hari Ini</div>
        </div>
        <div class="kb-stat-card">
          <div class="ic-purple" style="width:36px; height:36px; border-radius:8px; display:flex; align-items:center; justify-content:center;"><i class="ti ti-cash"></i></div>
          <div class="kb-stat-val">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</div>
          <div class="kb-stat-lbl">Pendapatan</div>
        </div>
      </div>

      <div class="kb-charts-row">
        <div class="kb-card">
          <div class="kb-card-title">Tren Penjualan Tiket</div>
          <div style="flex:1; position:relative;"><canvas id="lineChart"></canvas></div>
        </div>
        <div class="kb-card">
          <div class="kb-card-title">Rute Terpopuler</div>
          <div style="flex:1; position:relative;"><canvas id="donutChart"></canvas></div>
        </div>
      </div>

      <div class="kb-table-container">
        <div class="kb-card-title">Pesanan Terbaru</div>
        <div class="kb-table-scroll">
          <table class="kb-table">
            <thead>
              <tr>
                <th>ID Pesanan</th>
                <th>Penumpang</th>
                <th>Rute</th>
                <th>Harga</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
@forelse($pesanan_terbaru as $booking)
<tr>

    <td>#KB-{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</td>

    <td>
        {{ $booking->user->name ?? 'User Tidak Ditemukan' }}
    </td>

    <td>
        {{ $booking->schedule->route->departure ?? '-' }}
        →
        {{ $booking->schedule->route->destination ?? '-' }}
    </td>

    <td>
        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
    </td>

    <td>
        <span class="kb-status 
            {{ $booking->booking_status == 'confirmed'
                ? 's-confirmed'
                : 's-pending' }}">

            {{ $booking->booking_status == 'confirmed'
                ? 'Dikonfirmasi'
                : 'Menunggu' }}
        </span>
    </td>

</tr>
@empty
<tr>
    <td colspan="5" style="text-align:center; padding:20px;">
        Belum ada data pemesanan
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<script>
  new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
      labels: @json($line_labels),
      datasets: [{
        data: @json($line_data),
        borderColor: '#3b82f6',
        backgroundColor: 'rgba(59,130,246,0.05)',
        tension: 0.4,
        fill: true
      }]
    },
    options: { maintainAspectRatio: false, plugins: { legend: { display: false } } }
  });

  new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
      labels: @json($chart_labels),
      datasets: [{
        data: @json($chart_data),
        backgroundColor: ['#3b82f6','#6366f1','#10b981','#e5e7eb'],
        borderWidth: 2,
        borderColor: '#ffffff'
      }]
    },
    options: { 
      maintainAspectRatio: false, 
      cutout: '75%', 
      layout: {
        padding: {
          top: 10,
          bottom: 30, // Memberikan ruang ekstra untuk legenda
          left: 10,
          right: 10
        }
      },
      plugins: { 
        legend: { 
          position: 'bottom',
          labels: {
            padding: 15,
            boxWidth: 12,
            font: { size: 12 }
          }
        } 
      } 
    }
  });
</script>
</body>
</html>