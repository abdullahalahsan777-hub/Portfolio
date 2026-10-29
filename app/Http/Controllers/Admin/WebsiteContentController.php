<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\ThemeContent;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WebsiteContentController extends Controller
{
    /**
     * Shared helper to prepare page element data per selected theme and page.
     */
    private function getPageData(Request $request, string $pageTitle, string $pageSlug): array
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->query('theme', $activeTheme);
        $availableThemes = array_keys(SiteSetting::getAvailableThemes());

        if (!in_array($selectedTheme, $availableThemes, true)) {
            $selectedTheme = $activeTheme;
        }

        $contents = ThemeContent::forTheme($selectedTheme, $pageSlug);
        $themeDetails = SiteSetting::getThemeDetails($selectedTheme);

        // Retrieve sections directly from theme_contents table for this theme AND page
        $pageDbRows = ThemeContent::where('theme', $selectedTheme)
            ->where('page', $pageSlug)
            ->orderBy('id')
            ->get();

        // Fallback for home if page rows not yet populated separately
        if ($pageDbRows->isEmpty() && $pageSlug === 'home') {
            $pageDbRows = ThemeContent::where('theme', $selectedTheme)->orderBy('id')->get();
        }

        $themeSectionsData = $pageDbRows->groupBy('section');

        // Dynamically build right sidebar sections from database table theme_contents
        $sidebarSections = $this->buildSidebarSections($selectedTheme, $pageSlug, $themeSectionsData);

        return [
            'contents' => $contents,
            'settings' => $contents,
            'activeTheme' => $activeTheme,
            'selectedTheme' => $selectedTheme,
            'themeDetails' => $themeDetails,
            'pageTitle' => $pageTitle,
            'pageSlug' => $pageSlug,
            'themeSectionsData' => $themeSectionsData,
            'sidebarSections' => $sidebarSections,
            'activeSectionIds' => array_column($sidebarSections, 'id'),
        ];
    }

    /**
     * Build right sidebar sections dynamically from database table theme_contents.
     */
    private function buildSidebarSections(string $theme, string $pageSlug, $themeSectionsData): array
    {
        $pageSectionMeta = [
            'about' => [
                'hero' => ['id' => 'hero', 'title' => 'About Hero Header', 'subtitle' => 'Page badge, primary title, italic accent headline'],
                'narrative' => ['id' => 'narrative', 'title' => 'Editorial Narrative & Portrait', 'subtitle' => 'Editorial story paragraphs and portrait photo'],
                'metrics' => ['id' => 'metrics', 'title' => 'Achievement Metrics & Deliverables', 'subtitle' => 'High-impact stat counters and deliverable summaries'],
                'philosophy' => ['id' => 'philosophy', 'title' => 'Philosophy Quote & Bio', 'subtitle' => 'Editorial quote with attribution and extended bio'],
            ],
            'contact' => [
                'hero' => ['id' => 'hero', 'title' => 'Contact Hero Header', 'subtitle' => 'Section badge, contact headlines, and welcoming intro'],
                'channels' => ['id' => 'channels', 'title' => 'Direct Channels & Info', 'subtitle' => 'Direct email, telephone number, studio address'],
                'form' => ['id' => 'form', 'title' => 'Project Inquiry Form Settings', 'subtitle' => 'Interactive inquiry form settings and button label'],
                'footer' => ['id' => 'footer', 'title' => 'Footer Copyright & Notice', 'subtitle' => 'Notice displayed at the bottom of the contact page'],
            ],
            'service' => [
                'header' => ['id' => 'header', 'title' => 'Services Header & Tagline', 'subtitle' => 'Headlines and intro tag above grid'],
                'cta' => ['id' => 'cta', 'title' => 'Consultation CTA Banner', 'subtitle' => 'Call-to-action banner promoting inquiries'],
            ],
            'project' => [
                'hero' => ['id' => 'hero', 'title' => 'Project Page Hero Header', 'subtitle' => 'Page badge, primary title, italic accent headline'],
                'grid' => ['id' => 'grid', 'title' => 'Portfolio Grid Settings', 'subtitle' => 'Category filter tab styling and layout options'],
                'footer' => ['id' => 'footer', 'title' => 'Project Inquiry CTA Banner', 'subtitle' => 'Closing call-to-action banner'],
            ],
            'resume' => [
                'timeline' => ['id' => 'timeline', 'title' => 'Timeline Header & Tagline', 'subtitle' => 'Headlines and intro tag above timeline'],
                'skills' => ['id' => 'skills', 'title' => 'Skills Grid Section', 'subtitle' => 'Headlines and intro for skills section'],
                'download' => ['id' => 'download', 'title' => 'CV Download Card & CTA', 'subtitle' => 'CV download link and action button'],
            ],
            'blog' => [
                'hero' => ['id' => 'hero', 'title' => 'Blog Page Hero Header', 'subtitle' => 'Page badge, primary title, italic accent headline'],
                'feed' => ['id' => 'feed', 'title' => 'Article Feed & Filter Settings', 'subtitle' => 'Search bar placeholder, category filters'],
                'newsletter' => ['id' => 'newsletter', 'title' => 'Newsletter Subscription Banner', 'subtitle' => 'Newsletter headline, encouragement text'],
                'footer' => ['id' => 'footer', 'title' => 'Footer Notice (on Blog Page)', 'subtitle' => 'Copyright text and credits'],
            ],
            'faq' => [
                'hero' => ['id' => 'hero', 'title' => 'FAQ Page Hero Header', 'subtitle' => 'Page badge, primary title, italic accent headline'],
                'accordion' => ['id' => 'accordion', 'title' => 'Accordion Section Settings', 'subtitle' => 'Category badge, accordion intro headline'],
                'cta' => ['id' => 'cta', 'title' => 'Unanswered Question CTA Banner', 'subtitle' => 'Help banner encouraging direct contact'],
                'footer' => ['id' => 'footer', 'title' => 'Footer Notice (on FAQ Page)', 'subtitle' => 'Copyright text and credits'],
            ],
            'home' => [
                'hero' => ['id' => 'hero', 'title' => 'Hero Introduction & Showcase', 'subtitle' => 'Hero banner headlines & avatar'],
                'about' => ['id' => 'about', 'title' => 'About Me & Narrative', 'subtitle' => 'Bio copy, portrait & credentials'],
                'stats' => ['id' => 'stats', 'title' => 'Key Metrics & Statistics', 'subtitle' => 'Experience & project counters'],
                'services' => ['id' => 'services', 'title' => 'Services Section', 'subtitle' => 'Headlines & offerings overview'],
                'portfolio' => ['id' => 'projects', 'title' => 'Featured Projects & Portfolio', 'subtitle' => 'Selected case studies & works'],
                'resume' => ['id' => 'resume', 'title' => 'Experience & Resume Timeline', 'subtitle' => 'Career timeline & qualifications'],
                'skills' => ['id' => 'skills', 'title' => 'Skills & Competencies', 'subtitle' => 'Tools, languages & advantages'],
                'testimonials' => ['id' => 'testimonials', 'title' => 'Client Testimonials', 'subtitle' => 'Client reviews & background art'],
                'pricing' => ['id' => 'pricing', 'title' => 'Pricing Packages', 'subtitle' => 'Rates, plans & offerings'],
                'blog' => ['id' => 'blog', 'title' => 'Articles & Insights', 'subtitle' => 'Blog headlines & articles CTA'],
                'faq' => ['id' => 'faq', 'title' => 'Frequently Asked Questions', 'subtitle' => 'FAQ headlines & answers'],
                'contact' => ['id' => 'contact', 'title' => 'Contact Section', 'subtitle' => 'Headlines & inquiry channels'],
                'general' => ['id' => 'footer', 'title' => 'Global Footer & Copyright', 'subtitle' => 'Brand text, socials & copyright'],
                'footer' => ['id' => 'footer', 'title' => 'Global Footer & Copyright', 'subtitle' => 'Brand text, socials & copyright'],
                'marquee' => ['id' => 'hero', 'title' => 'Ticker Marquee Headline', 'subtitle' => 'Continuous marquee text headline'],
            ],
        ];

        $metaMap = $pageSectionMeta[$pageSlug] ?? $pageSectionMeta['home'];
        $sections = [];
        $index = 1;
        $seenIds = [];

        // Add sections configured in page metadata that exist in theme_contents table
        foreach ($metaMap as $secKey => $meta) {
            $panelId = $meta['id'];
            if (!in_array($panelId, $seenIds, true)) {
                $fieldCount = $themeSectionsData->has($secKey) ? $themeSectionsData->get($secKey)->count() : 0;
                $seenIds[] = $panelId;
                $sections[] = [
                    'id' => $panelId,
                    'num' => sprintf('%02d', $index++),
                    'title' => $meta['title'],
                    'subtitle' => $meta['subtitle'],
                    'count' => $fieldCount,
                    'badge' => $fieldCount > 0 ? "{$fieldCount} fields" : 'Section',
                ];
            }
        }

        // Any additional sections present in theme_contents table for this page
        foreach ($themeSectionsData->keys() as $secKey) {
            if (!isset($metaMap[$secKey]) && $secKey !== 'marquee') {
                $panelId = $secKey;
                if (!in_array($panelId, $seenIds, true)) {
                    $seenIds[] = $panelId;
                    $fieldCount = $themeSectionsData->get($secKey)->count();
                    $sections[] = [
                        'id' => $panelId,
                        'num' => sprintf('%02d', $index++),
                        'title' => ucfirst(str_replace('_', ' ', $secKey)),
                        'subtitle' => 'Dynamic database section',
                        'count' => $fieldCount,
                        'badge' => "{$fieldCount} fields",
                    ];
                }
            }
        }

        return $sections;
    }

    /**
     * Legacy entrypoint: redirect to Home Page elements.
     */
    public function index(Request $request): RedirectResponse|View
    {
        $theme = $request->query('theme', SiteSetting::getActiveTheme());
        return redirect()->route('admin.pages.home', ['theme' => $theme]);
    }

    /**
     * Home Page Elements View
     */
    public function home(Request $request): View
    {
        return view('admin.pages.home', $this->getPageData($request, 'Home Page', 'home'));
    }

    /**
     * About Page Elements View
     */
    public function about(Request $request): View
    {
        return view('admin.pages.about', $this->getPageData($request, 'About Page', 'about'));
    }

    /**
     * Contact Page Elements View
     */
    public function contact(Request $request): View
    {
        return view('admin.pages.contact', $this->getPageData($request, 'Contact Page', 'contact'));
    }

    /**
     * Service Page Elements View
     */
    public function service(Request $request): View
    {
        return view('admin.pages.service', $this->getPageData($request, 'Service Page', 'service'));
    }

    /**
     * Project Page Elements View
     */
    public function project(Request $request): View
    {
        return view('admin.pages.project', $this->getPageData($request, 'Project Page', 'project'));
    }

    /**
     * Resume Page Elements View
     */
    public function resume(Request $request): View
    {
        return view('admin.pages.resume', $this->getPageData($request, 'Resume Page', 'resume'));
    }

    /**
     * Blog Page Elements View
     */
    public function blog(Request $request): View
    {
        return view('admin.pages.blog', $this->getPageData($request, 'Blog Page', 'blog'));
    }

    /**
     * FAQ Page Elements View
     */
    public function faq(Request $request): View
    {
        return view('admin.pages.faq', $this->getPageData($request, 'FAQ Page', 'faq'));
    }

    /**
     * Unified section update for all page elements.
     * Each individual section form posts here with its specific fields.
     */
    public function update(Request $request): RedirectResponse
    {
        $theme = $request->input('theme', SiteSetting::getActiveTheme());
        $availableThemes = array_keys(SiteSetting::getAvailableThemes());

        if (!in_array($theme, $availableThemes, true)) {
            $theme = SiteSetting::getActiveTheme();
        }

        $sectionName = $request->input('section_name', 'Section');

        // Determine target page: explicit page input, or infer from request / referer
        $page = $request->input('page');
        if (!$page) {
            $page = $this->detectPageFromRequest($request, $sectionName);
        }
        $explicitSection = $request->input('section');

        // 1. Handle any uploaded image files
        $uploadedKeys = [];
        foreach ($request->allFiles() as $fileKey => $file) {
            if ($file && $file->isValid()) {
                $targetKey = str_ends_with($fileKey, '_file') ? substr($fileKey, 0, -5) : $fileKey;
                $relativePath = uploadFile($file, "uploads/themes/{$theme}", $targetKey);
                if ($relativePath) {
                    $existingSec = ThemeContent::where('theme', $theme)->where('page', $page)->where('key', $targetKey)->value('section');
                    $sec = $explicitSection ?: ($existingSec ?: null);
                    if (!$sec) {
                        $sec = 'general';
                        if (str_starts_with($targetKey, 'hero_')) {
                            $sec = 'hero';
                        } elseif ($targetKey === 'about_portrait_image' || str_starts_with($targetKey, 'about_narrative_')) {
                            $sec = 'narrative';
                        } elseif (str_starts_with($targetKey, 'about_') || str_starts_with($targetKey, 'profile_')) {
                            $sec = 'about';
                        } elseif (str_starts_with($targetKey, 'testimonials_')) {
                            $sec = 'testimonials';
                        } elseif (str_starts_with($targetKey, 'portfolio_')) {
                            $sec = ($page === 'project') ? 'hero' : 'portfolio';
                        }
                    }

                    ThemeContent::set($theme, $targetKey, $relativePath, $sec, 'image', $page);
                    $uploadedKeys[] = $targetKey;
                }
            }
        }

        // 2. Handle all text / textarea / URL input fields
        $ignoredKeys = ['_token', '_method', 'theme', 'section_name', 'page', 'section'];
        foreach ($request->except($ignoredKeys) as $key => $value) {
            if (str_ends_with($key, '_file') || in_array($key, $uploadedKeys, true)) {
                continue;
            }

            // Determine section: explicit section, existing section from DB, or inferred fallback
            $existingRecord = ThemeContent::where('theme', $theme)->where('page', $page)->where('key', $key)->first();
            $section = $explicitSection ?: ($existingRecord ? $existingRecord->section : null);
            if (!$section) {
                if ($page === 'about') {
                    if (str_starts_with($key, 'about_hero_')) {
                        $section = 'hero';
                    } elseif (str_starts_with($key, 'about_stat')) {
                        $section = 'metrics';
                    } elseif (str_starts_with($key, 'about_narrative_') || $key === 'about_portrait_image') {
                        $section = 'narrative';
                    } elseif (str_starts_with($key, 'quote_') || $key === 'about_bio_extended') {
                        $section = 'philosophy';
                    } else {
                        $section = 'about';
                    }
                } elseif ($page === 'contact') {
                    if (str_starts_with($key, 'contact_hero_')) {
                        $section = 'hero';
                    } elseif (str_starts_with($key, 'contact_email') || str_starts_with($key, 'contact_phone') || str_starts_with($key, 'contact_address')) {
                        $section = 'channels';
                    } elseif (str_starts_with($key, 'contact_form_') || $key === 'contact_btn_text') {
                        $section = 'form';
                    } elseif ($key === 'copyright_text' || $key === 'footer_credits') {
                        $section = 'footer';
                    } else {
                        $section = 'contact';
                    }
                } elseif ($page === 'service') {
                    if (str_starts_with($key, 'services_cta_')) {
                        $section = 'cta';
                    } else {
                        $section = 'header';
                    }
                } elseif ($page === 'project') {
                    if (str_starts_with($key, 'portfolio_hero_')) {
                        $section = 'hero';
                    } elseif (str_starts_with($key, 'portfolio_filter_') || str_starts_with($key, 'portfolio_cta_')) {
                        $section = 'grid';
                    } elseif ($key === 'copyright_text' || $key === 'footer_credits') {
                        $section = 'footer';
                    } else {
                        $section = 'grid';
                    }
                } elseif ($page === 'resume') {
                    if (str_starts_with($key, 'resume_cv_')) {
                        $section = 'download';
                    } elseif (str_starts_with($key, 'skills_')) {
                        $section = 'skills';
                    } else {
                        $section = 'timeline';
                    }
                } elseif ($page === 'blog') {
                    if (str_starts_with($key, 'blog_hero_')) {
                        $section = 'hero';
                    } elseif (str_starts_with($key, 'blog_read_more_') || $key === 'blog_posts_per_page') {
                        $section = 'feed';
                    } elseif (str_starts_with($key, 'newsletter_')) {
                        $section = 'newsletter';
                    } elseif ($key === 'copyright_text' || $key === 'footer_credits') {
                        $section = 'footer';
                    } else {
                        $section = 'feed';
                    }
                } elseif ($page === 'faq') {
                    if (str_starts_with($key, 'faq_hero_')) {
                        $section = 'hero';
                    } elseif (str_starts_with($key, 'faq_accordion_') || $key === 'faq_first_open') {
                        $section = 'accordion';
                    } elseif (str_starts_with($key, 'faq_cta_')) {
                        $section = 'cta';
                    } elseif ($key === 'copyright_text' || $key === 'footer_credits') {
                        $section = 'footer';
                    } else {
                        $section = 'accordion';
                    }
                } else {
                    // Home page & global fallbacks
                    if (str_starts_with($key, 'hero_')) {
                        $section = 'hero';
                    } elseif (str_starts_with($key, 'about_') || str_starts_with($key, 'profile_')) {
                        $section = 'about';
                    } elseif (str_contains($key, 'projects') || str_contains($key, 'clients') || str_contains($key, 'experience') || str_contains($key, 'awards')) {
                        $section = 'stats';
                    } elseif (str_starts_with($key, 'services_')) {
                        $section = 'services';
                    } elseif (str_starts_with($key, 'portfolio_')) {
                        $section = 'portfolio';
                    } elseif (str_starts_with($key, 'resume_')) {
                        $section = 'resume';
                    } elseif (str_starts_with($key, 'skills_')) {
                        $section = 'skills';
                    } elseif (str_starts_with($key, 'testimonials_')) {
                        $section = 'testimonials';
                    } elseif (str_starts_with($key, 'pricing_')) {
                        $section = 'pricing';
                    } elseif (str_starts_with($key, 'blog_')) {
                        $section = 'blog';
                    } elseif (str_starts_with($key, 'faq_')) {
                        $section = 'faq';
                    } elseif (str_starts_with($key, 'footer_') || str_starts_with($key, 'copyright_') || str_starts_with($key, 'social_') || str_starts_with($key, 'follow_') || str_starts_with($key, 'quote_')) {
                        $section = 'footer';
                    } elseif (str_starts_with($key, 'contact_') || str_starts_with($key, 'newsletter_')) {
                        $section = 'contact';
                    } elseif (str_contains($key, 'marquee')) {
                        $section = 'marquee';
                    }
                }
            }

            $type = $existingRecord ? $existingRecord->type : null;
            if (!$type) {
                $type = 'text';
                if (str_contains($key, 'image') || str_contains($key, 'img') || str_contains($key, 'photo')) {
                    $type = 'image';
                } elseif (str_contains($key, 'description') || str_contains($key, 'bio') || str_contains($key, 'subtitle') || (str_contains($key, 'text') && strlen((string)$value) > 60)) {
                    $type = 'textarea';
                }
            }

            ThemeContent::set($theme, $key, $value, $section, $type, $page);

            // Synchronize counter labels across different theme templates
            if ($key === 'experience_years_label') {
                ThemeContent::set($theme, 'counter1_title', $value, 'stats', 'text', $page);
            } elseif ($key === 'satisfied_clients_label') {
                ThemeContent::set($theme, 'counter2_title', $value, 'stats', 'text', $page);
            } elseif ($key === 'completed_projects_label') {
                ThemeContent::set($theme, 'counter3_title', $value, 'stats', 'text', $page);
            } elseif ($key === 'awards_count_label') {
                ThemeContent::set($theme, 'counter4_title', $value, 'stats', 'text', $page);
            } elseif ($key === 'services_title') {
                ThemeContent::set($theme, 'services_heading', $value, 'services', 'text', $page);
            } elseif ($key === 'services_subtitle') {
                ThemeContent::set($theme, 'services_description', $value, 'services', 'textarea', $page);
            } elseif ($key === 'services_btn_text') {
                ThemeContent::set($theme, 'services_cta_btn_text', $value, 'services', 'text', $page);
            } elseif ($key === 'services_btn_url') {
                ThemeContent::set($theme, 'services_cta_btn_url', $value, 'services', 'text', $page);
            } elseif ($key === 'portfolio_title') {
                ThemeContent::set($theme, 'portfolio_heading', $value, 'portfolio', 'text', $page);
            } elseif ($key === 'portfolio_subtitle') {
                ThemeContent::set($theme, 'portfolio_description', $value, 'portfolio', 'textarea', $page);
            } elseif ($key === 'portfolio_cta_text') {
                ThemeContent::set($theme, 'portfolio_btn_text', $value, 'portfolio', 'text', $page);
            } elseif ($key === 'portfolio_cta_url') {
                ThemeContent::set($theme, 'portfolio_btn_url', $value, 'portfolio', 'text', $page);
            } elseif ($key === 'resume_title') {
                ThemeContent::set($theme, 'experience_heading', $value, 'resume', 'text', $page);
            } elseif ($key === 'resume_tag') {
                ThemeContent::set($theme, 'experience_tag', $value, 'resume', 'text', $page);
            } elseif ($key === 'resume_subtitle') {
                ThemeContent::set($theme, 'experience_description', $value, 'resume', 'textarea', $page);
            } elseif ($key === 'resume_btn_text') {
                ThemeContent::set($theme, 'resume_cv_btn_text', $value, 'resume', 'text', $page);
            } elseif ($key === 'resume_btn_url') {
                ThemeContent::set($theme, 'resume_cv_btn_url', $value, 'resume', 'text', $page);
            } elseif ($key === 'skills_title') {
                ThemeContent::set($theme, 'skills_heading', $value, 'skills', 'text', $page);
            } elseif ($key === 'skills_subtitle') {
                ThemeContent::set($theme, 'skills_description', $value, 'skills', 'textarea', $page);
            } elseif ($key === 'skills_tag') {
                ThemeContent::set($theme, 'skills_badge', $value, 'skills', 'text', $page);
            } elseif ($key === 'skills_footer_note') {
                ThemeContent::set($theme, 'skills_quote', $value, 'skills', 'text', $page);
            } elseif ($key === 'testimonials_title') {
                ThemeContent::set($theme, 'testimonials_heading', $value, 'testimonials', 'text', $page);
            } elseif ($key === 'testimonials_subtitle') {
                ThemeContent::set($theme, 'testimonials_description', $value, 'testimonials', 'textarea', $page);
            } elseif ($key === 'testimonials_tag') {
                ThemeContent::set($theme, 'testimonials_badge', $value, 'testimonials', 'text', $page);
            } elseif ($key === 'blog_title') {
                ThemeContent::set($theme, 'blog_heading', $value, 'blog', 'text', $page);
            } elseif ($key === 'blog_subtitle') {
                ThemeContent::set($theme, 'blog_description', $value, 'blog', 'textarea', $page);
            } elseif ($key === 'blog_tag') {
                ThemeContent::set($theme, 'blog_badge', $value, 'blog', 'text', $page);
            } elseif ($key === 'blog_btn_text') {
                ThemeContent::set($theme, 'blog_cta_text', $value, 'blog', 'text', $page);
            } elseif ($key === 'blog_btn_url') {
                ThemeContent::set($theme, 'blog_cta_url', $value, 'blog', 'text', $page);
            } elseif ($key === 'contact_title') {
                ThemeContent::set($theme, 'contact_heading', $value, 'contact', 'text', $page);
            } elseif ($key === 'contact_subtitle') {
                ThemeContent::set($theme, 'contact_description', $value, 'contact', 'textarea', $page);
            } elseif ($key === 'contact_tag') {
                ThemeContent::set($theme, 'contact_badge', $value, 'contact', 'text', $page);
            } elseif ($key === 'contact_address') {
                ThemeContent::set($theme, 'contact_location', $value, 'contact', 'text', $page);
            } elseif ($key === 'contact_hero_tag') {
                ThemeContent::set($theme, 'contact_tag', $value, 'contact', 'text', $page);
                ThemeContent::set($theme, 'contact_badge', $value, 'contact', 'text', $page);
            } elseif ($key === 'contact_hero_description') {
                ThemeContent::set($theme, 'contact_subtitle', $value, 'contact', 'textarea', $page);
                ThemeContent::set($theme, 'contact_description', $value, 'contact', 'textarea', $page);
            } elseif ($key === 'about_hero_tag') {
                ThemeContent::set($theme, 'about_tag', $value, 'about', 'text', $page);
            } elseif ($key === 'about_hero_description') {
                ThemeContent::set($theme, 'about_description', $value, 'about', 'textarea', $page);
            } elseif ($key === 'about_portrait_image') {
                ThemeContent::set($theme, 'about_image', $value, 'about', 'image', $page);
            } elseif ($key === 'about_stat1_value') {
                ThemeContent::set($theme, 'completed_projects', $value, 'stats', 'text', $page);
            } elseif ($key === 'about_stat2_value') {
                ThemeContent::set($theme, 'awards_count', $value, 'stats', 'text', $page);
            } elseif ($key === 'portfolio_hero_tag') {
                ThemeContent::set($theme, 'portfolio_tag', $value, 'portfolio', 'text', $page);
            } elseif ($key === 'portfolio_hero_description') {
                ThemeContent::set($theme, 'portfolio_subtitle', $value, 'portfolio', 'textarea', $page);
            } elseif ($key === 'blog_hero_tag') {
                ThemeContent::set($theme, 'blog_tag', $value, 'blog', 'text', $page);
                ThemeContent::set($theme, 'blog_badge', $value, 'blog', 'text', $page);
            } elseif ($key === 'blog_hero_description') {
                ThemeContent::set($theme, 'blog_subtitle', $value, 'blog', 'textarea', $page);
                ThemeContent::set($theme, 'blog_description', $value, 'blog', 'textarea', $page);
            } elseif ($key === 'faq_hero_tag') {
                ThemeContent::set($theme, 'faq_tag', $value, 'faq', 'text', $page);
                ThemeContent::set($theme, 'faq_badge', $value, 'faq', 'text', $page);
            } elseif ($key === 'faq_hero_description') {
                ThemeContent::set($theme, 'faq_subtitle', $value, 'faq', 'textarea', $page);
                ThemeContent::set($theme, 'faq_description', $value, 'faq', 'textarea', $page);
            } elseif ($key === 'faq_cta_title') {
                ThemeContent::set($theme, 'faq_support_title', $value, 'faq', 'text', $page);
            } elseif ($key === 'faq_cta_subtitle') {
                ThemeContent::set($theme, 'faq_support_subtitle', $value, 'faq', 'textarea', $page);
            } elseif ($key === 'faq_cta_btn_text') {
                ThemeContent::set($theme, 'faq_support_btn_text', $value, 'faq', 'text', $page);
            } elseif ($key === 'faq_cta_btn_url') {
                ThemeContent::set($theme, 'faq_support_btn_url', $value, 'faq', 'text', $page);
            }
        }

        $themeTitle = ucfirst(str_replace('_', ' ', $theme));
        $pageTitle = ucfirst($page) . ' Page';
        $targetRoute = \Illuminate\Support\Facades\Route::has("admin.pages.{$page}")
            ? route("admin.pages.{$page}", ['theme' => $theme])
            : route('admin.website.content', ['theme' => $theme]);

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'content',
            'title' => "Page Element Updated: {$pageTitle} ({$sectionName})",
            'message' => "Section '{$sectionName}' on {$pageTitle} for theme [{$themeTitle}] was saved.",
            'action_url' => $targetRoute,
            'icon' => 'globe',
            'color' => 'indigo',
        ]);

        flash()->success("{$sectionName} for [{$themeTitle}] saved successfully.");

        return redirect()->back();
    }

    /**
     * Infer page slug from request data or referer URL if not explicitly supplied.
     */
    private function detectPageFromRequest(Request $request, string $sectionName): string
    {
        $sn = strtolower($sectionName);
        if (str_contains($sn, 'about') || $request->has('about_hero_tag') || $request->has('about_stat1_value') || $request->has('about_narrative_title')) {
            return 'about';
        }
        if (str_contains($sn, 'contact') || $request->has('contact_hero_tag') || $request->has('contact_email_subtext') || $request->has('contact_form_badge')) {
            return 'contact';
        }
        if (str_contains($sn, 'service') || str_contains($sn, 'consultation') || $request->has('services_cta_title')) {
            return 'service';
        }
        if (str_contains($sn, 'project') || str_contains($sn, 'portfolio grid') || $request->has('portfolio_hero_tag') || $request->has('portfolio_filter_all_label')) {
            return 'project';
        }
        if (str_contains($sn, 'timeline') || str_contains($sn, 'cv download') || $request->has('resume_cv_title')) {
            return 'resume';
        }
        if (str_contains($sn, 'article feed') || str_contains($sn, 'newsletter') || $request->has('blog_hero_tag') || $request->has('blog_posts_per_page')) {
            return 'blog';
        }
        if (str_contains($sn, 'accordion') || str_contains($sn, 'unanswered') || $request->has('faq_hero_tag') || $request->has('faq_accordion_mode') || $request->has('faq_cta_tag')) {
            return 'faq';
        }

        $referer = (string) $request->headers->get('referer', '');
        foreach (['about', 'contact', 'service', 'project', 'resume', 'blog', 'faq', 'home'] as $p) {
            if (str_contains($referer, "/pages/{$p}") || str_contains($referer, "admin.pages.{$p}")) {
                return $p;
            }
        }

        return 'home';
    }
}
