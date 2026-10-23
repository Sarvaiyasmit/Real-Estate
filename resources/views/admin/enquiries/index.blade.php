@extends('admin.layouts.app')
@section('title', 'Enquiries')
@section('page_title', 'Enquiries')

@section('content')

<div class="admin-page-header">
    <div>
        <div class="admin-page-title">Enquiries</div>
        <div class="admin-page-sub">{{ $enquiries->total() }} total · {{ \App\Models\Enquiry::where('status','new')->count() }} new</div>
    </div>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Interest</th>
                    <th>Unit</th>
                    <th>Status</th>
                    <th>Received</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enquiries as $enq)
                <tr style="{{ $enq->status === 'new' ? 'font-weight:600;' : '' }}">
                    <td style="color:var(--admin-muted);">{{ $enq->id }}</td>
                    <td>{{ $enq->name }}</td>
                    <td>
                        <div style="font-size:12px;">{{ $enq->email }}</div>
                        @if($enq->phone)<div style="font-size:12px;color:var(--admin-muted);">{{ $enq->phone }}</div>@endif
                    </td>
                    <td>{{ $enq->interest_label }}</td>
                    <td style="color:var(--admin-muted);">{{ $enq->unit ?? '—' }}</td>
                    <td><span class="admin-badge {{ $enq->status_color }}">{{ ucfirst($enq->status) }}</span></td>
                    <td style="color:var(--admin-muted);font-size:12px;">{{ $enq->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display:flex;gap:6px;align-items:center;">
                            <a href="{{ route('admin.enquiries.show', $enq) }}" class="admin-btn admin-btn-ghost admin-btn-sm">View</a>
                            <form method="POST" action="{{ route('admin.enquiries.destroy', $enq) }}"
                                  onsubmit="return confirm('Delete this enquiry?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="admin-btn admin-btn-danger admin-btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:var(--admin-muted);padding:40px;">No enquiries yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($enquiries->hasPages())
        <div class="admin-pagination">{{ $enquiries->links() }}</div>
    @endif
</div>

@endsection
