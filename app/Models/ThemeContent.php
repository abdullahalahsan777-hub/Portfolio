<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeContent extends Model
{
    use HasFactory;

    protected $table = 'theme_contents';

    protected $fillable = [
        'theme',
        'page',
        'section',
        'key',
        'value',
        'type',
    ];

    /**
     * Get a content value for a specific theme by key, optionally scoped to a page.
     */
    public static function get(string $theme, string $key, mixed $default = null, ?string $page = null): mixed
    {
        $query = static::where('theme', $theme)->where('key', $key);
        if ($page) {
            $item = (clone $query)->where('page', $page)->first();
            if ($item && !is_null($item->value)) {
                return $item->value;
            }
        }
        $item = $query->first();
        if ($item && !is_null($item->value)) {
            return $item->value;
        }

        $defaults = static::defaultsForTheme($theme);
        return $defaults[$key] ?? $default;
    }

    /**
     * Set/update a content value for a specific theme, page and section.
     */
    public static function set(string $theme, string $key, mixed $value, string $section = 'general', string $type = 'text', string $page = 'home'): self
    {
        return static::updateOrCreate(
            ['theme' => $theme, 'page' => $page, 'key' => $key],
            ['value' => $value, 'section' => $section, 'type' => $type]
        );
    }

    /**
     * Get all content key-value pairs for a specific theme, optionally scoped to a page, merged with default template data.
     */
    public static function forTheme(string $theme, ?string $page = null): array
    {
        $defaults           = static::defaultsForTheme($theme);

        if ($page && $page !== 'home') {
            $generalSaved   = static::where('theme', $theme)->whereIn('page', ['home', 'general'])->pluck('value', 'key')->toArray();
            $pageSaved      = static::where('theme', $theme)->where('page', $page)->pluck('value', 'key')->toArray();
            $saved          = array_merge($generalSaved, $pageSaved);
        } else {
            $saved          = static::where('theme', $theme)->pluck('value', 'key')->toArray();
        }

        // Database overrides take precedence over defaults
        return array_merge($defaults, array_filter($saved, fn($v) => !is_null($v)));
    }

    /**
     * Complete, curated content and images for each of the 6 portfolio themes based on template images.
     */
    public static function defaultsForTheme(string $theme): array
    {
        $all = static::allThemeDefaults();
        return $all[$theme] ?? ($all['developer'] ?? []);
    }

    /**
     * Catalog of all 6 themes with rich, design-accurate copy and image assets.
     */
    public static function allThemeDefaults(): array
    {
        return [
            /* =========================================================================
               1. DEVELOPER (GLINT - Developer Design.png)
               ========================================================================= */
            'developer' => [
                // Hero
                'hero_tag'               => '// LEAD SOFTWARE ARCHITECT',
                'hero_title_line1'       => 'IMAGINATION',
                'hero_title_line2'       => 'IS MORE IMPORTANT',
                'hero_title_line3'       => 'THAN KNOWLEDGE',
                'hero_description'       => 'I build resilient web platforms, decoupled backend APIs, and enterprise cloud solutions engineered for high concurrency, rock-solid stability, and sub-second execution.',
                'hero_image'             => 'images/themes/developer/hero_portrait.jpg',
                'hero_exp_badge'         => '10+ YRS EXP',
                'hero_cta_text'          => 'GET STARTED',
                'hero_cta_url'           => '#contact',
                'hero_cta2_text'         => 'VIEW PROJECTS',
                'hero_cta2_url'          => '#portfolio',

                // About / Video / Philosophy
                'about_tag'              => 'ABOUT ME',
                'about_heading'          => 'FAILURE IS THE CONDIMENT THAT GIVES SUCCESS',
                'about_description'      => 'Spend more time focusing on the important aspects of your business. Turn to McCartney HR LLC in Brooklyn, NY for HR solutions. As an advanced virtual HR company, we are offering online HR systems that allow you to track time and attendance.',
                'about_bio_extended'     => 'I build resilient web platforms, decoupled backend APIs, and enterprise cloud solutions engineered for high concurrency, rock-solid stability, and sub-second execution.',
                'about_image'            => 'images/themes/developer/workspace_video.jpg',
                'about_video_url'        => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'about_cv_text'          => 'DOWNLOAD CV',
                'about_cv_url'           => '#resume',

                // Stats / Counters
                'experience_years'       => '10+ YRS EXP',
                'completed_projects'     => '120+ Completed Projects',
                'satisfied_clients'      => '85+ Satisfied Clients',
                'awards_count'           => '14 Design Honors',

                // Headings
                'services_title'         => 'SERVICES AND SOLUTIONS',
                'services_subtitle'      => 'Full-spectrum software architecture, API engineering, and cloud deployment.',
                'portfolio_title'        => 'LATEST WORKING PROJECT',
                'portfolio_subtitle'     => 'Selected client applications and high-traffic cloud systems.',
                'resume_title'           => 'EXPERIENCE AND SKILL',
                'resume_subtitle'        => 'Works Seamlessly Computer across distributed cloud systems.',
                'skills_title'           => 'EXPERIENCE AND SKILL',
                'skills_subtitle'        => 'Circular progress metrics across specialized software engineering domains.',
                'testimonials_title'     => 'HAPPY CLIENTS TO SAYS',
                'testimonials_subtitle'  => 'Kind words and trusted endorsements from founders and technical leaders.',
                'pricing_title'          => 'ALL OUR PAYMENT OPTIONS',
                'pricing_subtitle'       => 'Predictable sprint investments and transparent retainers for projects of any scale.',
                'blog_title'             => 'LATEST NEWS & BLOGS',
                'blog_subtitle'          => 'Recent engineering insights and architectural breakdowns.',

                // Newsletter & Contact
                'contact_title'          => 'STAY UP TO DATE, SUBSCRIBE TO THE FREE NEWSLETTER!',
                'contact_subtitle'       => 'Have a project in mind or need technical leadership? Send a message and let\'s turn your vision into reality.',
                'newsletter_btn_text'    => 'SUBSCRIBE',
                'contact_email'          => 'hello@glint.dev',
                'contact_phone'          => '+1 (555) 839-2019',
                'contact_location'       => 'Austin, TX • Worldwide Remote',
                'copyright_text'         => '© 2024 GLINT. All rights reserved by quomodotheme.',
            ],

            /* =========================================================================
               2. GRAPHIC DESIGNER (william.design - GraphicsDesigner.png)
               ========================================================================= */
            'graphic_designer' => [
                // Hero
                'hero_tag'               => '👋 Hi there, I\'m William',
                'hero_title_line1'       => 'Crafting',
                'hero_title_line2'       => 'Intuitive Digital',
                'hero_title_line3'       => 'Experiences',
                'hero_description'       => 'I assist individuals and brands in achieving their objectives by creating and developing user-focused digital products and interactive experiences.',
                'hero_image'             => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=700&q=85',
                'hero_software_text'     => '+12 years with professional design software',
                'hero_cta_text'          => 'Hire me',
                'hero_cta_url'           => '#contact',
                'hero_cta2_text'         => 'Download CV',
                'hero_cta2_url'          => '#resume',

                // Stats
                'experience_years'       => '+12',
                'experience_years_label' => 'Year of Experience',
                'completed_projects'     => '+250',
                'completed_projects_label'=> 'Projects Completed',
                'satisfied_clients'      => '+680',
                'satisfied_clients_label'=> 'Satisfied Happy Clients',
                'awards_count'           => '+18',
                'awards_count_label'     => 'Awards Won Received',

                // Services
                'services_title'        => 'What do I offer?',
                'services_subtitle'     => 'My journey started with a fascination for design and technology, leading me to specialize in UI/UX design.',
                'services_cta_text'     => 'Get a Quote',
                'services_cta_url'      => '#contact',

                // Portfolio
                'portfolio_title'       => 'My Latest Works',
                'portfolio_subtitle'    => 'I believe that working hard and trying to learn every day will make me improve in satisfying my customers.',
                'portfolio_cta_text'    => 'View All Projects',
                'portfolio_cta_url'     => '#portfolio',

                // Resume
                'resume_title'       => 'My Resume',
                'resume_subtitle'    => 'I believe that working hard and trying to learn every day will make me improve in satisfying my customers.',
                'resume_cta_text'    => 'Get in touch',
                'resume_cta_url'     => '#contact',

                // Skills
                'skills_title'         => 'My Skills',
                'skills_subtitle'      => 'I thrive on turning complex problems into simple, beautiful solutions that enhance user satisfaction.',
                'skills_footer_note'   => 'In addition, I have some programming knowledge such as: HTML, CSS, Javascript, Bootstrap, TailwindCSS',

                // Testimonials & Blog
                'testimonials_title'   => 'Client\'s Testimonials',
                'testimonials_subtitle'=> 'I believe that working hard and trying to learn every day will make me improve in satisfying my customers.',
                'blog_title'           => 'Recent blog',
                'blog_subtitle'        => 'Explore the insights and trends shaping our industry.',
                'blog_cta_text'        => 'View more',
                'blog_cta_url'         => '#blog',

                // Contact
                'contact_title'        => 'Get in touch',
                'contact_subtitle'     => 'I\'m always excited to take on new projects and collaborate with innovative minds. If you have a project in mind or just want to chat about design, feel free to reach out!',
                'contact_form_title'   => 'Leave a message',
                'contact_phone'        => '+1-234-567-8901',
                'contact_email'        => 'contact@william.design',
                'contact_skype'        => 'WilliamDesignUX',
                'contact_address'      => '0811 Erdman Prairie, Joaville CA',
                'contact_cta_text'     => 'Send Message',
                'copyright_text'       => '© 2024 All Rights Reserved by William.design',
            ],

            /* =========================================================================
               3. UI/UX DESIGNER (Noxfolio - UI UX Designer.png)
               ========================================================================= */
            'uiux_designer' => [
                // Hero
                'hero_tag'             => 'Hello, I\'m',
                'hero_title_line1'     => 'Roy C. Jones',
                'hero_title_line2'     => 'web',
                'hero_title_line3'     => 'designer',
                'hero_description'     => 'We denounce with righteous indignation dislike demoralized by the charms of pleasure.',
                'hero_image'           => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=700&q=85',
                'hero_cta_text'        => 'Hire Me >',
                'hero_cta_url'         => '#contact',
                'hero_cta2_text'       => 'Download Resume >',
                'hero_cta2_url'        => '#resume',

                // Hero Floating Counters
                'experience_years'       => '13+',
                'experience_years_label' => 'Years Of Experience',
                'completed_projects'     => '8k+',
                'completed_projects_label'=> 'Project Complete',
                'satisfied_clients'      => '99%+',
                'satisfied_clients_label'=> 'Client Satisfactions',

                // About Me
                'about_tag'             => 'About Me',
                'about_heading'         => 'Professional Problem Solutions For Digital Products',
                'about_description'     => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate provident qui officia deserunt mollitia animi.',
                'about_image'           => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=700&q=85',
                'about_badge_text'      => 'Experience Designer ↗',
                'contact_email'         => 'support@gmail.com',
                'contact_phone'         => '+880 (123) 456 88',

                // Sections
                'services_tag'          => 'Popular Services',
                'services_title'        => 'My Special Service For your',
                'portfolio_tag'         => 'Latest Works',
                'portfolio_title'       => 'Explore My Popular Projects',
                'portfolio_cta_text'    => 'View More Projects >',
                'portfolio_cta_url'     => '#portfolio',
                'resume_tag'            => 'My Resume',
                'resume_title'          => 'Real Problem Solutions Experience',
                'skills_tag'            => 'My Skills',
                'skills_title'          => 'Let\'s Explore Popular Skills & Experience',
                'skills_subtitle'       => 'Sed ut perspiciatis unde omnis iste natus voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa quae ab illo inventore veritatis.',
                'skills_cta_text'       => 'Learn More >',
                'skills_cta_url'        => '#skills',
                'testimonials_tag'      => 'Clients Testimonials',
                'testimonials_title'    => 'I\'ve 1253+ Clients Feedback',
                'testimonials_subtitle' => 'Sed ut perspiciatis unde omnis natus totam rem aperiam eaque inventore veritatis.',
                'pricing_tag'           => 'Pricing Package',
                'pricing_title'         => 'Amazing Pricing For your Projects',
                'blog_tag'              => 'News & Blog',
                'blog_title'            => 'Latest News & Blog',

                // Contact
                'contact_tag'           => 'Get In Touch',
                'contact_title'         => 'Let\'s Talk For your Next Projects',
                'contact_subtitle'      => 'Sed ut perspiciatis unde omnis natus totam rem aperiam eaque inventore veritatis.',
                'contact_check1'        => '5+ Years Of Experience',
                'contact_check2'        => 'Professional Web Designer',
                'contact_check3'        => 'Mobile Apps Design',
                'contact_address'       => '55 Main Street, 2nd block, New York City',
                'contact_cta_text'      => 'Send Us Message >',
                'copyright_text'        => 'Copyright ©2023, Noxfolio All Rights Reserved',
            ],

            /* =========================================================================
               4. APP DEVELOPER (MYSTORY - app Developer.png)
               ========================================================================= */
            'app_developer' => [
                // Hero
                'hero_tag'              => 'MY DIGITAL SPACE',
                'hero_title_line1'      => 'ALEX RIVERA',
                'hero_title_line2'      => 'FULL STACK',
                'hero_title_line3'      => 'DEVELOPER',
                'hero_description'      => 'A Passionate Web Developer Crafting Modern And Responsive Websites. I Turn Ideas Into Interactive Digital Experiences.',
                'hero_image'            => 'images/app_developer/hero.jpg',
                'hero_cta_text'         => 'HIRE ME ↗',
                'hero_cta_url'          => '#contact',
                'contact_phone'         => '00 (92110) 85413',
                'contact_email'         => 'alex.patel@creative.com',
                'contact_address'       => '88 Broklyn Golden USA',

                // Marquee Ticker
                'marquee_text'          => 'BRANDING ✺ UI/UX DESIGN ✺ APP DESIGN ✺ LANDING PAGE ✺ FULL STACK',

                // About Us / WHO AM I
                'about_tag'             => 'ABOUT US',
                'about_heading'         => 'WHO AM I ?',
                'about_description'     => 'I\'m Ronaldo Fredrickson, a creative web developer driven by design and inspired by technology. I specialize in building modern, responsive, and engaging digital experiences that tell stories and connect with people.',
                'about_collab_image'    => 'images/app_developer/collab.jpg',
                'about_chart_image'     => 'images/app_developer/chart.jpg',
                'completed_projects'    => '15k',
                'completed_projects_label' => 'PROJECT COMPLETED',
                'satisfied_clients'     => '99',
                'satisfied_clients_label' => 'OUR HAPPY CLIENTS',
                'profile_name'          => 'Ronaldo Fredrickson',
                'profile_dob'           => 'November 28, 1989',
                'profile_address'       => 'San Francisco CA 97987 USA',
                'profile_zip'           => '1000',
                'profile_email'         => 'maya.patel@creative.com',
                'profile_phone'         => '00 (92110) 85413',
                'profile_language'      => 'English, Germanic',
                'profile_freelance'     => 'Available',
                'about_cv_text'         => 'DOWNLOAD CV ↗',
                'about_cv_url'          => '#resume',

                // Sections
                'services_tag'          => 'OUR SERVICES',
                'services_title'        => 'THE EASE-SERVICE PROCESS',
                'services_cta_text'     => 'VIEW ALL SERVICES ↗',
                'services_cta_url'      => '#services',
                'portfolio_tag'         => 'PORTFOLIO',
                'portfolio_title'       => 'FEATURED PORTFOLIO',
                'portfolio_cta_text'    => 'VIEW ALL PROJECT ↗',
                'portfolio_cta_url'     => '#portfolio',
                'resume_tag'            => 'RESUME',
                'resume_title'          => 'OUR RESUME',
                'skills_tag'            => 'SKILLS',
                'skills_title'          => 'OUR SKILLS',
                'faq_tag'               => 'FAQ',
                'faq_title'             => 'HAVE ANY QUESTIONS?',
                'blog_tag'              => 'BLOG',
                'blog_title'            => 'CHECK OUT MY ARTICLES',

                // Contact
                'contact_tag'           => 'CONTACT ME',
                'contact_title'         => 'GET IN TOUCH NOW',
                'contact_subtitle'      => 'Whether it\'s design, development, or advice, I\'m here to help. Send me a note and let\'s start a conversation.',
                'contact_box1_title'    => 'HAVE QUESTION ?',
                'contact_box1_val'      => 'Free 00 (92110) 85413',
                'contact_box2_title'    => 'WRITE EMAIL',
                'contact_box2_val'      => 'maya.patel@creative.com',
                'contact_box3_title'    => 'OUR LOCATION',
                'contact_box3_val'      => '88 Broklyn Golden USA',
                'contact_cta_text'      => 'SEND MESSAGE ↗',
                'follow_title'          => 'FOLLOW US',
                'copyright_text'        => '© 2025 Portfolio of "MyStory" — All rights reserved.',
            ],

            /* =========================================================================
               5. APP & SOFTWARE DEVELOPER (Tonu - App And Software Developer.png)
               ========================================================================= */
            'app_software_developer' => [
                // Hero
                'hero_tag'              => 'Software Development',
                'hero_title_line1'      => 'App & Software',
                'hero_title_line2'      => 'Developer',
                'hero_title_line3'      => 'ROBERT MILLER',
                'hero_description'      => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                'hero_image'            => 'images/app_software_developer/hero.jpg',
                'hero_cta_text'         => 'Contact Me',
                'hero_cta_url'          => '#contact',

                // About Me
                'about_tag'             => 'About Me',
                'about_heading'         => 'Welcome to Tonu, Best Software Services',
                'about_description'     => 'I have 8+ years of experiences in Software Development for give you better services. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                'about_bio_extended'    => 'I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence.',
                'about_image'           => 'images/app_software_developer/hero.jpg',

                // Counters
                'experience_years'      => '8+',
                'experience_years_label'=> 'Years Exprience',
                'completed_projects'    => '180+',
                'completed_projects_label'=> 'Projects Completed',
                'awards_count'          => '15+',
                'awards_count_label'    => 'Awards Win',
                'satisfied_clients'     => '120+',
                'satisfied_clients_label'=> 'Happy clients',

                // Services & Marquee
                'services_tag'          => 'Check Services',
                'services_title'        => 'My Best Services',
                'marquee_text'          => 'I always try to put my best service to my client. I always try to put my best effort into every line of code.',

                // Portfolio & Testimonials
                'portfolio_tag'         => 'Latest Project',
                'portfolio_title'       => 'My Latest Project',
                'portfolio_cta_text'    => 'View All Work',
                'portfolio_cta_url'     => '#portfolio',
                'testimonials_tag'      => 'Testimonials',
                'testimonials_title'    => 'What My Clients Say.',
                'blog_tag'              => 'Latest Blog',
                'blog_title'            => 'My Latest News',
                'blog_cta_text'         => 'View All Blog',
                'blog_cta_url'          => '#blog',
                'pricing_tag'           => 'Pricing',
                'pricing_title'         => 'My Pricing Plan',

                // Contact
                'contact_title'         => 'Send Me A Message',
                'contact_subtitle'      => 'Your email address will not be published. All fields are required.',
                'contact_phone'         => '+1238575694',
                'contact_email'         => 'example@mail.com',
                'contact_cta_text'      => 'Submit Now',
                'copyright_text'        => '© 2023. All rights reserved by themepress.',
            ],

            /* =========================================================================
               6. DIGITAL DESIGNER & ILLUSTRATOR (Blayden* - digital designer & illustrator.png)
               ========================================================================= */
            'digital_designer_illustrator' => [
                // Hero
                'hero_tag'              => 'Blayden Portfolio',
                'hero_title_line1'      => 'I am Alex Walker',
                'hero_title_line2'      => 'digital designer',
                'hero_title_line3'      => '& illustrator',
                'hero_description'      => 'Hello! I\'m Alex Walker, digital designer and illustrator based in Odessa, Ukraine.',
                'hero_image'            => 'images/digital_designer_illustrator/hero_cards.jpg',
                'hero_accent_image'     => 'images/digital_designer_illustrator/flower.jpg',
                'hero_cta_text'         => 'Download CV',
                'hero_cta_url'          => '#resume',
                'hero_cta2_text'        => 'Scroll for more',
                'hero_cta2_url'         => '#portfolio',

                // Portfolio
                'portfolio_tag'         => 'Portfolio ↗',
                'portfolio_title'       => 'Design, tech & some magic',
                'portfolio_subtitle'    => 'Curated selected projects crafted with precision, purpose, and attention to detail.',

                // Philosophy / About
                'about_tag'             => 'About me ↗',
                'about_heading'         => 'Approach and philosophy',
                'about_author'          => 'Alex Walker',
                'about_phone'           => '+1 212-708-9400',
                'about_email'           => 'hello@yourdomain.com',
                'about_description'     => 'I wonder if I\'ve been changed in the night? Let me think. Was I the same when I got up this morning? I almost think I can remember feeling a little different. But if I\'m not the same, the next question is Who in the world am I? Ah, that\'s the great puzzle!',
                'about_cv_text'         => 'Download CV',
                'about_cv_url'          => '#resume',
                'about_gallery_img1'    => 'blayden/img/avatars/400x400_t01.webp',
                'about_gallery_img2'    => 'blayden/img/testimonials/1400x1200_t01.webp',

                // Services & Resume
                'services_tag'          => 'Services ↗',
                'services_title'        => 'Creating impactful projects',
                'resume_tag'            => 'Resume ↗',
                'resume_title'          => 'The digital journey',
                'skills_title'          => 'My favourite tools',

                // Follow Ribbon
                'marquee_text'          => 'Follow me ✺ Follow me ✺ Follow me ✺ Follow me ✺ Follow me',

                // Contact
                'contact_tag'           => 'Contact ↗',
                'contact_title'         => 'Just say hello!',
                'contact_subtitle'      => 'Drop me a line and I\'ll get back as soon as possible.',
                'contact_subheading'    => 'Got an idea? Tell me!',
                'contact_cta_text'      => 'Submit request',
                'contact_location'      => '02000',
                'contact_phone'         => '+1 510-457-0211',
                'contact_email'         => 'support@example.com',
                'copyright_text'        => '© 2024 Blayden. All rights reserved.',
            ],
        ];
    }
}
