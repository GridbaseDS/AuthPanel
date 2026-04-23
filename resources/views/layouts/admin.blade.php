<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Gridbase Auth') }} - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                <img src="https://gridbase.com.do/wp-content/uploads/2025/02/imagen_2026-03-16_154236217.png" alt="Gridbase Logo" style="height: 32px; width: auto; object-fit: contain;">
                Gridbase
            </div>
            
            <nav class="sidebar-nav">
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('plugins.index') }}" class="nav-item {{ request()->routeIs('plugins.*') ? 'active' : '' }}">
                    Plugins
                </a>
                <a href="{{ route('licenses.index') }}" class="nav-item {{ request()->routeIs('licenses.*') ? 'active' : '' }}">
                    Licenses
                </a>
                <form action="{{ route('logout') }}" method="POST" style="margin-top: auto;">
                    @csrf
                    <button type="submit" class="nav-item" style="background:none; border:none; width:100%; text-align:left; cursor:pointer;">
                        Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="topbar">
                <h2>@yield('header')</h2>
                <div class="user-profile">
                    {{ auth()->user()->name }}
                </div>
            </header>

            @if(session('success'))
                <div class="glass-panel" style="padding: 16px; border-color: var(--success); color: var(--success); margin-bottom: 24px;">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="glass-panel" style="padding: 16px; border-color: var(--danger); color: var(--danger); margin-bottom: 24px;">
                    <ul style="margin-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
