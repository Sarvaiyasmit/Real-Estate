@extends('layouts.app')

@section('title', 'My Profile — VELORA HOMES')
@section('meta_description', 'View and manage your VELORA HOMES profile.')
@section('nav_class', 'nav-light')

@push('styles')
    <link rel="stylesheet" href="/css/profile.css">
@endpush

@section('content')
<section class="profile-page">
    <div class="container">
        <header class="profile-page-header">
            <span class="label-small">Your Client Account</span>
            <h1 class="section-title">My Profile</h1>
        </header>

        <div class="profile-grid">
            @include('profile.partials.sidebar', ['activeSection' => 'overview'])

            <section class="profile-card profile-details-card">
                <div class="profile-card-header">
                    <h2 class="profile-card-title">Personal details</h2>
                    <a href="{{ route('profile.edit') }}" class="profile-btn-ghost">Edit details</a>
                </div>
                <dl class="profile-details-list">
                    <div class="profile-detail-row">
                        <dt class="profile-info-label">Full name</dt>
                        <dd class="profile-info-value">{{ $user->name }}</dd>
                    </div>
                    <div class="profile-detail-row">
                        <dt class="profile-info-label">Username</dt>
                        <dd class="profile-info-value {{ $user->username ? '' : 'muted' }}">{{ $user->username ? '@'.$user->username : 'Not set' }}</dd>
                    </div>
                    <div class="profile-detail-row">
                        <dt class="profile-info-label">Email address</dt>
                        <dd class="profile-info-value">{{ $user->email }}</dd>
                    </div>
                    <div class="profile-detail-row">
                        <dt class="profile-info-label">Phone number</dt>
                        <dd class="profile-info-value {{ $user->phone ? '' : 'muted' }}">{{ $user->phone ?: 'Not set' }}</dd>
                    </div>
                    <div class="profile-detail-row">
                        <dt class="profile-info-label">City</dt>
                        <dd class="profile-info-value {{ $user->city ? '' : 'muted' }}">{{ $user->city ?: 'Not set' }}</dd>
                    </div>
                    <div class="profile-detail-row">
                        <dt class="profile-info-label">Occupation</dt>
                        <dd class="profile-info-value {{ $user->occupation ? '' : 'muted' }}">{{ $user->occupation ?: 'Not set' }}</dd>
                    </div>
                    <div class="profile-detail-row">
                        <dt class="profile-info-label">About me</dt>
                        <dd class="profile-info-value {{ $user->bio ? 'profile-bio-text' : 'muted' }}">{{ $user->bio ?: 'Not set' }}</dd>
                    </div>
                    <div class="profile-detail-row">
                        <dt class="profile-info-label">Member since</dt>
                        <dd class="profile-info-value">{{ $user->created_at->format('F Y') }}</dd>
                    </div>
                </dl>
            </section>
        </div>
    </div>
</section>
@endsection
