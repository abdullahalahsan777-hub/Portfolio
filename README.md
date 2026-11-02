# Portfolio — Multi-Theme Developer & Designer CMS

> Complete multi-theme portfolio with admin panel to maintain everything.

[![Current Version](https://img.shields.io/badge/Version-v1.2.0-0090e7?style=flat-square&logo=git&logoColor=white)](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.2.0)
[![Release Status](https://img.shields.io/badge/Release-Stable-emerald?style=flat-square)](https://github.com/abdullahalahsan777-hub/Portfolio/releases)
[![Laravel 12](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP 8.2+](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS 3.4](https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-6.x-646CFF?style=flat-square&logo=vite&logoColor=white)](https://vitejs.dev)
[![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-emerald.svg?style=flat-square)](LICENSE)

---

## Table of Contents

- [Version & Release Information](#version--release-information)
- [About The Software](#about-the-software)
- [Themes](#themes)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Requirements](#requirements)
- [Installation](#installation)
- [Default Credentials](#default-credentials)
- [Maintenance & Operations](#maintenance--operations)
  - [1. Switching Themes](#1-switching-themes)
  - [2. System Maintenance Mode](#2-system-maintenance-mode)
  - [3. Brand & Image Management](#3-brand--image-management)
  - [4. Two-Word Logo Configuration](#4-two-word-logo-configuration)
  - [5. Page Elements Management](#5-page-elements-management)
  - [6. Message & Inquiry Center](#6-message--inquiry-center)
  - [7. System & Browser Diagnostics Hub](#7-system--browser-diagnostics-hub)
  - [8. Social Authentication (Google & Facebook)](#8-social-authentication-google--facebook)
  - [9. Performance & Cache Optimization](#9-performance--cache-optimization)
  - [10. Queue & Background Processing](#10-queue--background-processing)
- [Directory Structure](#directory-structure)
- [Security Best Practices](#security-best-practices)
- [Changelog](#changelog)
- [Troubleshooting](#troubleshooting)
- [License](#license)

---

## Version & Release Information

| Metric | Details |
| :--- | :--- |
| **Current Stable Version** | **`v1.2.0`** |
| **Release Date** | October 2, 2026 |
| **Git Tag** | [`v1.2.0`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.2.0) |
| **Release Status** | **Stable** (Production-Ready) |
| **Laravel Compatibility** | Laravel `12.x` / PHP `8.2+` |
| **Default Branch** | [`main`](https://github.com/abdullahalahsan777-hub/Portfolio/tree/main) |
| **Version Releases Center** | [`/admin/versions`](http://127.0.0.1:8044/admin/versions) |

---

## Software Version Control & Releases Matrix (v1.0.0 – v1.2.0)

All releases from **v1.0.0** to **v1.2.0** are stable versions tracked by Git tags on GitHub.

### Unified Foundational Architecture (Retained in ALL Versions)
Across all versions, the foundational modules remain identical, unified, and fully operational:
1. **`Website` Group Module**: Website Studio Editor, Dynamic Sections & all Page Elements (Home, About, Contact, Services, Projects, Skills, Resume, Blog, FAQs, Pricing, Testimonials).
2. **Authentication Subsystem**: Secure session login, registration, password recovery, and role-based access.
3. **Account & Profile Management**: Admin user profile, avatar upload, and password update.
4. **General & Brand Settings**: Global title, copyright, social coordinates, and brand logos.
5. **Image & Media Engine**: Logo, favicon, dark mode wordmark, WebP image pipeline.
6. **Theme Engine Core**: Multi-theme presentation supporting Developer, App Developer, App Software Developer, UI/UX Designer, and Graphic Designer personas.

---

### Version-by-Version Subsystems & GitHub Downloads

| Version | Status | Release Date | Subsystem / Key Feature Focus | Direct Downloads | GitHub Release |
| :--- | :---: | :---: | :--- | :---: | :---: |
| **`v1.2.0`** | **Current Stable** | Oct 02, 2026 | **Enterprise Security & Full Responsive Polish**<br>&bull; Root `.htaccess` gateway protecting `.env`, `composer.json`, `.git`<br>&bull; Upload folder script execution prohibition (`php_flag engine off`)<br>&bull; `uploadFile()` extension blacklist<br>&bull; `SecurityHeadersMiddleware` (CSP/SAMEORIGIN/nosniff)<br>&bull; Public route rate-limiting throttle (15/min)<br>&bull; Fixed 100vh admin sidebar with slim custom scrollbars<br>&bull; Full device responsiveness (desktop, laptop, tab, mobile)<br>&bull; Version Control Releases Hub (`/admin/versions`) | [`.zip`](https://github.com/abdullahalahsan777-hub/Portfolio/archive/refs/tags/v1.2.0.zip) &bull; [`.tar.gz`](https://github.com/abdullahalahsan777-hub/Portfolio/archive/refs/tags/v1.2.0.tar.gz) | [`v1.2.0 Tag`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.2.0) |
| **`v1.1.9`** | Stable | Sep 15, 2026 | **Newsletter Engine & Pro Pagination**<br>&bull; Newsletter subscriber management & database migration<br>&bull; Public subscription endpoint (`/newsletter/subscribe`)<br>&bull; Dashboard newsletter audience health metrics card<br>&bull; Mathematical windowed pagination (capped to 7 items)<br>&bull; Scroll-to-top button auto-hide on scroll stop | [`.zip`](https://github.com/abdullahalahsan777-hub/Portfolio/archive/refs/tags/v1.1.9.zip) &bull; [`.tar.gz`](https://github.com/abdullahalahsan777-hub/Portfolio/archive/refs/tags/v1.1.9.tar.gz) | [`v1.1.9 Tag`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.1.9) |
| **`v1.1.8`** | Stable | Sep 01, 2026 | **Unified System & Browser Diagnostics Center**<br>&bull; Dual-source log viewer: backend `laravel.log` + client `browser.log`<br>&bull; Automated frontend JavaScript error beacon<br>&bull; Structured severity & runtime environment metric cards<br>&bull; One-click combined log download & dual-file clear | [`.zip`](https://github.com/abdullahalahsan777-hub/Portfolio/archive/refs/tags/v1.1.8.zip) &bull; [`.tar.gz`](https://github.com/abdullahalahsan777-hub/Portfolio/archive/refs/tags/v1.1.8.tar.gz) | [`v1.1.8 Tag`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.1.8) |
| **`v1.1.4`** | Stable | Aug 02, 2026 | **Client Inquiries & Communications Hub**<br>&bull; Gmail-style dark mode mailbox with hover action buttons<br>&bull; Folder navigation (Inbox, Sent, Drafts, Important, Trash)<br>&bull; Background autosave drafts with UUID `temp_id`<br>&bull; VIP importance badge inheritance from client history<br>&bull; Background file attachments & HTML email replies | [`.zip`](https://github.com/abdullahalahsan777-hub/Portfolio/archive/refs/tags/v1.1.4.zip) &bull; [`.tar.gz`](https://github.com/abdullahalahsan777-hub/Portfolio/archive/refs/tags/v1.1.4.tar.gz) | [`v1.1.4 Tag`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.1.4) |
| **`v1.1.1`** | Stable | Jul 01, 2026 | **System Maintenance & Infrastructure Hub**<br>&bull; Maintenance mode toggle (HTTP 503) with admin preview bypass<br>&bull; Automated broadcast emails to users on server status change<br>&bull; Real-time database size telemetry (MySQL/SQLite)<br>&bull; View, route, and configuration cache clear controls | [`.zip`](https://github.com/abdullahalahsan777-hub/Portfolio/archive/refs/tags/v1.1.1.zip) &bull; [`.tar.gz`](https://github.com/abdullahalahsan777-hub/Portfolio/archive/refs/tags/v1.1.1.tar.gz) | [`v1.1.1 Tag`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.1.1) |
| **`v1.1.0`** | Stable | Jun 01, 2026 | **Custom Error Pages Suite & Resilience**<br>&bull; Branded custom error pages: 400, 401, 403, 404, 405, 408, 410, 429, 500, 502, 503, 504<br>&bull; Interactive error preview showcase hub (`/errors`)<br>&bull; Exception reporter with route/action/IP context logging | [`.zip`](https://github.com/abdullahalahsan777-hub/Portfolio/archive/refs/tags/v1.1.0.zip) &bull; [`.tar.gz`](https://github.com/abdullahalahsan777-hub/Portfolio/archive/refs/tags/v1.1.0.tar.gz) | [`v1.1.0 Tag`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.1.0) |
| **`v1.0.0`** | Foundation | May 01, 2026 | **Multi-Theme Portfolio Foundation Release**<br>&bull; 5 frontend themes (Developer, App Developer, App Software, UI/UX, Graphic Designer)<br>&bull; Full Website Group content editor (Home, About, Services, Projects, Skills, Resume, Blog, FAQ, Pricing, Testimonials)<br>&bull; Authentication, User Management, General/Image/Media settings | [`.zip`](https://github.com/abdullahalahsan777-hub/Portfolio/archive/refs/tags/v1.0.0.zip) &bull; [`.tar.gz`](https://github.com/abdullahalahsan777-hub/Portfolio/archive/refs/tags/v1.0.0.tar.gz) | [`v1.0.0 Tag`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.0.0) |

---

## About The Software

**Portfolio Studio** is a self-hosted personal portfolio and content management system designed for software developers, digital designers, illustrators, and creators.

The platform provides **6 switchable frontend themes** combined with an **integrated Admin Control Panel**. Content elements — including headlines, counter metrics, portfolio projects, blog posts, brand logos, wordmarks, FAQ items, customer inquiries, and real-time runtime diagnostics — are manageable directly from the web interface without touching code.

---

## Themes

The application includes 6 themes with dedicated navigation structures, typography pairings, color systems, and interactive widgets:

| Theme Identifier | Target Audience | Visual Style | Accent Color |
| :--- | :--- | :--- | :--- |
| `developer` | Software Engineers & Backend Developers | Minimalist Dark, Code Aesthetic | `#00ff88` (Neon Emerald) |
| `digital_designer_illustrator` | Illustrators & 3D Artists | Editorial Layout, Serif Typography | `#e26d9b` (Rose Champagne) |
| `graphic_designer` | Brand & Graphic Designers | Dual-Tier Navigation, Gallery Grid | `#a855f7` (Electric Violet) |
| `uiux_designer` | UI/UX & Product Designers | High-Contrast Wireframe, Asymmetric Layout | `#ccff00` (Cyber Lime) |
| `app_developer` | Mobile App Developers | High-Contrast Dark, Tech Stack Chips | `#ff0033` (Crimson Red) |
| `app_software_developer` | Enterprise & SaaS Engineers | Modern Dark Tech, Metrics Display | `#ff6b00` (Amber Orange) |

---

## Features

### 1. Theme Engine
- Switch between 6 themes via the Admin Panel or URL parameter (`?theme=developer`).
- Supports **Dark Mode**, **Light Mode**, and **System Preference Auto-Detection**.
- Persistent user theme preferences saved in session and database.

### 2. Admin Control Panel
- Clean dark obsidian interface (`#09101d`) with responsive sidebar navigation.
- Real-time stat counters: inquiries, projects, articles, users, server status, and runtime diagnostics.
- Quick navigation shortcuts with keyboard-friendly workflows.

### 3. System & Browser Diagnostics Hub (`/admin/logs`)
- **Dual-Engine Log Capture**: Tracks backend runtime controller exceptions (`laravel.log`) and client-side browser JavaScript console errors (`browser.log`) via an automated frontend beacon.
- **Two-Row Diagnostic Metric Cards**:
  - **Row 1 (Severity & Volumes)**: Total Captured, Exceptions / Errors, Warnings, Browser Errors, Info & Notices.
  - **Row 2 (Runtime & Health)**: Today's Activity, Laravel Backend logs, Runtime Stack (`PHP 8.2 • Laravel v12`), Environment & Debug Mode status, Storage Footprint (`MB`).
- **Interactive Three-Column Filter Card**:
  - `SEARCHBOX`: Full-text keyword search across messages, stack traces, and JSON context.
  - `SOURCES`: Filter by *All Sources*, *Laravel Backend*, *Browser Console*, or individual log files.
  - `STATUS`: Instant severity filter by *All Status*, *Today's Activity*, *Error / Critical*, *Warning*, *Browser*, *Backend*, *Info*, or *Debug*.
- **Obsidian Pro Pagination**: First, Prev, page number pills with glowing active indicator, Next, Last, and custom per-page selector (`10`, `20`, `50`, `100`).
- **Unified Descending Export**: Single-click download of all combined log entries sorted descending by date/time into `System & Browser Diagnostics.log`.
- **Dual-File Purge**: Single-click clear emptying both `browser.log` and `laravel.log` simultaneously.
- **Diagnostics Tools**: Expandable stack traces with one-click "Copy Trace" clipboard button and formatted JSON context inspector.

### 4. Brand Assets & Logo Configuration
- **Software Logo**: Upload vector SVG or high-resolution PNG for desktop branding.
- **Browser Favicon**: Upload `.ico` or `.svg` browser tab icons.
- **Mini Logo**: Compact monogram icon for mobile headers and collapsed states.
- **Default Avatar**: Upload default profile placeholder photos.
- **Two-Word Logo**: Configure primary and accent wordmarks (e.g., `Abdullah` + `Ahsan.`) with real-time live preview and initials monogram generation.

### 5. Page Elements CMS (`/admin/pages`)
Edit both static subviews and dynamic database-driven sections across all 8 main pages:
- **Home**: Hero, About, Counter Stats, Services, Projects, Resume, Skills, Pricing, Blog, FAQ, Testimonials, Footer.
- **About**: Narrative Bio, Philosophy, Metric Cards, Milestone Highlights.
- **Services**: Offerings, Deliverables, Feature Matrix, Call-to-Action.
- **Portfolio / Projects**: Filterable Category Tags, Showcase Cards, Client & Live URL links.
- **Resume**: Downloadable PDF CV manager, Skills Radar, Career & Education Timelines.
- **Blog**: Article publisher with Summernote dark WYSIWYG editor, categories, cover photos, and tags.
- **FAQ**: Accordion Q&A items with category filters.
- **Contact**: Interactive contact cards (Email, WhatsApp, Phone, Location) and AJAX lead capture form.

### 6. Communications & Mailbox Suite (`/admin/messages`)
- **Gmail-Inspired Inbox Layout**: Clean dark mode design with two-line subject and message preview, hover action buttons, and unread badges.
- **Attachment Storage & Display**: Background folder upload with chip badges for PDF, PNG, JPG, and documents.
- **Sequential Queue Email Reply**: Reply with CC, BCC, and file attachments dispatched via background queue.
- **Mobile-Responsive Email Templates**: All transactional and reply email templates optimized for desktop, tablet, and mobile mail clients.

### 7. Toastr Notification System
- 6 notification statuses: `Success`, `Warning`, `Danger`, `Error`, `Info`, `Important`.
- Custom SVG icons, dark theme styling, animated countdown bars, and automatic duplicate prevention.

### 8. System Maintenance Mode
- Instant GUI toggle to place public frontend into maintenance while preserving admin access.
- Customizable downtime headline, explanatory narrative, and estimated restoration duration.

### 9. Social Authentication (OAuth 2.0)
- Single-click social login via **Google** and **Facebook** OAuth using Laravel Socialite.
- Automatic account provisioning and profile photo synchronization.

---

## Tech Stack

- **Backend Framework**: [Laravel 12.x](https://laravel.com)
- **Programming Language**: PHP 8.2 or 8.3
- **Database Engine**: MySQL 8.0+ / MariaDB 10.4+
- **Frontend Layer**: Blade Template Engine + Tailwind CSS 3.4
- **Asset Bundler**: Vite 6.x
- **Rich Text Editor**: Summernote Lite
- **Form UI Enhancement**: Select2
- **Icons**: Phosphor Icons & Custom SVG Iconography
- **Notifications**: Toastr 2.x
- **Social Login**: Laravel Socialite

---

## Requirements

Ensure your server or local environment meets the following specifications:

- **PHP Version**: `>= 8.2.0`
- **PHP Extensions**: `BCMath`, `Ctype`, `cURL`, `DOM`, `Fileinfo`, `JSON`, `Mbstring`, `OpenSSL`, `PCRE`, `PDO`, `PDO_MySQL`, `Tokenizer`, `XML`
- **Database**: MySQL 5.7+ / MySQL 8.0+ / MariaDB 10.4+
- **Package Managers**:
  - [Composer](https://getcomposer.org/) `>= 2.2.0`
  - [Node.js](https://nodejs.org/) `>= 18.0.0` & `npm` `>= 9.0.0`
- **Local Server**: Apache (XAMPP / WampServer / Laragon) or Nginx

---

## Installation

Follow these instructions to get a local instance running:

### Step 1: Clone the Repository

```bash
git clone https://github.com/abdullahalahsan777-hub/Portfolio.git
cd Portfolio
```

### Step 2: Install PHP Dependencies

```bash
composer install
```

### Step 3: Install Frontend Dependencies & Compile Assets

```bash
npm install
npm run build
```

> **Development Mode:** For live hot-reloading during template development, run `npm run dev`.

### Step 4: Configure Environment Settings

Copy the example environment configuration:

```bash
cp .env.example .env
```

Generate the application encryption key:

```bash
php artisan key:generate
```

Open `.env` in your text editor and set your local database credentials:

```env
APP_NAME="Portfolio Studio"
APP_VERSION=1.1.1
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=root
DB_PASSWORD=
```

### Step 5: Run Database Migrations & Seed Default Content

Ensure your MySQL server is running, create the `portfolio` database if it doesn't already exist, and execute:

```bash
php artisan migrate --seed
```

This creates all database tables and seeds:
- The default **Administrator** user account.
- Demo portfolio content (projects, skills, services, FAQs, testimonials, pricing plans, and articles).
- Initial site settings across all 6 themes.

### Step 6: Create Storage Symlink

Expose uploaded images, media assets, and PDF resumes to the public web:

```bash
php artisan storage:link
```

### Step 7: Launch the Application

Open `dev.sh` (or execute it via Git Bash / terminal):

```bash
./dev.sh
# or
bash dev.sh
```

> **Note**: `dev.sh` automatically launches the complete development environment, running the Laravel HTTP application server, background email queue listener, and Vite frontend asset bundler concurrently.

Visit the application in your browser:
- **Public Portfolio**: [http://127.0.0.1:8000](http://127.0.0.1:8000)
- **Admin Control Panel**: [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login)

---

## Default Credentials

Upon running `php artisan db:seed`, the system creates the default administrator:

| Parameter | Default Value | Notes |
| :--- | :--- | :--- |
| **Login URL** | `/login` or `/admin` | Redirects to Admin Dashboard upon login |
| **Email Address** | `admin@portfolio.local` | Can be updated in Admin > Profile Settings |
| **Password** | `admin123` | Please change this upon first login |
| **Access Role** | `admin` | Full system privileges |

---

## Maintenance & Operations

### 1. Switching Themes

Change the active theme anytime without editing code:
1. Log in to the Admin Control Panel.
2. Navigate to **System Settings > Theme Settings** (`/admin/settings/theme`).
3. Select any of the 6 themes (`developer`, `digital_designer_illustrator`, `graphic_designer`, `uiux_designer`, `app_developer`, `app_software_developer`).
4. Select your preferred color mode: **Dark**, **Light**, or **System**.
5. Click **Apply Theme Changes**.

Via Command Line:
```bash
php artisan tinker --execute="App\Models\SiteSetting::set('active_theme', 'digital_designer_illustrator', 'theme');"
```

---

### 2. System Maintenance Mode

Put the frontend into maintenance mode during upgrades while keeping the admin dashboard accessible:

- **Via Admin GUI**:
  1. Navigate to **Maintenance Mode** (`/admin/maintenance`).
  2. Toggle **Maintenance Status** to `Enabled`.
  3. Enter custom **Headline**, **Maintenance Narrative**, and **Estimated Duration**.
  4. Click **Save Maintenance Settings**.
- **Via Artisan CLI**:
  ```bash
  # Enable Maintenance
  php artisan down --secret="portfolio-admin-bypass"
  
  # Disable Maintenance
  php artisan up
  ```

---

### 3. Brand & Image Management

Manage brand assets under **System Settings > Image Upload** (`/admin/settings/images`):

1. **Software Logo**: Used in large branding locations and document headers.
2. **Favicon**: Displayed in browser tabs and mobile bookmark cards.
3. **Mini Logo**: Square monogram icon for compact headers.
4. **Placeholder Avatar**: Default profile photo placeholder.
5. Click **Upload** on any card to choose a new file, and click **SAVE IMAGES**.

---

### 4. Two-Word Logo Configuration

Configure a two-word logo with distinct primary and accent colors:

1. Go to **System Settings > Image Upload** (`/admin/settings/images`).
2. Locate the **Two-Word Logo** card.
3. Enter your **Word 1 (Primary)** and **Word 2 (Accent)**.
4. Watch the preview canvas update in real time.
5. Click **SAVE IMAGES** to persist changes across all theme navigation headers.

---

### 5. Page Elements Management

Control content blocks across all 8 core website pages under **Page Elements** (`/admin/pages`):

- **Home Elements** (`/admin/pages/home`): Edit Hero headline, dynamic counter stats, services overview, pricing tiers, skills matrix, testimonials, and FAQs.
- **About Elements** (`/admin/pages/about`): Edit personal narrative bio, core philosophy, and executive metric cards.
- **Service Elements** (`/admin/pages/service`): Configure service offerings, deliverables, and CTA banners.
- **Portfolio Elements** (`/admin/pages/project`): Manage project showcase items, client metadata, GitHub links, and live URLs.
- **Resume Elements** (`/admin/pages/resume`): Upload new PDF CV documents, configure skill levels, and update career timelines.
- **Blog Elements** (`/admin/pages/blog`): Publish articles with markdown/rich text, cover images, and category tags.

---

### 6. Message & Inquiry Center

Access inquiries submitted via frontend contact forms under **Messages** (`/admin/messages`):
- View sender's Name, Email, Phone, Subject, and Full Message.
- Gmail-inspired two-line preview with attachment chips.
- Direct reply with CC, BCC, and document attachments dispatched to background queue.
- Toastr notifications on successful queued dispatch.

---

### 7. System & Browser Diagnostics Hub

Monitor runtime errors and frontend console events under **System Logs** (`/admin/logs`):
- **Live Monitoring**: Real-time view of backend controller exceptions and client browser console errors.
- **Two-Row Diagnostic Cards**: Monitor counts across all severity levels, 24-hour activity, runtime stack, environment, and disk footprint.
- **One-Click Download**: Export all logs combined in datetime-descending order as `System & Browser Diagnostics.log`.
- **One-Click Clear**: Empty both `browser.log` and `laravel.log` simultaneously.
- **Instant Refresh**: Reload both log files fresh (`?source=all`).

---

### 8. Social Authentication (Google & Facebook)

Configure OAuth credentials in `.env` to enable single-click social login:

```env
# Google OAuth
GOOGLE_CLIENT_ID="your-google-client-id"
GOOGLE_CLIENT_SECRET="your-google-client-secret"
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"

# Facebook OAuth
FACEBOOK_CLIENT_ID="your-facebook-app-id"
FACEBOOK_CLIENT_SECRET="your-facebook-app-secret"
FACEBOOK_REDIRECT_URI="${APP_URL}/auth/facebook/callback"
```

1. **Google Console**: Obtain credentials from [Google Cloud Console > Credentials](https://console.cloud.google.com/apis/credentials).
2. **Facebook Developers**: Create an app and obtain credentials from [Meta for Developers](https://developers.facebook.com/apps/).

---

### 9. Performance & Cache Optimization

When deploying updates or modifying configuration, execute these standard cache commands:

```bash
# Clear application caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Re-cache for production performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize
php artisan optimize
```

---

### 10. Queue & Background Processing

For asynchronous email dispatch and background tasks:

```bash
php artisan queue:work --tries=3 --timeout=90
```

---

## Directory Structure

```plaintext
portfolio/
├── app/
│   ├── Helpers/
│   │   └── Helper.php          # Global Application Helper Utilities (currentUser, flash, etc.)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin Suite (Pages, Settings, Logs, Blog, Messages, etc.)
│   │   │   ├── Auth/           # Authentication Controllers (Login, Socialite, Password Reset)
│   │   │   └── Frontend/       # Multi-Theme Frontend Routing & Inquiries
│   │   └── Middleware/         # Admin Authentication, Maintenance & Guard Syncing
│   ├── Mail/                   # Mailable Classes (InquiryReplyMail, etc.)
│   ├── Models/                 # Eloquent Models (Project, Service, Blog, SiteSetting, etc.)
│   └── Notifications/          # Email & Database Notifications
├── config/                     # Framework & App Configurations (Cache, Logging, Auth, etc.)
├── database/
│   ├── migrations/             # Database Schema Migrations
│   └── seeders/                # Demo Content & Admin Seeders
├── public/
│   ├── images/defaults/        # Default Logos, Favicons, and Placeholders
│   ├── uploads/                # User Uploaded Media (Projects, Avatars, Attachments)
│   └── build/                  # Compiled Production Vite Assets
├── resources/
│   ├── css/                    # Tailwind CSS Architecture
│   ├── js/                     # Application Scripts & Tooling
│   └── views/
│       ├── admin/
│       │   ├── components/     # Reusable UI (Pro Pagination, etc.)
│       │   ├── logs/           # Unified System & Browser Diagnostics Interface
│       │   ├── messages/       # Inquiries & Mailbox Center
│       │   └── pages/          # 8-Page CMS Elements
│       ├── auth/               # Login, Socialite & Password Recovery Views
│       ├── emails/             # Mobile-Responsive HTML Email Templates
│       ├── frontend/
│       │   └── themes/         # 6 Switchable Theme Layouts & Partials
│       └── partials/           # Browser Error Beacon, Toastr & Global Partials
├── routes/
│   ├── web.php                 # Public Frontend, Socialite & Protected Admin Routes
│   └── console.php             # Custom Artisan Maintenance Commands
├── storage/
│   └── logs/                   # Unified Logs (laravel.log, browser.log)
├── .env.example                # Documented Environment Variable Blueprint
├── composer.json               # PHP Dependencies
├── dev.sh                      # Development Server Launcher (Server, Queue & Vite)
├── package.json                # Frontend Dependencies & Vite Scripts
├── tailwind.config.js          # Tailwind Color System & Font Extensions
└── vite.config.js              # Vite Compilation Pipeline
```

---

## Security Best Practices

1. **Environment Protection**: Never commit your `.env` file to version control. Keep `.env` in `.gitignore`.
2. **App Debug Mode**: In production environments, always set `APP_DEBUG=false` in `.env`.
3. **Admin Password**: Immediately update the default password (`admin123`) after installation via **Admin > Profile Settings**.
4. **File Permissions**:
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```
5. **Secure Cookies & HTTPS**: When deploying to production with SSL, set `SESSION_SECURE_COOKIE=true` in `.env`.

---

## Changelog

### [`v1.2.0`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.2.0) — *Current Stable Release* (October 2, 2026)

- **Enterprise Security Hardening**:
  - Added root gateway `.htaccess` policy blocking direct HTTP access to `.env`, `composer.json`, `.git`, and core Laravel folders.
  - Hardened `public/uploads/.htaccess` and `storage/app/public/.htaccess` disabling PHP engine (`php_flag engine off`) and denying script execution.
  - Implemented core `uploadFile()` extension blacklist prohibiting `.php`, `.phtml`, `.phar`, `.sh`, `.exe`, `.bat`, etc.
  - Registered `SecurityHeadersMiddleware` injecting `X-Frame-Options: SAMEORIGIN`, `X-Content-Type-Options: nosniff`, `X-XSS-Protection`, `Referrer-Policy`, and `Permissions-Policy`.
  - Added anti-brute-force `throttle` rate limiting across contact form (15/min), newsletter (15/min), and authentication routes (10/min).
  - Bounded client diagnostic log payload sizes and filtered third-party ad-blocker extension noise from `browser.log`.
- **Software Version Control Center**:
  - Implemented `/admin/versions` hub allowing administrators to audit, compare, and directly download every version archive (.zip and .tar.gz).
- **Responsive Layout Polish**:
  - Pinned 100vh admin sidebar with custom slim scrollbar.
  - Fixed mobile and desktop layout collisions on notifications, users, subscribers, and logs datalists.

### [`v1.1.9`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.1.9) — *Stable Release* (September 15, 2026)

- **Newsletter Subscription Subsystem**:
  - Implemented public subscription endpoint (`/newsletter/subscribe`) with duplicate check and validation.
  - Built Admin Subscriber Management module (`/admin/subscribers`) with bulk deletion, quick copy email, and direct mailto actions.
  - Added real-time Newsletter audience health and growth metrics card on Admin Dashboard.
- **Pro Mathematical Windowed Pagination**:
  - Completely refactored `admin.components.pagination` with dynamic sliding windowing (1 2 3 [4] 5 ... 11), capping buttons to 7 items and eliminating scrollbars.
- **Scroll-to-Top Interaction**:
  - Added automatic timer to hide the back-to-top button when scrolling stops across all themes.

### [`v1.1.8`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.1.8) — *Stable Release* (September 1, 2026)

- **Diagnostics UI Refinement**:
  - Reorganized diagnostic metrics into **two dedicated rows of 5 cards** covering log severity distributions and runtime health (`PHP 8.2 • Laravel v12.0`, Environment/Debug status, storage footprint).
  - Streamlined toolbar: Removed manual test error buttons to maintain a clean production view.
  - Added one-click **Download** combining both Browser and Laravel log data sorted descending by datetime as `System & Browser Diagnostics.log`.
  - Added dual-file **Clear** emptying both `browser.log` and `laravel.log` simultaneously.
  - Enhanced **Refresh** button to reload and fetch all live log data across both engines.
  - Added `today` and `backend` status filter options.

### [`v1.1.4`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.1.4) — *Stable Release* (August 2, 2026)

- **Mailbox & Inquiry Overhaul**:
  - Redesigned Inquiries Index with Gmail-style dark mode, two-line preview, and hover action triggers.
  - Implemented real-time autosave drafts using UUID `temp_id` tokens.
  - Added VIP importance badge inheritance based on client sender history.
  - Supported asynchronous attachment upload for documents and images with chip badges.
  - Sequential background queue email reply dispatch with Toastr integration.
  - Filtered dashboard inquiries stream specifically for inbox inquiries.
- **Mobile-Responsive Email Templates**:
  - Overhauled all notification and reply email templates for seamless responsiveness across mobile, tablet, and desktop clients.

### [`v1.1.1`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.1.1) — *Stable Release* (July 1, 2026)

- **System Maintenance & Infrastructure Hub**:
  - Instant GUI toggle to take frontend offline with customized HTTP 503 downtime message and duration banner.
  - Automated broadcast notification emails to all registered users upon maintenance mode toggling.
  - Real-time database storage telemetry (MySQL `information_schema` and SQLite calculation).
  - Integrated controls to purge compiled views, route caches, and application configurations.

### [`v1.1.0`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.1.0) — *Feature Release* (June 1, 2026)

- **Custom Error Pages Suite**:
  - Implemented comprehensive branded error pages for 400, 401, 403, 404, 405, 408, 410, 429, 500, 502, 503, and 504.
  - Created interactive error preview showcase hub (`/errors`).
  - Added structured exception reporting capturing route, action, method, URL, user identity, and IP address.
- **Developer Experience & Helper Utilities**:
  - Added `currentUser(): ?User` helper in base `Controller` and `app/Helpers/Helper.php`.
- **Socialite Authentication**:
  - Integrated Google and Facebook OAuth sign-in workflows with automatic user provisioning.

### [`v1.0.0`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.0.0) — *Official Public Release* (May 1, 2026)

- **Multi-Theme Engine**: 6 distinct frontend portfolio personas (`developer`, `digital_designer_illustrator`, `graphic_designer`, `uiux_designer`, `app_developer`, `app_software_developer`).
- **Admin Control Panel**: Dark control center with real-time statistics and responsive sidebar navigation.
- **Brand & Logo Studio**:
  - Vector Software Logo & Mini Monogram uploads.
  - Browser Favicon (`.ico`/`.svg`) and Avatar Placeholders.
  - Two-Word Logo: Dynamic primary and accent wordmarks with real-time browser preview, monogram initials generator, and optional graphic upload.
- **Page Elements CMS**: In-browser editor for static subviews and database-driven dynamic section cards across all 8 pages.
- **Toastr Notification System**: 6 distinct status levels (`Success`, `Warning`, `Danger`, `Error`, `Info`, `Important`) with custom SVG icons.
- **Inquiries & Message Hub**: AJAX contact form lead capture with unread status tracking and direct email reply integration.

## Troubleshooting

#### Q: Uploaded images or resumes return 404 Not Found.
**A:** Run `php artisan storage:link` to create the symbolic link between `storage/app/public` and `public/storage`. Also verify folder permissions on `public/uploads`.

#### Q: Styles or JavaScript updates do not reflect in the browser.
**A:** Run `npm run build` to recompile assets with Vite, followed by `php artisan view:clear`.

#### Q: Database connection error (`Access denied for user 'root'`).
**A:** Check `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env` and verify your MySQL service is running in XAMPP or your hosting control panel.

---

## License

This software is open-source software licensed under the [MIT License](LICENSE).
