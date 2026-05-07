<h1>Selamat Datang di KlikBus, {{ Auth::user()->name }}!</h1>
<p>Kamu berhasil masuk ke sistem.</p>
@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
        <strong>Berhasil!</strong> {{ session('success') }}
    </div>
@endif

<hr>

<div style="margin-top: 20px;">
    <h3>Menu Utama:</h3>
    <ul>
        <li><a href="{{ route('bookings.index') }}" style="font-size: 1.2rem; color: blue;">Cari & Pesan Tiket Bus</a></li>
    </ul>
</div>

<hr>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Keluar (Logout)</button>
</form>