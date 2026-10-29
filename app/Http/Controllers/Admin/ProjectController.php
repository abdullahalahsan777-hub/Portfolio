<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Project;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->query('theme', $activeTheme);

        $projects = Project::orderBy('sort_order')->get();

        $this->data['projects'] = $projects;
        $this->data['activeTheme'] = $activeTheme;
        $this->data['selectedTheme'] = $selectedTheme;

        return view('admin.projects.index', $this->data);
    }

    public function create(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->query('theme', $activeTheme);
        $this->data['selectedTheme'] = $selectedTheme;

        return view('admin.projects.create', $this->data);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'category' => 'required|string|max:80',
            'subtitle' => 'nullable|string|max:180',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'image_url' => 'nullable|string|max:500',
            'demo_url' => 'nullable|string|max:500',
            'github_url' => 'nullable|string|max:500',
            'tags' => 'nullable|string|max:250',
            'theme' => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $uploadedPath = uploadFile($request->file('image'), 'uploads/projects', 'project');
            if ($uploadedPath) {
                $validated['image_url'] = $uploadedPath;
            }
        }

        $project = Project::create($validated);

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'project',
            'title' => "Project Created: {$project->title}",
            'message' => "Project '{$project->title}' ({$project->category}) was published.",
            'action_url' => route('admin.projects.edit', $project->id),
            'icon' => 'folder',
            'color' => 'purple',
        ]);

        flash()->success('Project created successfully.');

        return redirect()->route('admin.projects.index');
    }

    public function edit(Project $project): View
    {
        $this->data['project'] = $project;

        return view('admin.projects.edit', $this->data);
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'category' => 'required|string|max:80',
            'subtitle' => 'nullable|string|max:180',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'image_url' => 'nullable|string|max:500',
            'demo_url' => 'nullable|string|max:500',
            'github_url' => 'nullable|string|max:500',
            'tags' => 'nullable|string|max:250',
            'theme' => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $uploadedPath = uploadFile($request->file('image'), 'uploads/projects', 'project');
            if ($uploadedPath) {
                $oldImage = $project->getRawOriginal('image_url');
                if (!empty($oldImage) && !str_starts_with($oldImage, 'http') && file_exists(public_path($oldImage))) {
                    @unlink(public_path($oldImage));
                }
                $validated['image_url'] = $uploadedPath;
            }
        }

        $project->update($validated);

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'project',
            'title' => "Project Updated: {$project->title}",
            'message' => "Project '{$project->title}' was modified.",
            'action_url' => route('admin.projects.edit', $project->id),
            'icon' => 'folder',
            'color' => 'purple',
        ]);

        flash()->success('Project updated successfully.');

        return redirect()->route('admin.projects.index');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $title = $project->title;
        $oldImage = $project->getRawOriginal('image_url');
        if (!empty($oldImage) && !str_starts_with($oldImage, 'http') && file_exists(public_path($oldImage))) {
            @unlink(public_path($oldImage));
        }

        $project->delete();

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'project',
            'title' => "Project Deleted: {$title}",
            'message' => "Project '{$title}' was removed.",
            'action_url' => route('admin.projects.index'),
            'icon' => 'folder',
            'color' => 'rose',
        ]);

        flash()->delete('Project deleted successfully.');

        return redirect()->route('admin.projects.index');
    }
}
