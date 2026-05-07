<h1>Daftar Akun KlikBus</h1>

<form action="{{ route('register') }}" method="POST">
    @csrf
    <div>
        <label>Nama:</label><br>
        <input type="text" name="name" required>
    </div>
    <br>
    <div>
        <label>Email:</label><br>
        <input type="email" name="email" required>
    </div>
    <br>
    <div>
        <label>Password:</label><br>
        <input type="password" name="password" required>
    </div>
    <br>
    <div>
        <label>Konfirmasi Password:</label><br>
        <input type="password" name="password_confirmation" required>
    </div>
    <br>
    <button type="submit">Daftar Sekarang</button>
</form>
<a href="{{ route('login') }}">Sudah punya akun? Login di sini</a>