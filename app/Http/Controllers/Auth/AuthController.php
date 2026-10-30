<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Notification;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Laravel\Socialite\Socialite;

class AuthController extends Controller
{
    /**
     * Show login form.
     */
    public function showLogin(): View|RedirectResponse
    {
        $isMaintenance = SiteSetting::get('maintenance_mode', '0') === '1'
            || SiteSetting::get('server_status', 'up') === 'maintenance';

        if (Auth::check()) {
            /** @var User|null $user */
            $user = Auth::user();
            if ($user instanceof User && $user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            if ($isMaintenance) {
                Auth::logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();

                return view('auth.login', [
                    'isMaintenance' => $isMaintenance,
                ])->withErrors([
                    'email' => 'Client portal is currently offline for server upgrade. Only administrators can sign in at this time.',
                ]);
            }

            return redirect()->route('admin.dashboard');
        }

        $this->data['isMaintenance'] = $isMaintenance;
        $this->data['settings'] = SiteSetting::all()->pluck('value', 'key')->toArray();
        $this->data['themeMode'] = SiteSetting::get('theme_mode', 'system');

        return view('auth.login', $this->data);
    }

    /**
     * Process login request.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            Notification::record([
                'user_id' => Auth::id(),
                'type' => 'auth',
                'title' => 'Login Activity',
                'message' => 'Signed into dashboard from IP ' . $request->ip(),
                'action_url' => route('admin.account'),
                'icon' => 'user',
                'color' => 'indigo',
            ]);

            /** @var User|null $user */
            $user = Auth::user();
            if ($user instanceof User && $user->isAdmin()) {
                flash()->info('Welcome back, Admin!');

                return redirect()->intended(route('admin.dashboard'));
            }

            $isMaintenance = SiteSetting::get('maintenance_mode', '0') === '1'
                || SiteSetting::get('server_status', 'up') === 'maintenance';

            if ($isMaintenance) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->withErrors([
                    'email' => 'The Client Portal is currently paused for server infrastructure upgrades. Only administrators can access the system at this time.',
                ]);
            }

            flash()->info('Welcome back!');

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show registration form.
     */
    public function showRegister(): View|RedirectResponse
    {
        $isMaintenance = SiteSetting::get('maintenance_mode', '0') === '1'
            || SiteSetting::get('server_status', 'up') === 'maintenance';

        if ($isMaintenance) {
            return redirect()->route('login')->withErrors([
                'email' => 'New client registrations are temporarily paused during server upgrades. Please check back shortly.',
            ]);
        }

        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }

