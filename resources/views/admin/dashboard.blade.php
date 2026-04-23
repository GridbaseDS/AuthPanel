@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')
<div class="stats-grid">
    <div class="glass-panel stat-card">
        <div class="stat-label">Total Plugins</div>
        <div class="stat-value">{{ $stats['total_plugins'] }}</div>
    </div>
    
    <div class="glass-panel stat-card">
        <div class="stat-label">Total Licenses</div>
        <div class="stat-value">{{ $stats['total_licenses'] }}</div>
    </div>

    <div class="glass-panel stat-card">
        <div class="stat-label">Active Licenses</div>
        <div class="stat-value" style="color: var(--success);">{{ $stats['active_licenses'] }}</div>
    </div>

    <div class="glass-panel stat-card">
        <div class="stat-label">Inactive Licenses</div>
        <div class="stat-value" style="color: var(--danger);">{{ $stats['inactive_licenses'] }}</div>
    </div>
</div>

<div class="glass-panel" style="padding: 32px">
    <h3 style="margin-bottom: 16px;">Welcome to Gridbase Auth Verificator</h3>
    <p>This is the central nervous system for your plugins. Here you can generate new plugins, monitor API traffic implicitly via license limits, and manually revoke any leaked licenses.</p>
</div>
@endsection
