<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\PricingPlan;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Show the main portfolio home page.
     */
    public function index(Request $request): View
    {
        $defaultTheme = SiteSetting::get('active_theme', 'developer');
        $activeTheme = $request->query('theme', session('user_theme', $defaultTheme));

        $allowedThemes = ['developer', 'graphic_designer', 'uiux_designer', 'app_developer', 'app_software_developer', 'digital_designer_illustrator'];
        if (! in_array($activeTheme, $allowedThemes, true)) {
            $activeTheme = 'developer';
        }

        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();

        $services = Service::whereIn('theme', ['all', $activeTheme])
            ->orderBy('sort_order')
            ->get();

        $projects = Project::whereIn('theme', ['all', $activeTheme])
            ->orderBy('sort_order')
            ->get();

        $skills = Skill::whereIn('theme', ['all', $activeTheme])
            ->orderBy('sort_order')
            ->get();

        $pricingPlans = PricingPlan::whereIn('theme', ['all', $activeTheme])
            ->orderBy('sort_order')
            ->get();

        $testimonials = Testimonial::whereIn('theme', ['all', $activeTheme])
            ->orderBy('sort_order')
            ->get();

        $this->data['activeTheme'] = $activeTheme;
        $this->data['settings'] = $settings;
        $this->data['services'] = $services;
        $this->data['projects'] = $projects;
        $this->data['skills'] = $skills;
        $this->data['pricingPlans'] = $pricingPlans;
        $this->data['testimonials'] = $testimonials;

        return view('welcome', $this->data);
    }

    /**
     * Switch theme temporarily for user session.
     */
    public function switchTheme(Request $request, string $theme): RedirectResponse
    {
        $allowedThemes = ['developer', 'graphic_designer', 'uiux_designer'];
        if (in_array($theme, $allowedThemes, true)) {
            session(['user_theme' => $theme]);
        }

        return redirect()->back();
    }

    /**
     * Handle contact form submission.
     */
    public function submitContact(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:40',
            'service_type' => 'nullable|string|max:100',
            'message' => 'required|string|min:5|max:5000',
        ]);

        // Check if this sender's email address has an importance badge or was previously marked important
        $hasImportance = ContactMessage::withTrashed()
            ->where('email', $validated['email'])
            ->where(function ($q) {
                $q->where('is_important', true)->orWhere('type', 'important');
            })
            ->exists();

        $validated['type'] = $hasImportance ? 'important' : 'inbox';
        $validated['is_important'] = $hasImportance;

        $message = ContactMessage::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully! We will get in touch promptly.',
            ]);
        }

        flash()->success('Your message has been sent successfully! We will get in touch promptly.');

        return redirect()->back();
    }
}
