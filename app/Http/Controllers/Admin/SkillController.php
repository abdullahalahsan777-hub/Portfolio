<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Skill;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->query('theme', $activeTheme);

        $skills = Skill::orderBy('sort_order')->get();

        $this->data['skills'] = $skills;
        $this->data['activeTheme'] = $activeTheme;
        $this->data['selectedTheme'] = $selectedTheme;

        return view('admin.skills.index', $this->data);
    }

    public function create(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->query('theme', $activeTheme);
        $this->data['selectedTheme'] = $selectedTheme;

        return view('admin.skills.create', $this->data);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:80',
            'percentage' => 'required|integer|min:1|max:100',
            'icon' => 'nullable|string|max:5000',
            'theme' => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'sort_order' => 'nullable|integer',
        ]);

        $skill = Skill::create($validated);

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'skill',
            'title' => "Skill Created: {$skill->name}",
            'message' => "Skill '{$skill->name}' ({$skill->percentage}%) was added.",
            'action_url' => route('admin.skills.edit', $skill->id),
            'icon' => 'check',
            'color' => 'cyan',
        ]);

        flash()->success('Skill created successfully.');

        return redirect()->route('admin.skills.index');
    }

    public function edit(Skill $skill): View
    {
        $this->data['skill'] = $skill;

        return view('admin.skills.edit', $this->data);
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:80',
            'percentage' => 'required|integer|min:1|max:100',
            'icon' => 'nullable|string|max:5000',
            'theme' => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'sort_order' => 'nullable|integer',
        ]);

        $skill->update($validated);

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'skill',
            'title' => "Skill Updated: {$skill->name}",
            'message' => "Skill '{$skill->name}' ({$skill->percentage}%) was modified.",
            'action_url' => route('admin.skills.edit', $skill->id),
            'icon' => 'check',
            'color' => 'cyan',
        ]);

        flash()->success('Skill updated successfully.');

        return redirect()->route('admin.skills.index');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $name = $skill->name;
        $skill->delete();

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'skill',
            'title' => "Skill Deleted: {$name}",
            'message' => "Skill '{$name}' was deleted.",
            'action_url' => route('admin.skills.index'),
            'icon' => 'check',
            'color' => 'rose',
        ]);

        flash()->delete('Skill deleted successfully.');

        return redirect()->route('admin.skills.index');
    }
}
