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
                'image_url'   => 'uploads/galleries/gallery_1.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Triple-Monitor Laravel Architect Command Station',
                'category'    => 'Workspace',
                'theme'       => 'laravel_developer',
                'image_url'   => 'uploads/galleries/gallery_2.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Real-Time Redis & Horizon Queue Workers Dashboard',
                'category'    => 'Performance & Queues',
                'theme'       => 'laravel_developer',
                'image_url'   => 'uploads/galleries/gallery_3.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 3,
            ],
            [
                'title'       => 'NSDA Level-3 Certified Full-Stack Accreditation',
                'category'    => 'Certificates',
                'theme'       => 'laravel_developer',
                'image_url'   => 'uploads/galleries/gallery_4.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 4,
            ],
            [
                'title'       => 'Decoupled RESTful API & OAuth2 Sanctum Topology',
                'category'    => 'Architecture & Systems',
                'theme'       => 'laravel_developer',
                'image_url'   => 'uploads/galleries/gallery_5.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 5,
            ],
            [
                'title'       => 'Automated Docker CI/CD Cloud Pipeline',
                'category'    => 'DevOps & Cloud',
                'theme'       => 'laravel_developer',
                'image_url'   => 'uploads/galleries/gallery_6.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 6,
            ],
            [
                'title'       => 'PostgreSQL Partitioned Relational Database Model',
                'category'    => 'Database Engineering',
                'theme'       => 'laravel_developer',
                'image_url'   => 'uploads/galleries/gallery_7.jpg',
                'is_featured' => false,
                'is_active'   => true,
                'sort_order'  => 7,
            ],
            [
                'title'       => 'Devzet LLC Tech Leadership & Architecture Review',
                'category'    => 'Events',
                'theme'       => 'laravel_developer',
                'image_url'   => 'uploads/galleries/gallery_8.jpg',
                'is_featured' => false,
                'is_active'   => true,
                'sort_order'  => 8,
            ],

            // Developer Theme Items
            [
                'title'       => 'Distributed Microservices Event-Driven Mesh',
                'category'    => 'Architecture & Systems',
                'theme'       => 'developer',
                'image_url'   => 'uploads/galleries/gallery_9.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Clean Code Architecture & Terminal Environment',
                'category'    => 'Workspace',
                'theme'       => 'developer',
                'image_url'   => 'uploads/galleries/gallery_10.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Cloud Infrastructure As Code Blueprint',
                'category'    => 'DevOps & Cloud',
                'theme'       => 'developer',
                'image_url'   => 'uploads/galleries/gallery_11.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 3,
            ],
            [
                'title'       => 'Algorithm Profiling & Query Optimization',
                'category'    => 'Software Engineering',
                'theme'       => 'developer',
                'image_url'   => 'uploads/galleries/gallery_12.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 4,
            ],

            // UI/UX Designer Theme Items
            [
                'title'       => 'Fintech Mobile Banking Design System',
                'category'    => 'UI/UX Designs',
                'theme'       => 'uiux_designer',
                'image_url'   => 'uploads/galleries/gallery_13.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Interactive SaaS Analytics Dashboard Wireframes',
                'category'    => 'Wireframes & UX',
                'theme'       => 'uiux_designer',
                'image_url'   => 'uploads/galleries/gallery_14.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Product Designer Studio & Creative Desk',
                'category'    => 'Workspace',
                'theme'       => 'uiux_designer',
                'image_url'   => 'uploads/galleries/gallery_15.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 3,
            ],
            [
                'title'       => 'Mobile App Micro-Interactions & Gestures',
                'category'    => 'UI/UX Designs',
                'theme'       => 'uiux_designer',
                'image_url'   => 'uploads/galleries/gallery_16.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 4,
            ],

            // Graphic Designer Theme Items
            [
                'title'       => 'Minimalist Modern Brand Identity & Typography',
                'category'    => 'Branding',
                'theme'       => 'graphic_designer',
                'image_url'   => 'uploads/galleries/gallery_17.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Kinetic Visual Arts & Exhibition Poster',
                'category'    => 'Typography',
                'theme'       => 'graphic_designer',
                'image_url'   => 'uploads/galleries/gallery_18.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Sustainable Packaging & Foil Stamp Presentation',
                'category'    => 'Packaging',
                'theme'       => 'graphic_designer',
                'image_url'   => 'uploads/galleries/gallery_19.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 3,
            ],
            [
                'title'       => 'Creative Studio Printmaking & Layout Station',
                'category'    => 'Workspace',
                'theme'       => 'graphic_designer',
                'image_url'   => 'uploads/galleries/gallery_20.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 4,
            ],

            // Digital Designer & Illustrator Theme Items
            [
                'title'       => 'Cyberpunk Neon Megacity Vector Illustration',
                'category'    => 'Digital Art',
                'theme'       => 'digital_designer_illustrator',
                'image_url'   => 'uploads/galleries/gallery_21.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Isometric 3D Game World & Character Assets',
                'category'    => 'Illustrations',
                'theme'       => 'digital_designer_illustrator',
                'image_url'   => 'uploads/galleries/gallery_22.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Digital Illustration Tablet & Stylus Station',
                'category'    => 'Workspace',
                'theme'       => 'digital_designer_illustrator',
                'image_url'   => 'uploads/galleries/gallery_23.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 3,
            ],

            // App Developer Theme Items
            [
                'title'       => 'Flutter & Swift Cross-Platform Health Tracker',
                'category'    => 'Mobile Apps',
                'theme'       => 'app_developer',
                'image_url'   => 'uploads/galleries/gallery_24.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Dual-Device Mobile Emulation & Debug Rig',
                'category'    => 'Workspace',
                'theme'       => 'app_developer',
                'image_url'   => 'uploads/galleries/gallery_25.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Mobile E-Commerce Checkout Experience',
                'category'    => 'Mobile Apps',
                'theme'       => 'app_developer',
                'image_url'   => 'uploads/galleries/gallery_26.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 3,
            ],

            // App & Software Developer Theme Items
            [
                'title'       => 'Enterprise POS & Inventory Desktop Platform',
                'category'    => 'Software Development',
                'theme'       => 'app_software_developer',
                'image_url'   => 'uploads/galleries/gallery_27.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Software Architect Engineering Lab',
                'category'    => 'Workspace',
                'theme'       => 'app_software_developer',
                'image_url'   => 'uploads/galleries/gallery_28.jpg',
                'is_featured' => true,
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Cross-Platform Electron Analytics Client',
                'category'    => 'Software Development',
                'theme'       => 'app_software_developer',
                'image_url'   => 'uploads/galleries/gallery_29.jpg',
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

