@extends('admin.layouts.app')
@section('title', 'Apartments')
@section('page_title', 'Apartments')

@section('content')

<div class="admin-page-header">
    <div>
        <div class="admin-page-title">Apartments</div>
        <div class="admin-page-sub">{{ $apartments->total() }} total listings</div>
    </div>
    <a href="{{ route('admin.apartments.create') }}" class="admin-btn admin-btn-primary">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Apartment
    </a>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Unit</th>
                    <th>Type</th>
                    <th>Block / Floor</th>
                    <th>Beds</th>
                    <th>Area</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($apartments as $apt)
                <tr>
                    <td style="color:var(--admin-muted);">{{ $apt->id }}</td>
                    <td style="font-weight:600;">{{ $apt->unit_number }}</td>
                    <td>{{ $apt->typology_label }}</td>
                    <td>Block {{ $apt->block }}, Floor {{ $apt->floor }}</td>
                    <td>{{ $apt->bedrooms }}</td>
                    <td>{{ number_format($apt->area_sqft) }} sq.ft.</td>
                    <td>{{ $apt->formatted_price }}</td>
                    <td><span class="admin-badge admin-badge-{{ $apt->status }}">{{ ucfirst($apt->status) }}</span></td>
                    <td>
                        <div style="display:flex; gap:6px; align-items:center;">
                            <a href="{{ route('admin.apartments.edit', $apt) }}" class="admin-btn admin-btn-ghost admin-btn-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.apartments.destroy', $apt) }}"
                                  onsubmit="return confirm('Delete Unit {{ $apt->unit_number }}? This cannot be undone.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="admin-btn admin-btn-danger admin-btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" style="text-align:center; color:var(--admin-muted); padding:40px;">No apartments found. <a href="{{ route('admin.apartments.create') }}" style="color:var(--admin-accent);">Add one →</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($apartments->hasPages())
        <div class="admin-pagination">{{ $apartments->links() }}</div>
    @endif
</div>

@endsection
