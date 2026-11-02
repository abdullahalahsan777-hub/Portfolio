<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\Project;
use App\Models\ResumeItem;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
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

        // 5. Seed ThemeContents across all 8 pages and all sections
        $themeContentPages = require __DIR__ . '/data_laravel_developer.php';

        ThemeContent::updateOrCreate(
            ['theme' => $theme, 'page' => 'general', 'key' => 'template_preview_image'],
            ['section' => 'general', 'value' => 'images/templates/developer.png', 'type' => 'image']
        );

        foreach ($themeContentPages as $page => $sections) {
            foreach ($sections as $section => $fields) {
                foreach ($fields as $key => [$value, $type]) {
                    ThemeContent::updateOrCreate(
                        ['theme' => $theme, 'page' => $page, 'key' => $key],
                        ['section' => $section, 'value' => $value, 'type' => $type]
                    );
                }
            }
        }

        // 6. Testimonials for laravel_developer theme
        $testimonials = [
            [
                'client_name' => 'Engr. Kazi M. Rahman',
                'client_role' => 'CTO & Tech Director',
                'company' => 'Devzet LLC',
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=300&q=80',
                'rating' => 5,
                'content' => "Abdullah's mastery of Laravel 11 and complex relational database schemas completely transformed our backend infrastructure. He engineered our custom order pipeline and automated PDF invoice generation system with queue workers that process thousands of orders daily without a hitch. A consummate engineering professional.",
                'theme' => $theme,
                'sort_order' => 1,
            ],
            [
                'client_name' => 'Prof. M. A. Karim',
                'client_role' => 'Principal & Project Lead',
                'company' => 'BBGC College',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=300&q=80',
                'rating' => 5,
                'content' => "The BBGC College Management ERP developed by Md. Abdullah Al Ahsan modernized our institutional operations. From automated student enrollments, attendance tracking, to secure fee collection and coordinator management, the system has run with flawless uptime. His mathematical background reflects in every algorithm.",
                'theme' => $theme,
                'sort_order' => 2,
            ],
            [
                'client_name' => 'Md. Rafiqul Islam',
                'client_role' => 'Managing Director',
                'company' => 'Rafiq Enterprise',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=300&q=80',
                'rating' => 5,
                'content' => "Managing inventory across multiple retail outlets used to be a nightmare before Abdullah engineered our custom multi-store POS system. The real-time synchronization, barcode scanning, and daily cash-ledger reconciliation give us complete control over our business.",
                'theme' => $theme,
                'sort_order' => 3,
            ],
            [
                'client_name' => 'Sarah Jenkins',
                'client_role' => 'VP of Product Engineering',
                'company' => 'Linksposting Platform',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=300&q=80',
                'rating' => 5,
                'content' => "Abdullah designed decoupled RESTful APIs with Laravel Sanctum and dynamic page management for our SaaS publisher marketplace. His code is exceptionally clean, thoroughly tested, and delivers sub-second response times under peak European & US traffic.",
                'theme' => $theme,
                'sort_order' => 4,
            ],
            [
                'client_name' => 'Tariqul Hasan',
                'client_role' => 'Lead Technical Consultant',
                'company' => 'Freelance IT Lab',
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=300&q=80',
                'rating' => 5,
                'content' => "Working alongside Abdullah at Freelance IT Lab was inspiring. Whether he was architecting complex database models for client projects or mentoring batches of junior web developers, his dedication, NSDA Level-3 rigor, and Laravel expertise are second to none.",
                'theme' => $theme,
                'sort_order' => 5,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate([
                'client_name' => $t['client_name'],
                'theme' => $t['theme'],
            ], $t);
        }

        // 7. Blog Posts for laravel_developer theme
        $blogPosts = [
            [
                'title' => 'Architecting High-Concurrency Invoicing Engines in Laravel 11',
                'slug' => 'architecting-high-concurrency-invoicing-engines-laravel-11',
                'category' => 'Backend Architecture',
                'date' => 'October 28, 2026',
                'read_time' => '7 min read',
                'author' => 'Md. Abdullah Al Ahsan',
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'How we engineered sub-second PDF invoice generation and asynchronous queue workers processing thousands of transactions at Devzet LLC without blocking HTTP requests.',
                'content' => "In modern enterprise applications, generating PDF invoices synchronously during a checkout or billing web request is an architectural anti-pattern. When transaction volume spikes, synchronous PDF rendering consumes worker memory and blocks incoming HTTP connections.\n\nAt Devzet LLC, we re-architected our invoicing pipeline using Laravel 11 queued jobs. By decoupling order completion from document rendering via Redis queues and dedicated worker daemons, checkout response times dropped from 3.4 seconds to under 180 milliseconds.\n\nWe implemented pessimistic database locking (`lockForUpdate()`) around the invoice sequencing table to guarantee gap-free invoice numbers even during parallel checkout attempts. Templates are written using lightweight Tailwind CSS and rendered through headless Chrome, delivering crisp typography and barcode fidelity.\n\nKey takeaways for high-throughput billing:\n1. Never render binary documents on the web thread.\n2. Isolate document generation into a dedicated queue worker pool.\n3. Store generated artifacts on S3-compatible object storage and dispatch signed temporary URLs.\n4. Ensure complete idempotency so retried queue jobs never issue duplicate invoice numbers.",
                'theme' => $theme,
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'title' => 'Mastering Multi-Store POS Database Modeling with MySQL & Eloquent',
                'slug' => 'mastering-multi-store-pos-database-modeling-mysql-eloquent',
                'category' => 'Database Optimization',
                'date' => 'October 15, 2026',
                'read_time' => '8 min read',
                'author' => 'Md. Abdullah Al Ahsan',
                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'A deep dive into schema design, inventory ledger tables, optimistic locking, and indexing strategies for retail POS systems like Rafiq Enterprise.',
                'content' => "Managing retail inventory across decentralized branches presents unique database challenges: stock races, intermittent internet connectivity, and daily cash-ledger reconciliation.\n\nWhen designing the Rafiq Enterprise Multi-Store POS, we rejected simplistic single-column stock counters in favor of an append-only inventory ledger model. Rather than mutating a single `products.stock` integer, every stock movement (sale, return, transfer, adjustment) is recorded as an immutable ledger transaction.\n\nTo ensure lightning-fast POS checkouts at branch terminals:\n- Current store stock is computed using atomic SQL increments (`decrement('stock', \$qty)`) within transactional blocks.\n- Composite indexes on `(store_id, product_id, created_at)` ensure scan operations complete in sub-millisecond time.\n- End-of-day reconciliation balances ledger entries against cash drawers with automated variance alerts.\n\nThis architecture eliminated inventory discrepancies and provided complete auditability for tax and business reporting.",
                'theme' => $theme,
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'title' => 'Building Enterprise ERPs using the Coordinator Architecture Pattern',
                'slug' => 'building-enterprise-erps-using-coordinator-architecture-pattern',
                'category' => 'Enterprise ERP',
                'date' => 'September 24, 2026',
                'read_time' => '6 min read',
                'author' => 'Md. Abdullah Al Ahsan',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Case study on how the BBGC College ERP maintains loose coupling across academic modules, attendance, fees, and examination workflows.',
                'content' => "As enterprise software grows, controllers frequently become bloated god-objects entangled with business rules, authorization, and notifications. In large institutional platforms like the BBGC School Management ERP, such coupling makes maintenance hazardous.\n\nTo resolve this, we employed the Coordinator Pattern in Laravel. Coordinators act as pure workflow orchestrators that sequence granular single-responsibility Action classes without containing business logic themselves.\n\nFor example, during student semester registration, the `EnrollmentCoordinator`:\n1. Invokes `VerifyAcademicPrerequisitesAction`.\n2. Dispatches `CalculateTuitionFeeAction`.\n3. Initiates `GenerateFeeVoucherAction`.\n4. Fires `StudentEnrolledEvent` to trigger SMS and parent portal updates.\n\nEach Action class is completely decoupled, unit-testable, and reusable across web controllers, console commands, and API webhooks.",
                'theme' => $theme,
                'sort_order' => 3,
                'is_published' => true,
            ],
            [
                'title' => 'Securing Decoupled RESTful APIs with Laravel Sanctum & Rate Limiting',
                'slug' => 'securing-decoupled-restful-apis-laravel-sanctum-rate-limiting',
                'category' => 'API & Security',
                'date' => 'September 10, 2026',
                'read_time' => '5 min read',
                'author' => 'Md. Abdullah Al Ahsan',
                'image' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Best practices for role-based access control (RBAC), token lifecycle management, and protecting high-throughput endpoints against abuse.',
                'content' => "Building scalable mobile applications and third-party integrations requires rock-solid API security. Laravel Sanctum provides a featherweight yet enterprise-grade authentication system for SPAs, mobile apps, and token-based external integrations.\n\nIn our production deployments, we follow strict defense-in-depth principles:\n- Scoped Token Abilities: Tokens issued to external clients specify exact granular permissions (e.g., `orders:create`, `invoices:read`) enforced via Sanctum middleware.\n- Dynamic Redis Rate Limiting: High-traffic endpoints utilize tiered rate limiters keyed by authenticated user ID and IP address to prevent brute-force attacks.\n- Standardized JSON Schemas: Every response is transformed via Laravel API Resources, guaranteeing consistent response envelopes and zero data leakage.\n- Automated Audit Logging: All privileged administrative mutations trigger structured audit records containing user identity, IP address, and changed attributes.",
                'theme' => $theme,
                'sort_order' => 4,
                'is_published' => true,
            ],
        ];

        foreach ($blogPosts as $b) {
            BlogPost::updateOrCreate([
                'slug' => $b['slug'],
                'theme' => $b['theme'],
            ], $b);
        }

        // 8. FAQs for laravel_developer theme
        $faqs = [
            [
                'category' => 'Architecture & Stack',
                'question' => 'What versions of Laravel and PHP do you build production applications with?',
                'answer' => 'I specialize in Laravel 11 and PHP 8.3, leveraging modern language features including typed properties, match expressions, readonly classes, and the streamlined application bootstrap structure of Laravel 11. I also provide legacy modernization, migration, and performance refactoring for older Laravel codebases (versions 5.x through 10.x).',
                'theme' => $theme,
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'category' => 'Performance & Scalability',
                'question' => 'How do you handle heavy operations like PDF invoice generation and automated reporting?',
                'answer' => 'Heavy processing tasks are offloaded to background queue workers managed by Redis and Laravel Horizon or database queues monitored by Supervisor daemons. This ensures HTTP web requests return instantly while documents, reports, and transactional email notifications are processed asynchronously without impacting server responsiveness.',
                'theme' => $theme,
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'category' => 'Enterprise ERP & POS',
                'question' => 'Can you integrate multi-branch POS systems with central databases and offline support?',
                'answer' => 'Yes. Having engineered systems like the Rafiq Enterprise Multi-Store POS, I design robust synchronization layers that allow branch terminals to process sales efficiently while maintaining inventory consistency and ledger audit trails across multiple locations without duplicate sales or race conditions.',
                'theme' => $theme,
                'sort_order' => 3,
                'is_published' => true,
            ],
            [
                'category' => 'Database & Security',
                'question' => 'How do you ensure data integrity and prevent race conditions in inventory and financial apps?',
                'answer' => 'I implement strict database transactions (DB::transaction), pessimistic row-level locking (lockForUpdate()), and atomic decrement queries. Combined with strict foreign key constraints, composite indexing, and database triggers, financial ledgers and stock counts remain 100% accurate under peak concurrency.',
                'theme' => $theme,
                'sort_order' => 4,
                'is_published' => true,
            ],
            [
                'category' => 'Engagements & Contracts',
                'question' => 'What is your engagement model for full-time or contract Laravel engineering?',
                'answer' => 'I am available for full-time remote roles, dedicated contract sprints, and architectural consultation. I operate with clear Git version control, daily standup updates, milestone deliverables, and automated testing suites to ensure complete delivery transparency.',
                'theme' => $theme,
                'sort_order' => 5,
                'is_published' => true,
            ],
            [
                'category' => 'Full-Stack Capabilities',
                'question' => 'Do you build reactive frontends alongside Laravel backends?',
                'answer' => 'Yes. While specialized in deep backend architecture, I build clean, reactive frontends using Tailwind CSS, AngularJS, Vue.js, and Blade. This enables responsive dashboards, real-time POS interfaces, and interactive user experiences tailored to high-speed workflows.',
                'theme' => $theme,
                'sort_order' => 6,
                'is_published' => true,
            ],
        ];

        foreach ($faqs as $f) {
            Faq::updateOrCreate([
                'question' => $f['question'],
                'theme' => $f['theme'],
            ], $f);
        }
    }
}

