<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Seed initial gallery items.
     */
    public function run(): void
    {
        $items = [
            // Laravel Developer Theme Items
            [
                'title'       => 'Laravel 11 Multi-Tenant ERP Architecture Schema',
                'category'    => 'Architecture & Systems',
                'theme'       => 'laravel_developer',
                'image_url'   => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Complete high-availability cloud database and queue topology for BBGC College Management & Multi-Store ERP.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Triple-Monitor Laravel Architect Command Station',
                'category'    => 'Workspace',
                'theme'       => 'laravel_developer',
                'image_url'   => 'https://images.unsplash.com/photo-1581291518655-9523c932deb2?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Ergonomic dual 4K development environment with split IDE, database analyzer, and live server monitoring terminal.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Real-Time Redis & Horizon Queue Workers Dashboard',
                'category'    => 'Performance & Queues',
                'theme'       => 'laravel_developer',
                'image_url'   => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Monitoring thousands of asynchronous background jobs, invoice generators, and webhook deliveries with sub-second latency.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 3,
            ],
            [
                'title'       => 'NSDA Level-3 Certified Full-Stack Accreditation',
                'category'    => 'Certificates',
                'theme'       => 'laravel_developer',
                'image_url'   => 'https://images.unsplash.com/photo-1496171367470-9ed9a91ea931?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Government of Bangladesh National Skills Development Authority NSDA Level-3 Computer Operations Certification.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 4,
            ],
            [
                'title'       => 'Decoupled RESTful API & OAuth2 Sanctum Topology',
                'category'    => 'Architecture & Systems',
                'theme'       => 'laravel_developer',
                'image_url'   => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Secure, stateless API token authentication with rate-limiting and granular role-based permissions.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 5,
            ],
            [
                'title'       => 'Automated Docker CI/CD Cloud Pipeline',
                'category'    => 'DevOps & Cloud',
                'theme'       => 'laravel_developer',
                'image_url'   => 'https://images.unsplash.com/photo-1618401471353-b98afee0b2eb?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Zero-downtime deployment workflows leveraging Docker, GitHub Actions, and automated PHPUnit / Pest test suites.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 6,
            ],
            [
                'title'       => 'PostgreSQL Partitioned Relational Database Model',
                'category'    => 'Database Engineering',
                'theme'       => 'laravel_developer',
                'image_url'   => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Optimized indexing and schema design handling multi-million record order transactions without bottlenecking.',
                'is_featured' => false,
                'is_active'   => true,
                'sort_order'  => 7,
            ],
            [
                'title'       => 'Devzet LLC Tech Leadership & Architecture Review',
                'category'    => 'Events',
                'theme'       => 'laravel_developer',
                'image_url'   => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Collaborative system sprint planning and backend architectural audit with lead engineers and institutional clients.',
                'is_featured' => false,
                'is_active'   => true,
                'sort_order'  => 8,
            ],

            // Developer Theme Items
            [
                'title'       => 'Distributed Microservices Event-Driven Mesh',
                'category'    => 'Architecture & Systems',
                'theme'       => 'developer',
                'image_url'   => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Event sourcing and message queuing topology using Kafka and gRPC for resilient inter-service communication.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Clean Code Architecture & Terminal Environment',
                'category'    => 'Workspace',
                'theme'       => 'developer',
                'image_url'   => 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Minimalist dark developer setup featuring customized Neovim, zsh shell, and automated linting hooks.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Cloud Infrastructure As Code Blueprint',
                'category'    => 'DevOps & Cloud',
                'theme'       => 'developer',
                'image_url'   => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Terraform and Kubernetes infrastructure provisioning for multi-region AWS high-availability clusters.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 3,
            ],
            [
                'title'       => 'Algorithm Profiling & Query Optimization',
                'category'    => 'Software Engineering',
                'theme'       => 'developer',
                'image_url'   => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Memory profiling and algorithmic time complexity benchmarking under heavy concurrent loads.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 4,
            ],

            // UI/UX Designer Theme Items
            [
                'title'       => 'Fintech Mobile Banking Design System',
                'category'    => 'UI/UX Designs',
                'theme'       => 'uiux_designer',
                'image_url'   => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Comprehensive component library, interaction states, and atomic typography scale designed in Figma.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Interactive SaaS Analytics Dashboard Wireframes',
                'category'    => 'Wireframes & UX',
                'theme'       => 'uiux_designer',
                'image_url'   => 'https://images.unsplash.com/photo-1581291518655-9523c932deb2?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Low-fidelity user flows and cognitive walkthrough testing for multi-tenant enterprise dashboards.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Product Designer Studio & Creative Desk',
                'category'    => 'Workspace',
                'theme'       => 'uiux_designer',
                'image_url'   => 'https://images.unsplash.com/photo-1586717791821-3f44a563fa4c?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Graphic tablet, design color guides, and dual displays optimized for rapid prototyping.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 3,
            ],
            [
                'title'       => 'Mobile App Micro-Interactions & Gestures',
                'category'    => 'UI/UX Designs',
                'theme'       => 'uiux_designer',
                'image_url'   => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Spring-based physics animations and fluid gesture response curves for iOS and Android.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 4,
            ],

            // Graphic Designer Theme Items
            [
                'title'       => 'Minimalist Modern Brand Identity & Typography',
                'category'    => 'Branding',
                'theme'       => 'graphic_designer',
                'image_url'   => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Complete corporate stationery, vector emblem marks, and bespoke letterforms for luxury lifestyle brands.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Kinetic Visual Arts & Exhibition Poster',
                'category'    => 'Typography',
                'theme'       => 'graphic_designer',
                'image_url'   => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Experimental Swiss grid poster exploration combining bold grotesque type and abstract geometric shapes.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Sustainable Packaging & Foil Stamp Presentation',
                'category'    => 'Packaging',
                'theme'       => 'graphic_designer',
                'image_url'   => 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Eco-friendly kraft carton mockups with embossed metallic foil accents and matte texture finishing.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 3,
            ],
            [
                'title'       => 'Creative Studio Printmaking & Layout Station',
                'category'    => 'Workspace',
                'theme'       => 'graphic_designer',
                'image_url'   => 'https://images.unsplash.com/photo-1513542789411-b6a5d4f31634?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Pantone swatch fan decks, paper sample books, and cutting mat for hands-on print crafting.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 4,
            ],

            // Digital Designer & Illustrator Theme Items
            [
                'title'       => 'Cyberpunk Neon Megacity Vector Illustration',
                'category'    => 'Digital Art',
                'theme'       => 'digital_designer_illustrator',
                'image_url'   => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b675?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Atmospheric digital painting with vibrant cyan and magenta neon lighting, reflections, and flying vehicles.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Isometric 3D Game World & Character Assets',
                'category'    => 'Illustrations',
                'theme'       => 'digital_designer_illustrator',
                'image_url'   => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Stylized modular assets and environment props for modern low-poly adventure game titles.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Digital Illustration Tablet & Stylus Station',
                'category'    => 'Workspace',
                'theme'       => 'digital_designer_illustrator',
                'image_url'   => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Wacom Cintiq high-gamut pen display with custom shortcut remotes for digital concept painting.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 3,
            ],

            // App Developer Theme Items
            [
                'title'       => 'Flutter & Swift Cross-Platform Health Tracker',
                'category'    => 'Mobile Apps',
                'theme'       => 'app_developer',
                'image_url'   => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Biometric activity dashboard syncing real-time health data via Apple HealthKit and Google Fit APIs.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Dual-Device Mobile Emulation & Debug Rig',
                'category'    => 'Workspace',
                'theme'       => 'app_developer',
                'image_url'   => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Multi-screen setup running parallel iOS Simulators and Android Emulators for cross-platform layout checks.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Mobile E-Commerce Checkout Experience',
                'category'    => 'Mobile Apps',
                'theme'       => 'app_developer',
                'image_url'   => 'https://images.unsplash.com/photo-1556742049-0a67c5574f73?auto=format&fit=crop&w=1600&q=80',
                'caption'     => '1-tap Apple Pay and Google Pay integration with encrypted tokenization and optimistic UI state handling.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 3,
            ],

            // App & Software Developer Theme Items
            [
                'title'       => 'Enterprise POS & Inventory Desktop Platform',
                'category'    => 'Software Development',
                'theme'       => 'app_software_developer',
                'image_url'   => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'High-throughput point of sale system with offline SQLite sync and automatic cloud reconciliation.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Software Architect Engineering Lab',
                'category'    => 'Workspace',
                'theme'       => 'app_software_developer',
                'image_url'   => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Collaborative software engineering workstations with hardware device bridges and real-time packet loggers.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Cross-Platform Electron Analytics Client',
                'category'    => 'Software Development',
                'theme'       => 'app_software_developer',
                'image_url'   => 'https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?auto=format&fit=crop&w=1600&q=80',
                'caption'     => 'Native desktop wrapper with GPU hardware acceleration and multi-threaded data processing workers.',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 3,
            ],
        ];

        foreach ($items as $data) {
            Gallery::updateOrCreate(
                ['title' => $data['title'], 'theme' => $data['theme']],
                $data
            );
        }
    }
}
