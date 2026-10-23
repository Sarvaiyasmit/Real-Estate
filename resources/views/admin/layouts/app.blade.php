<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — VELORA HOMES</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>

<div class="admin-shell">

    {{-- ── Sidebar ── --}}
    <aside class="admin-sidebar" id="admin-sidebar">
        <div class="admin-sidebar-logo">
            <a href="{{ route('admin.dashboard') }}">VELORA HOMES</a>
            <span>Admin Panel</span>
        </div>

        <nav class="admin-nav">
            <div class="admin-nav-label">Main</div>
            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Dashboard
            </a>

            <div class="admin-nav-label">Content</div>
            <a href="{{ route('admin.apartments.index') }}"
               class="{{ request()->routeIs('admin.apartments.*') ? 'active' : '' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Apartments
            </a>
            <a href="{{ route('admin.enquiries.index') }}"
               class="{{ request()->routeIs('admin.enquiries.*') ? 'active' : '' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                Enquiries
                @php $newCount = \App\Models\Enquiry::where('status','new')->count(); @endphp
                @if($newCount > 0)
                    <span style="margin-left:auto; background:var(--admin-accent); color:#fff; font-size:10px; font-weight:700; padding:1px 7px; border-radius:100px;">{{ $newCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.users.index') }}"
               class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Users
            </a>
        </nav>

        <div class="admin-sidebar-footer">
            <a href="{{ route('home') }}" target="_blank">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                View Website
            </a>
            <form method="POST" action="{{ route('logout') }}" style="margin-top:4px;">
                @csrf
                <button type="submit" style="background:none;border:none;cursor:pointer;font-family:inherit;font-size:13px;width:100%;text-align:left;display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:7px;color:rgba(255,255,255,0.5);transition:background 0.2s,color 0.2s;"
                        onmouseover="this.style.background='rgba(255,255,255,0.06)';this.style.color='rgba(255,255,255,0.85)'"
                        onmouseout="this.style.background='none';this.style.color='rgba(255,255,255,0.5)'">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- ── Main ── --}}
    <div class="admin-main">

        {{-- Topbar --}}
        <header class="admin-topbar">
            <div class="admin-topbar-title">@yield('page_title', 'Dashboard')</div>
            <div class="admin-topbar-right">
                <div class="admin-user-pill">
                    <div class="admin-user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    {{ Auth::user()->name }}
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main class="admin-content">

            {{-- Flash messages --}}
            @if(session('success'))
                <div class="admin-alert admin-alert-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="admin-alert admin-alert-error">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</div>

@stack('scripts')
</body>
</html>
