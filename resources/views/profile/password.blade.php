<div>
    <!-- We must ship. - Taylor Otwell -->
</div>
@extends('layouts.app')

@section('title', 'Password & Security — VELORA HOMES')
@section('meta_description', 'Change your VELORA HOMES account password.')
@section('nav_class', 'nav-light')

@push('styles')
    <link rel="stylesheet" href="/css/profile.css">
@endpush

@section('content')
<section class="profile-page">
    <div class="container">
        <header class="profile-page-header">
            <span class="label-small">Your Client Account</span>
            <h1 class="section-title">Password &amp; Security</h1>
            <p>Choose a strong password to keep your account secure.</p>
        </header>

        <div class="profile-grid">
            @include('profile.partials.sidebar', ['activeSection' => 'password'])

            <div class="profile-main">
                <section class="profile-card">
                    <div class="profile-card-header">
                        <h2 class="profile-card-title">Change password</h2>
                    </div>
                    <form method="POST" action="{{ route('profile.password.update') }}" class="profile-form">
                        @csrf
                        @method('PUT')

                        <div class="profile-form-group">
                            <label for="current_password" class="profile-form-label">Current password</label>
                            <input id="current_password" name="current_password" type="password" autocomplete="current-password"
                                   class="profile-form-input @error('current_password') is-invalid @enderror"
                                   required aria-describedby="@error('current_password') current-password-error @enderror">
                            @error('current_password')
                                <span id="current-password-error" class="profile-form-error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="profile-form-row">
                            <div class="profile-form-group">
                                <label for="password" class="profile-form-label">New password</label>
                                <input id="password" name="password" type="password" autocomplete="new-password"
                                       class="profile-form-input @error('password') is-invalid @enderror"
                                       required aria-describedby="password-hint @error('password') password-error @enderror">
                                <span id="password-hint" class="profile-form-hint">Use at least 8 characters.</span>
                                @error('password')
                                    <span id="password-error" class="profile-form-error" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="profile-form-group">
                                <label for="password_confirmation" class="profile-form-label">Confirm new password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                                       class="profile-form-input" required>
                            </div>
                        </div>

                        <div class="profile-form-actions">
                            <button type="submit" class="profile-btn-primary">Update password</button>
                            <a href="{{ route('profile.show') }}" class="profile-btn-ghost">Cancel</a>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</section>
@endsection
