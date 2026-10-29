<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show frontend user dashboard.
     */
    public function index(): View
    {
        $user = Auth::user();

        // Find messages sent with this user's email
        $myMessages = ContactMessage::where('email', $user->email)
            ->latest()
            ->get();

        $this->data['user'] = $user;
        $this->data['myMessages'] = $myMessages;

        return view('user.dashboard', $this->data);
    }

    /**
     * Update user profile.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'phone' => 'nullable|string|max:30',
            'location' => 'nullable|string|max:150',
            'bio' => 'nullable|string|max:1000',
        ]);

        $user->update($validated);

        flash()->success('Profile updated successfully.');

        return back();
    }

    /**
     * Update user password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (! Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        flash()->success('Password updated successfully.');

        return back();
    }
}
