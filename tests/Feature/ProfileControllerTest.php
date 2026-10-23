<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_profile(): void
    {
        $response = $this->get(route('profile.show'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_view_profile_pages_and_navigation_avatar(): void
    {
        $user = User::factory()->create(['name' => 'Riya Shah']);

        $this->actingAs($user)
            ->get(route('profile.show'))
            ->assertSee('My Profile')
            ->assertSee('Riya Shah')
            ->assertSee('Personal details');

        $this->get(route('profile.edit'))
            ->assertSee('Profile picture')
            ->assertSee('name="username"', false);

        $this->get(route('profile.password'))
            ->assertSee('Change password');

        $this->get(route('home'))
            ->assertSee(route('profile.show'), false)
            ->assertSee('RS');
    }

    public function test_user_can_update_profile_details(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'name' => 'Riya Shah',
            'username' => 'riya_shah',
            'email' => 'riya@example.com',
            'phone' => '+91 98765 43210',
            'bio' => 'Looking for a peaceful home in Ahmedabad.',
            'city' => 'Ahmedabad',
            'occupation' => 'Architect',
        ]);

        $response->assertRedirect(route('profile.show'));
        $response->assertSessionHas('success', 'Profile updated successfully.');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Riya Shah',
            'username' => 'riya_shah',
            'email' => 'riya@example.com',
            'phone' => '+91 98765 43210',
            'bio' => 'Looking for a peaceful home in Ahmedabad.',
            'city' => 'Ahmedabad',
            'occupation' => 'Architect',
        ]);
    }

    public function test_profile_update_rejects_duplicate_email_and_invalid_username(): void
    {
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'name' => 'Updated Name',
            'username' => 'not a valid username',
            'email' => $anotherUser->email,
        ]);

        $response->assertSessionHasErrors(['email', 'username']);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function test_profile_escapes_user_bio_when_rendered(): void
    {
        $user = User::factory()->create([
            'bio' => '<script>alert("hello")</script>',
        ]);

        $this->actingAs($user)
            ->get(route('profile.show'))
            ->assertSee('<script>alert("hello")</script>')
            ->assertDontSee('<script>alert("hello")</script>', false);
    }

    public function test_user_can_upload_a_new_profile_picture_and_replace_the_old_one(): void
    {
        Storage::fake('public');
        $oldAvatar = 'avatars/old-picture.jpg';
        Storage::disk('public')->put($oldAvatar, 'old picture');

        $user = User::factory()->create(['avatar' => $oldAvatar]);

        $response = $this->actingAs($user)->post(route('profile.avatar'), [
            'avatar' => UploadedFile::fake()->createWithContent(
                'new-picture.png',
                base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII='),
            ),
        ]);

        $response->assertRedirect(route('profile.show'));
        $response->assertSessionHas('success', 'Profile picture updated successfully.');
        $this->assertNotSame($oldAvatar, $user->fresh()->avatar);
        Storage::disk('public')->assertExists($user->fresh()->avatar);
        Storage::disk('public')->assertMissing($oldAvatar);
        $this->get(route('profile.show'))
            ->assertSee($user->fresh()->avatar_url, false);
    }

    public function test_avatar_upload_rejects_non_image_files(): void
    {
        Storage::fake('public');
        $avatar = 'avatars/current-picture.jpg';
        Storage::disk('public')->put($avatar, 'current picture');
        $user = User::factory()->create(['avatar' => $avatar]);

        $response = $this->actingAs($user)->post(route('profile.avatar'), [
            'avatar' => UploadedFile::fake()->create('document.txt', 10, 'text/plain'),
        ]);

        $response->assertSessionHasErrors('avatar');
        $this->assertSame($avatar, $user->fresh()->avatar);
        Storage::disk('public')->assertExists($avatar);
        Storage::disk('public')->assertCount('avatars', 1);
    }

    public function test_user_can_remove_profile_picture(): void
    {
        Storage::fake('public');
        $avatar = 'avatars/profile.jpg';
        Storage::disk('public')->put($avatar, 'profile picture');
        $user = User::factory()->create(['avatar' => $avatar]);

        $response = $this->actingAs($user)->delete(route('profile.avatar.remove'));

        $response->assertRedirect(route('profile.show'));
        $this->assertNull($user->fresh()->avatar);
        Storage::disk('public')->assertMissing($avatar);
    }

    public function test_user_can_change_password_with_the_correct_current_password(): void
    {
        $user = User::factory()->create(['password' => Hash::make('old-password')]);

        $response = $this->actingAs($user)->put(route('profile.password.update'), [
            'current_password' => 'old-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response->assertRedirect(route('profile.show'));
        $response->assertSessionHas('success', 'Password changed successfully.');
        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
    }

    public function test_password_change_rejects_an_incorrect_current_password(): void
    {
        $user = User::factory()->create(['password' => Hash::make('old-password')]);

        $response = $this->actingAs($user)->put(route('profile.password.update'), [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response->assertSessionHasErrors('current_password');
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
    }
}
