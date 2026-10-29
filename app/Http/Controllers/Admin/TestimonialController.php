<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->query('theme', $activeTheme);

        $testimonials = Testimonial::orderBy('sort_order')->get();

        $this->data['testimonials'] = $testimonials;
        $this->data['activeTheme'] = $activeTheme;
        $this->data['selectedTheme'] = $selectedTheme;

        return view('admin.testimonials.index', $this->data);
    }

    public function create(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->query('theme', $activeTheme);
        $this->data['selectedTheme'] = $selectedTheme;

        return view('admin.testimonials.create', $this->data);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:120',
            'client_role' => 'required|string|max:120',
            'company' => 'nullable|string|max:120',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'avatar' => 'nullable|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string',
            'theme' => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('avatar_file')) {
            $uploadedPath = uploadFile($request->file('avatar_file'), 'uploads/testimonials', 'testimonial');
            if ($uploadedPath) {
                $validated['avatar'] = $uploadedPath;
            }
        }

        $testimonial = Testimonial::create($validated);
        $company = $testimonial->company ? " ({$testimonial->company})" : "";

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'testimonial',
            'title' => "Testimonial Created: {$testimonial->client_name}",
            'message' => "Testimonial from '{$testimonial->client_name}'{$company} was added.",
            'action_url' => route('admin.testimonials.edit', $testimonial->id),
            'icon' => 'user',
            'color' => 'amber',
        ]);

        flash()->success('Testimonial created successfully.');

        return redirect()->route('admin.testimonials.index');
    }

    public function edit(Testimonial $testimonial): View
    {
        $this->data['testimonial'] = $testimonial;

        return view('admin.testimonials.edit', $this->data);
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:120',
            'client_role' => 'required|string|max:120',
            'company' => 'nullable|string|max:120',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'avatar' => 'nullable|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string',
            'theme' => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('avatar_file')) {
            $uploadedPath = uploadFile($request->file('avatar_file'), 'uploads/testimonials', 'testimonial');
            if ($uploadedPath) {
                $oldAvatar = $testimonial->getRawOriginal('avatar');
                if (!empty($oldAvatar) && !str_starts_with($oldAvatar, 'http') && file_exists(public_path($oldAvatar))) {
                    @unlink(public_path($oldAvatar));
                }
                $validated['avatar'] = $uploadedPath;
            }
        }

        $testimonial->update($validated);
        $company = $testimonial->company ? " ({$testimonial->company})" : "";

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'testimonial',
            'title' => "Testimonial Updated: {$testimonial->client_name}",
            'message' => "Testimonial for '{$testimonial->client_name}'{$company} was modified.",
            'action_url' => route('admin.testimonials.edit', $testimonial->id),
            'icon' => 'user',
            'color' => 'amber',
        ]);

        flash()->success('Testimonial updated successfully.');

        return redirect()->route('admin.testimonials.index');
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $clientName = $testimonial->client_name;
        $oldAvatar = $testimonial->getRawOriginal('avatar');
        if (!empty($oldAvatar) && !str_starts_with($oldAvatar, 'http') && file_exists(public_path($oldAvatar))) {
            @unlink(public_path($oldAvatar));
        }

        $testimonial->delete();

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'testimonial',
            'title' => "Testimonial Deleted: {$clientName}",
            'message' => "Testimonial from '{$clientName}' was removed.",
            'action_url' => route('admin.testimonials.index'),
            'icon' => 'user',
            'color' => 'rose',
        ]);

        flash()->delete('Testimonial deleted successfully.');

        return redirect()->route('admin.testimonials.index');
    }
}
