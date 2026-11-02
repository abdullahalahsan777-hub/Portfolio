<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ResumeItem;
use App\Models\Service;
use App\Models\Skill;
use App\Models\ThemeContent;
use Illuminate\Database\Seeder;

class LaravelDeveloperThemeSeeder extends Seeder
{
    public function run(): void
    {
        $theme = 'laravel_developer';

        // 1. Services
        $services = [
            [
                'title' => 'Full-Stack Laravel Development',
                'description' => 'Architecting end-to-end web applications from database schema to responsive frontend using Laravel 11, Tailwind CSS, and reactive components.',
                'icon' => 'code-bracket',
                'category' => 'Core Development',
                'theme' => $theme,
                'sort_order' => 1,
            ],
            [
                'title' => 'Enterprise ERP & POS Systems',
                'description' => 'Custom school, retail, and business ERP systems featuring coordinator pattern, inventory tracking, point-of-sale, and financial reporting.',
                'icon' => 'building-office',
                'category' => 'Enterprise Systems',
                'theme' => $theme,
                'sort_order' => 2,
            ],
            [
                'title' => 'E-Commerce & Payment Checkout',
                'description' => 'Complete online store backends with multi-attribute products, cart, wishlist, order tracking, and payment gateways.',
                'icon' => 'shopping-cart',
                'category' => 'E-Commerce',
                'theme' => $theme,
                'sort_order' => 3,
            ],
            [
                'title' => 'RESTful API & JSON Services',
                'description' => 'Designing decoupled RESTful APIs with token authentication (Sanctum/Passport), robust validation, rate-limiting, and comprehensive endpoints.',
                'icon' => 'cpu-chip',
                'category' => 'APIs & Microservices',
                'theme' => $theme,
                'sort_order' => 4,
            ],
            [
                'title' => 'Automated PDF Invoicing & Reporting',
                'description' => 'High-speed PDF generation systems for custom orders, recurring billing, audit trails, and automated email delivery.',
                'icon' => 'document-text',
                'category' => 'Automation',
                'theme' => $theme,
                'sort_order' => 5,
            ],
            [
                'title' => 'Database Modeling & Optimization',
                'description' => 'Designing normalized MySQL schemas, indexing strategies, Eloquent relationships, and performant query optimization.',
                'icon' => 'circle-stack',
                'category' => 'Databases',
                'theme' => $theme,
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $s) {
            Service::updateOrCreate(['title' => $s['title'], 'theme' => $s['theme']], $s);
        }

        // 2. Projects (Real projects from PDF resume)
        $projects = [
            [
                'title' => 'Devzet Custom Order & PDF Invoicing Engine',
                'category' => 'Laravel Backend & Automation',
                'subtitle' => 'Devzet LLC (Modhupur)',
                'description' => 'High-performance backend engine for processing custom client orders, generating automated PDF invoices on-the-fly, and handling transactional email dispatches with queue workers.',
                'image_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80',
                'tags' => 'Laravel, PHP 8, MySQL, PDF Invoicing, Queue Jobs',
                'theme' => $theme,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'BBGC School Management ERP System',
                'category' => 'Enterprise ERP',
                'subtitle' => 'BBGC (Tarakanda)',
                'description' => 'Comprehensive web-based school management ERP system featuring student enrollment, gradebook, attendance tracking, fee collection, staff payroll, and coordinator module.',
                'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80',
                'tags' => 'Laravel, MySQL, ERP, Coordinator Architecture, RBAC',
                'theme' => $theme,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Rafiq Ent Multi-Branch Inventory & POS System',
                'category' => 'Inventory & POS',
                'subtitle' => 'Rafiq Ent (Tangail)',
                'description' => 'Point of Sale (POS) and inventory management system with real-time stock alerts, barcode lookup, invoice printing, and daily financial reporting.',
                'image_url' => 'https://images.unsplash.com/photo-1556742049-0a67c5574f73?auto=format&fit=crop&w=1200&q=80',
                'tags' => 'PHP, Laravel, MySQL, POS, Inventory, Tailwind CSS',
                'theme' => $theme,
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Boutique E-Commerce Platform',
                'category' => 'E-Commerce',
                'subtitle' => 'Devzet LLC',
                'description' => 'Robust e-commerce store backend featuring dynamic product catalog, multi-attribute variations, wishlist, shopping cart, checkout pipeline, payment gateway integration, and order management.',
                'image_url' => 'https://images.unsplash.com/photo-1472851294608-062f824d29cc?auto=format&fit=crop&w=1200&q=80',
                'tags' => 'Laravel, Tailwind CSS, REST API, E-Commerce, MySQL',
                'theme' => $theme,
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Ananda Mohan College Management Web Portal',
                'category' => 'Web Application',
                'subtitle' => 'Ananda Mohan College (Mymensingh)',
                'description' => 'Interactive college management web portal allowing department coordination, course scheduling, student notices, online admission inquiries, and faculty profiles.',
                'image_url' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1200&q=80',
                'tags' => 'Laravel, PHP, MySQL, Blade, AngularJS',
                'theme' => $theme,
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'Linksposting Dynamic CMS & Content Engine',
                'category' => 'Dynamic Frontend & CMS',
                'subtitle' => 'Devzet LLC',
                'description' => 'Dynamic frontend page management and content distribution system with modular block builder, SEO metadata optimization, and sub-second caching.',
                'image_url' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=1200&q=80',
                'tags' => 'Laravel, Tailwind CSS, JavaScript, AngularJS, Redis',
                'theme' => $theme,
                'is_featured' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($projects as $p) {
            Project::updateOrCreate(['title' => $p['title'], 'theme' => $p['theme']], $p);
        }

        // 3. Skills
        $skills = [
            ['name' => 'Laravel Framework 11', 'percentage' => 96, 'category' => 'Backend Frameworks', 'theme' => $theme, 'sort_order' => 1],
            ['name' => 'PHP 8.x & CodeIgniter', 'percentage' => 92, 'category' => 'Backend Languages', 'theme' => $theme, 'sort_order' => 2],
            ['name' => 'MySQL & Relational Modeling', 'percentage' => 90, 'category' => 'Databases & ORM', 'theme' => $theme, 'sort_order' => 3],
            ['name' => 'Tailwind CSS 3.x', 'percentage' => 95, 'category' => 'Frontend UI/UX', 'theme' => $theme, 'sort_order' => 4],
            ['name' => 'AngularJS & JavaScript ES6+', 'percentage' => 88, 'category' => 'Frontend UI/UX', 'theme' => $theme, 'sort_order' => 5],
            ['name' => 'RESTful APIs & JSON Protocols', 'percentage' => 92, 'category' => 'API & Microservices', 'theme' => $theme, 'sort_order' => 6],
            ['name' => 'RBAC & User Privilege Security', 'percentage' => 94, 'category' => 'Security & Auth', 'theme' => $theme, 'sort_order' => 7],
            ['name' => 'ERP & POS Architecture', 'percentage' => 91, 'category' => 'Enterprise Solutions', 'theme' => $theme, 'sort_order' => 8],
            ['name' => 'Automated PDF Generation', 'percentage' => 95, 'category' => 'Document Automation', 'theme' => $theme, 'sort_order' => 9],
            ['name' => 'Git & GitHub Version Control', 'percentage' => 90, 'category' => 'DevOps & Tools', 'theme' => $theme, 'sort_order' => 10],
            ['name' => 'MS Office Suite (Word, Excel, PPT)', 'percentage' => 96, 'category' => 'Office Applications', 'theme' => $theme, 'sort_order' => 11],
            ['name' => 'Database Backups & Server Deployment', 'percentage' => 86, 'category' => 'DevOps & Tools', 'theme' => $theme, 'sort_order' => 12],
        ];

        foreach ($skills as $sk) {
            Skill::updateOrCreate(['name' => $sk['name'], 'theme' => $sk['theme']], $sk);
        }

        // 4. Resume Items (Experience & Education)
        $resumeItems = [
            // Experience
            [
                'type' => 'experience',
                'title' => 'Laravel Developer',
                'company' => 'Devzet LLC (Modhupur)',
                'period' => '2024 - 2025',
                'grade' => 'Senior Developer',
                'description' => 'Built custom backend with authentication and user privilege (RBAC). Developed custom orders & automated PDF invoice backend for Devzet. Engineered dynamic frontend page management for Linksposting. Architected complete e-commerce backend for Boutique (cart, wishlist, search, orders, checkout).',
                'theme' => $theme,
                'sort_order' => 1,
            ],
            [
                'type' => 'experience',
                'title' => 'Web Developer & Technical Trainer',
                'company' => 'Freelance IT Lab (Mymensingh)',
                'period' => '2017 - 2023',
                'grade' => 'Developer & Trainer',
                'description' => 'Built custom backend with authentication and user privilege. Managed the creation of a school management ERP system for BBGC (Tarakanda) using the Coordinator pattern. Developed an inventory & POS management system for Rafiq Ent (Tangail). Created college management website for Ananda Mohan College (Mymensingh) using Laravel. Conducted hands-on web design & office application training for 20+ students per batch.',
                'theme' => $theme,
                'sort_order' => 2,
            ],
            [
                'type' => 'experience',
                'title' => 'Store Keeper & Records Manager',
                'company' => 'Pentalon Textile (Gazipur)',
                'period' => '2011 - 2013',
                'grade' => 'Store Keeper',
                'description' => 'Maintained inventory records and stock management using computer systems. Prepared daily stock reports and coordinated with production teams. Ensured accuracy in data entry for materials received and issued. Assisted in preparing documentation for audits and inspections.',
                'theme' => $theme,
                'sort_order' => 3,
            ],

            // Education & Certifications
            [
                'type' => 'education',
                'title' => 'Web Design and Development for Freelancing (Level-3)',
                'institution' => 'European IT Solutions Institute (Dhaka) / NSDA',
                'period' => 'Completed in 2025',
                'grade' => 'National Skills Certificate (NSDA) Level-3',
                'description' => 'National Skills Certificate (NSDA) Level-3 qualification covering enterprise full-stack development, modern PHP & Laravel, and freelance delivery standards.',
                'theme' => $theme,
                'sort_order' => 1,
            ],
            [
                'type' => 'education',
                'title' => 'Web Design & Development',
                'institution' => 'Freelance IT Lab (Mymensingh)',
                'period' => 'Completed in 2016',
                'grade' => 'Professional Certificate',
                'description' => 'Comprehensive professional training covering PHP, MySQL, frontend frameworks, responsive UI architecture, and dynamic web application development.',
                'theme' => $theme,
                'sort_order' => 2,
            ],
            [
                'type' => 'education',
                'title' => 'Computer Office Application (360 Hours)',
                'institution' => 'School Of Science And Technology (Sherpur)',
                'period' => 'Completed in 2013',
                'grade' => 'National Skill Standard Basic Course Examination',
                'description' => 'National Skill Standard Examination certified by Bangladesh Technical Education Board covering advanced database management, office automation, and data operations.',
                'theme' => $theme,
                'sort_order' => 3,
            ],
            [
                'type' => 'education',
                'title' => 'Higher Secondary Certificate (HSC)',
                'institution' => 'Sherpur Govt. University College',
                'period' => 'Completed in 2010',
                'grade' => 'Passed',
                'description' => 'Higher Secondary Certificate with focus on general education, analytical science, and computer fundamentals.',
                'theme' => $theme,
                'sort_order' => 4,
            ],
        ];

        foreach ($resumeItems as $r) {
            ResumeItem::updateOrCreate([
                'title' => $r['title'],
                'type' => $r['type'],
                'theme' => $r['theme'],
            ], $r);
        }

        // 5. Seed ThemeContents
        $defaults = ThemeContent::defaultsForTheme($theme);
        foreach ($defaults as $key => $val) {
            ThemeContent::set($theme, $key, $val, 'general', 'text', 'home');
        }
    }
}
