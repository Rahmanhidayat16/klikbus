<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>KlikBus - Edit Armada</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Sora:wght@400;600;700&display=swap');
    :root { --color-border: #e5e7eb; --color-text-primary: #1a1a2e; --color-text-secondary: #4b5563; --bg-main: #f7f6f3; --accent-blue: #3b82f6; }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { width: 100vw; height: 100vh; overflow: hidden; font-family: 'DM Sans', sans-serif; }
    .kb-shell { display: flex; width: 100vw; height: 100vh; background: var(--bg-main); }
    .kb-sidebar { width: 280px; flex-shrink: 0; background: #fff; border-right: 1px solid var(--color-border); display: flex; flex-direction: column; }
    .kb-logo { padding: 30px 24px; border-bottom: 1px solid var(--color-border); display: flex; align-items: center; gap: 12px; }
    .kb-logo-icon { width: 40px; height: 40px; background: #1a1a2e; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; }
    .kb-logo-text { font-family: 'Sora', sans-serif; font-size: 26px; font-weight: 700; color: #1a1a2e; }
    .kb-nav { padding: 15px 10px; flex: 1; }
    .kb-nav a { text-decoration: none; display: block; }
    .kb-nav-item { display: flex; align-items: center; gap: 12px; padding: 14px 18px; border-radius: 12px; font-size: 18px; color: var(--color-text-secondary); margin-bottom: 6px; }
    .kb-nav-item.active { background: #1a1a2e; color: #fff; }
    .kb-main { flex: 1; display: flex; flex-direction: column; height: 100vh; }
    .kb-topbar { background: #fff; height: 75px; padding: 0 40px; display: flex; align-items: center; border-bottom: 1px solid var(--color-border); }
    .kb-content { padding: 40px; flex: 1; display: flex; justify-content: center; align-items: flex-start; overflow-y: auto; }
    .kb-form-card { background: #fff; width: 100%; max-width: 600px; padding: 40px; border-radius: 20px; border: 1px solid var(--color-border); }
    .kb-form-title { font-family: 'Sora', sans-serif; font-size: 24px; font-weight: 700; margin-bottom: 10px; color: #1a1a2e; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-size: 15px; font-weight: 600; color: var(--color-text-secondary); margin-bottom: 8px; }
    .form-group input, .form-group select { width: 100%; padding: 14px; border-radius: 12px; border: 1px solid var(--color-border); font-size: 16px; font-family: 'DM Sans', sans-serif; outline: none; }
    .form-group input:focus { border-color: var(--accent-blue); box-shadow: 0 0 0 4px rgba(59,130,246,0.1); }
    .btn-save { width: 100%; background: #1a1a2e; color: #fff; padding: 16px; border: none; border-radius: 12px; font-size: 16px; font-weight: 600; cursor: pointer; margin-top: 10px; }
    .btn-save:hover { background: #2a2a4e; }
    .btn-back { display: block; text-align: center; margin-top: 20px; color: #9ca3af; text-decoration: none; font-size: 14px; }
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
      <a href="{{ route('admin.bus.index') }}"><div class="kb-nav-item active"><i class="ti ti-bus"></i> Kelola Bus</div></a>
      <a href="#"><div class="kb-nav-item"><i class="ti ti-route"></i> Atur Rute</div></a>
      <a href="#"><div class="kb-nav-item"><i class="ti ti-calendar-event"></i> Jadwal</div></a>
    </nav>
  </aside>

  <main class="kb-main">
    <div class="kb-topbar">
      <div style="font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 600;">EDIT ARMADA</div>
    </div>
    <div class="kb-content">
      <div class="kb-form-card">
        <div class="kb-form-title">Edit Informasi Armada</div>
        <p style="color: #9ca3af; margin-bottom: 30px;">Ubah data armada yang sudah terdaftar.</p>

        <form action="{{ route('admin.bus.update', $bus->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label>Nama Armada Bus</label>
            <input type="text" name="bus_name" value="{{ $bus->bus_name }}" required>
          </div>

          <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
              <label>Kapasitas (Kursi)</label>
              <input type="number" name="total_seats" value="{{ $bus->total_seats }}" required>
            </div>
            <div>
              <label>Tipe Armada</label>
              <select name="type" required>
                <option value="Executive" {{ $bus->type === 'Executive' ? 'selected' : '' }}>Executive</option>
                <option value="Economy" {{ $bus->type === 'Economy' ? 'selected' : '' }}>Economy</option>
                <option value="Royal Class" {{ $bus->type === 'Royal Class' ? 'selected' : '' }}>Royal Class</option>
              </select>
            </div>
          </div>
              <div class="form-group">
              <label>Status Armada</label>
              <select name="status" required>
                <option value="active">Aktif</option>
                <option value="maintenance">Perbaikan</option>
              </select>
            </div>
          <button type="submit" class="btn-save">Simpan Perubahan</button>
          <a href="{{ route('admin.bus.index') }}" class="btn-back">Kembali ke Daftar Armada</a>
        </form>
      </div>
    </div>
  </main>
</div>
</body>
</html>