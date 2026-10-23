<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use RuntimeException;

class ProfileController extends Controller
{
    /**
     * Show the user's profile page.
     */
    public function show(): View
    {
        return view('profile.show', ['user' => Auth::user()]);
    }

    /**
     * Show the profile edit form.
     */
    public function edit(): View
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    /**
     * Update profile details.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:30', 'alpha_dash', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:100'],
            'occupation' => ['nullable', 'string', 'max:100'],
        ]);

        $user->update($validated);

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Upload / change avatar.
     */
    public function updateAvatar(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $user = Auth::user();

        $oldAvatar = $user->avatar;
        $path = $request->file('avatar')->storePublicly('avatars', 'public');

        if (! $path) {
            throw new RuntimeException('The profile picture could not be saved.');
        }

        $user->update(['avatar' => $path]);

        if ($oldAvatar) {
            Storage::disk('public')->delete($oldAvatar);
        }

        return redirect()->route('profile.show')
            ->with('success', 'Profile picture updated successfully.');
    }

    /**
     * Remove avatar — revert to initials.
     */
    public function removeAvatar(): RedirectResponse
    {
        $user = Auth::user();

        if ($user->avatar) {
            $avatar = $user->avatar;
            $user->update(['avatar' => null]);
            Storage::disk('public')->delete($avatar);
        }

        return redirect()->route('profile.show')
            ->with('success', 'Profile picture removed.');
    }

    /**
     * Show change password form.
     */
    public function editPassword(): View
    {
        return view('profile.password', ['user' => Auth::user()]);
    }

    /**
     * Update password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('profile.show')
            ->with('success', 'Password changed successfully.');
    }
}
