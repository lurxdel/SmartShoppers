<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Purchase;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $user = $request->user();
        $validated = $request->validated();
        
        $user-> fill($validated);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && \Storage::disk('public')->exists($user->avatar)) {
                \Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath; 
        }


        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    } 

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function accounts(): View
    {
        // Only show non-admins if preferred
        $users = \App\Models\User::paginate(3); 

        return view('admin.accounts.index', compact('users'));
        
    }

    public function destroyUser(\App\Models\User $user)
    {
        // Optional: prevent deleting self or other admins
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        if ($user->role === 'admin') {
            return back()->with('error', 'Cannot delete another admin account.');
        }

        // Delete avatar if exists
        if ($user->avatar && \Storage::disk('public')->exists($user->avatar)) {
            \Storage::disk('public')->delete($user->avatar);
        }

        // Delete related purchases first to avoid foreign key constraint error
        $user->purchases()->delete();

        // Now delete the user
        $user->delete();

        return back()->with('status', 'User deleted successfully.');
    }

    public function approval()
    {
        $pendingUsers = User::where('is_approved', false)->paginate(5);
        return view('admin.accounts.approval', compact('pendingUsers'));
    }

    public function approveUser(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string|in:staff,user',
        ]);

        $user->update([
            'is_approved' => true,
            'role' => $request->role,
        ]);

        return redirect()->route('accounts.approval')->with('status', 'User approved and role assigned.');
    }


}