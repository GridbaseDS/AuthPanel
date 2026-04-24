@extends('layouts.admin')

@section('header', 'Generar Llave de Pago')

@section('content')
<div class="glass-panel" style="max-width: 600px; padding: 32px;">
    
    <form action="{{ route('licenses.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Seleccionar Plugin Premium</label>
            <select name="plugin_id" class="form-control" required style="appearance: none;">
                @forelse($plugins as $plugin)
                    <option value="{{ $plugin->id }}">{{ $plugin->name }} ({{ $plugin->slug }})</option>
                @empty
                    <option value="">No hay plugins premium registrados aún</option>
                @endforelse
            </select>
            <p style="font-size: 12px; margin-top: 8px;">Solo aparecen plugins marcados como Premium.</p>
        </div>

        <div style="margin-top: 32px;">
            <button type="submit" class="btn btn-primary" style="width: 100%;">
                Generar Llave Formato GB-XXXX-XXXX
            </button>
        </div>
    </form>

</div>
@endsection
