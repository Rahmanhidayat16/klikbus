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
      <div class="kb-nav-item active"><i class="ti ti-layout-dashboard"></i> Dashboard</div>
    <a href="{{ route('admin.bus.index') }}" style="text-decoration: none;">
  <div class="kb-nav-item {{ request()->routeIs('admin.bus.*') ? 'active' : '' }}">
    <i class="ti ti-bus"></i> Kelola Bus 
    <span class="kb-badge">{{ $semua_bus->count() }}</span>
  </div>
</a>
      <div class="kb-nav-item"><i class="ti ti-route"></i> Atur Rute <span class="kb-badge">8</span></div>
      <div class="kb-nav-item"><i class="ti ti-calendar-event"></i> Jadwal</div>

      <div class="kb-nav-label">Laporan & Keuangan</div>
      <div class="kb-nav-item"><i class="ti ti-file-analytics"></i> Laporan Pemesanan</div>
      <div class="kb-nav-item"><i class="ti ti-ticket"></i> Data Tiket <span class="kb-badge">124</span></div>

      <div class="kb-nav-label">Sistem</div>
      <div class="kb-nav-item"><i class="ti ti-users"></i> Pengguna</div>
      <div class="kb-nav-item"><i class="ti ti-settings"></i> Pengaturan</div>
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
          <div class="kb-stat-val">12</div>
          <div class="kb-stat-lbl">Total Armada Bus</div>
        </div>
        <div class="kb-stat-card">
          <div class="ic-green" style="width:36px; height:36px; border-radius:8px; display:flex; align-items:center; justify-content:center;"><i class="ti ti-route"></i></div>
          <div class="kb-stat-val">8</div>
          <div class="kb-stat-lbl">Rute Aktif</div>
        </div>
        <div class="kb-stat-card">
          <div class="ic-amber" style="width:36px; height:36px; border-radius:8px; display:flex; align-items:center; justify-content:center;"><i class="ti ti-ticket"></i></div>
          <div class="kb-stat-val">124</div>
          <div class="kb-stat-lbl">Pesanan Hari Ini</div>
        </div>
        <div class="kb-stat-card">
          <div class="ic-purple" style="width:36px; height:36px; border-radius:8px; display:flex; align-items:center; justify-content:center;"><i class="ti ti-cash"></i></div>
          <div class="kb-stat-val">Rp 48jt</div>
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
              <tr><td>#KB-2087</td><td>Rizky Aditya</td><td>Rajabasa → Bakauheni</td><td>Rp 45.000</td><td><span class="kb-status s-confirmed">Dikonfirmasi</span></td></tr>
              <tr><td>#KB-2086</td><td>Siti Nurhaliza</td><td>Rajabasa → Metro</td><td>Rp 25.000</td><td><span class="kb-status s-pending">Menunggu</span></td></tr>
              <tr><td>#KB-2085</td><td>Budi Santoso</td><td>Rajabasa → Unit 2</td><td>Rp 85.000</td><td><span class="kb-status s-confirmed">Dikonfirmasi</span></td></tr>
              <tr><td>#KB-2084</td><td>Dewi Kusuma</td><td>Rajabasa → Kotabumi</td><td>Rp 60.000</td><td><span class="kb-status s-confirmed">Dikonfirmasi</span></td></tr>
              <tr><td>#KB-2083</td><td>Ahmad Fauzi</td><td>Rajabasa → Pringsewu</td><td>Rp 30.000</td><td><span class="kb-status s-pending">Menunggu</span></td></tr>
              <tr><td>#KB-2082</td><td>Eko Prasetyo</td><td>Rajabasa → Kalianda</td><td>Rp 40.000</td><td><span class="kb-status s-confirmed">Dikonfirmasi</span></td></tr>
              <tr><td>#KB-2081</td><td>Fitri Handayani</td><td>Rajabasa → Way Kanan</td><td>Rp 95.000</td><td><span class="kb-status s-confirmed">Dikonfirmasi</span></td></tr>
              <tr><td>#KB-2080</td><td>Gilang Ramadhan</td><td>Rajabasa → Mesuji</td><td>Rp 110.000</td><td><span class="kb-status s-pending">Menunggu</span></td></tr>
              <tr><td>#KB-2079</td><td>Hesti Purwanti</td><td>Rajabasa → Tulang Bawang</td><td>Rp 80.000</td><td><span class="kb-status s-confirmed">Dikonfirmasi</span></td></tr>
              <tr><td>#KB-2078</td><td>Indra Wijaya</td><td>Rajabasa → Liwa</td><td>Rp 120.000</td><td><span class="kb-status s-confirmed">Dikonfirmasi</span></td></tr>
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
      labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'],
      datasets: [{
        data: [18, 24, 21, 30, 28, 42, 38],
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
      labels: ['Bakauheni', 'Metro', 'Kotabumi', 'Lainnya'],
      datasets: [{
        data: [45, 30, 20, 29],
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