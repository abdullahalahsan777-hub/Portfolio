<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use App\Models\PricingPlan;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Administrator
        User::updateOrCreate(
            ['email' => 'admin@portfolio.local'],
            [
                'name' => 'Portfolio Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '+1 (555) 234-5678',
            ]
        );

        // 2. Site Settings (matching the exact image layout and texts)
        $settings = [
            // General & Theme
            'active_theme' => 'developer', // 'developer', 'graphic_designer', 'uiux_designer'
            'site_title' => 'Alex Rivera — UX Designer & Web Developer',
            'site_logo_text' => 'Alex',
            'contact_email' => 'hello@portfolio.me',
            'contact_phone' => '+1 (555) 839-2019',
            'contact_location' => 'Austin, TX &bull; Remote Available Worldwide',
            // Branding & Images (Image Upload Settings)
            'software_logo' => 'images/defaults/software_logo.svg',
            'site_favicon' => 'images/defaults/favicon.svg',
            'mini_logo' => 'images/defaults/mini_logo.svg',
            'site_placeholder' => 'images/defaults/placeholder.jpg',

            // Social Media (Matching 3rd Image)
            'social_facebook' => 'https://www.facebook.com/yourpage',
            'social_instagram' => 'https://www.instagram.com/yourpage',
            'social_linkedin' => 'https://www.linkedin.com/company/yourpage',
            'social_pinterest' => 'https://www.pinterest.com/yourpage',
            'social_tiktok' => 'https://www.tiktok.com/@yourpage',
            'social_youtube' => 'https://www.youtube.com/@yourchannel',
            'social_github' => 'https://github.com',
            'social_twitter' => 'https://twitter.com',
            'social_dribbble' => 'https://dribbble.com',
            'social_behance' => 'https://behance.net',

            // Hero Section (Image Layout)
            'hero_tag' => 'Hey, I am Alex Rivera',
            'hero_title_line1' => 'UX designer',
            'hero_title_line2' => 'and WordPress',
            'hero_title_line3' => 'Developer',
            'hero_cta_text' => 'Hire Me',
            'hero_cta_url' => '#contact',

            // Ticker / Ribbon
            'ticker_text' => 'DEVELOPMENT * DESIGN * BRANDING * UI/UX * WORDPRESS * FULL-STACK * E-COMMERCE * SPEED OPTIMIZATION *',

            // About Section (Image Layout)
            'about_heading' => 'A passionate web designer turning ideas into visually stunning and user-friendly websites.',
            'about_description' => 'With over 6+ years of specialized experience in crafting pixel-perfect interfaces and solid backend architectures, I transform complex business challenges into seamless web applications with measurable impact.',
            'experience_years' => '06+ Years Experience',
            'completed_projects' => '120+ Completed Projects',

            // Impact / Features Box
            'impact_title' => 'How we can develop bigger impact',
            'impact_card1_title' => 'Strategic Thinking',
            'impact_card1_desc' => 'Every design and line of code is structured to maximize conversion and engagement.',
            'impact_card2_title' => 'Clean Architecture',
            'impact_card2_desc' => 'Maintainable, secure codebase engineered with Laravel, modern PHP, and optimal database indexing.',
            'impact_card3_title' => '24/7 Priority Support',
            'impact_card3_desc' => 'Dedicated post-launch warranty, ongoing performance monitoring, and iterative enhancements.',
            'impact_card4_title' => 'High Performance',
            'impact_card4_desc' => 'Sub-second load times, mobile-first responsiveness, and 99.9% uptime reliability.',

            // Services Section
            'services_title' => 'My Special Service For your Website Development',

            // Skills Section
            'skills_title' => 'Tools & Technologies I Use In My Everyday work',

            // Testimonials Section
            'testimonials_title' => 'What Amazing people Say About me',

            // Pricing Section
            'pricing_title' => 'Awesome Pricing For your Next Project',

            // Contact Section
            'contact_title' => "Let's Talk About your Next Project",
            'contact_subtitle' => 'Have a project in mind or need technical leadership? Send a message and let\'s turn your vision into reality.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 4. Seed Services
        Service::truncate();
        $services = [
            [
                'title' => 'Web & Mobile Design',
                'description' => 'Tailored UI/UX design systems, responsive layouts, and interactive wireframes built for high usability.',
                'icon' => 'device-mobile',
                'category' => 'Design',
                'theme' => 'all',
                'sort_order' => 1,
            ],
            [
                'title' => 'Website Development',
                'description' => 'Custom full-stack web applications, Laravel APIs, WordPress themes, and performant headless architectures.',
                'icon' => 'code-bracket',
                'category' => 'Development',
                'theme' => 'all',
                'sort_order' => 2,
            ],
            [
                'title' => 'Application Design',
                'description' => 'Complex SaaS dashboards, user onboarding funnels, and enterprise workflows designed with precision.',
                'icon' => 'sparkles',
                'category' => 'UI/UX',
                'theme' => 'all',
                'sort_order' => 3,
            ],
            // Graphic Designer specific
            [
                'title' => 'Brand Identity & Guidelines',
                'description' => 'Memorable logo suites, brand books, color schemes, and visual storytelling that sets your brand apart.',
                'icon' => 'swatch',
                'category' => 'Branding',
                'theme' => 'graphic_designer',
                'sort_order' => 4,
            ],
            [
                'title' => '3D Render & Motion Graphics',
                'description' => 'Eye-catching 3D product visualizations, animated social assets, and cinematic vector illustrations.',
                'icon' => 'cube',
                'category' => 'Creative',
                'theme' => 'graphic_designer',
                'sort_order' => 5,
            ],
            // UI/UX Designer specific
            [
                'title' => 'Design Systems & Tokens',
                'description' => 'Unified component libraries in Figma, design tokens, and scalable accessibility guidelines.',
                'icon' => 'square-3-stack-3d',
                'category' => 'Design Systems',
                'theme' => 'uiux_designer',
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $srv) {
            Service::create($srv);
        }

        // 5. Seed Skills
        Skill::truncate();
        $skills = [
            ['name' => 'Laravel / PHP', 'category' => 'Backend', 'percentage' => 95, 'theme' => 'developer', 'sort_order' => 1],
            ['name' => 'WordPress & WooCommerce', 'category' => 'CMS', 'percentage' => 92, 'theme' => 'developer', 'sort_order' => 2],
            ['name' => 'Vue.js & React', 'category' => 'Frontend', 'percentage' => 88, 'theme' => 'developer', 'sort_order' => 3],
            ['name' => 'Tailwind CSS & Sass', 'category' => 'Styling', 'percentage' => 96, 'theme' => 'developer', 'sort_order' => 4],
            ['name' => 'MySQL & Redis', 'category' => 'Database', 'percentage' => 90, 'theme' => 'developer', 'sort_order' => 5],
            ['name' => 'Docker & Cloud CI/CD', 'category' => 'DevOps', 'percentage' => 85, 'theme' => 'developer', 'sort_order' => 6],

            // Graphic Designer
            ['name' => 'Adobe Illustrator & Photoshop', 'category' => 'Design', 'percentage' => 98, 'theme' => 'graphic_designer', 'sort_order' => 1],
            ['name' => 'Brand Identity & Typography', 'category' => 'Branding', 'percentage' => 95, 'theme' => 'graphic_designer', 'sort_order' => 2],
            ['name' => 'Blender 3D Modeling', 'category' => '3D', 'percentage' => 86, 'theme' => 'graphic_designer', 'sort_order' => 3],
            ['name' => 'After Effects Motion Design', 'category' => 'Animation', 'percentage' => 89, 'theme' => 'graphic_designer', 'sort_order' => 4],

            // UI/UX Designer
            ['name' => 'Figma & FigJam Prototyping', 'category' => 'Prototyping', 'percentage' => 98, 'theme' => 'uiux_designer', 'sort_order' => 1],
            ['name' => 'User Research & Wireframing', 'category' => 'Research', 'percentage' => 92, 'theme' => 'uiux_designer', 'sort_order' => 2],
            ['name' => 'Design Systems (Atomic Design)', 'category' => 'Systems', 'percentage' => 94, 'theme' => 'uiux_designer', 'sort_order' => 3],
            ['name' => 'Usability Testing & Analytics', 'category' => 'Validation', 'percentage' => 88, 'theme' => 'uiux_designer', 'sort_order' => 4],
        ];

        foreach ($skills as $sk) {
            Skill::create($sk);
        }

        // 6. Seed Projects
        Project::truncate();
        $projects = [
            [
                'title' => 'Nordic Living E-Commerce',
                'category' => 'Web Design',
                'subtitle' => 'High-conversion shopping experience',
                'description' => 'A bespoke modern store designed for an organic furniture brand with custom checkout workflows and micro-interactions.',
                'image_url' => 'https://images.unsplash.com/photo-1507652313519-d4e9174996dd?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => 'https://github.com',
                'tags' => 'WordPress, WooCommerce, Tailwind',
                'theme' => 'developer',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'FinTrack SaaS Dashboard',
                'category' => 'Development',
                'subtitle' => 'Real-time multi-currency expense tracker',
                'description' => 'Real-time financial telemetry dashboard handling live transactions with chart analytics and automated PDF invoice generation.',
                'image_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => 'https://github.com',
                'tags' => 'Laravel 12, Vue 3, Redis, MySQL',
                'theme' => 'developer',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Aether Digital Agency',
                'category' => 'Branding',
                'subtitle' => 'Interactive 3D agency portfolio',
                'description' => 'Complete brand identity and interactive web experience featuring custom typography, dark aesthetic, and smooth page transitions.',
                'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => 'https://github.com',
                'tags' => 'UI/UX, GSAP, Tailwind CSS',
                'theme' => 'developer',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            // Graphic Designer Projects
            [
                'title' => 'Solace Botanical Cosmetics',
                'category' => 'Brand Identity',
                'subtitle' => 'Sustainable packaging & visual language',
                'description' => 'Complete packaging system, embossed label vector design, and clean typographic identity for organic skincare line.',
                'image_url' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Packaging, Illustrator, Branding',
                'theme' => 'graphic_designer',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Apex Synthwave Poster Series',
                'category' => 'Visual Art',
                'subtitle' => 'Retro-futuristic exhibition posters',
                'description' => 'Screen-printed poster collection exploring isometric geometry, vibrant duotone gradients, and typography layout.',
                'image_url' => 'https://images.unsplash.com/photo-1541701494587-cb58502866ab?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Print Design, Vector, Typography',
                'theme' => 'graphic_designer',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            // UI/UX Designer Projects
            [
                'title' => 'Pulse Health Mobile App',
                'category' => 'Product Design',
                'subtitle' => 'Patient tele-consultation platform',
                'description' => 'End-to-end UX flow from user research, journey mapping, wireframing, to high-fidelity clickable prototype in Figma.',
                'image_url' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Figma, Design System, UX Research',
                'theme' => 'uiux_designer',
                'is_featured' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($projects as $proj) {
            Project::create($proj);
        }

        // 7. Seed Testimonials (Matching screenshot)
        Testimonial::truncate();
        $testimonials = [
            [
                'client_name' => 'Marcus Vance',
                'client_role' => 'Founder & CEO',
                'company' => 'Aura Media Studio',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'content' => 'Alex delivered an extraordinary website that increased our client conversion by 48%. His eye for detail and clean code architecture are unmatched.',
                'theme' => 'all',
                'sort_order' => 1,
            ],
            [
                'client_name' => 'Sophia Chen',
                'client_role' => 'VP of Product',
                'company' => 'Kinetix Software',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'content' => 'Working with Alex was the best decision we made for our SaaS re-launch. The animations, speed, and backend responsiveness are truly world-class.',
                'theme' => 'all',
                'sort_order' => 2,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create($t);
        }

        // 8. Seed Pricing Plans (Matching screenshot: Basic, Standard, Premium)
        PricingPlan::truncate();
        $pricing = [
            [
                'name' => 'Basic Plan',
                'subtitle' => 'For startups & personal brands',
                'price' => 499.00,
                'billing_period' => 'project',
                'features' => "Landing Page Design\nResponsive Mobile Layout\nBasic SEO Setup\nContact Form Integration\n2 Rounds of Revisions\n1 Week Delivery",
                'is_featured' => false,
                'button_text' => 'Choose Basic',
                'button_url' => '#contact',
                'theme' => 'all',
                'sort_order' => 1,
            ],
            [
                'name' => 'Standard Plan',
                'subtitle' => 'Most Popular for growing businesses',
                'price' => 999.00,
                'billing_period' => 'project',
                'features' => "Multi-Page Custom Website\nCMS / WordPress or Laravel Core\nAdvanced Interactive Animations\nSpeed & Performance Optimization\nComprehensive SEO Strategy\n1 Month Priority Support",
                'is_featured' => true,
                'button_text' => 'Choose Standard',
                'button_url' => '#contact',
                'theme' => 'all',
                'sort_order' => 2,
            ],
            [
                'name' => 'Premium Plan',
                'subtitle' => 'For high-scale enterprises & SaaS',
                'price' => 1899.00,
                'billing_period' => 'project',
                'features' => "Custom Web Application Architecture\nREST API & Third-party Integrations\nFull Design System in Figma\nAutomated CI/CD Deployment\nDatabase Optimization & Caching\n3 Months Ongoing Maintenance",
                'is_featured' => false,
                'button_text' => 'Choose Premium',
                'button_url' => '#contact',
                'theme' => 'all',
                'sort_order' => 3,
            ],
        ];

        foreach ($pricing as $plan) {
            PricingPlan::create($plan);
        }

        // Seed additional rich elements across all themes
        $this->call(ThemeElementsSeeder::class);
        $this->call(ThemeContentSeeder::class);
    }
}
