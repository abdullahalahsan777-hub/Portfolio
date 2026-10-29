<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\PricingPlan;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PricingPlanController extends Controller
{
    public function index(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->query('theme', $activeTheme);

        $plans = PricingPlan::orderBy('sort_order')->get();

        $this->data['plans'] = $plans;
        $this->data['activeTheme'] = $activeTheme;
        $this->data['selectedTheme'] = $selectedTheme;

        return view('admin.pricing.index', $this->data);
    }

    public function create(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->query('theme', $activeTheme);
        $this->data['selectedTheme'] = $selectedTheme;

        return view('admin.pricing.create', $this->data);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'subtitle' => 'nullable|string|max:150',
            'price' => 'required|numeric|min:0',
            'billing_period' => 'required|string|max:50',
            'features' => 'nullable|string',
            'button_text' => 'required|string|max:80',
            'button_url' => 'required|string|max:250',
            'theme' => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $pricing = PricingPlan::create($validated);

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'pricing',
            'title' => "Pricing Plan Created: {$pricing->name}",
            'message' => "Pricing plan '{$pricing->name}' (\${$pricing->price}/{$pricing->billing_period}) was created.",
            'action_url' => route('admin.pricing.edit', $pricing->id),
            'icon' => 'check',
            'color' => 'emerald',
        ]);

        flash()->success('Pricing plan created successfully.');

        return redirect()->route('admin.pricing.index');
    }

    public function edit(PricingPlan $pricing): View
    {
        $this->data['pricing'] = $pricing;

        return view('admin.pricing.edit', $this->data);
    }

    public function update(Request $request, PricingPlan $pricing): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'subtitle' => 'nullable|string|max:150',
            'price' => 'required|numeric|min:0',
            'billing_period' => 'required|string|max:50',
            'features' => 'nullable|string',
            'button_text' => 'required|string|max:80',
            'button_url' => 'required|string|max:250',
            'theme' => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $pricing->update($validated);

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'pricing',
            'title' => "Pricing Plan Updated: {$pricing->name}",
            'message' => "Pricing plan '{$pricing->name}' was modified.",
            'action_url' => route('admin.pricing.edit', $pricing->id),
            'icon' => 'check',
            'color' => 'emerald',
        ]);

        flash()->success('Pricing plan updated successfully.');

        return redirect()->route('admin.pricing.index');
    }

    public function destroy(PricingPlan $pricing): RedirectResponse
    {
        $name = $pricing->name;
        $pricing->delete();

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'pricing',
            'title' => "Pricing Plan Deleted: {$name}",
            'message' => "Pricing plan '{$name}' was removed.",
            'action_url' => route('admin.pricing.index'),
            'icon' => 'check',
            'color' => 'rose',
        ]);

        flash()->delete('Pricing plan deleted successfully.');

        return redirect()->route('admin.pricing.index');
    }
}
