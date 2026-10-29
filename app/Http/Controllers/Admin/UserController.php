<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use App\Models\User;
use App\Models\Notification;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query();

        // Search query across name, email, phone, location
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Role filter
        $role = $request->get('role', 'all');
        if ($role && $role !== 'all') {
            if ($role === 'recent') {
                $query->where('created_at', '>=', now()->subDays(30));
            } else {
                $query->where('role', $role);
            }
        }

        // Sort order
        $sort = $request->get('sort', 'latest');
        if ($sort === 'oldest') {
            $query->oldest();
        } elseif ($sort === 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort === 'name_desc') {
            $query->orderBy('name', 'desc');
        } else {
            $query->latest();
        }

        // Per page
        $perPage = (int) $request->get('per_page', 10);
        if (!in_array($perPage, [5, 10, 20, 50, 100], true)) {
            $perPage = 10;
        }

        $users = $query->paginate($perPage)->withQueryString();

        // Metric counts for top 4 cards
        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $regularCount = User::where('role', '!=', 'admin')->count();
        $recentCount = User::where('created_at', '>=', now()->subDays(30))->count();

        $this->data['users'] = $users;
        $this->data['totalUsers'] = $totalUsers;
        $this->data['adminCount'] = $adminCount;
        $this->data['regularCount'] = $regularCount;
        $this->data['recentCount'] = $recentCount;
        $this->data['perPage'] = $perPage;
        $this->data['search'] = $search;
        $this->data['role'] = $role;
        $this->data['sort'] = $sort;

        return view('admin.users.index', $this->data);
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|unique:users,email|max:150',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:admin,user',
            'phone' => 'nullable|string|max:30',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'user',
            'title' => "User Created: {$user->name}",
            'message' => "User account '{$user->name}' ({$user->email}) was created with role '{$user->role}'.",
            'action_url' => route('admin.users.show', $user->id),
            'icon' => 'user',
            'color' => 'cyan',
        ]);

        flash()->success('User created successfully.');

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified user's profile and details.
     */
    public function show(User $user): View
    {
        $this->data['user'] = $user;
        return view('admin.users.show', $this->data);
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user): View
    {
        $this->data['user'] = $user;
        return view('admin.users.edit', $this->data);
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:150|unique:users,email,' . $user->id,
            'role' => 'required|string|in:admin,user',
            'phone' => 'nullable|string|max:30',
            'location' => 'nullable|string|max:150',
            'bio' => 'nullable|string|max:1000',
            'password' => 'nullable|string|min:6|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        // Prevent an administrator from demoting their own active session
        if ($user->id === Auth::id() && $validated['role'] !== 'admin') {
            $validated['role'] = 'admin';
        }

        if ($request->hasFile('avatar')) {
            $uploadedAvatar = uploadFile($request->file('avatar'), 'uploads/avatars', 'avatar_' . $user->id);
            if ($uploadedAvatar) {
                $validated['avatar'] = $uploadedAvatar;
            }
        }

        $oldRole = $user->role;
        $passwordChanged = !empty($validated['password']);
        if ($passwordChanged) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        $changes = [];
        if ($oldRole !== $user->role) {
            $changes[] = "role changed to '{$user->role}'";
        }
        if ($passwordChanged) {
            $changes[] = "password reset";
        }
        $detailMsg = !empty($changes) ? " (" . implode(', ', $changes) . ")" : "";

        if ($user->id !== Auth::id()) {
            Notification::record([
                'user_id' => $user->id,
                'type' => $passwordChanged ? 'auth' : 'user',
                'title' => $passwordChanged ? 'Account Security Updated' : 'Profile Updated by Admin',
                'message' => "Your account information was updated by administrator " . Auth::user()->name . "{$detailMsg}.",
                'action_url' => $user->isAdmin() ? route('admin.account') : (route('user.dashboard') ?: route('admin.account')),
                'icon' => $passwordChanged ? 'check' : 'user',
                'color' => $passwordChanged ? 'amber' : 'cyan',
            ]);
        } else {
            Notification::record([
                'user_id' => Auth::id(),
                'type' => 'user',
                'title' => "User Updated: {$user->name}",
                'message' => "User account '{$user->name}' ({$user->email}) was updated{$detailMsg}.",
                'action_url' => route('admin.users.show', $user->id),
                'icon' => 'user',
                'color' => 'cyan',
            ]);
        }

        flash()->success("User [{$user->name}] updated successfully.");

        return redirect()->route('admin.users.index');
    }

    public function toggleRole(User $user): RedirectResponse
    {
        if ($user->id === Auth::id()) {
            flash()->danger('You cannot change your own role.');

            return redirect()->back();
        }

        $oldRole = $user->role;
        $newRole = $user->role === 'admin' ? 'user' : 'admin';
        $user->update(['role' => $newRole]);

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'user',
            'title' => "User Role Changed: {$user->name}",
            'message' => "Role for '{$user->name}' was changed from '{$oldRole}' to '{$newRole}'.",
            'action_url' => route('admin.users.show', $user->id),
            'icon' => 'user',
            'color' => 'cyan',
        ]);

        flash()->success("User role changed to {$newRole}.");

        return redirect()->back();
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === Auth::id()) {
            flash()->danger('You cannot delete yourself.');

            return redirect()->back();
        }

        $userName = $user->name;
        $userEmail = $user->email;
        $user->delete();

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'user',
            'title' => "User Deleted: {$userName}",
            'message' => "User account '{$userName}' ({$userEmail}) was deleted.",
            'action_url' => route('admin.users.index'),
            'icon' => 'user',
            'color' => 'rose',
        ]);

        flash()->delete('User deleted successfully.');

        return redirect()->route('admin.users.index');
    }

    /**
     * Show admin profile overview page.
     */
    public function profile(): View
    {
        $user = Auth::user();
        $this->data['user'] = $user;
        $this->data['cvFile'] = SiteSetting::get('resume_pdf_file');
        $this->data['cvName'] = SiteSetting::get('resume_pdf_name', 'resume.pdf');
        $this->data['cvSize'] = SiteSetting::get('resume_pdf_size');
        $this->data['cvUpdatedAt'] = SiteSetting::get('resume_pdf_updated_at');

        // Overview Statistics
        $this->data['stats'] = [
            'projects' => Project::count(),
            'blogs' => BlogPost::count(),
            'services' => Service::count(),
            'skills' => Skill::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
        ];

        // Active Theme & Color Inspiration
        $activeTheme = SiteSetting::getActiveTheme();
        $availableThemes = SiteSetting::getAvailableThemes();
        $themeMeta = $availableThemes[$activeTheme] ?? ($availableThemes['developer'] ?? [
            'name' => 'Developer',
            'color' => '#00ff88',
        ]);

        $themeColor = $themeMeta['color'] ?? '#ff0033';
        $themeName = $themeMeta['name'] ?? ucfirst($activeTheme);

        $themeGradients = [
            'developer' => 'linear-gradient(135deg, #022c22 0%, #064e3b 40%, #09101d 100%)',
            'app_developer' => 'linear-gradient(135deg, #450a0a 0%, #7f1d1d 40%, #09101d 100%)',
            'graphic_designer' => 'linear-gradient(135deg, #2e1065 0%, #4c1d95 40%, #09101d 100%)',
            'uiux_designer' => 'linear-gradient(135deg, #1a2e05 0%, #365314 40%, #09101d 100%)',
            'app_software_developer' => 'linear-gradient(135deg, #431407 0%, #7c2d12 40%, #09101d 100%)',
            'digital_designer_illustrator' => 'linear-gradient(135deg, #4c0519 0%, #831843 40%, #09101d 100%)',
        ];

        $this->data['activeTheme'] = $activeTheme;
        $this->data['themeColor'] = $themeColor;
        $this->data['themeName'] = $themeName;
        $this->data['themeGradient'] = $themeGradients[$activeTheme] ?? 'linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #09101d 100%)';

        return view('admin.profile.show', $this->data);
    }

    /**
     * Show admin account settings page.
     */
    public function account(): View
    {
        $this->data['user'] = Auth::user();
        $this->data['cvFile'] = SiteSetting::get('resume_pdf_file');
        $this->data['cvName'] = SiteSetting::get('resume_pdf_name', 'resume.pdf');
        $this->data['cvSize'] = SiteSetting::get('resume_pdf_size');
        $this->data['cvUpdatedAt'] = SiteSetting::get('resume_pdf_updated_at');

        return view('admin.account.index', $this->data);
    }

    /**
     * Update admin account profile details.
     */
    public function updateAccountProfile(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:150|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:30',
            'location' => 'nullable|string|max:150',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $uploadedAvatar = uploadFile($request->file('avatar'), 'uploads/avatars', 'avatar_' . $user->id);
            if ($uploadedAvatar) {
                $validated['avatar'] = $uploadedAvatar;
            }
        }

        $user->update($validated);

        Notification::record([
            'user_id' => $user->id,
            'type' => 'user',
            'title' => 'Profile Updated Successfully',
            'message' => "Your personal account profile details ({$user->email}) were updated successfully.",
            'action_url' => route('admin.account'),
            'icon' => 'user',
            'color' => 'cyan',
        ]);

        flash()->success('Account profile details updated successfully.');

        return back();
    }

    /**
     * Update admin account password.
     */
    public function updateAccountPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match our records.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        Notification::record([
            'user_id' => $user->id,
            'type' => 'auth',
            'title' => 'Password Changed Successfully',
            'message' => 'Your account security password was changed successfully.',
            'action_url' => route('admin.account'),
            'icon' => 'check',
            'color' => 'emerald',
        ]);

        flash()->important('Account password changed successfully.');

        return back();
    }
}
