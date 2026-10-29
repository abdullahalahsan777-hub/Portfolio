<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Get a setting by key with a fallback default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }

    /**
     * Set/update a setting by key.
     */
    public static function set(string $key, mixed $value, string $group = 'general'): self
    {
        return static::updateOrCreate(
            ['key'   => $key],
            ['value' => $value, 'group' => $group]
        );
    }

    /**
     * Get the active portfolio theme.
     */
    public static function getActiveTheme(): string
    {
        return (string) static::get('active_theme', 'developer');
    }

    /**
     * Get all supported themes with styling metadata.
     */
    public static function getAvailableThemes(): array
    {
        return [
            'developer' => [
                'name'       => 'Developer (GLINT)',
                'short'      => 'Developer',
                'color'      => '#00ff88',
                'badge'      => 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30',
                'border'     => 'border-[#00ff88]',
                'description'=> 'Pitch black & neon emerald code agency architecture',
                'icon'       => 'code-bracket',
            ],
            'graphic_designer' => [
                'name'       => 'Graphic Designer',
                'short'      => 'Graphic',
                'color'      => '#7c3aed',
                'badge'      => 'bg-purple-500/20 text-purple-300 border-purple-500/30',
                'border'     => 'border-[#7c3aed]',
                'description'=> 'Deep cosmic violet & electric neon fuchsia visual design',
                'icon'       => 'swatch',
            ],
            'uiux_designer' => [
                'name'       => 'UI/UX Designer',
                'short'      => 'UI/UX',
                'color'      => '#ccff00',
                'badge'      => 'bg-lime-500/20 text-lime-300 border-lime-500/30',
                'border'     => 'border-[#ccff00]',
                'description'=> 'Pitch black & electric neon lime interface design systems',
                'icon'       => 'square-3-stack-3d',
            ],
            'app_developer' => [
                'name'       => 'App Developer',
                'short'      => 'App Dev',
                'color'      => '#ff0033',
                'badge'      => 'bg-rose-500/20 text-rose-300 border-rose-500/30',
                'border'     => 'border-[#ff0033]',
                'description'=> 'Pitch black & vibrant crimson iOS, Android & Flutter apps',
                'icon'       => 'device-phone-mobile',
            ],
            'app_software_developer' => [
                'name'       => 'App & Software Developer',
                'short'      => 'Software Dev',
                'color'      => '#ff6b00',
                'badge'      => 'bg-amber-500/20 text-amber-300 border-amber-500/30',
                'border'     => 'border-[#ff6b00]',
                'description'=> 'Deep onyx charcoal & warm amber cloud engineering portfolio',
                'icon'       => 'cpu-chip',
            ],
            'digital_designer_illustrator' => [
                'name'       => 'Digital Designer & Illustrator',
                'short'      => 'Illustrator',
                'color'      => '#e26d9b',
                'badge'      => 'bg-pink-500/20 text-pink-300 border-pink-500/30',
                'border'     => 'border-[#e26d9b]',
                'description'=> 'Cosmic dark mauve & vector illustration showcase',
                'icon'       => 'paint-brush',
            ],
        ];
    }

    /**
     * Get details for a specific theme.
     */
    public static function getThemeDetails(?string $key): array
    {
        $themes = static::getAvailableThemes();

        if ($key === 'all') {
            return [
                'name'       => 'All Themes (Shared Across Website)',
                'short'      => 'All Themes',
                'color'      => '#6366f1',
                'badge'      => 'bg-indigo-500/20 text-indigo-300 border-indigo-500/30',
                'border'     => 'border-indigo-500',
                'description'=> 'Elements visible across all portfolio themes',
                'icon'       => 'globe-alt',
            ];
        }

        return $themes[$key] ?? [
            'name'        => ucfirst(str_replace('_', ' ', (string) $key)),
            'short'       => ucfirst((string) $key),
            'color'       => '#6366f1',
            'badge'       => 'bg-indigo-500/20 text-indigo-300 border-indigo-500/30',
            'border'      => 'border-indigo-500',
            'description' => 'Theme-specific elements',
        ];
    }
    /**
     * Get default website content elements for a given theme.
     */
    public static function getThemeContentDefaults(string $theme): array
    {
        $defaults = [
            'developer' => [
                'hero_tag'          => '// LEAD SOFTWARE ARCHITECT',
                'hero_title_line1'  => 'IMAGINATION',
                'hero_title_line2'  => 'IS MORE IMPORTANT',
                'hero_title_line3'  => 'THAN KNOWLEDGE',
                'hero_cta_text'     => 'GET STARTED',
                'hero_cta_url'      => '#contact',
                'hero_cta2_text'    => 'VIEW PROJECTS',
                'hero_cta2_url'     => '#portfolio',
                'quote_text'        => 'FAILURE IS THE CONDIMENT THAT GIVES SUCCESS',
                'quote_author'      => 'Truman Capote',
                'about_heading'     => 'FAILURE IS THE CONDIMENT THAT GIVES SUCCESS',
                'about_description' => 'Spend more time focusing on the important aspects of your business. Turn to McCartney HR LLC in Brooklyn, NY for HR solutions. As an advanced virtual HR company, we are offering online HR systems that allow you to track time and attendance.',
                'about_bio_extended'=> 'I build resilient web platforms, decoupled backend APIs, and enterprise cloud solutions engineered for high concurrency, rock-solid stability, and sub-second execution.',
                'experience_years'  => '10+ YRS EXP',
                'completed_projects'=> '120+ Completed Projects',
                'satisfied_clients' => '85+ Satisfied Clients',
                'awards_count'      => '14 Design Honors',
                'portfolio_title'   => 'LATEST WORKING PROJECT',
                'portfolio_subtitle'=> 'Selected client applications and high-traffic cloud systems',
                'services_title'    => 'SERVICES AND SOLUTIONS',
                'services_subtitle' => 'Full-spectrum software architecture, API engineering, and cloud deployment',
                'resume_title'      => 'EXPERIENCE AND SKILL',
                'resume_subtitle'   => 'A decade of hands-on digital creation, academic honors, and engineering leadership.',
                'skills_title'      => 'EXPERIENCE AND SKILL',
                'skills_subtitle'   => 'Circular dials and core competencies across full-stack engineering.',
                'testimonials_title'=> 'HAPPY CLIENTS TO SAYS',
                'testimonials_subtitle' => 'Kind words and trusted endorsements from founders and technical leaders.',
                'pricing_title'     => 'ALL OUR PAYMENT OPTIONS',
                'pricing_subtitle'  => 'Predictable sprint investments and transparent retainers for projects of any scale.',
                'contact_title'     => 'STAY UP TO DATE, SUBSCRIBE TO THE FREE NEWSLETTER!',
                'contact_subtitle'  => 'Have a project in mind or need technical leadership? Send a message and let\'s turn your vision into reality.',
            ],
            'graphic_designer' => [
                'hero_tag'          => 'Hi there, I\'m William',
                'hero_title_line1'  => 'Crafting',
                'hero_title_line2'  => 'Intuitive Digital',
                'hero_title_line3'  => 'Experiences',
                'hero_cta_text'     => 'Hire me',
                'hero_cta_url'      => '#contact',
                'hero_cta2_text'    => 'Download CV',
                'hero_cta2_url'     => '#resume',
                'quote_text'        => 'I assist individuals and brands in achieving their objectives by creating and developing user-focused digital products and interactive experiences.',
                'quote_author'      => 'William / Creative Director',
                'about_heading'     => 'What do I offer?',
                'about_description' => 'My journey started with a fascination for design and technology, leading me to specialize in UI/UX design. I thrive on turning complex problems into simple, beautiful solutions.',
                'about_bio_extended'=> 'With +12 years with professional design software, I build products that elevate conversion and retention.',
                'experience_years'  => '+12 Year of Experience',
                'completed_projects'=> '+250 Projects Completed',
                'satisfied_clients' => '+680 Satisfied Happy Clients',
                'awards_count'      => '+18 Awards Won Received',
                'portfolio_title'   => 'My Latest Works',
                'portfolio_subtitle'=> 'I believe that working hard and trying to learn every day will make me improve in satisfying my customers.',
                'services_title'    => 'What do I offer?',
                'services_subtitle' => 'Full-spectrum visual design, mobile app UI, brand identity, and web development.',
                'resume_title'      => 'My Resume',
                'resume_subtitle'   => 'I believe that working hard and trying to learn every day will make me improve in satisfying my customers.',
                'skills_title'      => 'My Skills',
                'skills_subtitle'   => 'I thrive on turning complex problems into simple, beautiful solutions that enhance user satisfaction.',
                'testimonials_title'=> 'Client\'s Testimonials',
                'testimonials_subtitle' => 'I believe that working hard and trying to learn every day will make me improve in satisfying my customers.',
                'pricing_title'     => 'Sprint & Project Investment Plans',
                'pricing_subtitle'  => 'Predictable sprint investments and ongoing design retainers with full milestone transparency.',
                'contact_title'     => 'Get in touch',
                'contact_subtitle'  => 'I\'m always excited to take on new projects and collaborate with innovative minds. If you have a project in mind, feel free to reach out!',
            ],
            'uiux_designer' => [
                'hero_tag'          => 'Hello, I\'m',
                'hero_title_line1'  => 'Roy C. Jones',
                'hero_title_line2'  => 'web',
                'hero_title_line3'  => 'designer',
                'hero_cta_text'     => 'Hire Me >',
                'hero_cta_url'      => '#contact',
                'hero_cta2_text'    => 'Download Resume >',
                'hero_cta2_url'     => '#resume',
                'quote_text'        => 'We denounce with righteous indignation dislike demoralized by the charms of pleasure.',
                'quote_author'      => 'Roy C. Jones — Lead Product Designer',
                'about_heading'     => 'Professional Problem Solutions For Digital Products',
                'about_description' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate.',
                'about_bio_extended'=> 'Deciphering complicated digital ecosystems into frictionless, high-converting product journeys with atomic design tokens.',
                'experience_years'  => '13+ Years Of Experience',
                'completed_projects'=> '8k+ Project Complete',
                'satisfied_clients' => '99%+ Client Satisfactions',
                'awards_count'      => '24 Design Awards',
                'portfolio_title'   => 'Explore My Popular Projects',
                'portfolio_subtitle'=> 'Sed ut perspiciatis unde omnis iste natus voluptatem accusantium doloremque laudantium.',
                'services_title'    => 'My Special Service For your',
                'services_subtitle' => 'Popular services engineered for user engagement, accessibility, and retention.',
                'resume_title'      => 'Real Problem Solutions Experience',
                'resume_subtitle'   => 'Career highlights across global tech giants and design-led agencies.',
                'skills_title'      => 'Let\'s Explore Popular Skills & Experience',
                'skills_subtitle'   => 'Sed ut perspiciatis unde omnis iste natus to voluptatem accusantium doloremque laudantium.',
                'testimonials_title'=> 'I\'ve 1253+ Clients Feedback',
                'testimonials_subtitle' => 'Sed ut perspiciatis unde omnis natus totam rem aperiam eaque inventore veritatis.',
                'pricing_title'     => 'Amazing Pricing For your Projects',
                'pricing_subtitle'  => 'Sed perspiciatis unde natus totam rem aperiam eaque inventore veritatis architecto beatae.',
                'contact_title'     => 'Let\'s Talk For your Next Projects',
                'contact_subtitle'  => 'Sed ut perspiciatis unde omnis natus totam rem aperiam eaque inventore veritatis architecto.',
            ],
            'app_developer' => [
                'hero_tag'          => 'MY DIGITAL SPACE',
                'hero_title_line1'  => 'ALEX RIVERA',
                'hero_title_line2'  => 'FULL STACK',
                'hero_title_line3'  => 'DEVELOPER',
                'hero_cta_text'     => 'HIRE ME',
                'hero_cta_url'      => '#contact',
                'hero_cta2_text'    => 'DOWNLOAD CV',
                'hero_cta2_url'     => '#about',
                'quote_text'        => 'A Passionate Web Developer Crafting Modern And Responsive Websites. I Turn Ideas Into Interactive Digital Experiences.',
                'quote_author'      => 'Alex Rivera / Full Stack Developer',
                'about_heading'     => 'WHO AM I ?',
                'about_description' => 'I\'m Ronaldo Fredrickson, a creative web developer driven by design and inspired by technology. I specialize in building modern, responsive, and engaging digital experiences that tell stories and connect with people.',
                'about_bio_extended'=> 'Language: English, Germanic. Available for freelance contracts and full-time technical leadership.',
                'experience_years'  => '08+ Years Experience',
                'completed_projects'=> '15k PROJECT COMPLETED',
                'satisfied_clients' => '99 OUR HAPPY CLIENTS',
                'awards_count'      => '12 Tech Honors',
                'portfolio_title'   => 'FEATURED PORTFOLIO',
                'portfolio_subtitle'=> 'High-impact mobile applications, responsive dashboards, and interactive portals.',
                'services_title'    => 'THE EASE-SERVICE PROCESS',
                'services_subtitle' => 'Turn complex challenges into intuitive, high-performance digital products.',
                'resume_title'      => 'OUR RESUME',
                'resume_subtitle'   => 'Education and work experience across full stack engineering and UI/UX design.',
                'skills_title'      => 'OUR SKILLS',
                'skills_subtitle'   => 'Core frontend, backend, CMS, and marketing technology proficiencies.',
                'testimonials_title'=> 'What Founders Say About Working With Me',
                'testimonials_subtitle'=> 'Endorsements and feedback from leading technology founders and engineering directors.',
                'pricing_title'     => 'Transparent Project Investments',
                'pricing_subtitle'  => 'Predictable milestone deliveries with clean code guarantees and warranty.',
                'contact_title'     => 'GET IN TOUCH NOW',
                'contact_subtitle'  => 'Whether it\'s design, development, or advice, I\'m here to help. Send me a note and let\'s start a conversation.',
            ],
            'app_software_developer' => [
                'hero_tag'          => 'Software Development',
                'hero_title_line1'  => 'App & Software',
                'hero_title_line2'  => 'Developer',
                'hero_title_line3'  => 'ROBERT MILLER',
                'hero_cta_text'     => 'Contact Me',
                'hero_cta_url'      => '#contact',
                'hero_cta2_text'    => 'View All Work',
                'hero_cta2_url'     => '#portfolio',
                'quote_text'        => 'I always try to put my best service to my client. I always try to put my best effort into every line of code.',
                'quote_author'      => 'Robert Miller — Software Architect',
                'about_heading'     => 'Welcome to Tonu, Best Software Services',
                'about_description' => 'I have 8+ years of experiences in Software Development for give you better services. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
                'about_bio_extended'=> 'I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine.',
                'experience_years'  => '8+ Years Exprience',
                'completed_projects'=> '180+ Projects Completed',
                'satisfied_clients' => '120+ Happy clients',
                'awards_count'      => '15+ Awards Win',
                'portfolio_title'   => 'My Latest Project',
                'portfolio_subtitle'=> 'Selected cloud applications and high-throughput enterprise platforms.',
                'services_title'    => 'My Best Services',
                'services_subtitle' => 'Check services engineered for speed, scalability, and robust uptime.',
                'resume_title'      => 'Career & Education Path',
                'resume_subtitle'   => 'Academic honors in computer science and enterprise engineering leadership.',
                'skills_title'      => 'My Core Tech Stack',
                'skills_subtitle'   => 'Tools and technologies I use to build scalable distributed architectures.',
                'testimonials_title'=> 'What My Clients Say.',
                'testimonials_subtitle'=> 'To begin to identify aspects of students\' own portfolios to identify key portfolio features.',
                'pricing_title'     => 'My Pricing Plan',
                'pricing_subtitle'  => 'Consectetur adipiscing elit. Purusout phasellus malesuada lectus.',
                'contact_title'     => 'Send Me A Message',
                'contact_subtitle'  => 'Your email address will not be published. All fields are required.',
            ],
            'digital_designer_illustrator' => [
                'hero_tag'           => 'Blayden Portfolio',
                'hero_title_line1'   => 'I am Alex Walker',
                'hero_title_line2'   => 'digital designer',
                'hero_title_line3'   => '& illustrator',
                'hero_cta_text'      => 'Download CV',
                'hero_cta_url'       => '#resume',
                'hero_cta2_text'     => 'Scroll for more',
                'hero_cta2_url'      => '#portfolio',
                'quote_text'         => 'Here we must run as fast as we can, just to stay in place. And if you wish to go anywhere you must run twice as fast as that.',
                'quote_author'       => 'Lewis Carroll / Through the Looking-Glass',
                'about_heading'      => 'Approach and philosophy',
                'about_description'  => 'I wonder if I\'ve been changed in the night? Let me think. Was I the same when I got up this morning? I almost think I can remember feeling a little different. But if I\'m not the same, the next question is Who in the world am I? Ah, that\'s the great puzzle!',
                'about_bio_extended' => 'Bridging the sweet spot between clean aesthetic minimalism and technical robustness. Every interaction is designed with purpose and micro-interaction fluidity.',
                'experience_years'   => '06+ Years Experience',
                'completed_projects' => '120+ Completed Projects',
                'satisfied_clients'  => '85+ Satisfied Clients',
                'awards_count'       => '14 Design Honors',
                'portfolio_title'    => 'Design, tech & some magic',
                'portfolio_subtitle' => 'Curated selected projects crafted with precision, purpose, and attention to detail.',
                'services_title'     => 'Creating impactful projects',
                'services_subtitle'  => 'Full-spectrum design, UI/UX architecture, brand identity, and scalable development.',
                'resume_title'       => 'The digital journey',
                'resume_subtitle'    => 'A decade of hands-on digital creation, academic honors, and engineering leadership.',
                'skills_title'       => 'My favourite tools',
                'skills_subtitle'    => 'My essential daily toolkit for high-fidelity prototyping, code synthesis, and production deployment.',
                'testimonials_title' => 'My client\'s stories',
                'testimonials_subtitle'=> 'Kind words and trusted endorsements from founders and design partners.',
                'pricing_title'      => 'Commission & Retainer Rates',
                'pricing_subtitle'   => 'Predictable sprint investments and transparent retainers for projects of any scale.',
                'contact_title'      => 'Just say hello!',
                'contact_subtitle'   => 'Got an idea? Tell me! Drop me a line and I\'ll get back as soon as possible.',
            ],
        ];

        return $defaults[$theme] ?? ($defaults['developer'] ?? []);
    }
}
