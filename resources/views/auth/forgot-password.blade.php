<h1>Lupa Password?</h1>
<p>Masukkan email kamu, nanti kita kirim link resetnya.</p>

@if (session('status'))
    <p style="color: green;">{{ session('status') }}</p>
@endif

<form action="{{ route('password.email') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Email kamu" required>
    <button type="submit">Kirim Link</button>
</form>

<a href="{{ route('login') }}">Balik ke Login</a>