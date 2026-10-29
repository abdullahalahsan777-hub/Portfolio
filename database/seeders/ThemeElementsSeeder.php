<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\PricingPlan;
use App\Models\Project;
use App\Models\ResumeItem;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ThemeElementsSeeder extends Seeder
{
    public function run(): void
    {
        /* =========================================================================
           1. DEVELOPER THEME (GLINT - Developer Design.png)
           ========================================================================= */
        $developerServices = [
            [
                'title' => 'Design Principales',
                'description' => "Need A Project Completed By An Expert? Let's Go! Access A Human Resources Consultant To Answer Questions",
                'icon' => 'sparkles',
                'category' => 'Design',
                'theme' => 'developer',
                'sort_order' => 1,
            ],
            [
                'title' => 'Unique Values',
                'description' => "Need A Project Completed By An Expert? Let's Go! Access A Human Resources Consultant To Answer Questions",
                'icon' => 'light-bulb',
                'category' => 'Strategy',
                'theme' => 'developer',
                'sort_order' => 2,
            ],
            [
                'title' => 'Style Components',
                'description' => "Need A Project Completed By An Expert? Let's Go! Access A Human Resources Consultant To Answer Questions",
                'icon' => 'square-3-stack-3d',
                'category' => 'UI/UX',
                'theme' => 'developer',
                'sort_order' => 3,
            ],
            [
                'title' => 'Enterprise Web Architecture',
                'description' => 'Architecting scalable, decoupled web applications using modern Laravel, Vue 3, and microservices.',
                'icon' => 'code-bracket',
                'category' => 'Full-Stack',
                'theme' => 'developer',
                'sort_order' => 4,
            ],
        ];
        foreach ($developerServices as $item) {
            Service::updateOrCreate(['title' => $item['title'], 'theme' => $item['theme']], $item);
        }

        $developerProjects = [
            [
                'title' => 'Catering by Chefs',
                'category' => 'Food & Event',
                'subtitle' => 'For People With Taste Buds',
                'description' => 'Culinary brand experience, interactive menu booking, and digital event reservation system.',
                'image_url' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Branding, Laravel, Booking, Tailored UI',
                'theme' => 'developer',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'We Serve Food But With A Purpose',
                'category' => 'Branding',
                'subtitle' => 'Family Restaurant & Digital Menu',
                'description' => 'Farm-to-table digital ordering pipeline with real-time POS sync and customer rewards.',
                'image_url' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'E-Commerce, Vue.js, POS API, Mobile UI',
                'theme' => 'developer',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'We do big things with big ideas',
                'category' => 'Architecture',
                'subtitle' => 'Corporate Architecture Company Inc.',
                'description' => 'Immersive 3D architectural showcase, interactive building plans, and investor portfolio.',
                'image_url' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'WebGL, Corporate, 3D Architecture, Next.js',
                'theme' => 'developer',
                'is_featured' => true,
                'sort_order' => 3,
            ],
        ];
        foreach ($developerProjects as $item) {
            Project::updateOrCreate(['title' => $item['title'], 'theme' => $item['theme']], $item);
        }

        $developerSkills = [
            ['name' => 'Branding Design', 'category' => 'Design', 'percentage' => 60, 'theme' => 'developer', 'sort_order' => 1],
            ['name' => 'UI & UX Design', 'category' => 'Interface', 'percentage' => 70, 'theme' => 'developer', 'sort_order' => 2],
            ['name' => 'Web Design', 'category' => 'Frontend', 'percentage' => 30, 'theme' => 'developer', 'sort_order' => 3],
            ['name' => 'Illustration', 'category' => 'Creative', 'percentage' => 90, 'theme' => 'developer', 'sort_order' => 4],
            ['name' => 'Laravel & Modern PHP', 'category' => 'Backend', 'percentage' => 95, 'theme' => 'developer', 'sort_order' => 5],
            ['name' => 'Docker & Cloud Infra', 'category' => 'DevOps', 'percentage' => 88, 'theme' => 'developer', 'sort_order' => 6],
        ];
        foreach ($developerSkills as $item) {
            Skill::updateOrCreate(['name' => $item['name'], 'theme' => $item['theme']], $item);
        }

        $developerResume = [
            [
                'title' => 'UI Designer',
                'institution' => 'Google Corporation',
                'period' => '2011 — 2014',
                'description' => 'Works Seamlessly Computer. Enterprise UX systems and modular design patterns for cloud workspace.',
                'type' => 'experience',
                'theme' => 'developer',
                'sort_order' => 1,
            ],
            [
                'title' => 'UI Designer',
                'institution' => 'Apple Product Co',
                'period' => '2011 — 2014',
                'description' => 'Works Seamlessly Computer. Human interface guidelines, iOS micro-interactions, and reactive components.',
                'type' => 'experience',
                'theme' => 'developer',
                'sort_order' => 2,
            ],
            [
                'title' => 'Lead Designer',
                'institution' => 'Lead Designer Microsoft',
                'period' => '2011 — 2014',
                'description' => 'Works Seamlessly Computer. Fluent Design component libraries, telemetry monitoring, and dashboard UI.',
                'type' => 'experience',
                'theme' => 'developer',
                'sort_order' => 3,
            ],
            [
                'title' => 'UI Designer',
                'institution' => 'Bruno Mars AS',
                'period' => '2011 — 2014',
                'description' => 'Works Seamlessly Computer. Media platform architecture, live streaming interface, and high-scale user experience.',
                'type' => 'experience',
                'theme' => 'developer',
                'sort_order' => 4,
            ],
        ];
        foreach ($developerResume as $item) {
            ResumeItem::updateOrCreate(['title' => $item['title'], 'institution' => $item['institution'], 'theme' => $item['theme']], $item);
        }

        $developerPricing = [
            [
                'name' => 'Influencer',
                'subtitle' => 'Best For Small Investors',
                'price' => 104.00,
                'billing_period' => 'month',
                'features' => json_encode(['Web App Architecture', 'Interactive Prototypes', 'REST API Integration', 'Dedicated Tech Support']),
                'is_featured' => false,
                'button_text' => 'Read More',
                'button_url' => '#contact',
                'theme' => 'developer',
                'sort_order' => 1,
            ],
            [
                'name' => 'Agency',
                'subtitle' => 'Best For Small Investors',
                'price' => 204.00,
                'billing_period' => 'month',
                'features' => json_encode(['Full-Stack Development', 'Cloud Cluster Deployment', 'High Performance Caching', '24/7 Priority SLA']),
                'is_featured' => true,
                'button_text' => 'Read More',
                'button_url' => '#contact',
                'theme' => 'developer',
                'sort_order' => 2,
            ],
            [
                'name' => 'Enterprise',
                'subtitle' => 'Best For Small Investors',
                'price' => 499.00,
                'billing_period' => 'month',
                'features' => json_encode(['Custom Microservices', 'Kubernetes Cluster', 'Zero-Downtime Migration', 'Dedicated Lead Architect']),
                'is_featured' => false,
                'button_text' => 'Read More',
                'button_url' => '#contact',
                'theme' => 'developer',
                'sort_order' => 3,
            ],
        ];
        foreach ($developerPricing as $item) {
            PricingPlan::updateOrCreate(['name' => $item['name'], 'theme' => $item['theme']], $item);
        }

        $developerTestimonials = [
            [
                'client_name' => 'Jack Metiyo Shina',
                'client_role' => 'Founder & Managing Partner',
                'company' => 'NYC, USA',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'content' => 'GILROY IS A GREAT AND SUPER-PROFESSIONAL SERVICE PROVIDER, WHICH BROUGHT NEW TECHNOLOGIES, NEW METHODOLOGY, AND A FRESH PERSPECTIVE TO OUR PROJECT',
                'theme' => 'developer',
                'sort_order' => 1,
            ],
        ];
        foreach ($developerTestimonials as $item) {
            Testimonial::updateOrCreate(['client_name' => $item['client_name'], 'theme' => $item['theme']], $item);
        }

        $developerBlogs = [
            [
                'title' => 'Addiction When Gambling Becomes Complex Systems',
                'slug' => 'addiction-when-gambling-becomes-complex-systems',
                'category' => 'Technology',
                'date' => 'September 28, 2019',
                'read_time' => '5 min read',
                'author' => 'Alex Rivera',
                'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Architecting ethical engagement systems and high-throughput real-time telemetry for consumer-facing SaaS.',
                'content' => 'Full architectural review of reactive microservices, queue orchestration, and data consistency patterns.',
                'theme' => 'developer',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Hypnosis 12 Steps To Acquire Mind Power in Engineering',
                'slug' => 'hypnosis-12-steps-to-acquire-mind-power',
                'category' => 'Performance',
                'date' => 'September 28, 2019',
                'read_time' => '6 min read',
                'author' => 'Alex Rivera',
                'image' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Deep work strategies and cognitive load reduction for engineering teams building distributed cloud applications.',
                'content' => 'How continuous profiling and mental clarity accelerate software development cycles.',
                'theme' => 'developer',
                'is_published' => true,
                'sort_order' => 2,
            ],
        ];
        foreach ($developerBlogs as $item) {
            BlogPost::updateOrCreate(['slug' => $item['slug']], $item);
        }

        /* =========================================================================
           2. GRAPHIC DESIGNER THEME (william.design - GraphicsDesigner.png)
           ========================================================================= */
        $graphicServices = [
            [
                'title' => '01. UI/UX Design',
                'description' => 'Designing visually stunning and user-friendly interfaces for web and mobile applications.',
                'icon' => 'device-phone-mobile',
                'category' => 'UI/UX',
                'theme' => 'graphic_designer',
                'sort_order' => 1,
            ],
            [
                'title' => '02. Mobile App Design',
                'description' => 'Designing intuitive and appealing mobile applications for both iOS and Android platforms.',
                'icon' => 'device-mobile',
                'category' => 'Mobile',
                'theme' => 'graphic_designer',
                'sort_order' => 2,
            ],
            [
                'title' => '03. Brand Identity Design',
                'description' => 'Developing cohesive visual branding that resonates with your target audience.',
                'icon' => 'swatch',
                'category' => 'Branding',
                'theme' => 'graphic_designer',
                'sort_order' => 3,
            ],
            [
                'title' => '04. Web Development',
                'description' => 'Crafting responsive and engaging websites that align with your brand and business goals.',
                'icon' => 'code-bracket',
                'category' => 'Web Dev',
                'theme' => 'graphic_designer',
                'sort_order' => 4,
            ],
        ];
        foreach ($graphicServices as $item) {
            Service::updateOrCreate(['title' => $item['title'], 'theme' => $item['theme']], $item);
        }

        $graphicProjects = [
            [
                'title' => 'Photo App UI/UX',
                'category' => 'UI/UX',
                'subtitle' => 'Bokeh network',
                'description' => 'Meet your new photography portfolio. Smart photo cataloging, dark mode editing experience, and portfolio sharing.',
                'image_url' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Figma, Mobile UI, Photo Editing, Dark Mode',
                'theme' => 'graphic_designer',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Mobile App Design',
                'category' => 'Mobile App',
                'subtitle' => 'Tech Innovators Inc.',
                'description' => 'Bring every idea to life. Frictionless biometric onboarding, real-time sync, and fluid fluid gesture navigation.',
                'image_url' => 'https://images.unsplash.com/photo-1559526324-4b87b5e36e44?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'iOS, Android, FinTech, Micro-Interactions',
                'theme' => 'graphic_designer',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Interaction Design',
                'category' => 'Interaction',
                'subtitle' => 'HealthTrack Solutions',
                'description' => 'The AI-enhanced call experience with animated voice waveforms and zero-latency telemetry.',
                'image_url' => 'https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Prototyping, Telehealth, Framer, AI Audio',
                'theme' => 'graphic_designer',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Design Consultation',
                'category' => 'Branding',
                'subtitle' => 'Creative Pulse Studios',
                'description' => 'Bold typographic brand identity, exhibition collateral, and spatial event signage.',
                'image_url' => 'https://images.unsplash.com/photo-1539185441755-769473a23570?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Print, Packaging, Typography, Vector',
                'theme' => 'graphic_designer',
                'is_featured' => true,
                'sort_order' => 4,
            ],
        ];
        foreach ($graphicProjects as $item) {
            Project::updateOrCreate(['title' => $item['title'], 'theme' => $item['theme']], $item);
        }

        $graphicSkills = [
            ['name' => 'Figma', 'category' => 'Design Tool', 'percentage' => 98, 'theme' => 'graphic_designer', 'sort_order' => 1],
            ['name' => 'Adobe XD', 'category' => 'Prototyping', 'percentage' => 82, 'theme' => 'graphic_designer', 'sort_order' => 2],
            ['name' => 'Illustrator', 'category' => 'Vector', 'percentage' => 76, 'theme' => 'graphic_designer', 'sort_order' => 3],
            ['name' => 'Sketch', 'category' => 'Interface', 'percentage' => 58, 'theme' => 'graphic_designer', 'sort_order' => 4],
            ['name' => 'Photoshop', 'category' => 'Photo Editing', 'percentage' => 60, 'theme' => 'graphic_designer', 'sort_order' => 5],
            ['name' => 'Webflow', 'category' => 'No-Code Web', 'percentage' => 72, 'theme' => 'graphic_designer', 'sort_order' => 6],
            ['name' => 'Framer', 'category' => 'Motion & Code', 'percentage' => 93, 'theme' => 'graphic_designer', 'sort_order' => 7],
        ];
        foreach ($graphicSkills as $item) {
            Skill::updateOrCreate(['name' => $item['name'], 'theme' => $item['theme']], $item);
        }

        $graphicResume = [
            // Education
            [
                'title' => 'Certification in UX Design',
                'institution' => 'University of Stanford',
                'period' => '2018 — 2019',
                'grade' => '4.9/5',
                'description' => 'Human-centered design principles, behavioral economics, and usability testing methodologies.',
                'type' => 'education',
                'theme' => 'graphic_designer',
                'sort_order' => 1,
            ],
            [
                'title' => 'Certification in Web Dev',
                'institution' => 'University of Stanford',
                'period' => '2017 — 2018',
                'grade' => '5.0/5',
                'description' => 'Advanced HTML5 semantic structure, CSS grid systems, client-side animation, and web accessibility.',
                'type' => 'education',
                'theme' => 'graphic_designer',
                'sort_order' => 2,
            ],
            [
                'title' => 'Advanced UX/UI Bootcamp',
                'institution' => 'Design Academy',
                'period' => '2014 — 2016',
                'grade' => '4.9/5',
                'description' => 'Rapid prototyping sprints, user flow mapping, design token architecture, and interactive design.',
                'type' => 'education',
                'theme' => 'graphic_designer',
                'sort_order' => 3,
            ],
            [
                'title' => 'Certification in Graphic Design',
                'institution' => 'Coursera',
                'period' => '2012 — 2013',
                'grade' => '4.8/5',
                'description' => 'Swiss graphic design heritage, typography rules, color theory, and print production workflows.',
                'type' => 'education',
                'theme' => 'graphic_designer',
                'sort_order' => 4,
            ],
            // Experience
            [
                'title' => 'Senior UI/UX Designer',
                'institution' => 'Leader in Creative team',
                'period' => '2019 — Present',
                'description' => 'Directing end-to-end design strategy for mobile applications and SaaS dashboards.',
                'type' => 'experience',
                'theme' => 'graphic_designer',
                'sort_order' => 1,
            ],
            [
                'title' => 'UI/UX Designer at BOS Agency',
                'institution' => 'Tech Startup',
                'period' => '2016 — 2019',
                'description' => 'Designed modular component libraries in Figma and boosted user retention metrics by 42%.',
                'type' => 'experience',
                'theme' => 'graphic_designer',
                'sort_order' => 2,
            ],
            [
                'title' => 'Freelance UI/UX Designer',
                'institution' => 'Self-Employed',
                'period' => '2014 — 2016',
                'description' => 'Delivered bespoke branding and web interfaces for 30+ international clients.',
                'type' => 'experience',
                'theme' => 'graphic_designer',
                'sort_order' => 3,
            ],
            [
                'title' => 'Junior UI Designer',
                'institution' => 'Web Solutions team',
                'period' => '2012 — 2014',
                'description' => 'Constructed wireframes, high-fidelity prototypes, and graphic assets for consumer products.',
                'type' => 'experience',
                'theme' => 'graphic_designer',
                'sort_order' => 4,
            ],
        ];
        foreach ($graphicResume as $item) {
            ResumeItem::updateOrCreate(['title' => $item['title'], 'institution' => $item['institution'], 'theme' => $item['theme']], $item);
        }

        $graphicTestimonials = [
            [
                'client_name' => 'John Doe',
                'client_role' => 'Head of Legal and Compliance',
                'company' => 'Tech Innovators',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'content' => "Working with William was an absolute pleasure. His attention to detail and user-focused design approach significantly improved our product's usability.",
                'theme' => 'graphic_designer',
                'sort_order' => 1,
            ],
        ];
        foreach ($graphicTestimonials as $item) {
            Testimonial::updateOrCreate(['client_name' => $item['client_name'], 'theme' => $item['theme']], $item);
        }

        $graphicBlogs = [
            [
                'title' => '5 UI/UX Trends to Watch in 2024',
                'slug' => '5-ui-ux-trends-to-watch-in-2024',
                'category' => 'App Design',
                'date' => 'March 28, 2023',
                'read_time' => '3 min read',
                'author' => 'William',
                'image' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Stay ahead of the curve with these emerging trends in UI/UX design and spatial interfaces.',
                'content' => 'Comprehensive breakdown of micro-interactions, dark mode color grading, and accessible design systems.',
                'theme' => 'graphic_designer',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'The Importance of User Research',
                'slug' => 'the-importance-of-user-research',
                'category' => 'Branding',
                'date' => 'March 28, 2023',
                'read_time' => '3 min read',
                'author' => 'William',
                'image' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Why empathetic qualitative research prevents costly product misalignments before launching.',
                'content' => 'How user interviews and continuous usability testing turn hypotheses into measurable conversions.',
                'theme' => 'graphic_designer',
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'The Role of Color Psychology in Conversions',
                'slug' => 'the-role-of-color-psychology',
                'category' => 'Mockup',
                'date' => 'March 28, 2023',
                'read_time' => '3 min read',
                'author' => 'William',
                'image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Stay ahead of the curve with these emerging chromatic harmony trends in UI/UX design.',
                'content' => 'Practical guides for choosing primary, secondary, and accent colors that resonate with target demographics.',
                'theme' => 'graphic_designer',
                'is_published' => true,
                'sort_order' => 3,
            ],
        ];
        foreach ($graphicBlogs as $item) {
            BlogPost::updateOrCreate(['slug' => $item['slug']], $item);
        }

        /* =========================================================================
           3. UI/UX DESIGNER THEME (Noxfolio - UI UX Designer.png)
           ========================================================================= */
        $uiuxServices = [
            ['title' => '01. Brand Identity Design', 'description' => 'Dignissimos ducimus blanditiis praesentium voluptatum deleniti atque corrupti quos dolores.', 'icon' => 'swatch', 'category' => 'Branding', 'theme' => 'uiux_designer', 'sort_order' => 1],
            ['title' => '02. Website Design', 'description' => 'Dignissimos ducimus blanditiis praesentium voluptatum deleniti atque corrupti quos dolores.', 'icon' => 'device-mobile', 'category' => 'Web Design', 'theme' => 'uiux_designer', 'sort_order' => 2],
            ['title' => '03. Mobile Application Design', 'description' => 'Dignissimos ducimus blanditiis praesentium voluptatum deleniti atque corrupti quos dolores.', 'icon' => 'device-phone-mobile', 'category' => 'Mobile', 'theme' => 'uiux_designer', 'sort_order' => 3],
            ['title' => '04. Motion Graphics Design', 'description' => 'Dignissimos ducimus blanditiis praesentium voluptatum deleniti atque corrupti quos dolores.', 'icon' => 'sparkles', 'category' => 'Motion', 'theme' => 'uiux_designer', 'sort_order' => 4],
            ['title' => '05. Website Development', 'description' => 'Dignissimos ducimus blanditiis praesentium voluptatum deleniti atque corrupti quos dolores.', 'icon' => 'code-bracket', 'category' => 'Development', 'theme' => 'uiux_designer', 'sort_order' => 5],
            ['title' => '06. SEO & Digital Marketing', 'description' => 'Dignissimos ducimus blanditiis praesentium voluptatum deleniti atque corrupti quos dolores.', 'icon' => 'chart-bar', 'category' => 'Marketing', 'theme' => 'uiux_designer', 'sort_order' => 6],
        ];
        foreach ($uiuxServices as $item) {
            Service::updateOrCreate(['title' => $item['title'], 'theme' => $item['theme']], $item);
        }

        $uiuxProjects = [
            [
                'title' => 'Mobile Application Design',
                'category' => 'Product Design',
                'subtitle' => 'Modern iOS Interface System',
                'description' => 'Sed ut perspiciatis unde omnis iste natus voluptatem accusantium doloremque laudantium.',
                'image_url' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Product Design, Figma, Mobile UI',
                'theme' => 'uiux_designer',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Website Makeup Design',
                'category' => 'Product Design',
                'subtitle' => 'E-Commerce Beauty Portal',
                'description' => 'Sed ut perspiciatis unde omnis natus totam rem aperiam eaque inventore veritatis architecto.',
                'image_url' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'E-Commerce, Minimalist, Responsive',
                'theme' => 'uiux_designer',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Brand Identity and Motion Design',
                'category' => 'Product Design',
                'subtitle' => 'Tactile Brand Packaging & Cards',
                'description' => 'Sed ut perspiciatis unde omnis natus totam rem aperiam eaque inventore veritatis architecto.',
                'image_url' => 'https://images.unsplash.com/photo-1539185441755-769473a23570?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Branding, Foil Print, Typography',
                'theme' => 'uiux_designer',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Mobile Application Development',
                'category' => 'Product Design',
                'subtitle' => 'Cross-Platform App Architecture',
                'description' => 'Sed ut perspiciatis unde omnis natus totam rem aperiam eaque inventore veritatis architecto.',
                'image_url' => 'https://images.unsplash.com/photo-1559526324-4b87b5e36e44?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'React Native, Design Tokens, UX Research',
                'theme' => 'uiux_designer',
                'is_featured' => true,
                'sort_order' => 4,
            ],
        ];
        foreach ($uiuxProjects as $item) {
            Project::updateOrCreate(['title' => $item['title'], 'theme' => $item['theme']], $item);
        }

        $uiuxResume = [
            [
                'title' => 'Lead Product Designer',
                'institution' => 'Google',
                'period' => '2021 — Present',
                'description' => 'Directing Google Workspace visual design tokens and accessibility guidelines across 1B+ active users.',
                'type' => 'experience',
                'theme' => 'uiux_designer',
                'sort_order' => 1,
            ],
            [
                'title' => 'Junior UX/UI Designer',
                'institution' => 'LinkedIn',
                'period' => '2016 — 2018',
                'description' => 'Collaborated on mobile feed redesign and user onboarding flow optimization.',
                'type' => 'experience',
                'theme' => 'uiux_designer',
                'sort_order' => 2,
            ],
            [
                'title' => 'Senior Product Designer',
                'institution' => 'Webflow',
                'period' => '2018 — 2021',
                'description' => 'Spearheaded visual interaction builder and responsive canvas UI components.',
                'type' => 'experience',
                'theme' => 'uiux_designer',
                'sort_order' => 3,
            ],
            [
                'title' => 'Graphics Designer',
                'institution' => 'Apple',
                'period' => '2014 — 2016',
                'description' => 'Crafted marketing materials and product presentation decks for Apple Keynotes.',
                'type' => 'experience',
                'theme' => 'uiux_designer',
                'sort_order' => 4,
            ],
        ];
        foreach ($uiuxResume as $item) {
            ResumeItem::updateOrCreate(['title' => $item['title'], 'institution' => $item['institution'], 'theme' => $item['theme']], $item);
        }

        $uiuxPricing = [
            [
                'name' => 'Basic Plan',
                'subtitle' => 'Sed perspiciatis unde natus totam rem aperiam eaque',
                'price' => 19.95,
                'billing_period' => 'month',
                'features' => json_encode(['Website Design', 'Mobile Apps Design', 'Product Design', 'Digital Marketing', 'Custom Support']),
                'is_featured' => false,
                'button_text' => 'Choose Plan',
                'button_url' => '#contact',
                'theme' => 'uiux_designer',
                'sort_order' => 1,
            ],
            [
                'name' => 'Standard Plan',
                'subtitle' => 'Sed perspiciatis unde natus totam rem aperiam eaque',
                'price' => 19.95,
                'billing_period' => 'month',
                'features' => json_encode(['Website Design', 'Mobile Apps Design', 'Product Design', 'Digital Marketing', 'Custom Support']),
                'is_featured' => true,
                'button_text' => 'Choose Plan',
                'button_url' => '#contact',
                'theme' => 'uiux_designer',
                'sort_order' => 2,
            ],
            [
                'name' => 'Premium Plan',
                'subtitle' => 'Sed perspiciatis unde natus totam rem aperiam eaque',
                'price' => 19.95,
                'billing_period' => 'month',
                'features' => json_encode(['Website Design', 'Mobile Apps Design', 'Product Design', 'Digital Marketing', 'Custom Support']),
                'is_featured' => false,
                'button_text' => 'Choose Plan',
                'button_url' => '#contact',
                'theme' => 'uiux_designer',
                'sort_order' => 3,
            ],
        ];
        foreach ($uiuxPricing as $item) {
            PricingPlan::updateOrCreate(['name' => $item['name'], 'theme' => $item['theme']], $item);
        }

        $uiuxTestimonials = [
            [
                'client_name' => 'Rosalie D. Graham',
                'client_role' => 'CEO & Founder',
                'company' => 'Nox Digital',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'content' => 'Nam libero tempore cumsoluta nobise est eligendi optio cumque nihil impedit quominus idquod maxime placeat facere possimus.',
                'theme' => 'uiux_designer',
                'sort_order' => 1,
            ],
            [
                'client_name' => 'Kenneth C. Burton',
                'client_role' => 'Web Developer',
                'company' => 'Creative Minds',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'content' => 'At vero eoset accusamus et iusto odio dignissimos ducimus quie blanditiis praesentium voluptatum deleniti atque corrupti.',
                'theme' => 'uiux_designer',
                'sort_order' => 2,
            ],
        ];
        foreach ($uiuxTestimonials as $item) {
            Testimonial::updateOrCreate(['client_name' => $item['client_name'], 'theme' => $item['theme']], $item);
        }

        $uiuxBlogs = [
            [
                'title' => 'Usability Studies in Modern Digital Workspaces',
                'slug' => 'usability-studies-modern-digital-workspaces',
                'category' => 'Design, Figma',
                'date' => 'September 25, 2023',
                'read_time' => '4 min read',
                'author' => 'Roy C. Jones',
                'image' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'How remote unmoderated user tests illuminate critical friction points in digital workflows.',
                'content' => 'Full study on user test synthesis and implementing ergonomic visual patterns in enterprise SaaS.',
                'theme' => 'uiux_designer',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Assistive Technology and Inclusive Interface Guidelines',
                'slug' => 'assistive-technology-inclusive-interface-guidelines',
                'category' => 'Design, Figma',
                'date' => 'September 25, 2023',
                'read_time' => '5 min read',
                'author' => 'Roy C. Jones',
                'image' => 'https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Building accessible screen-reader optimized digital interfaces conforming to WCAG 2.1 AAA.',
                'content' => 'Practical checklist for color contrast, keyboard tab indexing, and accessible SVG icons.',
                'theme' => 'uiux_designer',
                'is_published' => true,
                'sort_order' => 2,
            ],
        ];
        foreach ($uiuxBlogs as $item) {
            BlogPost::updateOrCreate(['slug' => $item['slug']], $item);
        }

        /* =========================================================================
           4. APP DEVELOPER THEME (MYSTORY - app Developer.png)
           ========================================================================= */
        $appDevServices = [
            ['title' => 'UI/UX Design', 'description' => 'I design modern and user-friendly mobile app interfaces that deliver seamless experiences.', 'icon' => 'sparkles', 'category' => 'UI/UX', 'theme' => 'app_developer', 'sort_order' => 1],
            ['title' => 'Brand Identity Design', 'description' => 'I craft unique brand identities that capture your vision and connect with your audience.', 'icon' => 'swatch', 'category' => 'Branding', 'theme' => 'app_developer', 'sort_order' => 2],
            ['title' => 'Mobile App Design', 'description' => 'I design modern and user-friendly mobile app interfaces that deliver seamless experiences.', 'icon' => 'device-phone-mobile', 'category' => 'Mobile', 'theme' => 'app_developer', 'sort_order' => 3],
            ['title' => 'Web Design', 'description' => 'I craft unique brand identities that capture your vision and connect with your audience.', 'icon' => 'device-mobile', 'category' => 'Web', 'theme' => 'app_developer', 'sort_order' => 4],
            ['title' => 'Digital Product', 'description' => 'I design modern and user-friendly mobile app interfaces that deliver seamless experiences.', 'icon' => 'cube', 'category' => 'Product', 'theme' => 'app_developer', 'sort_order' => 5],
            ['title' => 'Content Writing', 'description' => 'I design modern and user-friendly mobile app interfaces that deliver seamless experiences.', 'icon' => 'pencil-square', 'category' => 'Content', 'theme' => 'app_developer', 'sort_order' => 6],
        ];
        foreach ($appDevServices as $item) {
            Service::updateOrCreate(['title' => $item['title'], 'theme' => $item['theme']], $item);
        }

        $appDevProjects = [
            [
                'title' => 'Branding Mockup Design',
                'category' => 'Backend Development',
                'subtitle' => 'Finance Company',
                'description' => 'Brand identity refresh for a local business with high conversion checkout and client portal.',
                'image_url' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Finance, Backend, Laravel, Mockup',
                'theme' => 'app_developer',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Learning Mangement',
                'category' => 'Backend Development',
                'subtitle' => 'Finance Company',
                'description' => 'Full-scale corporate e-learning LMS portal with interactive quizzes, course progress, and video streaming.',
                'image_url' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'LMS, Video, Real-Time, Education',
                'theme' => 'app_developer',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Mobile App Design',
                'category' => 'Backend Development',
                'subtitle' => 'Finance Company',
                'description' => 'Cryptocurrency mobile wallet with biometric security, portfolio charts, and instant fiat withdrawals.',
                'image_url' => 'https://images.unsplash.com/photo-1526498460520-4c246339dccb?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Crypto, React Native, Biometrics, Mobile',
                'theme' => 'app_developer',
                'is_featured' => true,
                'sort_order' => 3,
            ],
        ];
        foreach ($appDevProjects as $item) {
            Project::updateOrCreate(['title' => $item['title'], 'theme' => $item['theme']], $item);
        }

        $appDevSkills = [
            ['name' => 'HTML/CSS', 'category' => 'Frontend Core', 'percentage' => 75, 'theme' => 'app_developer', 'sort_order' => 1],
            ['name' => 'Digital Marketing', 'category' => 'Growth', 'percentage' => 79, 'theme' => 'app_developer', 'sort_order' => 2],
            ['name' => 'Web Design', 'category' => 'UI Design', 'percentage' => 88, 'theme' => 'app_developer', 'sort_order' => 3],
            ['name' => 'UI/UX', 'category' => 'User Experience', 'percentage' => 95, 'theme' => 'app_developer', 'sort_order' => 4],
            ['name' => 'Javascript', 'category' => 'Client Scripting', 'percentage' => 60, 'theme' => 'app_developer', 'sort_order' => 5],
            ['name' => 'Next JS', 'category' => 'React Framework', 'percentage' => 90, 'theme' => 'app_developer', 'sort_order' => 6],
            ['name' => 'React JS', 'category' => 'Web UI', 'percentage' => 79, 'theme' => 'app_developer', 'sort_order' => 7],
            ['name' => 'Kit', 'category' => 'Tooling', 'percentage' => 97, 'theme' => 'app_developer', 'sort_order' => 8],
            ['name' => 'Wordpress', 'category' => 'CMS Architecture', 'percentage' => 80, 'theme' => 'app_developer', 'sort_order' => 9],
            ['name' => 'CMS', 'category' => 'Content Management', 'percentage' => 85, 'theme' => 'app_developer', 'sort_order' => 10],
        ];
        foreach ($appDevSkills as $item) {
            Skill::updateOrCreate(['name' => $item['name'], 'theme' => $item['theme']], $item);
        }

        $appDevResume = [
            // Education
            [
                'title' => 'Masteral in Information Technology',
                'institution' => 'UDEMY / SKILLSHARE / CODECADEMY',
                'period' => 'ONGOING',
                'description' => 'Project-based learning in responsive layout, mobile-first design, and CMS platforms like WordPress.',
                'type' => 'education',
                'theme' => 'app_developer',
                'sort_order' => 1,
            ],
            [
                'title' => 'Computer Processing Systems',
                'institution' => 'UNIVERSITY OF VISUAL ARTS',
                'period' => '2018 — 2022',
                'description' => 'Emphasis on design theory, color psychology, branding, and layout composition.',
                'type' => 'education',
                'theme' => 'app_developer',
                'sort_order' => 2,
            ],
            [
                'title' => 'Google UX Design Certificate',
                'institution' => 'COURSERA — GOOGLE CAREER CERTIFICATES',
                'period' => '2023',
                'description' => 'Learned UX research, wireframing, prototyping, and usability testing with real projects.',
                'type' => 'education',
                'theme' => 'app_developer',
                'sort_order' => 3,
            ],
            // Experience
            [
                'title' => 'Full Stack Developer',
                'institution' => 'UDEMY / SKILLSHARE / CODECADEMY',
                'period' => 'ONGOING',
                'description' => 'Project-based learning in responsive layout, mobile-first design, and CMS platforms like WordPress.',
                'type' => 'experience',
                'theme' => 'app_developer',
                'sort_order' => 1,
            ],
            [
                'title' => 'Front End Development',
                'institution' => 'UNIVERSITY OF VISUAL ARTS',
                'period' => '2018 — 2022',
                'description' => 'Emphasis on design theory, color psychology, branding, and layout composition.',
                'type' => 'experience',
                'theme' => 'app_developer',
                'sort_order' => 2,
            ],
            [
                'title' => 'UI/UX Designer',
                'institution' => 'COURSERA — GOOGLE CAREER CERTIFICATES',
                'period' => '2023',
                'description' => 'Learned UX research, wireframing, prototyping, and usability testing with real projects.',
                'type' => 'experience',
                'theme' => 'app_developer',
                'sort_order' => 3,
            ],
        ];
        foreach ($appDevResume as $item) {
            ResumeItem::updateOrCreate(['title' => $item['title'], 'institution' => $item['institution'], 'theme' => $item['theme']], $item);
        }

        $appDevFaqs = [
            [
                'question' => 'Q1. What services do you offer?',
                'answer' => 'I specialize in web design, WordPress development, and front-end solutions. I also provide UI/UX design, website optimization, and maintenance support for clients looking for long-term collaboration.',
                'category' => 'General',
                'theme' => 'app_developer',
                'sort_order' => 1,
            ],
            [
                'question' => 'Q2. What are your payment terms?',
                'answer' => 'I typically work on a 50% deposit upfront and 50% upon project completion and client sign-off. Milestone payments are also available for larger custom projects.',
                'category' => 'Billing',
                'theme' => 'app_developer',
                'sort_order' => 2,
            ],
            [
                'question' => 'Q3. How can I get started?',
                'answer' => 'Simply reach out via the contact form with your project details, timeline, and requirements. I will respond within 24 hours to schedule an initial discovery call.',
                'category' => 'Process',
                'theme' => 'app_developer',
                'sort_order' => 3,
            ],
            [
                'question' => 'Q4. What tools and technologies do you use?',
                'answer' => 'I work with Figma, React, Next.js, WordPress, TailwindCSS, Laravel, Node.js, and modern cloud deployment pipelines.',
                'category' => 'Tech Stack',
                'theme' => 'app_developer',
                'sort_order' => 4,
            ],
        ];
        foreach ($appDevFaqs as $item) {
            Faq::updateOrCreate(['question' => $item['question'], 'theme' => $item['theme']], $item);
        }

        $appDevBlogs = [
            [
                'title' => 'The Tools I Use Daily as a Developer/Designer',
                'slug' => 'tools-i-use-daily-developer-designer',
                'category' => 'Branding',
                'date' => 'Aug 08, 2025',
                'read_time' => '4 min read',
                'author' => 'Alex Rivera',
                'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'A deep dive into the productivity extensions, terminal setups, and design tools that supercharge my daily workflow.',
                'content' => 'Overview of VS Code, Figma plugins, Raycast shortcuts, and automated Docker build environments.',
                'theme' => 'app_developer',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'How I Solve Real-World Problems Through Design',
                'slug' => 'how-i-solve-real-world-problems-through-design',
                'category' => 'Identity',
                'date' => 'Aug 08, 2025',
                'read_time' => '5 min read',
                'author' => 'Alex Rivera',
                'image' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Transforming abstract business dilemmas into elegant, friction-free user interface architectures with measurable results.',
                'content' => 'Case studies from client onboarding redesigns, checkout conversion improvements, and design system rollouts.',
                'theme' => 'app_developer',
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'How I Balance Creativity With Technical Skills',
                'slug' => 'how-i-balance-creativity-with-technical-skills',
                'category' => 'Mobile Apps',
                'date' => 'Aug 08, 2025',
                'read_time' => '4 min read',
                'author' => 'Alex Rivera',
                'image' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Bridging the gap between engineering feasibility and aesthetic visual expression in mobile apps.',
                'content' => 'Why understanding backend APIs and database indexing makes you a 10x better UI/UX designer.',
                'theme' => 'app_developer',
                'is_published' => true,
                'sort_order' => 3,
            ],
        ];
        foreach ($appDevBlogs as $item) {
            BlogPost::updateOrCreate(['slug' => $item['slug']], $item);
        }

        /* =========================================================================
           5. APP & SOFTWARE DEVELOPER THEME (Tonu - App And Software Developer.png)
           ========================================================================= */
        $tonuServices = [
            ['title' => 'Enterprise Software Architecture', 'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.', 'icon' => 'server-stack', 'category' => 'Architecture', 'theme' => 'app_software_developer', 'sort_order' => 1],
            ['title' => 'Cloud App Infrastructure', 'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.', 'icon' => 'cloud', 'category' => 'Cloud', 'theme' => 'app_software_developer', 'sort_order' => 2],
            ['title' => 'Mobile & Web Platforms', 'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.', 'icon' => 'device-phone-mobile', 'category' => 'Platforms', 'theme' => 'app_software_developer', 'sort_order' => 3],
            ['title' => 'Data Analytics & Scaling', 'description' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.', 'icon' => 'chart-bar', 'category' => 'Data', 'theme' => 'app_software_developer', 'sort_order' => 4],
        ];
        foreach ($tonuServices as $item) {
            Service::updateOrCreate(['title' => $item['title'], 'theme' => $item['theme']], $item);
        }

        $tonuProjects = [
            [
                'title' => 'Bespoke Web Application',
                'category' => 'Web Design',
                'subtitle' => 'Cloud SaaS Workspace',
                'description' => 'High-throughput cloud portal built with decoupled API architecture and interactive dashboard telemetry.',
                'image_url' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Web Design, SaaS, Full Stack',
                'theme' => 'app_software_developer',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Food Delivery Platform',
                'category' => 'Web Development',
                'subtitle' => 'Real-Time Logistics Engine',
                'description' => 'Multi-vendor food ordering telemetry and real-time courier tracking system with sub-second WebSocket updates.',
                'image_url' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Logistics, WebSockets, Redis, Vue',
                'theme' => 'app_software_developer',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Creative Portfolio Suite',
                'category' => 'Web Design',
                'subtitle' => 'Dynamic 3D Showcase',
                'description' => 'Dynamic portfolio showcase with 3D model viewers and fluid transitions.',
                'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Creative, Portfolio, Three.js',
                'theme' => 'app_software_developer',
                'is_featured' => true,
                'sort_order' => 3,
            ],
        ];
        foreach ($tonuProjects as $item) {
            Project::updateOrCreate(['title' => $item['title'], 'theme' => $item['theme']], $item);
        }

        $tonuResume = [
            [
                'title' => 'Lead Software Architect',
                'institution' => 'Enterprise Cloud Systems Ltd',
                'period' => '2021 — PRESENT',
                'description' => 'Directing core microservices architecture, automated CI/CD pipelines, and high-concurrency API performance.',
                'type' => 'experience',
                'theme' => 'app_software_developer',
                'sort_order' => 1,
            ],
            [
                'title' => 'Senior Backend Engineer',
                'institution' => 'FinTrack Telemetry Inc',
                'period' => '2018 — 2021',
                'description' => 'Engineered high-frequency payment gateways with sub-second settlement times and zero data loss.',
                'type' => 'experience',
                'theme' => 'app_software_developer',
                'sort_order' => 2,
            ],
            [
                'title' => 'M.Sc. in Computer Science',
                'institution' => 'Massachusetts Institute of Technology',
                'period' => '2016 — 2018',
                'description' => 'Specialization in Distributed Systems, Distributed Consensus Algorithms, and Cryptographic Security.',
                'type' => 'education',
                'theme' => 'app_software_developer',
                'sort_order' => 1,
            ],
        ];
        foreach ($tonuResume as $item) {
            ResumeItem::updateOrCreate(['title' => $item['title'], 'institution' => $item['institution'], 'theme' => $item['theme']], $item);
        }

        $graphicPricing = [
            [
                'name' => 'Design Sprint',
                'subtitle' => '1-Week Rapid Prototyping',
                'price' => 1800.00,
                'billing_period' => 'sprint',
                'features' => json_encode(['User Journey Mapping', 'Figma Clickable Prototype', 'Usability Test Session', 'Design Token Export']),
                'is_featured' => false,
                'button_text' => 'Get a Quote',
                'button_url' => '#contact',
                'theme' => 'graphic_designer',
                'sort_order' => 1,
            ],
            [
                'name' => 'Complete UI/UX Suite',
                'subtitle' => 'End-to-End Product Design',
                'price' => 3600.00,
                'billing_period' => 'project',
                'features' => json_encode(['Complete Figma Component System', 'Desktop & Mobile Viewports', 'Micro-Interactions in Framer', 'Developer Handoff Support']),
                'is_featured' => true,
                'button_text' => 'Get a Quote',
                'button_url' => '#contact',
                'theme' => 'graphic_designer',
                'sort_order' => 2,
            ],
            [
                'name' => 'Monthly Design Retainer',
                'subtitle' => 'Ongoing Design Partner',
                'price' => 2400.00,
                'billing_period' => 'month',
                'features' => json_encode(['Dedicated Slack Channel', 'Unlimited Revision Cycles', 'Weekly Milestone Demos', 'Guaranteed 24h Turnaround']),
                'is_featured' => false,
                'button_text' => 'Get a Quote',
                'button_url' => '#contact',
                'theme' => 'graphic_designer',
                'sort_order' => 3,
            ],
        ];
        foreach ($graphicPricing as $item) {
            PricingPlan::updateOrCreate(['name' => $item['name'], 'theme' => $item['theme']], $item);
        }

        $appDevPricing = [
            [
                'name' => 'Starter Mobile App',
                'subtitle' => 'MVP Launch Package',
                'price' => 1500.00,
                'billing_period' => 'project',
                'features' => json_encode(['React Native or Flutter MVP', 'Clean REST API Integration', 'Authentication & Push Alerts', 'App Store / Play Store Submission']),
                'is_featured' => false,
                'button_text' => 'Let\'s Build',
                'button_url' => '#contact',
                'theme' => 'app_developer',
                'sort_order' => 1,
            ],
            [
                'name' => 'Pro Mobile Application',
                'subtitle' => 'Scalable Production Build',
                'price' => 3200.00,
                'billing_period' => 'project',
                'features' => json_encode(['Cross-Platform iOS & Android', 'Custom Laravel API Backend', 'Payment Gateway & Stripe Sync', '3 Months Dedicated Warranty']),
                'is_featured' => true,
                'button_text' => 'Let\'s Build',
                'button_url' => '#contact',
                'theme' => 'app_developer',
                'sort_order' => 2,
            ],
        ];
        foreach ($appDevPricing as $item) {
            PricingPlan::updateOrCreate(['name' => $item['name'], 'theme' => $item['theme']], $item);
        }

        $blaydenPricing = [
            [
                'name' => 'Visual Identity Package',
                'subtitle' => 'Complete Brand Storytelling',
                'price' => 1200.00,
                'billing_period' => 'project',
                'features' => json_encode(['Custom Logo Suite & Mark', 'Brand Typography & Color Guide', 'Stationery & Packaging Design', 'Vector Illustration Assets']),
                'is_featured' => false,
                'button_text' => 'Inquire Now',
                'button_url' => '#contact',
                'theme' => 'digital_designer_illustrator',
                'sort_order' => 1,
            ],
            [
                'name' => 'Full Identity & 3D Render',
                'subtitle' => 'Luxury Digital Presence',
                'price' => 2800.00,
                'billing_period' => 'project',
                'features' => json_encode(['3D Blender Visualizations', 'Editorial Web Design', 'Interactive Framer Prototype', 'Full Commercial Licensing']),
                'is_featured' => true,
                'button_text' => 'Inquire Now',
                'button_url' => '#contact',
                'theme' => 'digital_designer_illustrator',
                'sort_order' => 2,
            ],
        ];
        foreach ($blaydenPricing as $item) {
            PricingPlan::updateOrCreate(['name' => $item['name'], 'theme' => $item['theme']], $item);
        }

        $tonuPricing = [
            [
                'name' => 'BASIC',
                'subtitle' => 'Consectetur adipiscing elit. Purusout phasellus.',
                'price' => 120.00,
                'billing_period' => 'month',
                'features' => json_encode(['Web App design', 'Software Development', '3D Animation Add', 'Web Development', 'Graphic Design']),
                'is_featured' => false,
                'button_text' => 'Choose Plan',
                'button_url' => '#contact',
                'theme' => 'app_software_developer',
                'sort_order' => 1,
            ],
            [
                'name' => 'PREMIUM',
                'subtitle' => 'Consectetur adipiscing elit. Purusout phasellus.',
                'price' => 210.00,
                'billing_period' => 'month',
                'features' => json_encode(['Web App design', 'Software Development', '3D Animation Add', 'Web Development', 'Graphic Design']),
                'is_featured' => true,
                'button_text' => 'Choose Plan',
                'button_url' => '#contact',
                'theme' => 'app_software_developer',
                'sort_order' => 2,
            ],
            [
                'name' => 'ADVANCED',
                'subtitle' => 'Consectetur adipiscing elit. Purusout phasellus.',
                'price' => 373.00,
                'billing_period' => 'month',
                'features' => json_encode(['Web App design', 'Software Development', '3D Animation Add', 'Web Development', 'Graphic Design']),
                'is_featured' => false,
                'button_text' => 'Choose Plan',
                'button_url' => '#contact',
                'theme' => 'app_software_developer',
                'sort_order' => 3,
            ],
        ];
        foreach ($tonuPricing as $item) {
            PricingPlan::updateOrCreate(['name' => $item['name'], 'theme' => $item['theme']], $item);
        }

        $tonuTestimonials = [
            [
                'client_name' => 'Robert Miller Client',
                'client_role' => 'VP of Engineering',
                'company' => 'Tonu Corp',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'content' => "To begin to identify aspects of students' own portfolios To identify key portfolio features, varied styles, and organizational schemes; that will need careful attention.",
                'theme' => 'app_software_developer',
                'sort_order' => 1,
            ],
            [
                'client_name' => 'Sarah Jenkins',
                'client_role' => 'Engineering Director',
                'company' => 'Vanguard',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'content' => "To identify key portfolio features, varied styles, and organizational schemes; to begin to identify aspects of students' own portfolios that will need careful attention.",
                'theme' => 'app_software_developer',
                'sort_order' => 2,
            ],
        ];
        foreach ($tonuTestimonials as $item) {
            Testimonial::updateOrCreate(['client_name' => $item['client_name'], 'theme' => $item['theme']], $item);
        }

        $tonuBlogs = [
            [
                'title' => 'Helpful tips for become a successful designer',
                'slug' => 'helpful-tips-for-become-successful-designer',
                'category' => 'DESIGNER',
                'date' => 'May 12, 2023',
                'read_time' => '4 min read',
                'author' => 'Robert Miller',
                'image' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Consectetur adipiscing elit. Purusout phasellus malesuada lectus.',
                'content' => 'Practical principles for elevating technical design communication and product workflows.',
                'theme' => 'app_software_developer',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Master These Awesome New Skills in May 2023',
                'slug' => 'master-these-awesome-new-skills-may-2023',
                'category' => 'DEVELOPER',
                'date' => 'May 15, 2023',
                'read_time' => '5 min read',
                'author' => 'Robert Miller',
                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Consectetur adipiscing elit. Purusout phasellus malesuada lectus.',
                'content' => 'Deep dive into Golang concurrency channels, Kafka message partitioning, and cloud infrastructure.',
                'theme' => 'app_software_developer',
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'We provide solutions growin your business',
                'slug' => 'we-provide-solutions-growin-your-business',
                'category' => 'FASION',
                'date' => 'May 18, 2023',
                'read_time' => '4 min read',
                'author' => 'Robert Miller',
                'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Consectetur adipiscing elit. Purusout phasellus malesuada lectus.',
                'content' => 'How strategic cloud architectures unlock scalable growth and resilient reliability.',
                'theme' => 'app_software_developer',
                'is_published' => true,
                'sort_order' => 3,
            ],
        ];
        foreach ($tonuBlogs as $item) {
            BlogPost::updateOrCreate(['slug' => $item['slug']], $item);
        }

        /* =========================================================================
           6. DIGITAL DESIGNER & ILLUSTRATOR THEME (Blayden* - digital designer & illustrator.png)
           ========================================================================= */
        $blaydenServices = [
            ['title' => 'Frontend development', 'description' => 'I work with HTML/CSS, Framer and WordPress.', 'icon' => 'code-bracket', 'category' => 'Development', 'theme' => 'digital_designer_illustrator', 'sort_order' => 1],
            ['title' => 'Graphic design', 'description' => 'I use Adobe Fresco and Blender to create illustrations and 3D renders.', 'icon' => 'swatch', 'category' => 'Creative', 'theme' => 'digital_designer_illustrator', 'sort_order' => 2],
            ['title' => 'Brand identity', 'description' => 'I help my clients to develop a personality and brand voice, design the brand look and logo.', 'icon' => 'sparkles', 'category' => 'Branding', 'theme' => 'digital_designer_illustrator', 'sort_order' => 3],
            ['title' => 'Digital marketing', 'description' => 'Social media content plans, media monitoring, email and text messaging and search engine optimization.', 'icon' => 'chart-bar', 'category' => 'Marketing', 'theme' => 'digital_designer_illustrator', 'sort_order' => 4],
        ];
        foreach ($blaydenServices as $item) {
            Service::updateOrCreate(['title' => $item['title'], 'theme' => $item['theme']], $item);
        }

        $blaydenProjects = [
            [
                'title' => 'Anime style fantasy scenes',
                'category' => 'Illustration',
                'subtitle' => 'Digital Environmental Painting',
                'description' => 'Digital painted concept environments with atmospheric backlighting and cinematic mood.',
                'image_url' => 'https://images.unsplash.com/photo-1578632767115-351597cf2477?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Illustration, Anime, Environment, Painting',
                'theme' => 'digital_designer_illustrator',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Blayden portfolio identity',
                'category' => 'Branding',
                'subtitle' => 'Stationery & Stone Sculptures',
                'description' => 'Minimalist corporate stationery, letterpress business cards, and organic stone sculpture props.',
                'image_url' => 'https://images.unsplash.com/photo-1586075010923-2dd4570fb338?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Letterpress, Stationery, Minimalist, Luxury',
                'theme' => 'digital_designer_illustrator',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Design, tech & some magic',
                'category' => 'Web & UI',
                'subtitle' => 'Interactive Laptop Viewport',
                'description' => 'Editorial typography and fluid interactive web layout demonstration for digital creators.',
                'image_url' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Editorial, Web Design, Interactive, Fluid',
                'theme' => 'digital_designer_illustrator',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => '3D Sculptural Formations',
                'category' => '3D Art',
                'subtitle' => 'Blender Textures & Lighting',
                'description' => 'Generative 3D textures, chrome reflections, and abstract geometric sculpture studies.',
                'image_url' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=800&q=80',
                'demo_url' => '#',
                'github_url' => null,
                'tags' => 'Blender, 3D Render, Abstract, Geometry',
                'theme' => 'digital_designer_illustrator',
                'is_featured' => true,
                'sort_order' => 4,
            ],
        ];
        foreach ($blaydenProjects as $item) {
            Project::updateOrCreate(['title' => $item['title'], 'theme' => $item['theme']], $item);
        }

        $blaydenSkills = [
            ['name' => 'Photoshop', 'category' => 'Creative Tool', 'percentage' => 95, 'theme' => 'digital_designer_illustrator', 'sort_order' => 1],
            ['name' => 'Figma', 'category' => 'Interface Tool', 'percentage' => 92, 'theme' => 'digital_designer_illustrator', 'sort_order' => 2],
            ['name' => 'Illustrator', 'category' => 'Vector Tool', 'percentage' => 90, 'theme' => 'digital_designer_illustrator', 'sort_order' => 3],
            ['name' => 'Blender', 'category' => '3D Tool', 'percentage' => 85, 'theme' => 'digital_designer_illustrator', 'sort_order' => 4],
            ['name' => 'HTML5', 'category' => 'Web Core', 'percentage' => 88, 'theme' => 'digital_designer_illustrator', 'sort_order' => 5],
            ['name' => 'CSS3', 'category' => 'Styling', 'percentage' => 91, 'theme' => 'digital_designer_illustrator', 'sort_order' => 6],
            ['name' => 'Notion', 'category' => 'Productivity', 'percentage' => 84, 'theme' => 'digital_designer_illustrator', 'sort_order' => 7],
        ];
        foreach ($blaydenSkills as $item) {
            Skill::updateOrCreate(['name' => $item['name'], 'theme' => $item['theme']], $item);
        }

        $blaydenResume = [
            // Education
            [
                'title' => 'Drawing Concentration',
                'institution' => 'New York Academy of Art',
                'period' => '2019 — 2020',
                'description' => 'Intensive drawing courses that present the fundamental principles of drawing.',
                'type' => 'education',
                'theme' => 'digital_designer_illustrator',
                'sort_order' => 1,
            ],
            [
                'title' => 'UI/UX Design Specialization',
                'institution' => 'California Institute of Arts',
                'period' => '2022 — 2024',
                'description' => 'Research, design, and prototype effective, visually-driven websites and apps.',
                'type' => 'education',
                'theme' => 'digital_designer_illustrator',
                'sort_order' => 2,
            ],
            [
                'title' => 'UI/UX Designer',
                'institution' => 'Coursera',
                'period' => '2025',
                'description' => 'This course is about how to complete the design process from beginning to end.',
                'type' => 'education',
                'theme' => 'digital_designer_illustrator',
                'sort_order' => 3,
            ],
            // Experience
            [
                'title' => 'Illustrator',
                'institution' => 'Creative Mind agency',
                'period' => '2020 — 2021',
                'description' => 'I created original images for a range of digital and printed products.',
                'type' => 'experience',
                'theme' => 'digital_designer_illustrator',
                'sort_order' => 1,
            ],
            [
                'title' => 'Graphic designer',
                'institution' => 'MoonLight agency',
                'period' => '2021 — 2024',
                'description' => 'My job was to create adverts, branding, signage and other media products.',
                'type' => 'experience',
                'theme' => 'digital_designer_illustrator',
                'sort_order' => 2,
            ],
            [
                'title' => 'UI/UX designer',
                'institution' => 'MoonLight agency',
                'period' => '2024 — now',
                'description' => 'I am actively involved in creating user interfaces for mobile apps and websites.',
                'type' => 'experience',
                'theme' => 'digital_designer_illustrator',
                'sort_order' => 3,
            ],
        ];
        foreach ($blaydenResume as $item) {
            ResumeItem::updateOrCreate(['title' => $item['title'], 'institution' => $item['institution'], 'theme' => $item['theme']], $item);
        }

        $blaydenTestimonials = [
            [
                'client_name' => 'Jenny Lemon',
                'client_role' => 'CEO',
                'company' => 'Creative People',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                'rating' => 5,
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',
                'theme' => 'digital_designer_illustrator',
                'sort_order' => 1,
            ],
        ];
        foreach ($blaydenTestimonials as $item) {
            Testimonial::updateOrCreate(['client_name' => $item['client_name'], 'theme' => $item['theme']], $item);
        }

        $themeFaqs = [
            // developer
            ['question' => 'What software architecture principles do you apply?', 'answer' => 'I build enterprise web applications with hexagonal architecture, CQRS, domain-driven design, and decoupled REST & GraphQL APIs.', 'category' => 'Architecture', 'theme' => 'developer', 'sort_order' => 1],
            ['question' => 'Do you provide cloud migration and DevOps support?', 'answer' => 'Yes, I containerize legacy monolithic systems with Docker and orchestrate migrations to AWS ECS or Kubernetes with zero downtime.', 'category' => 'Cloud', 'theme' => 'developer', 'sort_order' => 2],
            // graphic_designer
            ['question' => 'What does the design handoff include?', 'answer' => 'Full Figma design token export, interactive prototype, component documentation, typography guidelines, and responsive specifications.', 'category' => 'Handoff', 'theme' => 'graphic_designer', 'sort_order' => 1],
            ['question' => 'Can you handle complete brand rebrandings?', 'answer' => 'Yes, from logo mark exploration to corporate stationery, color systems, brand books, and digital asset kits.', 'category' => 'Branding', 'theme' => 'graphic_designer', 'sort_order' => 2],
            // uiux_designer
            ['question' => 'How do you validate UX prototypes before engineering?', 'answer' => 'Through structured qualitative user interviews, unmoderated remote usability testing, and interactive wireframe click tracking.', 'category' => 'Testing', 'theme' => 'uiux_designer', 'sort_order' => 1],
            ['question' => 'Do you build atomic design systems from scratch?', 'answer' => 'Yes, atomic design systems in Figma complete with design variables, dark/light modes, WCAG accessibility, and developer guidelines.', 'category' => 'Design Systems', 'theme' => 'uiux_designer', 'sort_order' => 2],
            // app_software_developer
            ['question' => 'Which cloud providers and infrastructure do you support?', 'answer' => 'AWS, Google Cloud, DigitalOcean, and dedicated private bare-metal clusters with Terraform IaC and Docker orchestration.', 'category' => 'Cloud', 'theme' => 'app_software_developer', 'sort_order' => 1],
            ['question' => 'What is your typical project delivery methodology?', 'answer' => 'Bi-weekly agile sprints with continuous integration, automated unit testing, and weekly milestone demonstrations.', 'category' => 'Agile', 'theme' => 'app_software_developer', 'sort_order' => 2],
            // digital_designer_illustrator
            ['question' => 'Do you produce custom 3D renders for web and branding?', 'answer' => 'Yes, I model, texture, and light bespoke 3D objects in Blender for web interactions, packaging, and marketing collateral.', 'category' => '3D Art', 'theme' => 'digital_designer_illustrator', 'sort_order' => 1],
            ['question' => 'What file formats and resolutions do you provide?', 'answer' => 'Full high-res exports in SVG, PNG, WebP, AI, PSD, and interactive GLTF/GLB formats for 3D web rendering.', 'category' => 'Deliverables', 'theme' => 'digital_designer_illustrator', 'sort_order' => 2],
        ];
        foreach ($themeFaqs as $item) {
            Faq::updateOrCreate(['question' => $item['question'], 'theme' => $item['theme']], $item);
        }

        $blaydenBlogs = [
            [
                'title' => 'Approach and philosophy in modern digital design',
                'slug' => 'approach-and-philosophy-modern-digital-design',
                'category' => 'Philosophy',
                'date' => 'Oct 14, 2024',
                'read_time' => '5 min read',
                'author' => 'Alex Walker',
                'image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Exploring tactile textures, raw minimalism, and humanistic visual cadence.',
                'content' => 'Reflections on intentional restraint, high typographic hierarchy, and craftsmanship.',
                'theme' => 'digital_designer_illustrator',
                'is_published' => true,
                'sort_order' => 1,
            ],
        ];
        foreach ($blaydenBlogs as $item) {
            BlogPost::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}