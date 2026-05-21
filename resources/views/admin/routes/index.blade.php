<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>KlikBus - Atur Rute</title>
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
      height: 100vh;
      overflow: hidden;
      font-family: 'DM Sans', sans-serif;
      background: #000;
    }

    .kb-shell { display: flex; width: 100vw; height: 100vh; background: var(--bg-main); }

    /* SIDEBAR */
    .kb-sidebar {
      width: 280px; flex-shrink: 0;
      background: #fff; border-right: 1px solid var(--color-border);
      display: flex; flex-direction: column;
      height: 100vh;
      overflow: hidden;
    }
    .kb-logo {
      padding: 30px 24px; border-bottom: 1px solid var(--color-border);
      display: flex; align-items: center; gap: 12px;
    }
    .kb-logo-icon {
      width: 40px; height: 40px; background: #1a1a2e; border-radius: 10px;
      display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px;
    }
    .kb-logo-text { font-family: 'Sora', sans-serif; font-size: 26px; font-weight: 700; color: #1a1a2e; }
    .kb-nav { padding: 15px 10px; flex: 1; overflow-y: auto; }
    .kb-nav-label { font-size: 13px; font-weight: 600; color: var(--color-text-tertiary); text-transform: uppercase; padding: 12px 15px 8px; }
    .kb-nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 14px 18px; border-radius: 12px;
      font-size: 18px; color: var(--color-text-secondary);
      cursor: pointer; margin-bottom: 6px; transition: 0.2s;
      text-decoration: none;
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
      display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 600;
    }
    .kb-profile-name { font-size: 15px; font-weight: 600; color: #1a1a2e; }
    .kb-profile-role { font-size: 13px; color: var(--color-text-tertiary); }

    /* MAIN */
    .kb-main { flex: 1; display: flex; flex-direction: column; min-height: 0; height: 100%; overflow: hidden; }
    .kb-topbar {
      background: #fff; height: 75px; padding: 0 40px;
      display: flex; align-items: center; justify-content: space-between;
      border-bottom: 1px solid var(--color-border); flex-shrink: 0;
    }
    .kb-topbar-title { font-family: 'Sora', sans-serif; font-size: 25px; font-weight: 600; }
    .kb-content { padding: 25px 40px; flex: 1; min-height: 0; overflow: hidden; display: flex; flex-direction: column; gap: 20px; }

    /* STATS */
    .kb-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; flex-shrink: 0; }
    .kb-stat-card {
      background: #fff; padding: 20px; border-radius: 16px;
      border: 1px solid var(--color-border); display: flex; align-items: center; gap: 16px;
    }
    .stat-icon {
      width: 48px; height: 48px; border-radius: 12px;
      display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;
    }
    .ic-blue { background: #eff6ff; color: #3b82f6; }
    .ic-green { background: #f0fdf4; color: #16a34a; }
    .ic-amber { background: #fffbeb; color: #d97706; }
    .stat-val { font-family: 'Sora', sans-serif; font-size: 28px; font-weight: 700; color: #1a1a2e; }
    .stat-lbl { font-size: 14px; color: var(--color-text-secondary); }

    /* CARD */
    .kb-card {
      background: #fff; border-radius: 18px;
      border: 1px solid var(--color-border); overflow: hidden;
      display: flex; flex-direction: column;
      flex: 1;
      min-height: 540px;
    }
    .kb-card-header {
      padding: 20px 24px; display: flex; align-items: center;
      justify-content: space-between; border-bottom: 1px solid var(--color-border);
      flex-shrink: 0;
    }
    .kb-card-body {
      flex: 1;
      overflow-y: auto;
      padding: 0 24px 24px;
      min-height: 0;
      max-height: calc(100vh - 360px);
    }
    .kb-card-title { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; }
    .kb-card-sub { font-size: 13px; color: var(--color-text-tertiary); margin-top: 2px; }

    /* BTN */
    .btn-primary {
      background: #1a1a2e; color: #fff; border: none;
      padding: 10px 20px; border-radius: 10px; font-size: 14px; font-weight: 600;
      cursor: pointer; display: flex; align-items: center; gap: 8px; transition: 0.2s;
      font-family: 'DM Sans', sans-serif;
    }
    .btn-primary:hover { background: #2d2d4e; }
    .btn-danger {
      background: #fef2f2; color: #dc2626; border: 1px solid #fecaca;
      padding: 7px 14px; border-radius: 8px; font-size: 13px; font-weight: 600;
      cursor: pointer; transition: 0.2s; font-family: 'DM Sans', sans-serif;
    }
    .btn-danger:hover { background: #fee2e2; }
    .btn-edit {
      background: #eff6ff; color: #3b82f6; border: 1px solid #bfdbfe;
      padding: 7px 14px; border-radius: 8px; font-size: 13px; font-weight: 600;
      cursor: pointer; transition: 0.2s; font-family: 'DM Sans', sans-serif;
    }
    .btn-edit:hover { background: #dbeafe; }

    /* TABLE */
    .kb-table { width: 100%; border-collapse: collapse; }
    .kb-table thead th {
      text-align: left; padding: 14px 20px;
      font-size: 13px; color: var(--color-text-tertiary); font-weight: 600;
      background: #fafafa; border-bottom: 1px solid var(--color-border);
    }
    .kb-table tbody tr { transition: background 0.15s; }
    .kb-table tbody tr:hover { background: #f9fafb; }
    .kb-table td { padding: 16px 20px; font-size: 15px; border-bottom: 1px solid var(--color-border); }
    .kb-table tbody tr:last-child td { border-bottom: none; }

    .route-badge {
      display: inline-flex; align-items: center; gap: 8px;
      background: #f0f9ff; border: 1px solid #bae6fd;
      padding: 6px 14px; border-radius: 20px; font-size: 14px; font-weight: 500; color: #0369a1;
    }
    .route-arrow { color: #94a3b8; font-size: 12px; }

    .sched-count {
      display: inline-flex; align-items: center; gap: 5px;
      background: #f5f3ff; color: #7c3aed;
      padding: 4px 10px; border-radius: 20px; font-size: 13px; font-weight: 600;
    }

    /* MODAL OVERLAY */
    .modal-overlay {
      position: fixed; inset: 0; background: rgba(0,0,0,0.4);
      display: flex; align-items: center; justify-content: center;
      z-index: 1000; opacity: 0; pointer-events: none; transition: opacity 0.2s;
    }
    .modal-overlay.open { opacity: 1; pointer-events: all; }
    .modal {
      background: #fff; border-radius: 20px; padding: 32px;
      width: 480px; transform: translateY(20px); transition: transform 0.2s;
      box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    .modal-overlay.open .modal { transform: translateY(0); }
    .modal-title { font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 700; margin-bottom: 6px; }
    .modal-sub { font-size: 14px; color: var(--color-text-secondary); margin-bottom: 24px; }

    .form-group { margin-bottom: 18px; }
    .form-label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 6px; }
    .form-input {
      width: 100%; padding: 12px 14px; border: 1px solid var(--color-border);
      border-radius: 10px; font-size: 15px; font-family: 'DM Sans', sans-serif;
      transition: border-color 0.2s; outline: none;
    }
    .form-input:focus { border-color: var(--accent-blue); box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

    .modal-footer { display: flex; gap: 10px; justify-content: flex-end; margin-top: 24px; }
    .btn-cancel {
      background: #f3f4f6; color: #374151; border: none;
      padding: 10px 20px; border-radius: 10px; font-size: 14px; font-weight: 600;
      cursor: pointer; font-family: 'DM Sans', sans-serif;
    }
    .btn-cancel:hover { background: #e5e7eb; }

    /* ALERT */
    .kb-alert {
      padding: 14px 18px; border-radius: 12px; font-size: 14px; font-weight: 500;
      display: flex; align-items: center; gap: 10px;
    }
    .kb-alert.success { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
    .kb-alert.error { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

    /* EMPTY STATE */
    .empty-state {
      text-align: center; padding: 60px 20px;
      color: var(--color-text-tertiary);
    }
    .empty-state i { font-size: 48px; margin-bottom: 12px; display: block; }
    .empty-state p { font-size: 16px; }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
</head>
<body>

<div class="kb-shell">
  {{-- SIDEBAR --}}
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

  {{-- MAIN --}}
  <main class="kb-main">
    <div class="kb-topbar">
      <div class="kb-topbar-title">ATUR RUTE</div>
      <div style="display:flex; align-items:center; gap:20px;">
        <div style="font-size:14px; color:#666;"><i class="ti ti-calendar"></i> Mei 2026</div>
        <i class="ti ti-bell" style="font-size:22px; cursor:pointer;"></i>
      </div>
    </div>

    <div class="kb-content">

      {{-- ALERT --}}
      @if(session('success'))
        <div class="kb-alert success"><i class="ti ti-circle-check"></i> {{ session('success') }}</div>
      @endif
      @if($errors->any())
        <div class="kb-alert error"><i class="ti ti-alert-circle"></i> {{ $errors->first() }}</div>
      @endif

      {{-- STATS --}}
      <div class="kb-stats">
        <div class="kb-stat-card">
          <div class="stat-icon ic-blue"><i class="ti ti-route"></i></div>
          <div>
            <div class="stat-val">{{ $routes->count() }}</div>
            <div class="stat-lbl">Total Rute</div>
          </div>
        </div>
        <div class="kb-stat-card">
          <div class="stat-icon ic-green"><i class="ti ti-map-pin"></i></div>
          <div>
            <div class="stat-val">{{ $routes->pluck('departure')->merge($routes->pluck('destination'))->unique()->count() }}</div>
            <div class="stat-lbl">Kota Tersedia</div>
          </div>
        </div>
        <div class="kb-stat-card">
          <div class="stat-icon ic-amber"><i class="ti ti-calendar-event"></i></div>
          <div>
            <div class="stat-val">{{ $routes->sum('schedules_count') }}</div>
            <div class="stat-lbl">Total Jadwal Terdaftar</div>
          </div>
        </div>
      </div>

      {{-- TABLE CARD --}}
      <div class="kb-card">
        <div class="kb-card-header">
          <div>
            <div class="kb-card-title">Daftar Rute</div>
            <div class="kb-card-sub">Kelola rute perjalanan bus antar kota wilayah Lampung</div>
          </div>
          <button class="btn-primary" onclick="openModal('add')">
            <i class="ti ti-plus"></i> Tambah Rute
          </button>
        </div>
        <div class="kb-card-body">
          @if($routes->isEmpty())
            <div class="empty-state">
              <i class="ti ti-route-off"></i>
              <p>Belum ada rute yang ditambahkan.</p>
            </div>
          @else
            <table class="kb-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Rute</th>
                <th>Harga Dasar</th>
                <th>Jadwal Terdaftar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($routes as $i => $route)
              <tr>
                <td style="color: var(--color-text-tertiary); width: 50px;">{{ $i + 1 }}</td>
                <td>
                  <span class="route-badge">
                    <i class="ti ti-map-pin" style="font-size:13px;"></i>
                    {{ $route->departure }}
                    <span class="route-arrow">→</span>
                    {{ $route->destination }}
                  </span>
                </td>
                <td style="font-weight: 600;">Rp {{ number_format($route->base_price, 0, ',', '.') }}</td>
                <td>
                  <span class="sched-count">
                    <i class="ti ti-calendar" style="font-size:13px;"></i>
                    {{ $route->schedules_count }} jadwal
                  </span>
                </td>
                <td>
                  <div style="display:flex; gap:8px;">
                    <button class="btn-edit" onclick="openModal('edit', {{ $route->id }}, '{{ addslashes($route->departure) }}', '{{ addslashes($route->destination) }}', {{ $route->base_price }})">
                      <i class="ti ti-pencil"></i> Edit
                    </button>
                    <form method="POST" action="{{ route('admin.routes.destroy', $route) }}" onsubmit="return confirm('Hapus rute {{ $route->departure }} → {{ $route->destination }}?')">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn-danger"><i class="ti ti-trash"></i> Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div>

    </div>{{-- /kb-content --}}
  </main>
</div>

{{-- MODAL TAMBAH / EDIT --}}
<div class="modal-overlay" id="routeModal">
  <div class="modal">
    <div class="modal-title" id="modalTitle">Tambah Rute Baru</div>
    <div class="modal-sub" id="modalSub">Masukkan detail rute perjalanan</div>

    <form method="POST" id="routeForm" action="{{ route('admin.routes.store') }}">
      @csrf
      <span id="methodField"></span>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Kota Asal</label>
          <input type="text" name="departure" id="inputDeparture" class="form-input" placeholder="cth. Bandar Lampung" required>
        </div>
        <div class="form-group">
          <label class="form-label">Kota Tujuan</label>
          <input type="text" name="destination" id="inputDestination" class="form-input" placeholder="cth. Bakauheni" required>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Harga Dasar (Rp)</label>
        <input type="number" name="base_price" id="inputPrice" class="form-input" placeholder="cth. 45000" min="0" required>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
        <button type="submit" class="btn-primary" id="submitBtn">
          <i class="ti ti-plus"></i> <span id="submitText">Tambah Rute</span>
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function openModal(mode, id = null, dep = '', dest = '', price = '') {
    const modal = document.getElementById('routeModal');
    const form  = document.getElementById('routeForm');
    const method = document.getElementById('methodField');

    if (mode === 'edit') {
      document.getElementById('modalTitle').textContent = 'Edit Rute';
      document.getElementById('modalSub').textContent = 'Perbarui detail rute perjalanan';
      document.getElementById('submitText').textContent = 'Simpan Perubahan';
      document.querySelector('#submitBtn i').className = 'ti ti-check';
      form.action = `/admin/routes/${id}`;
      method.innerHTML = '<input type="hidden" name="_method" value="PUT">';
      document.getElementById('inputDeparture').value = dep;
      document.getElementById('inputDestination').value = dest;
      document.getElementById('inputPrice').value = price;
    } else {
      document.getElementById('modalTitle').textContent = 'Tambah Rute Baru';
      document.getElementById('modalSub').textContent = 'Masukkan detail rute perjalanan';
      document.getElementById('submitText').textContent = 'Tambah Rute';
      document.querySelector('#submitBtn i').className = 'ti ti-plus';
      form.action = '{{ route("admin.routes.store") }}';
      method.innerHTML = '';
      document.getElementById('inputDeparture').value = '';
      document.getElementById('inputDestination').value = '';
      document.getElementById('inputPrice').value = '';
    }

    modal.classList.add('open');
  }

  function closeModal() {
    document.getElementById('routeModal').classList.remove('open');
  }

  // Close modal on overlay click
  document.getElementById('routeModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
  });

  // Auto-dismiss alert
  setTimeout(() => {
    const alert = document.querySelector('.kb-alert');
    if (alert) alert.style.display = 'none';
  }, 4000);
</script>
</body>
</html>