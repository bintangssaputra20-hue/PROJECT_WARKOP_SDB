<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>

<body>

    <div class="login-card">

        <a href="/" class="btn-back">
            ← Kembali
        </a>

        <h2>Login Admin</h2>
        <p>Masuk untuk mengelola pesanan Warkop SDB</p>

        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form action="/login" method="POST">
            
            @csrf 

            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>

            <button type="submit">Login</button>
        </form>

        <small style="display:block; text-align:center; margin-top:15px; color:#aaa;">
            Hanya untuk admin
        </small>

    </div>

</body>
</html>