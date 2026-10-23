@extends('layouts.app')

@section('title', 'Edit Profile — VELORA HOMES')
@section('meta_description', 'Update your personal details and profile picture.')
@section('nav_class', 'nav-light')

@push('styles')
    <link rel="stylesheet" href="/css/profile.css">
@endpush

@section('content')
<section class="profile-page">
    <div class="container">
        <header class="profile-page-header">
            <span class="label-small">Your Client Account</span>
            <h1 class="section-title">Edit Profile</h1>
            <p>Update your contact information and profile picture.</p>
        </header>

        <div class="profile-grid">
            @include('profile.partials.sidebar', ['activeSection' => 'edit'])

            <div class="profile-main">
                <section class="profile-card">
                    <div class="profile-card-header">
                        <h2 class="profile-card-title">Profile picture</h2>
                    </div>
                    <form method="POST" action="{{ route('profile.avatar') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="avatar-upload-section">
                            <div class="avatar-preview-lg">
                                <div class="avatar-circle" id="avatar-preview-wrap">
                                    <img id="avatar-preview"
                                         src="{{ $user->avatar_url ?? '' }}"
                                         alt="Profile picture preview"
                                         @if(! $user->avatar_url) hidden @endif>
                                    <span id="avatar-initials" class="avatar-initials" @if($user->avatar_url) hidden @endif>{{ $user->initials }}</span>
                                </div>
                            </div>
                            <div class="avatar-upload-info">
                                <h4>Make it yours</h4>
                                <p>Choose a clear profile picture. JPG, PNG, or WEBP up to 2 MB.</p>
                                <label for="avatar" class="avatar-upload-btn">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                    Choose picture
                                </label>
                                <input id="avatar" name="avatar" type="file" class="avatar-file-input" accept="image/jpeg,image/png,image/webp" aria-describedby="avatar-help @error('avatar') avatar-error @enderror">
                                <span id="avatar-filename" class="profile-form-hint" aria-live="polite"></span>
                                <span id="avatar-help" class="profile-form-hint">Your picture is only visible as your account avatar.</span>
                                @error('avatar')
                                    <span id="avatar-error" class="profile-form-error" role="alert">{{ $message }}</span>
                                @enderror
                                <div class="profile-form-actions profile-form-actions-inline">
                                    <button type="submit" class="profile-btn-primary">Save picture</button>
                                    @if($user->avatar)
                                        <button type="submit"
                                                form="remove-avatar-form"
                                                class="avatar-remove-btn"
                                                onclick="return confirm('Remove your profile picture?')">
                                            Remove picture
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                    @if($user->avatar)
                        <form id="remove-avatar-form" method="POST" action="{{ route('profile.avatar.remove') }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                </section>

                <section class="profile-card">
                    <div class="profile-card-header">
                        <h2 class="profile-card-title">Personal details</h2>
                    </div>
                    <form method="POST" action="{{ route('profile.update') }}" class="profile-form">
                        @csrf
                        @method('PUT')

                        <div class="profile-form-row">
                            <div class="profile-form-group">
                                <label for="name" class="profile-form-label">Full name</label>
                                <input id="name" name="name" type="text" maxlength="255" autocomplete="name"
                                       value="{{ old('name', $user->name) }}"
                                       class="profile-form-input @error('name') is-invalid @enderror"
                                       required aria-describedby="@error('name') name-error @enderror">
                                @error('name')
                                    <span id="name-error" class="profile-form-error" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="profile-form-group">
                                <label for="username" class="profile-form-label">Username</label>
                                <input id="username" name="username" type="text" maxlength="30" autocomplete="username"
                                       value="{{ old('username', $user->username) }}"
                                       class="profile-form-input @error('username') is-invalid @enderror"
                                       placeholder="e.g. rajeshpatel"
                                       aria-describedby="username-hint @error('username') username-error @enderror">
                                <span id="username-hint" class="profile-form-hint">Letters, numbers, dashes, and underscores only.</span>
                                @error('username')
                                    <span id="username-error" class="profile-form-error" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="profile-form-group">
                                <label for="email" class="profile-form-label">Email address</label>
                                <input id="email" name="email" type="email" maxlength="255" autocomplete="email"
                                       value="{{ old('email', $user->email) }}"
                                       class="profile-form-input @error('email') is-invalid @enderror"
                                       required aria-describedby="@error('email') email-error @enderror">
                                @error('email')
                                    <span id="email-error" class="profile-form-error" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="profile-form-group">
                                <label for="phone" class="profile-form-label">Phone number</label>
                                <input id="phone" name="phone" type="tel" maxlength="20" autocomplete="tel"
                                       value="{{ old('phone', $user->phone) }}"
                                       class="profile-form-input @error('phone') is-invalid @enderror"
                                       aria-describedby="@error('phone') phone-error @enderror">
                                @error('phone')
                                    <span id="phone-error" class="profile-form-error" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="profile-form-group">
                                <label for="city" class="profile-form-label">City</label>
                                <input id="city" name="city" type="text" maxlength="100" autocomplete="address-level2"
                                       value="{{ old('city', $user->city) }}"
                                       class="profile-form-input @error('city') is-invalid @enderror"
                                       aria-describedby="@error('city') city-error @enderror">
                                @error('city')
                                    <span id="city-error" class="profile-form-error" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="profile-form-group">
                                <label for="occupation" class="profile-form-label">Occupation</label>
                                <input id="occupation" name="occupation" type="text" maxlength="100" autocomplete="organization-title"
                                       value="{{ old('occupation', $user->occupation) }}"
                                       class="profile-form-input @error('occupation') is-invalid @enderror"
                                       aria-describedby="@error('occupation') occupation-error @enderror">
                                @error('occupation')
                                    <span id="occupation-error" class="profile-form-error" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="profile-form-group full">
                                <label for="bio" class="profile-form-label">About you</label>
                                <textarea id="bio" name="bio" maxlength="500" rows="4"
                                          class="profile-form-textarea @error('bio') is-invalid @enderror"
                                          placeholder="Share a little about yourself or the kind of home you are looking for..."
                                          aria-describedby="bio-hint @error('bio') bio-error @enderror">{{ old('bio', $user->bio) }}</textarea>
                                <span id="bio-hint" class="profile-form-hint">Up to 500 characters.</span>
                                @error('bio')
                                    <span id="bio-error" class="profile-form-error" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="profile-form-actions">
                            <button type="submit" class="profile-btn-primary">Save changes</button>
                            <a href="{{ route('profile.show') }}" class="profile-btn-ghost">Cancel</a>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    const avatarInput = document.getElementById('avatar');
    const avatarPreview = document.getElementById('avatar-preview');
    const avatarInitials = document.getElementById('avatar-initials');
    const avatarFilename = document.getElementById('avatar-filename');

    avatarInput.addEventListener('change', () => {
        const [file] = avatarInput.files;
        if (!file) {
            avatarFilename.textContent = '';
            return;
        }

        avatarFilename.textContent = file.name;
        avatarPreview.src = URL.createObjectURL(file);
        avatarPreview.hidden = false;
        avatarInitials.hidden = true;
    });
</script>
@endpush
