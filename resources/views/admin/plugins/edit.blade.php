@extends('layouts.admin')

@section('header', 'Editar Plugin')

@section('content')
<div class="glass-panel" style="max-width: 600px; padding: 32px;">
    
    <form action="{{ route('plugins.update', $plugin->id) }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Nombre Oficial del Plugin</label>
            <input type="text" name="name" class="form-control" value="{{ $plugin->name }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Slug del Plugin (Identificador Único)</label>
            <input type="text" name="slug" class="form-control" value="{{ $plugin->slug }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Tipo de Licencia</label>
            <select name="type" class="form-control" required style="appearance: none;">
                <option value="free" {{ $plugin->type == 'free' ? 'selected' : '' }}>Gratuito (Se auto-registra silenciosamente)</option>
                <option value="premium" {{ $plugin->type == 'premium' ? 'selected' : '' }}>Premium (Requerirá introducir una clave comprada)</option>
            </select>
        </div>

        <div style="margin-top: 32px;">
            <button type="submit" class="btn btn-primary" style="width: 100%;">Guardar Cambios</button>
        </div>
    </form>

</div>
@endsection
