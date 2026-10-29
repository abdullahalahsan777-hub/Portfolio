<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Default settings redirect to General Settings.
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('admin.settings.general');
    }

    /**
     * 1. General Settings Page
     */
    public function general(): View
    {
        $this->data['settings'] = SiteSetting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.general', $this->data);
    }

    /**
     * Update General Settings (With all fields from Image)
     */
    public function updateGeneral(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => 'nullable|string|max:150',
            'site_title' => 'nullable|string|max:150',
            'site_logo_text' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:250',
            'email' => 'nullable|email|max:120',
            'contact_email' => 'nullable|email|max:120',
            'whatsapp' => 'nullable|string|max:50',
            'phone_one' => 'nullable|string|max:50',
            'phone_two' => 'nullable|string|max:50',
            'contact_phone' => 'nullable|string|max:50',
            'teams' => 'nullable|string|max:100',
            'theme_mode' => 'nullable|string|in:dark,light,system',
            'about_software' => 'nullable|string|max:1000',
        ]);

        // Keep system aliases in sync with new fields
        if (!empty($validated['site_name'])) {
            $validated['site_title'] = $validated['site_name'];
            if (empty($validated['site_logo_text'])) {
                $validated['site_logo_text'] = $validated['site_name'];
            }
        }
        if (!empty($validated['email'])) {
            $validated['contact_email'] = $validated['email'];
        }
        if (!empty($validated['location'])) {
            $validated['contact_location'] = $validated['location'];
        }
        if (!empty($validated['phone_one'])) {
            $validated['contact_phone'] = $validated['phone_one'];
        }

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value, 'general');
        }

        if (!empty($validated['theme_mode'])) {
            session(['user_theme_mode' => $validated['theme_mode']]);
        }

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'settings',
            'title' => 'General Settings Updated',
            'message' => 'Site branding, contact info, and metadata were updated.',
            'action_url' => route('admin.settings.general'),
            'icon' => 'settings',
            'color' => 'indigo',
        ]);

        flash()->success('General settings updated successfully.');

        return redirect()->back();
    }

    /**
     * 2. Theme Settings Page (Separated in its own file)
     */
    public function theme(): View
    {
        $this->data['settings'] = SiteSetting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.theme', $this->data);
    }

    /**
     * Update Active Theme and Theme Mode
     */
    public function updateTheme(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'active_theme' => 'required|string|in:developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'theme_mode' => 'nullable|string|in:dark,light,system',
        ]);

        if (empty($validated['theme_mode'])) {
            $validated['theme_mode'] = 'system';
        }

        SiteSetting::set('active_theme', $validated['active_theme'], 'theme');
        SiteSetting::set('theme_mode', $validated['theme_mode'], 'theme');

        session([
            'user_theme' => $validated['active_theme'],
            'user_theme_mode' => $validated['theme_mode'],
        ]);

        $themeTitle = ucfirst(str_replace('_', ' ', $validated['active_theme']));
        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'settings',
            'title' => 'Theme Settings Changed',
            'message' => "Active portfolio theme switched to '{$themeTitle}' in {$validated['theme_mode']} mode.",
            'action_url' => route('admin.settings.theme'),
            'icon' => 'settings',
            'color' => 'purple',
        ]);

        flash()->success('Theme settings updated and applied successfully.');

        return redirect()->back();
    }

    /**
     * 3. Image Upload Settings Page (Software Logo, Favicon, Mini Logo, Placeholder)
     */
    public function images(): View
    {
        $this->data['settings'] = SiteSetting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.images', $this->data);
    }

    /**
     * Process Image Uploads
     */
    public function updateImages(Request $request): RedirectResponse
    {
        $request->validate([
            'software_logo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'site_favicon' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,ico|max:2048',
            'mini_logo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'site_placeholder' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'two_word_logo_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
            'logo_word_one' => 'nullable|string|max:50',
            'logo_word_two' => 'nullable|string|max:50',
        ]);

        $uploadPath = public_path('uploads/settings');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        $imageFields = [
            'software_logo' => 'logo',
            'site_favicon' => 'favicon',
            'mini_logo' => 'mini',
            'site_placeholder' => 'placeholder',
            'two_word_logo_image' => 'two_word_logo',
        ];

        $uploadedCount = 0;
        $textUpdated = false;

        foreach ($imageFields as $field => $prefix) {
            if ($request->hasFile($field)) {
                $uploadedPath = uploadFile($request->file($field), 'uploads/settings', $prefix);
                if ($uploadedPath) {
                    SiteSetting::set($field, $uploadedPath, 'images');
                    $uploadedCount++;
                }
            }
        }

        // Handle Two-Word Logo Text inputs
        if ($request->has('logo_word_one') || $request->has('logo_word_two')) {
            $wordOne = trim((string) $request->input('logo_word_one', ''));
            $wordTwo = trim((string) $request->input('logo_word_two', ''));

            SiteSetting::set('logo_word_one', $wordOne, 'images');
            SiteSetting::set('logo_word_two', $wordTwo, 'images');

            // Keep site_logo_text synchronized
            $combined = trim("{$wordOne} {$wordTwo}");
            if (!empty($combined)) {
                SiteSetting::set('site_logo_text', $combined, 'general');
            }
            $textUpdated = true;
        }

        if ($uploadedCount === 0 && !$textUpdated) {
            flash()->info('No changes were made. Current image assets preserved.');

            return redirect()->back();
        }

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'settings',
            'title' => 'Brand & Asset Images Updated',
            'message' => $uploadedCount > 0
                ? "{$uploadedCount} brand media asset(s) and logo settings were updated."
                : 'Website two-word logo was updated successfully.',
            'action_url' => route('admin.settings.images'),
            'icon' => 'settings',
            'color' => 'emerald',
        ]);

        flash()->success('Brand logo & image assets updated successfully.');

        return redirect()->back();
    }

    /**
     * 4. Social Media Settings Page (Matching 3rd Image)
     */
    public function social(): View
    {
        $this->data['settings'] = SiteSetting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.social', $this->data);
    }

    /**
     * Update Social Media Links
     */
    public function updateSocial(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'social_facebook' => 'nullable|string|max:255',
            'social_instagram' => 'nullable|string|max:255',
            'social_linkedin' => 'nullable|string|max:255',
            'social_pinterest' => 'nullable|string|max:255',
            'social_tiktok' => 'nullable|string|max:255',
            'social_youtube' => 'nullable|string|max:255',
            'social_github' => 'nullable|string|max:255',
            'social_twitter' => 'nullable|string|max:255',
            'social_dribbble' => 'nullable|string|max:255',
            'social_behance' => 'nullable|string|max:255',
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value, 'social');
        }

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'settings',
            'title' => 'Social Links Updated',
            'message' => 'Social profiles and external channel links were updated.',
            'action_url' => route('admin.settings.social'),
            'icon' => 'settings',
            'color' => 'amber',
        ]);

        flash()->success('Social media links saved successfully.');

        return redirect()->back();
    }

    /**
     * Legacy / Direct Update Handler for backwards compatibility
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'active_theme' => 'nullable|string|in:developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'theme_mode' => 'nullable|string|in:dark,light,system',
            'site_title' => 'nullable|string|max:150',
            'site_logo_text' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email|max:120',
            'contact_phone' => 'nullable|string|max:50',
            'contact_location' => 'nullable|string|max:200',
        ]);

        foreach ($validated as $key => $value) {
            if ($value !== null) {
                SiteSetting::set($key, $value, 'settings');
            }
        }

        if (!empty($validated['active_theme'])) {
            session(['user_theme' => $validated['active_theme']]);
        }
        if (!empty($validated['theme_mode'])) {
            session(['user_theme_mode' => $validated['theme_mode']]);
        }

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'settings',
            'title' => 'Settings Updated',
            'message' => 'System settings and configurations were updated.',
            'action_url' => route('admin.settings.general'),
            'icon' => 'settings',
            'color' => 'indigo',
        ]);

        flash()->success('Settings updated successfully.');

        return redirect()->back();
    }
}
