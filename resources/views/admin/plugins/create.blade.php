@extends('layouts.admin')

@section('header', 'Añadir Nuevo Plugin')

@section('content')
<div class="glass-panel" style="max-width: 600px; padding: 32px;">
    
    <form action="{{ route('plugins.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Nombre Oficial del Plugin</label>
            <input type="text" name="name" class="form-control" placeholder="ej. FlowSoft WP" required>
        </div>

        <div class="form-group">
            <label class="form-label">Slug del Plugin (Identificador Único)</label>
            <input type="text" name="slug" class="form-control" placeholder="ej. flowsoft-wp" required>
            <p style="font-size: 12px; margin-top: 8px;">Debe coincidir exactamente con el slug que enviarás en `GridbaseAuth::init()` en el plugin de WordPress.</p>
        </div>

        <div class="form-group">
            <label class="form-label">Tipo de Licencia</label>
            <select name="type" class="form-control" required style="appearance: none;">
                <option value="free">Gratuito (Se auto-registra silenciosamente sin pedirle clave al usuario)</option>
                <option value="premium">Premium (Requerirá introducir una clave comprada)</option>
            </select>
        </div>

        <div style="margin-top: 32px;">
            <button type="submit" class="btn btn-primary" style="width: 100%;">Crear Plugin</button>
        </div>
    </form>

</div>
@endsection
