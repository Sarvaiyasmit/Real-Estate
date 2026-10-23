<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserAdminController extends Controller
{
    public function index(): View
    {
        $users = User::latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function toggleAdmin(User $user): RedirectResponse
    {
        // Prevent removing own admin rights
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own admin status.');
        }

        $user->update(['is_admin' => ! $user->is_admin]);

        $action = $user->is_admin ? 'granted admin rights' : 'revoked admin rights';

        return back()->with('success', "User {$user->name} has been {$action}.");
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account here.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
