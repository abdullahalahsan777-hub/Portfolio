<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Notification;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->get('theme', $activeTheme);

        $faqs = Faq::orderBy('sort_order')->get();

        $this->data['faqs'] = $faqs;
        $this->data['activeTheme'] = $activeTheme;
        $this->data['selectedTheme'] = $selectedTheme;
        $this->data['themeFilter'] = $selectedTheme;

        return view('admin.faqs.index', $this->data);
    }

    public function create(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->get('theme', $activeTheme);
        $this->data['selectedTheme'] = $selectedTheme;

        return view('admin.faqs.create', $this->data);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'required|string|max:100',
            'theme' => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'sort_order' => 'nullable|integer',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');
        $validated['sort_order'] = $validated['sort_order'] ?? ((Faq::max('sort_order') ?? 0) + 1);

        $faq = Faq::create($validated);
        $qSnippet = Str::limit($faq->question, 60);

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'faq',
            'title' => "FAQ Created: {$qSnippet}",
            'message' => "FAQ question: '{$qSnippet}' ({$faq->category}) was published.",
            'action_url' => route('admin.faqs.edit', $faq->id),
            'icon' => 'book',
            'color' => 'indigo',
        ]);

        flash()->success('FAQ question created successfully.');

        return redirect()->route('admin.faqs.index');
    }

    public function edit(Faq $faq): View
    {
        $this->data['faq'] = $faq;

        return view('admin.faqs.edit', $this->data);
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'required|string|max:100',
            'theme' => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'sort_order' => 'nullable|integer',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');

        $faq->update($validated);
        $qSnippet = Str::limit($faq->question, 60);

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'faq',
            'title' => "FAQ Updated: {$qSnippet}",
            'message' => "FAQ question: '{$qSnippet}' was modified.",
            'action_url' => route('admin.faqs.edit', $faq->id),
            'icon' => 'book',
            'color' => 'indigo',
        ]);

        flash()->success('FAQ updated successfully.');

        return redirect()->route('admin.faqs.index');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $qSnippet = Str::limit($faq->question, 60);
        $faq->delete();

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'faq',
            'title' => "FAQ Deleted: {$qSnippet}",
            'message' => "FAQ question: '{$qSnippet}' was deleted.",
            'action_url' => route('admin.faqs.index'),
            'icon' => 'book',
            'color' => 'rose',
        ]);

        flash()->delete('FAQ deleted successfully.');

        return redirect()->route('admin.faqs.index');
    }
}
