@extends('layouts.admin')

@section('header', 'Active Licenses')

@section('content')

<div class="glass-panel table-container">
    <table class="table">
        <thead>
            <tr>
                <th>Plugin</th>
                <th>Domain Used</th>
                <th>License Key</th>
                <th>Status</th>
                <th>Registered At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($licenses as $license)
            <tr>
                <td style="font-weight: 500;">{{ $license->plugin->name }}</td>
                <td style="color: #60A5FA;">{{ $license->domain }}</td>
                <td><code style="font-size:12px; opacity: 0.7;">{{ $license->license_key }}</code></td>
                <td>
                    <span class="badge {{ $license->status === 'active' ? 'badge-success' : 'badge-danger' }}">
                        {{ strtoupper($license->status) }}
                    </span>
                </td>
                <td style="color: var(--text-muted);">{{ $license->registered_at }}</td>
                <td style="width: 100px;">
                    @if($license->status === 'active')
                    <form action="{{ route('licenses.revoke', $license->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to revoke this license from the domain? They will lose access instantly.')">
                        @csrf
                        <button type="submit" class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;">Revoke</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 32px;">No licenses have been issued yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
