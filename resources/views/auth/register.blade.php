@extends('layouts.app')

@section('title', 'Create Account — VELORA HOMES')
@section('meta_description', 'Create your account to save favourite homes and receive direct property updates from VELORA HOMES.')
@section('nav_class', 'nav-hidden')

@push('styles')
    <link rel="stylesheet" href="/css/auth.css">
    <style>
        #main-nav { display: none; }
        footer     { display: none; }
        body       { padding-top: 0; }
    </style>
@endpush

@section('content')

<div class="auth-page">

    {{-- ══ LEFT: Brand image panel ══ --}}
    <div class="auth-left" aria-hidden="true">
        <div class="auth-left-bg"></div>
        <div class="auth-left-overlay"></div>

        <span class="auth-left-logo">VELORA HOMES</span>

        <div class="auth-left-content">
            <p class="auth-brand-line">Your curated journey to Gujarat's finest residences begins here.</p>
            <p class="auth-brand-sub">Exclusive estates across Ahmedabad, Surat &amp; Rajkot</p>
        </div>
    </div>

    {{-- ══ RIGHT: Form panel ══ --}}
    <div class="auth-right">

        {{-- Top bar --}}
        <div class="auth-topbar">
            <a href="{{ route('home') }}" class="auth-back-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Back to Home
            </a>
            <a href="{{ route('apartments.index') }}" class="auth-topbar-link">
                Explore Listings →
            </a>
        </div>

        {{-- Form --}}
        <div class="auth-form-wrap">
            <div class="auth-card">

                <div class="auth-header">
                    <span class="auth-kicker">Join the Portfolio</span>
                    <h1 class="auth-title">Create Account</h1>
                    <p class="auth-desc">Register to save favourite homes and receive curated property updates.</p>
                </div>

                @if($errors->any())
                    <div class="auth-error-banner" role="alert">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('register.submit') }}" class="auth-form" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Full Name</label>
                        <div class="input-container">
                            <input id="name" name="name" type="text"
                                   class="form-input @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}"
                                   placeholder="e.g. Rajesh Patel"
                                   required autofocus autocomplete="name">
                        </div>
                        @error('name')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-container">
                            <input id="email" name="email" type="email"
                                   class="form-input @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}"
                                   placeholder="you@domain.com"
                                   required autocomplete="email">
                        </div>
                        @error('email')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-container">
                            <input id="password" name="password" type="password"
                                   class="form-input has-toggle @error('password') is-invalid @enderror"
                                   placeholder="At least 8 characters"
                                   required autocomplete="new-password">
                            <button type="button" class="password-toggle"
                                    onclick="togglePass('password', this)"
                                    aria-label="Toggle password visibility">
                                <svg id="eye-password" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <div class="input-container">
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                   class="form-input has-toggle"
                                   placeholder="Enter password again"
                                   required autocomplete="new-password">
                            <button type="button" class="password-toggle"
                                    onclick="togglePass('password_confirmation', this)"
                                    aria-label="Toggle confirm password visibility">
                                <svg id="eye-password_confirmation" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="terms-group">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">
                            I agree to the
                            <a href="#" onclick="return false;">Privacy Policy</a>
                            and
                            <a href="#" onclick="return false;">Terms of Use</a>.
                        </label>
                    </div>
                    @error('terms')
                        <span class="form-error" role="alert">{{ $message }}</span>
                    @enderror

                    <button type="submit" class="auth-submit-btn">
                        Create My Account
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </button>
                </form>

                <div class="auth-footer">
                    Already have an account? <a href="{{ route('login') }}">Sign In</a>
                </div>

            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
function togglePass(id, btn) {
    const input = document.getElementById(id);
    const eye   = document.getElementById('eye-' + id);
    const show  = input.type === 'password';
    input.type  = show ? 'text' : 'password';
    btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
    if (eye) {
        eye.innerHTML = show
            ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>`
            : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
    }
}
</script>
@endpush
@endsection
