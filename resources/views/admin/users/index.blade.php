@extends('admin.layouts.app')
@section('title', 'Users')
@section('page_title', 'Users')

@section('content')

<div class="admin-page-header">
    <div>
        <div class="admin-page-title">Users</div>
        <div class="admin-page-sub">{{ $users->total() }} registered accounts</div>
    </div>
</div>

<div class="admin-card">
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td style="color:var(--admin-muted);">{{ $user->id }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:30px;height:30px;border-radius:50%;background:var(--admin-accent);color:#fff;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;flex-shrink:0;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span style="font-weight:600;">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->is_admin)
                            <span class="admin-badge admin-badge-admin">Admin</span>
                        @else
                            <span class="admin-badge admin-badge-user">User</span>
                        @endif
                    </td>
                    <td style="color:var(--admin-muted); font-size:12px;">{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display:flex;gap:6px;align-items:center;">
                            <form method="POST" action="{{ route('admin.users.toggle-admin', $user) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="admin-btn admin-btn-ghost admin-btn-sm"
                                        title="{{ $user->is_admin ? 'Revoke admin' : 'Grant admin' }}">
                                    {{ $user->is_admin ? 'Revoke Admin' : 'Make Admin' }}
                                </button>
                            </form>
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                  onsubmit="return confirm('Delete {{ $user->name }}? This cannot be undone.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="admin-btn admin-btn-danger admin-btn-sm">Delete</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:var(--admin-muted);padding:40px;">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
        <div class="admin-pagination">{{ $users->links() }}</div>
    @endif
</div>

@endsection
