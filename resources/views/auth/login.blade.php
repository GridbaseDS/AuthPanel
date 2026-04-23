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
            <h1 class="login-title">Welcome Back</h1>
            <p class="login-subtitle">Sign in to manage Gridbase plugins</p>

            @if($errors->any())
                <div style="color: var(--danger); font-size: 14px; margin-bottom: 16px; text-align: center;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; height: 48px; margin-top: 16px;">
                    Sign In
                </button>
            </form>
        </div>
    </div>

</body>
</html>
