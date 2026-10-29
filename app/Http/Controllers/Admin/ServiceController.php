<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->query('theme', $activeTheme);

        $services = Service::orderBy('sort_order')->get();

        $this->data['services'] = $services;
        $this->data['activeTheme'] = $activeTheme;
        $this->data['selectedTheme'] = $selectedTheme;

        return view('admin.services.index', $this->data);
    }

    public function create(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->query('theme', $activeTheme);
        $this->data['selectedTheme'] = $selectedTheme;

        return view('admin.services.create', $this->data);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:60',
            'category' => 'required|string|max:60',
            'theme' => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'sort_order' => 'nullable|integer',
        ]);

        $service = Service::create($validated);

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'service',
            'title' => "Service Created: {$service->title}",
            'message' => "Service '{$service->title}' ({$service->category}) was created.",
            'action_url' => route('admin.services.edit', $service->id),
            'icon' => 'folder',
            'color' => 'indigo',
        ]);

        flash()->success('Service created successfully.');

        return redirect()->route('admin.services.index');
    }

    public function edit(Service $service): View
    {
        $this->data['service'] = $service;

        return view('admin.services.edit', $this->data);
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:60',
            'category' => 'required|string|max:60',
            'theme' => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'sort_order' => 'nullable|integer',
        ]);

        $service->update($validated);

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'service',
            'title' => "Service Updated: {$service->title}",
            'message' => "Service '{$service->title}' ({$service->category}) was updated.",
            'action_url' => route('admin.services.edit', $service->id),
            'icon' => 'folder',
            'color' => 'indigo',
        ]);

        flash()->success('Service updated successfully.');

        return redirect()->route('admin.services.index');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $title = $service->title;
        $service->delete();

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'service',
            'title' => "Service Deleted: {$title}",
            'message' => "Service '{$title}' was deleted.",
            'action_url' => route('admin.services.index'),
            'icon' => 'folder',
            'color' => 'rose',
        ]);

        flash()->delete('Service deleted successfully.');

        return redirect()->route('admin.services.index');
    }
}
