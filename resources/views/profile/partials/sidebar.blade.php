<aside class="profile-sidebar">
    <section class="profile-avatar-card">
        <a href="{{ route('profile.edit') }}" class="avatar-upload-wrap" aria-label="Edit profile and picture">
            @if($user->avatar_url)
                <div class="avatar-circle">
                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}'s profile picture">
                </div>
            @else
                <div class="avatar-initials" aria-hidden="true">{{ $user->initials }}</div>
            @endif
            <span class="avatar-upload-overlay" aria-hidden="true"><span>Edit profile</span></span>
        </a>
        <h2 class="profile-name">{{ $user->name }}</h2>
        @if($user->username)
            <p class="profile-username">{{ '@'.$user->username }}</p>
        @endif
        @if($user->occupation)
            <p class="profile-occupation">{{ $user->occupation }}</p>
        @endif
    </section>

    <nav class="profile-nav-card" aria-label="Profile settings">
        <a href="{{ route('profile.show') }}"
           class="profile-nav-link {{ $activeSection === 'overview' ? 'active' : '' }}"
           @if($activeSection === 'overview') aria-current="page" @endif>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Overview
        </a>
        <a href="{{ route('profile.edit') }}"
           class="profile-nav-link {{ $activeSection === 'edit' ? 'active' : '' }}"
           @if($activeSection === 'edit') aria-current="page" @endif>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4Z"/></svg>
            Edit profile
        </a>
        <a href="{{ route('profile.password') }}"
           class="profile-nav-link {{ $activeSection === 'password' ? 'active' : '' }}"
           @if($activeSection === 'password') aria-current="page" @endif>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            Password &amp; security
        </a>
    </nav>
</aside>
