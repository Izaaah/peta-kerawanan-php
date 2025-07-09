<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login BNNP JATIM</title>
    <link rel="stylesheet" href="{{ asset('storage/css/login.css') }}">
</head>
<body>
    <div class="overlay"></div>
    <div class="login-container">
        <div class="logo">
            <img src="{{ asset('storage/img/logo.png') }}" alt="Logo UIN" class="Image-title">
        </div>
        <h2>BNNP JATIM</h2>
        <div class="subtitle">Silakan login untuk melanjutkan</div>

        {{-- Tampilkan error jika login gagal --}}
        @if ($errors->any())
            <div class="error-message" id="errorMsg">
                @foreach ($errors->all() as $error)
                    <p style="color: red;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form id="loginForm" method="POST" action="{{ url('/login') }}" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required placeholder="Masukkan username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Masukkan password">
            </div>
            <button type="submit" class="login-btn">Sign In</button>
        </form>
    </div>
</body>
</html>
