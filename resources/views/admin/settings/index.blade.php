<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>KlikBus - Pengaturan Sistem</title>
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
    html, body { width: 100vw; height: 100vh; overflow: hidden; font-family: 'DM Sans', sans-serif; background: #000; }
    .kb-shell { display: flex; width: 100vw; height: 100vh; background: var(--bg-main); }

    /* SIDEBAR */
    .kb-sidebar { width: 280px; flex-shrink: 0; background: #fff; border-right: 1px solid var(--color-border); display: flex; flex-direction: column; }
    .kb-logo { padding: 30px 24px; border-bottom: 1px solid var(--color-border); display: flex; align-items: center; gap: 12px; }
    .kb-logo-icon { width: 40px; height: 40px; background: #1a1a2e; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px; }
    .kb-logo-text { font-family: 'Sora', sans-serif; font-size: 26px; font-weight: 700; color: #1a1a2e; }
    .kb-nav { padding: 15px 10px; flex: 1; overflow-y: auto; }
    .kb-nav-label { font-size: 13px; font-weight: 600; color: #9ca3af; text-transform: uppercase; padding: 12px 15px 8px; }
    .kb-nav-item { display: flex; align-items: center; gap: 12px; padding: 14px 18px; border-radius: 12px; font-size: 16px; color: var(--color-text-secondary); cursor: pointer; margin-bottom: 6px; text-decoration: none; font-weight: 500; }
    .kb-nav-item.active { background: #1a1a2e; color: #fff; }
    .kb-nav-item:hover:not(.active) { background: #f9fafb; }

    /* MAIN CONTENT */
    .kb-main { flex: 1; display: flex; flex-direction: column; height: 100vh; }
    .kb-topbar { background: #fff; height: 75px; padding: 0 40px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--color-border); flex-shrink: 0; }
    .kb-topbar-title { font-family: 'Sora', sans-serif; font-size: 25px; font-weight: 600; }
    .kb-content { padding: 25px 40px; display: flex; flex-direction: column; gap: 20px; flex: 1; overflow-y: auto; }

    /* SETTINGS LAYOUT (1 Kolom lurus ke bawah) */
    .settings-grid { display: flex; flex-direction: column; gap: 25px; max-width: 850px; margin-bottom: 90px; }
    .settings-card { background: #fff; border-radius: 18px; padding: 25px; border: 1px solid var(--color-border); box-shadow: 0 10px 25px rgba(0,0,0,0.02); height: fit-content; }
    
    .kb-card-title { font-size: 18px; font-weight: 700; margin-bottom: 20px; color: #1a1a2e; display: flex; align-items: center; gap: 10px; border-bottom: 1px solid #f3f4f6; padding-bottom: 12px; }
    
    .form-group { margin-bottom: 18px; }
    .form-label { display: block; font-weight: 600; margin-bottom: 6px; color: var(--color-text-primary); font-size: 14px; }
    .form-input { width: 100%; padding: 11px 14px; border: 1px solid var(--color-border); border-radius: 10px; font-family: 'DM Sans'; font-size: 14px; background: #f9fafb; outline: none; transition: 0.2s; }
    .form-input:focus { border-color: var(--accent-blue); background: #fff; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.05); }
    
    .hint { font-size: 12px; color: #9ca3af; margin-top: 4px; display: block; }

    /* Tombol Simpan Melayang yang Valid */
    .btn-save-fixed { position: fixed; bottom: 30px; right: 40px; background: #1a1a2e; color: #fff; border: none; padding: 15px 35px; border-radius: 14px; font-weight: 600; font-size: 16px; cursor: pointer; box-shadow: 0 10px 20px rgba(0,0,0,0.15); display: flex; align-items: center; gap: 10px; transition: 0.3s; z-index: 100; }
    .btn-save-fixed:hover { transform: translateY(-3px); background: #2d2d44; }

    .toggle-container { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid #f9fafb; }
    .toggle-info { font-size: 14px; color: var(--color-text-primary); font-weight: 500; }
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
      <a href="{{ route('admin.tickets.index') }}" style="text-decoration: none;"><div class="kb-nav-item"><i class="ti ti-ticket"></i> Data Tiket</div></a>

      <div class="kb-nav-label">Sistem</div>
      <a href="{{ route('admin.users.index') }}" style="text-decoration: none;"><div class="kb-nav-item"><i class="ti ti-users"></i> Pengguna</div></a>
      <a href="{{ route('admin.settings.index') }}" style="text-decoration: none;"><div class="kb-nav-item active"><i class="ti ti-settings"></i> Pengaturan</div></a>
    </nav>

    <div class="kb-sidebar-footer" style="padding: 20px; border-top: 1px solid var(--color-border); display: flex; align-items: center; gap: 12px; margin-top: auto;">
      <div class="kb-avatar" style="width: 40px; height: 40px; background: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #ffffff;">RH</div>
      <div class="kb-profile-info" style="flex: 1;">
        <div class="kb-profile-name" style="font-weight: 600; font-size: 14px;">Rahman Hidayat</div>
        <div class="kb-profile-role" style="font-size: 12px; color: #00000;">Super Admin</div>
      </div>
      
      <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
        @csrf
        <button type="submit" style="background: none; border: none; cursor: pointer; color: #ef4444; font-size: 18px; padding: 5px;">
          <i class="ti ti-logout"></i>
        </button>
      </form>
    </div>
  </aside>

  <main class="kb-main">
    <div class="kb-topbar">
      <div class="kb-topbar-title">KONFIGURASI SISTEM</div>
    </div>

    <div class="kb-content">
      
      <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        
        <div class="settings-grid">
          
          <div class="settings-card">
            <div class="kb-card-title"><i class="ti ti-info-circle"></i> Tampilan & Informasi Web</div>
            
            <div class="form-group">
              <label class="form-label">Nama Aplikasi</label>
              <input type="text" name="app_name" class="form-input" value="{{ $settings['app_name'] ?? 'KlikBus' }}">
            </div>
            
            <div class="form-group">
              <label class="form-label">Kota Operasional Utama</label>
              <input type="text" name="main_city" class="form-input" value="{{ $settings['main_city'] ?? 'Bandar Lampung' }}">
              <span class="hint">Akan jadi titik keberangkatan default di halaman pencarian tiket.</span>
            </div>
            
            <div class="form-group">
              <label class="form-label">Zona Waktu Sistem</label>
              <select name="timezone" class="form-input">
                <option value="Asia/Jakarta" {{ isset($settings['timezone']) && $settings['timezone'] == 'Asia/Jakarta' ? 'selected' : '' }}>WIB (Waktu Indonesia Barat)</option>
                <option value="Asia/Makassar" {{ isset($settings['timezone']) && $settings['timezone'] == 'Asia/Makassar' ? 'selected' : '' }}>WITA (Waktu Indonesia Tengah)</option>
                <option value="Asia/Jayapura" {{ isset($settings['timezone']) && $settings['timezone'] == 'Asia/Jayapura' ? 'selected' : '' }}>WIT (Waktu Indonesia Timur)</option>
              </select>
            </div>

            <div class="form-group">
              <label class="form-label">Teks Pengumuman Beranda</label>
              <textarea name="announcement_text" class="form-input" rows="2" style="resize: none;">{{ $settings['announcement_text'] ?? 'Gunakan kode promo KLIKHEMAT untuk diskon 10% khusus pengguna baru!' }}</textarea>
            </div>
            
            <div class="form-group">
              <label class="form-label">Username Instagram (Tanpa @)</label>
              <div style="display: flex; align-items: center; border: 1px solid var(--color-border); border-radius: 10px; background: #f9fafb; overflow: hidden;">
                <span style="padding: 11px 14px; background: #e5e7eb; color: var(--color-text-secondary); font-weight: 600; font-size: 14px; border-right: 1px solid var(--color-border);">ig.com/</span>
                <input type="text" name="ig_link" class="form-input" value="{{ $settings['ig_link'] ?? 'klikbus.id' }}" style="border: none; border-radius: 0; background: transparent; width: 100%;">
              </div>
            </div>
          </div>

          <div class="settings-card">
            <div class="kb-card-title"><i class="ti ti-wallet"></i> Keuangan & Pembayaran</div>
            <div class="form-group">
              <label class="form-label">Biaya Admin Platform (Rp)</label>
              <input type="number" name="admin_fee" class="form-input" value="{{ $settings['admin_fee'] ?? '2500' }}">
            </div>
            <div class="form-group">
              <label class="form-label">Biaya Pembatalan (Refund Fee %)</label>
              <input type="number" name="refund_fee" class="form-input" value="{{ $settings['refund_fee'] ?? '25' }}">
            </div>
            
            <div style="margin-top: 15px;">
              <label class="form-label" style="border-top: 1px solid #f3f4f6; padding-top: 10px; margin-bottom: 10px;">Metode Pembayaran Aktif</label>
              @foreach($payment_methods as $method)
              <div class="toggle-container" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px dashed #f3f4f6;">
                <span class="toggle-info" style="font-size: 14px; font-weight: 500;">{{ $method->name }}</span>
                <select name="payment_methods[{{ $method->id }}]" class="form-input" style="width: 130px; padding: 6px 10px; font-weight: 600; color: {{ $method->is_active ? '#22c55e' : '#ef4444' }};">
                  <option value="1" {{ $method->is_active ? 'selected' : '' }} style="color: #22c55e;">● AKTIF</option>
                  <option value="0" {{ !$method->is_active ? 'selected' : '' }} style="color: #ef4444;">○ NONAKTIF</option>
                </select>
              </div>
              @endforeach
            </div>
          </div>

          <div class="settings-card">
            <div class="kb-card-title"><i class="ti ti-clock-cog"></i> Aturan Operasional Tiket</div>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
              <div class="form-group">
                <label class="form-label">Batas Waktu Pembayaran (Menit)</label>
                <input type="number" name="payment_timeout" class="form-input" value="{{ $settings['payment_timeout'] ?? '30' }}">
              </div>
              <div class="form-group">
                <label class="form-label">Maksimal H- Pemesanan (Menit)</label>
                <input type="number" name="max_booking_minutes" class="form-input" value="{{ $settings['max_booking_minutes'] ?? '1440' }}">
              </div>
            </div>
          </div>

        </div>

        <button type="submit" class="btn-save-fixed">
          <i class="ti ti-device-floppy"></i> Simpan Semua Perubahan
        </button>
      </form>
      
    </div>
  </main>
</div>

</body>
</html>