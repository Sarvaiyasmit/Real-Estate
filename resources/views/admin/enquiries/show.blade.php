@extends('admin.layouts.app')
@section('title', 'Enquiry #'.$enquiry->id)
@section('page_title', 'Enquiry #'.$enquiry->id)

@section('content')

<div style="max-width:760px;">

    <div style="margin-bottom:16px;display:flex;align-items:center;gap:10px;">
        <a href="{{ route('admin.enquiries.index') }}" class="admin-btn admin-btn-ghost admin-btn-sm">← Back to Enquiries</a>
        <span class="admin-badge {{ $enquiry->status_color }}">{{ ucfirst($enquiry->status) }}</span>
    </div>

    <div class="admin-card" style="margin-bottom:16px;">
        <div class="admin-card-header">
            <span class="admin-card-title">Contact Details</span>
            <span style="font-size:12px;color:var(--admin-muted);">{{ $enquiry->created_at->format('d M Y, H:i') }}</span>
        </div>
        <div class="admin-detail-grid">
            <div class="admin-detail-row">
                <div class="admin-detail-label">Full Name</div>
                <div class="admin-detail-value">{{ $enquiry->name }}</div>
            </div>
            <div class="admin-detail-row">
                <div class="admin-detail-label">Email</div>
                <div class="admin-detail-value"><a href="mailto:{{ $enquiry->email }}" style="color:var(--admin-accent);">{{ $enquiry->email }}</a></div>
            </div>
            <div class="admin-detail-row">
                <div class="admin-detail-label">Phone / WhatsApp</div>
                <div class="admin-detail-value">{{ $enquiry->phone ?? '—' }}</div>
            </div>
            <div class="admin-detail-row">
                <div class="admin-detail-label">Interested In</div>
                <div class="admin-detail-value">{{ $enquiry->interest_label }}</div>
            </div>
            <div class="admin-detail-row">
                <div class="admin-detail-label">Property Unit</div>
                <div class="admin-detail-value">{{ $enquiry->unit ?? '—' }}</div>
            </div>
            <div class="admin-detail-row">
                <div class="admin-detail-label">Status</div>
                <div class="admin-detail-value"><span class="admin-badge {{ $enquiry->status_color }}">{{ ucfirst($enquiry->status) }}</span></div>
            </div>
        </div>
    </div>

    <div class="admin-card" style="margin-bottom:16px;">
        <div class="admin-card-header">
            <span class="admin-card-title">Message</span>
        </div>
        <div style="padding:20px 22px;">
            <div class="admin-message-box">{{ $enquiry->message }}</div>
        </div>
    </div>

    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <a href="mailto:{{ $enquiry->email }}" class="admin-btn admin-btn-primary">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            Reply via Email
        </a>
        @if($enquiry->phone)
        <a href="https://wa.me/91{{ preg_replace('/\D/','',$enquiry->phone) }}" target="_blank" class="admin-btn admin-btn-ghost">
            WhatsApp
        </a>
        @endif
        @if($enquiry->status !== 'replied')
        <form method="POST" action="{{ route('admin.enquiries.replied', $enquiry) }}">
            @csrf @method('PATCH')
            <button type="submit" class="admin-btn admin-btn-ghost">Mark as Replied</button>
        </form>
        @endif
        <form method="POST" action="{{ route('admin.enquiries.destroy', $enquiry) }}"
              onsubmit="return confirm('Delete this enquiry?')" style="margin-left:auto;">
            @csrf @method('DELETE')
            <button type="submit" class="admin-btn admin-btn-danger">Delete Enquiry</button>
        </form>
    </div>

</div>

@endsection
