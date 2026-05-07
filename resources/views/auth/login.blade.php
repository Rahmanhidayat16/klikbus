<h1>Login Admin/User</h1>

@if($errors->any())
    <p style="color: red;">{{ $errors->first() }}</p>
@endif

<form action="{{ route('login') }}" method="POST">
    @csrf
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
    <button type="submit">Login</button>
</form>
<a href="{{ route('register') }}">Belum punya akun? Daftar di sini</a>