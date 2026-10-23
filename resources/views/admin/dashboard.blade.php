@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

{{-- Stats grid --}}
<div class="admin-stats-grid">
    <div class="admin-stat-card">
        <div class="admin-stat-label">Total Apartments</div>
        <div class="admin-stat-value">{{ $totalApartments }}</div>
    </div>
    <div class="admin-stat-card accent">
        <div class="admin-stat-label">Available</div>
        <div class="admin-stat-value">{{ $availableApartments }}</div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-label">Reserved</div>
        <div class="admin-stat-value">{{ $reservedApartments }}</div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-label">Registered Users</div>
        <div class="admin-stat-value">{{ $totalUsers }}</div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-label">Total Enquiries</div>
        <div class="admin-stat-value">{{ $totalEnquiries }}</div>
    </div>
    <div class="admin-stat-card accent">
        <div class="admin-stat-label">New Enquiries</div>
        <div class="admin-stat-value">{{ $newEnquiries }}</div>
    </div>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">

    {{-- Recent Apartments --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <span class="admin-card-title">Recent Apartments</span>
            <a href="{{ route('admin.apartments.index') }}" class="admin-btn admin-btn-ghost admin-btn-sm">View All</a>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Unit</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentApartments as $apt)
                    <tr>
                        <td style="font-weight:600;">{{ $apt->unit_number }}</td>
                        <td>{{ $apt->typology_label }}</td>
                        <td><span class="admin-badge admin-badge-{{ $apt->status }}">{{ ucfirst($apt->status) }}</span></td>
                        <td style="font-size:13px;">{{ $apt->formatted_price }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="color:var(--admin-muted); text-align:center; padding:24px;">No apartments yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent Enquiries --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <span class="admin-card-title">Recent Enquiries</span>
            <a href="{{ route('admin.enquiries.index') }}" class="admin-btn admin-btn-ghost admin-btn-sm">View All</a>
        </div>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Interest</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentEnquiries as $enq)
                    <tr>
                        <td>
                            <div style="font-weight:600;">{{ $enq->name }}</div>
                            <div style="font-size:12px; color:var(--admin-muted);">{{ $enq->email }}</div>
                        </td>
                        <td>{{ $enq->interest_label }}</td>
                        <td><span class="admin-badge {{ $enq->status_color }}">{{ ucfirst($enq->status) }}</span></td>
                        <td><a href="{{ route('admin.enquiries.show', $enq) }}" class="admin-btn admin-btn-ghost admin-btn-sm">View</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="color:var(--admin-muted); text-align:center; padding:24px;">No enquiries yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
