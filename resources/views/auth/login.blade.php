<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gridbase Auth</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

    <div class="login-wrapper">
        <div class="glass-panel login-box">
            <div style="text-align: center; margin-bottom: 24px;">
                <img src="https://gridbase.com.do/wp-content/uploads/2025/02/imagen_2026-03-16_154236217.png" alt="Gridbase Logo" style="height: 48px; width: auto; object-fit: contain;">
            </div>
            <h1 class="login-title">Bienvenido a Gridbase</h1>
            <p class="login-subtitle">Inicia sesión para gestionar tus plugins</p>

            @if($errors->any())
                <div style="color: var(--danger); font-size: 14px; margin-bottom: 16px; text-align: center;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; height: 48px; margin-top: 16px;">
                    Ingresar
                </button>
            </form>
        </div>
    </div>

</body>
</html>
