@extends('layouts.admin')

@section('header', 'Plugins')

@section('content')
<div style="display: flex; justify-content: flex-end; margin-bottom: 24px;">
    <a href="{{ route('plugins.create') }}" class="btn btn-primary">
        + Añadir Nuevo Plugin
    </a>
</div>

<div class="glass-panel table-container">
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del Plugin</th>
                <th>Slug (Identificador)</th>
                <th>Tipo</th>
                <th>Licencias Emitidas</th>
                <th>Creado el</th>
            </tr>
        </thead>
        <tbody>
            @forelse($plugins as $plugin)
            <tr>
                <td style="font-weight: 500;">{{ $plugin->name }}</td>
                <td><code style="background: rgba(255,255,255,0.1); padding: 4px 8px; border-radius: 4px;">{{ $plugin->slug }}</code></td>
                <td>
                    <span class="badge {{ $plugin->type === 'free' ? 'badge-primary' : 'badge-success' }}">
                        {{ strtoupper($plugin->type) }}
                    </span>
                </td>
                <td>{{ $plugin->licenses_count }}</td>
                <td style="color: var(--text-muted);">{{ $plugin->created_at->format('M d, Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 32px;">No hay plugins registrados aún.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
