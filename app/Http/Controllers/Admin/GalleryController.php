<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Notification;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display a listing of gallery photos.
     */
    public function index(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->query('theme', $activeTheme);
        $themes = SiteSetting::getAvailableThemes();

        $galleries = Gallery::query()->orderBy('sort_order')->orderByDesc('id')->get();

        // Compute categories per theme so only relevant categories are shown for the selected theme
        $themeCategories = [];
        foreach (array_keys($themes) as $themeKey) {
            $themeCategories[$themeKey] = Gallery::whereIn('theme', [$themeKey, 'all'])
                ->pluck('category')
                ->map(fn($c) => trim($c))
                ->filter()
                ->unique()
                ->values();
        }
        $themeCategories['everything'] = Gallery::pluck('category')
            ->map(fn($c) => trim($c))
            ->filter()
            ->unique()
            ->values();
        $themeCategories['all'] = Gallery::where('theme', 'all')
            ->pluck('category')
            ->map(fn($c) => trim($c))
            ->filter()
            ->unique()
            ->values();

        $this->data['galleries'] = $galleries;
        $this->data['themeCategories'] = $themeCategories;
        $this->data['activeTheme'] = $activeTheme;
        $this->data['selectedTheme'] = $selectedTheme;
        $this->data['themes'] = $themes;

        return view('admin.galleries.index', $this->data);
    }

    /**
     * Show the form for creating a new gallery photo.
     */
    public function create(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->query('theme', $activeTheme);

        $categories = Gallery::getCategories();
        $quickCategories = Gallery::getQuickCategories();

        $this->data['selectedTheme'] = $selectedTheme;
        $this->data['activeTheme'] = $activeTheme;
        $this->data['categories'] = $categories;
        $this->data['quickCategories'] = $quickCategories;

        return view('admin.galleries.create', $this->data);
    }

    /**
     * Store a newly created gallery photo in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:180',
            'category'    => 'required|string|max:80',
            'theme'       => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator,laravel_developer',
            'image_file'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:10240',
            'image_url'   => 'nullable|string|max:500',
            'is_featured' => 'nullable|boolean',
            'is_active'   => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active']   = $request->boolean('is_active', true);
        if (!$request->filled('sort_order')) {
            unset($validated['sort_order']);
        }

        // Handle Image Upload
        if ($request->hasFile('image_file')) {
            $uploadedPath = uploadFile($request->file('image_file'), 'uploads/galleries', 'gallery');
            if ($uploadedPath) {
                $validated['image_url'] = $uploadedPath;
            }
        }

        if (empty($validated['image_url'])) {
            return back()->withErrors(['image_file' => 'Please upload a photo or provide an image URL.'])->withInput();
        }

        unset($validated['image_file']);

        $gallery = Gallery::create($validated);

        Notification::record([
            'user_id'    => Auth::id(),
            'type'       => 'gallery',
            'title'      => "Gallery Photo Added: {$gallery->title}",
            'message'    => "New photo '{$gallery->title}' ({$gallery->category}) was added to gallery.",
            'action_url' => route('admin.galleries.edit', $gallery->id),
            'icon'       => 'camera',
            'color'      => 'cyan',
        ]);

        flash()->success('Gallery photo added successfully.');

        return redirect()->route('admin.galleries.index');
    }

    /**
     * Show the form for editing the specified gallery photo.
     */
    public function edit(Gallery $gallery): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $categories = Gallery::getCategories();
        $quickCategories = Gallery::getQuickCategories();

        $this->data['gallery'] = $gallery;
        $this->data['activeTheme'] = $activeTheme;
        $this->data['categories'] = $categories;
        $this->data['quickCategories'] = $quickCategories;

        return view('admin.galleries.edit', $this->data);
    }

    /**
     * Update the specified gallery photo in storage.
     */
    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:180',
            'category'    => 'required|string|max:80',
            'theme'       => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator,laravel_developer',
            'image_file'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:10240',
            'image_url'   => 'nullable|string|max:500',
            'is_featured' => 'nullable|boolean',
            'is_active'   => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active']   = $request->boolean('is_active');
        if (!$request->filled('sort_order')) {
            unset($validated['sort_order']);
        }

        // Handle Image Upload Replacement
        if ($request->hasFile('image_file')) {
            $uploadedPath = uploadFile($request->file('image_file'), 'uploads/galleries', 'gallery');
            if ($uploadedPath) {
                // Delete previous local upload if exists
                $oldRaw = $gallery->getRawOriginal('image_url');
                if (!empty($oldRaw) && !str_starts_with($oldRaw, 'http') && file_exists(public_path($oldRaw))) {
                    @unlink(public_path($oldRaw));
                }
                $validated['image_url'] = $uploadedPath;
            }
        } elseif (empty($validated['image_url'])) {
            $validated['image_url'] = $gallery->getRawOriginal('image_url');
        }

        unset($validated['image_file']);

        $gallery->update($validated);

        Notification::record([
            'user_id'    => Auth::id(),
            'type'       => 'gallery',
            'title'      => "Gallery Photo Updated: {$gallery->title}",
            'message'    => "Photo '{$gallery->title}' details were updated.",
            'action_url' => route('admin.galleries.edit', $gallery->id),
            'icon'       => 'camera',
            'color'      => 'cyan',
        ]);

        flash()->success('Gallery photo updated successfully.');

        return redirect()->route('admin.galleries.index');
    }

    /**
     * Remove the specified gallery photo from storage.
     */
    public function destroy(Gallery $gallery): RedirectResponse
    {
        $title = $gallery->title;
        $oldRaw = $gallery->getRawOriginal('image_url');

        if (!empty($oldRaw) && !str_starts_with($oldRaw, 'http') && file_exists(public_path($oldRaw))) {
            @unlink(public_path($oldRaw));
        }

        $gallery->delete();

        Notification::record([
            'user_id'    => Auth::id(),
            'type'       => 'gallery',
            'title'      => "Gallery Photo Deleted: {$title}",
            'message'    => "Photo '{$title}' was removed from gallery.",
            'action_url' => route('admin.galleries.index'),
            'icon'       => 'trash',
            'color'      => 'rose',
        ]);

        flash()->delete('Gallery photo deleted successfully.');

        return redirect()->route('admin.galleries.index');
    }

    /**
     * Toggle photo active status.
     */
    public function toggleActive(Gallery $gallery): RedirectResponse|JsonResponse
    {
        $gallery->update(['is_active' => ! $gallery->is_active]);

        if (request()->wantsJson()) {
            return response()->json([
                'success'   => true,
                'is_active' => $gallery->is_active,
                'message'   => 'Photo status updated.',
            ]);
        }

        flash()->info($gallery->is_active ? 'Photo published to gallery.' : 'Photo hidden from gallery.');

        return back();
    }

    /**
     * Toggle home page featured status.
     */
    public function toggleFeatured(Gallery $gallery): RedirectResponse|JsonResponse
    {
        $gallery->update(['is_featured' => ! $gallery->is_featured]);

        if (request()->wantsJson()) {
            return response()->json([
                'success'     => true,
                'is_featured' => $gallery->is_featured,
                'message'     => 'Featured status updated.',
            ]);
        }

        flash()->info($gallery->is_featured ? 'Photo featured on home page.' : 'Photo removed from featured.');

        return back();
    }
}
