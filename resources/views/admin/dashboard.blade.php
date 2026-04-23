@extends('layouts.admin')

@section('header', 'Panel de Control')

@section('content')
<div class="stats-grid">
    <div class="glass-panel stat-card">
        <div class="stat-label">Total Plugins</div>
        <div class="stat-value">{{ $stats['total_plugins'] }}</div>
    </div>
    
    <div class="glass-panel stat-card">
        <div class="stat-label">Licencias Emitidas</div>
        <div class="stat-value">{{ $stats['total_licenses'] }}</div>
    </div>

    <div class="glass-panel stat-card">
        <div class="stat-label">Licencias Activas</div>
        <div class="stat-value" style="color: var(--success);">{{ $stats['active_licenses'] }}</div>
    </div>

    <div class="glass-panel stat-card">
        <div class="stat-label">Licencias Revocadas</div>
        <div class="stat-value" style="color: var(--danger);">{{ $stats['inactive_licenses'] }}</div>
    </div>
</div>

<div class="glass-panel" style="padding: 32px">
    <h3 style="margin-bottom: 16px;">Bienvenido a Gridbase Auth Verificator</h3>
    <p>Este es el sistema nervioso central operativo de tus plugins. Aquí puedes dar de alta nuevos productos y monitorear al instante su adopción e instalación en los dominios de tus clientes, asegurando sus licencias.</p>
</div>
@endsection
