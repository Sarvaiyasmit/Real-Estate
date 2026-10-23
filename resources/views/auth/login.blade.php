@extends('layouts.app')

@section('title', 'Sign In — VELORA HOMES')
@section('meta_description', 'Sign in to your VELORA HOMES account to view saved homes, valuation reports, and contact advisors.')
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
            <p class="auth-brand-line">Unlocking Gujarat's finest<br>private residences.</p>
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
                    <span class="auth-kicker">Client Portal</span>
                    <h1 class="auth-title">Welcome Back</h1>
                    <p class="auth-desc">Sign in to access saved estates, valuation reports, and site visit bookings.</p>
                </div>

                {{-- Google --}}
                <div class="social-auth">
                    <button type="button" class="btn-google" onclick="alert('Google sign-in coming soon.')">
                        <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        Continue with Google
                    </button>
                </div>

                <div class="auth-divider">
                    <span class="auth-divider-line"></span>
                    <span class="auth-divider-text">Or sign in with email</span>
                    <span class="auth-divider-line"></span>
                </div>

                @if($errors->any())
                    <div class="auth-error-banner" role="alert">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}" class="auth-form" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-container">
                            <input id="email" name="email" type="email"
                                   class="form-input @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}"
                                   placeholder="you@domain.com"
                                   required autofocus autocomplete="email">
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
                                   placeholder="Your password"
                                   required autocomplete="current-password">
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

                    <div class="remember-row">
                        <label class="remember-checkbox">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="forgot-link">Forgot password?</a>
                    </div>

                    <button type="submit" class="auth-submit-btn">
                        Access Portal
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </button>
                </form>

                <div class="auth-footer">
                    Don't have an account? <a href="{{ route('register') }}">Create an account</a>
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
