<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\PricingPlan;
use App\Models\Project;
use App\Models\ResumeItem;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Get the currently active theme from query, session, or database.
     */
    private function getActiveTheme(): string
    {
        $allowedThemes = ['developer', 'graphic_designer', 'uiux_designer', 'app_developer', 'app_software_developer', 'digital_designer_illustrator'];
        $requestedTheme = request()->query('theme', session('user_theme'));
        if ($requestedTheme && in_array($requestedTheme, $allowedThemes, true)) {
            return $requestedTheme;
        }

        $activeTheme = SiteSetting::get('active_theme', 'developer');
        return in_array($activeTheme, $allowedThemes, true) ? $activeTheme : 'developer';
    }

    /**
     * Get the active theme mode: dark, light, or system.
     */
    private function getThemeMode(): string
    {
        if (request()->has('mode') && in_array(request()->query('mode'), ['dark', 'light', 'system'], true)) {
            return request()->query('mode');
        }
        $themeMode = session('user_theme_mode', SiteSetting::get('theme_mode', 'system'));
        return in_array($themeMode, ['dark', 'light', 'system'], true) ? $themeMode : 'system';
    }

    /**
     * Get global settings key-value array merged with theme content defaults and database values.
     */
    private function getSettings(?string $theme = null, ?string $page = null): array
    {
        $theme = $theme ?: $this->getActiveTheme();
        $allSettings = SiteSetting::all()->pluck('value', 'key')->toArray();
        $themeContents = \App\Models\ThemeContent::forTheme($theme, $page);

        // Merge site settings with theme_contents, with theme_contents taking priority
        return array_merge($allSettings, $themeContents);
    }

    /**
     * Common blog articles retrieved dynamically from database.
     */
    private function getBlogPosts(?string $theme = null)
    {
        $theme = $theme ?: $this->getActiveTheme();
        $posts = BlogPost::where('is_published', true)
            ->whereIn('theme', ['all', $theme])
            ->orderBy('sort_order')
            ->get();

        if ($posts->isEmpty()) {
            $posts = BlogPost::where('is_published', true)->orderBy('sort_order')->get();
        }

        return $posts;
    }

    /**
     * Common FAQs list retrieved dynamically from database.
     */
    private function getFaqs(?string $theme = null)
    {
        $theme = $theme ?: $this->getActiveTheme();
        $faqs = Faq::where('is_published', true)
            ->whereIn('theme', ['all', $theme])
            ->orderBy('sort_order')
            ->get();

        if ($faqs->isEmpty()) {
            $faqs = Faq::where('is_published', true)->orderBy('sort_order')->get();
        }

        return $faqs;
    }

    /**
     * Show the main portfolio home page.
     */
    public function index(Request $request): View
    {
        $activeTheme = $this->getActiveTheme();
        $settings = $this->getSettings();

        $services = Service::where('theme', $activeTheme)->orderBy('sort_order')->get();
        if ($services->count() < 4) {
            $services = Service::whereIn('theme', ['all', $activeTheme])->orderBy('sort_order')->get();
        }
        if ($services->count() < 4) {
            $services = Service::orderBy('sort_order')->take(6)->get();
        }

        $projects = Project::whereIn('theme', ['all', $activeTheme])->orderBy('sort_order')->get();
        if ($projects->count() < 4) {
            $projects = Project::orderBy('sort_order')->take(4)->get();
        }

        $skills = Skill::whereIn('theme', ['all', $activeTheme])->orderBy('sort_order')->get();
        if ($activeTheme === 'uiux_designer') {
            if ($skills->count() < 9) {
                $skills = Skill::orderBy('sort_order')->take(9)->get();
            } else {
                $skills = $skills->take(9);
            }
        } elseif ($activeTheme === 'graphic_designer') {
            if ($skills->count() < 12) {
                $skills = Skill::orderBy('sort_order')->take(12)->get();
            } else {
                $skills = $skills->take(12);
            }
        } elseif ($skills->count() < 6) {
            $skills = Skill::orderBy('sort_order')->take(12)->get();
        }

        $pricingPlans = PricingPlan::whereIn('theme', ['all', $activeTheme])->orderBy('sort_order')->get();
        $testimonials = Testimonial::whereIn('theme', ['all', $activeTheme])->orderBy('sort_order')->get();

        $resumeEducation = ResumeItem::where('type', 'education')
            ->whereIn('theme', ['all', $activeTheme])
            ->orderBy('sort_order')
            ->get();
        if ($resumeEducation->isEmpty()) {
            $resumeEducation = ResumeItem::where('type', 'education')->orderBy('sort_order')->get();
        }

        $resumeExperience = ResumeItem::where('type', 'experience')
            ->whereIn('theme', ['all', $activeTheme])
            ->orderBy('sort_order')
            ->get();
        if ($resumeExperience->isEmpty()) {
            $resumeExperience = ResumeItem::where('type', 'experience')->orderBy('sort_order')->get();
        }

        $blogPosts = $this->getBlogPosts();
        $faqs = $this->getFaqs();

        $viewName = "frontend.themes.{$activeTheme}.index";
        if (! view()->exists($viewName)) {
            $viewName = 'frontend.themes.graphic_designer.index';
        }

        $themeMode = $this->getThemeMode();

        $themeContents = \App\Models\ThemeContent::forTheme($activeTheme, 'home');

        $this->data['activeTheme'] = $activeTheme;
        $this->data['themeMode'] = $themeMode;
        $this->data['settings'] = $settings;
        $this->data['themeContent'] = $themeContents;
        $this->data['contents'] = $themeContents;
        $this->data['services'] = $services;
        $this->data['projects'] = $projects;
        $this->data['skills'] = $skills;
        $this->data['pricingPlans'] = $pricingPlans;
        $this->data['testimonials'] = $testimonials;
        $this->data['resumeEducation'] = $resumeEducation;
        $this->data['resumeExperience'] = $resumeExperience;
        $this->data['blogPosts'] = $blogPosts;
        $this->data['faqs'] = $faqs;

        return view($viewName, $this->data);
    }

    /**
     * Dedicated About Page.
     */
    public function about(): View
    {
        $activeTheme = $this->getActiveTheme();
        $settings = $this->getSettings(null, 'about');
        $skills = Skill::whereIn('theme', ['all', $activeTheme])->orderBy('sort_order')->get();
        if ($activeTheme === 'graphic_designer') {
            if ($skills->count() < 12) {
                $skills = Skill::orderBy('sort_order')->take(12)->get();
            } else {
                $skills = $skills->take(12);
            }
        } elseif ($skills->count() < 4) {
            $skills = Skill::orderBy('sort_order')->take(12)->get();
        }

        $themeMode = $this->getThemeMode();

        $viewName = "frontend.themes.{$activeTheme}.pages.about";
        if (! view()->exists($viewName)) {
            $viewName = 'frontend.themes.graphic_designer.pages.about';
        }

        $this->data['activeTheme'] = $activeTheme;
        $this->data['themeMode'] = $themeMode;
        $this->data['settings'] = $settings;
        $this->data['skills'] = $skills;

        return view($viewName, $this->data);
    }

    /**
     * Dedicated Portfolio / Works Page.
     */
    public function portfolio(): View
    {
        $activeTheme = $this->getActiveTheme();
        $themeMode = $this->getThemeMode();
        $settings = $this->getSettings(null, 'project');
        $projects = Project::whereIn('theme', ['all', $activeTheme])->orderBy('sort_order')->get();
        if ($projects->count() < 4) {
            $projects = Project::orderBy('sort_order')->get();
        }

        $viewName = "frontend.themes.{$activeTheme}.pages.portfolio";
        if (! view()->exists($viewName)) {
            $viewName = 'frontend.themes.graphic_designer.pages.portfolio';
        }

        $this->data['activeTheme'] = $activeTheme;
        $this->data['themeMode'] = $themeMode;
        $this->data['settings'] = $settings;
        $this->data['projects'] = $projects;

        return view($viewName, $this->data);
    }

    /**
     * Dedicated Blog Listing Page.
     */
    public function blog(): View
    {
        $activeTheme = $this->getActiveTheme();
        $themeMode = $this->getThemeMode();
        $settings = $this->getSettings(null, 'blog');
        $blogPosts = $this->getBlogPosts();

        $viewName = "frontend.themes.{$activeTheme}.pages.blog";
        if (! view()->exists($viewName)) {
            $viewName = 'frontend.themes.graphic_designer.pages.blog';
        }

        $this->data['activeTheme'] = $activeTheme;
        $this->data['themeMode'] = $themeMode;
        $this->data['settings'] = $settings;
        $this->data['blogPosts'] = $blogPosts;

        return view($viewName, $this->data);
    }

    /**
     * Dedicated Single Blog Detail Page.
     */
    public function blogDetail(string $slug): View
    {
        $activeTheme = $this->getActiveTheme();
        $themeMode = $this->getThemeMode();
        $settings = $this->getSettings(null, 'blog');
        $allPosts = $this->getBlogPosts();

        $post = BlogPost::where('slug', $slug)->first() ?? $allPosts->first();
        $relatedPosts = $allPosts->filter(fn ($p) => ($p['slug'] ?? $p->slug) !== ($post['slug'] ?? $post->slug))->take(2)->values();

        $viewName = "frontend.themes.{$activeTheme}.pages.blog-detail";
        if (! view()->exists($viewName)) {
            $viewName = 'frontend.themes.graphic_designer.pages.blog-detail';
        }

        $this->data['activeTheme'] = $activeTheme;
        $this->data['themeMode'] = $themeMode;
        $this->data['settings'] = $settings;
        $this->data['post'] = $post;
        $this->data['relatedPosts'] = $relatedPosts;

        return view($viewName, $this->data);
    }

    /**
     * Dedicated FAQ Page.
     */
    public function faq(): View
    {
        $activeTheme = $this->getActiveTheme();
        $themeMode = $this->getThemeMode();
        $settings = $this->getSettings(null, 'faq');
        $faqs = $this->getFaqs();

        $viewName = "frontend.themes.{$activeTheme}.pages.faq";
        if (! view()->exists($viewName)) {
            $viewName = 'frontend.themes.graphic_designer.pages.faq';
        }

        $this->data['activeTheme'] = $activeTheme;
        $this->data['themeMode'] = $themeMode;
        $this->data['settings'] = $settings;
        $this->data['faqs'] = $faqs;

        return view($viewName, $this->data);
    }

    /**
     * Dedicated Contact Page.
     */
    public function contact(): View
    {
        $activeTheme = $this->getActiveTheme();
        $themeMode = $this->getThemeMode();
        $settings = $this->getSettings(null, 'contact');

        $viewName = "frontend.themes.{$activeTheme}.pages.contact";
        if (! view()->exists($viewName)) {
            $viewName = 'frontend.themes.graphic_designer.pages.contact';
        }

        $this->data['activeTheme'] = $activeTheme;
        $this->data['themeMode'] = $themeMode;
        $this->data['settings'] = $settings;

        return view($viewName, $this->data);
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
            'subject' => 'nullable|string|max:150',
            'service_type' => 'nullable|string|max:100',
            'message' => 'required|string|min:5|max:5000',
        ]);

        ContactMessage::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your message has been sent successfully. I will get back to you shortly.',
            ]);
        }

        flash()->success('Thank you! Your message has been sent successfully. I will get back to you shortly.');

        return redirect()->back();
    }

    /**
     * Download or view the uploaded CV / Resume PDF file.
     */
    public function downloadCv(): \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\RedirectResponse
    {
        $pdfPath = SiteSetting::get('resume_pdf_file');
        $originalName = SiteSetting::get('resume_pdf_name', 'Curriculum_Vitae.pdf');

        if ($pdfPath && file_exists(public_path($pdfPath))) {
            return response()->download(public_path($pdfPath), $originalName, [
                'Content-Type' => 'application/pdf',
            ]);
        }

        if (file_exists(public_path('resume.pdf'))) {
            return response()->download(public_path('resume.pdf'), $originalName, [
                'Content-Type' => 'application/pdf',
            ]);
        }

        flash()->warning('No CV / Resume document is currently available for download.');

        return redirect()->back();
    }
}