        return view('auth.register');
    }

    /**
     * Process registration request.
     */
    public function register(Request $request): RedirectResponse
    {
        $isMaintenance = SiteSetting::get('maintenance_mode', '0') === '1'
            || SiteSetting::get('server_status', 'up') === 'maintenance';

        if ($isMaintenance) {
            return redirect()->route('login')->withErrors([
                'email' => 'Registration is currently disabled during maintenance mode.',
            ]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|unique:users,email|max:150',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:30',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'role' => 'user', // Default registered users are regular frontend users
        ]);

        // Notification for Admins
        Notification::record([
            'user_id' => null,
            'type' => 'user',
            'title' => 'New User Registered',
            'message' => "User '{$user->name}' ({$user->email}) created an account as {$user->role}.",
            'action_url' => route('admin.users.show', $user->id),
            'icon' => 'user',
            'color' => 'cyan',
        ]);

        // Welcome notification for the new user
        Notification::record([
            'user_id' => $user->id,
            'type' => 'user',
            'title' => 'Welcome to Portfolio Studio!',
            'message' => 'Your account was created successfully. Explore your dashboard and account settings.',
            'action_url' => route('user.dashboard'),
            'icon' => 'check',
            'color' => 'emerald',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        flash()->success('Your account has been created successfully!');

        return redirect()->route('user.dashboard');
    }

    /**
     * Log user out.
     */
    public function logout(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if ($user) {
            Notification::record([
                'user_id' => $user->id,
                'type' => 'auth',
                'title' => 'Logout Activity',
                'message' => "User account '{$user->name}' signed out of the session.",
                'action_url' => route('login'),
                'icon' => 'user',
                'color' => 'slate',
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        flash()->info('You have been logged out.');

        return redirect('/');
    }

    /**
     * Redirect the user to the OAuth provider authentication page.
     */
    public function redirectToProvider(string $provider): RedirectResponse
    {
        if (!in_array($provider, ['google', 'facebook'])) {
            return redirect()->route('login')->withErrors([
                'email' => 'Unsupported social login provider.',
            ]);
        }

        try {
            return Socialite::driver($provider)->stateless()->redirect();
        } catch (\Throwable $e) {
            try {
                return Socialite::driver($provider)->redirect();
            } catch (\Throwable $ex) {
                return redirect()->route('login')->withErrors([
                    'email' => 'Unable to connect to ' . ucfirst($provider) . ': ' . $ex->getMessage(),
                ]);
            }
        }
    }

    /**
     * Obtain the user information from the OAuth provider and log them in.
     */
    public function handleProviderCallback(string $provider): RedirectResponse
    {
        if (!in_array($provider, ['google', 'facebook'])) {
            return redirect()->route('login')->withErrors([
                'email' => 'Unsupported social login provider.',
            ]);
        }

        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
        } catch (\Throwable $e) {
            try {
                $socialUser = Socialite::driver($provider)->user();
            } catch (\Throwable $ex) {
                return redirect()->route('login')->withErrors([
                    'email' => 'Social authentication was cancelled or encountered an error. Please try again.',
                ]);
            }
        }

        if (empty($socialUser->getEmail())) {
            return redirect()->route('login')->withErrors([
                'email' => 'Could not retrieve email address from ' . ucfirst($provider) . '. Please ensure email permission is granted.',
            ]);
        }

        // Find existing user by provider_id or email
        $user = User::where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if (!$user) {
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                // Link existing account with social provider
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $user->avatar ?: $socialUser->getAvatar(),
                ]);
            } else {
                // Create a new client account
                $user = User::create([
                    'name' => $socialUser->getName() ?: $socialUser->getNickname() ?: 'Client User',
                    'email' => $socialUser->getEmail(),
                    'password' => null,
                    'role' => 'client',
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                    'email_verified_at' => now(),
                ]);
            }
        }

        // Check maintenance mode
        $isMaintenance = SiteSetting::get('maintenance_mode', '0') === '1'
            || SiteSetting::get('server_status', 'up') === 'maintenance';

        if ($isMaintenance && !$user->isAdmin()) {
            return redirect()->route('login')->withErrors([
                'email' => 'The Client Portal is currently paused for server infrastructure upgrades.',
            ]);
        }

        Auth::login($user, true);
        request()->session()->regenerate();

        Notification::record([
            'user_id' => $user->id,
            'type' => 'auth',
            'title' => 'Social Login Activity',
            'message' => 'Signed in via ' . ucfirst($provider) . ' from IP ' . request()->ip(),
            'action_url' => route('admin.account'),
            'icon' => 'user',
            'color' => 'indigo',
        ]);

        flash()->success('Signed in successfully via ' . ucfirst($provider) . '!');

        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Show the forgot password form.
     */
    public function showForgotPassword(): View
    {
        $this->data['settings'] = SiteSetting::all()->pluck('value', 'key')->toArray();
        $this->data['themeMode'] = SiteSetting::get('theme_mode', 'system');

        return view('auth.forgot-password', $this->data);
    }

    /**
     * Send password reset link to user's email.
     */
    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            $status = Password::broker()->sendResetLink(
                $request->only('email')
            );

            if ($status === Password::RESET_LINK_SENT) {
                $user = User::where('email', $request->email)->first();
                if ($user) {
                    Notification::record([
                        'user_id' => $user->id,
                        'type' => 'auth',
                        'title' => 'Password Reset Requested',
                        'message' => 'A password reset link was sent to ' . $request->email,
                        'action_url' => route('admin.account'),
                        'icon' => 'lock',
                        'color' => 'blue',
                    ]);
                }

                flash()->success('A password reset link has been emailed to you. Please check your inbox.');

                return back()->with('status', trans($status));
            }

            flash()->danger(trans($status));

            return back()->withInput($request->only('email'))->withErrors(['email' => trans($status)]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Password reset email error: ' . $e->getMessage());
            flash()->danger('Unable to send password reset email: ' . $e->getMessage());

            return back()->withInput($request->only('email'))->withErrors(['email' => 'Mail delivery error: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the reset password form.
     */
    public function showResetPassword(Request $request, ?string $token = null): View
    {
        $this->data['token'] = $token ?? $request->route('token');
        $this->data['email'] = $request->query('email', old('email'));
        $this->data['settings'] = SiteSetting::all()->pluck('value', 'key')->toArray();
        $this->data['themeMode'] = SiteSetting::get('theme_mode', 'system');

        return view('auth.reset-password', $this->data);
    }

    /**
     * Process password reset submission.
     */
    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new \Illuminate\Auth\Events\PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                Notification::record([
                    'user_id' => $user->id,
                    'type' => 'auth',
                    'title' => 'Password Reset Completed',
                    'message' => 'Your password was successfully reset.',
                    'action_url' => route('admin.account'),
                    'icon' => 'lock',
                    'color' => 'emerald',
                ]);
            }

            flash()->success('Your password has been reset successfully! Please sign in with your new password.');

            return redirect()->route('login')->with('status', trans($status));
        }

        flash()->danger(trans($status));

        return back()->withInput($request->only('email'))->withErrors(['email' => trans($status)]);
    }
}
