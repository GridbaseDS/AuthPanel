@extends('layouts.admin')

@section('header', 'Add New Plugin')

@section('content')
<div class="glass-panel" style="max-width: 600px; padding: 32px;">
    
    <form action="{{ route('plugins.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Plugin Official Name</label>
            <input type="text" name="name" class="form-control" placeholder="e.g. FlowSoft WP" required>
        </div>

        <div class="form-group">
            <label class="form-label">Plugin Slug (Unique identifier)</label>
            <input type="text" name="slug" class="form-control" placeholder="e.g. flowsoft-wp" required>
            <p style="font-size: 12px; margin-top: 8px;">Must exactly match the slug you will use in GridbaseAuth::init() on your WP Plugin.</p>
        </div>

        <div class="form-group">
            <label class="form-label">Plugin License Type</label>
            <select name="type" class="form-control" required style="appearance: none;">
                <option value="free">Free (Auto-Registers silently without manual key)</option>
                <option value="premium">Premium (Requires manual license key input - Phase 2)</option>
            </select>
        </div>

        <div style="margin-top: 32px;">
            <button type="submit" class="btn btn-primary" style="width: 100%;">Create Plugin</button>
        </div>
    </form>

</div>
@endsection
