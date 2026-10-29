# Portfolio — Multi-Theme Developer & Designer CMS

> Complete multi-theme portfolio with admin panel to maintain everything.

[![Current Version](https://img.shields.io/badge/Version-v1.0.0-0090e7?style=flat-square&logo=git&logoColor=white)](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.0.0)
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
  - [7. Performance & Cache Optimization](#7-performance--cache-optimization)
  - [8. Queue & Background Processing](#8-queue--background-processing)
- [Directory Structure](#directory-structure)
- [Security Best Practices](#security-best-practices)
- [Changelog](#changelog)
- [Troubleshooting](#troubleshooting)
- [License](#license)

---

## Version & Release Information

| Metric | Details |
| :--- | :--- |
| **Current Stable Version** | **`v1.0.0`** |
| **Release Date** | October 29, 2026 |
| **Git Tag** | [`v1.0.0`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.0.0) |
| **Release Status** | Production-Ready (LTS) |
| **Laravel Compatibility** | Laravel `12.x` / PHP `8.2+` |
| **Default Branch** | [`main`](https://github.com/abdullahalahsan777-hub/Portfolio/tree/main) |

---

## About The Software

**Portfolio Studio** is a self-hosted personal portfolio and content management system designed for software developers, digital designers, illustrators, and creators.

The platform provides **6 switchable frontend themes** combined with an **integrated Admin Control Panel**. Content elements — including headlines, counter metrics, portfolio projects, blog posts, brand logos, wordmarks, FAQ items, and customer inquiries — are manageable directly from the web interface without touching code.

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
- Clean dark interface (`#09101d`) with responsive sidebar navigation.
- Real-time stat counters: inquiries, projects, articles, users, and server status.
- Quick navigation shortcuts with keyboard-friendly workflows.

### 3. Brand Assets & Logo Configuration
- **Software Logo**: Upload vector SVG or high-resolution PNG for desktop branding.
- **Browser Favicon**: Upload `.ico` or `.svg` browser tab icons.
- **Mini Logo**: Compact monogram icon for mobile headers and collapsed states.
- **Default Avatar**: Upload default profile placeholder photos.
- **Two-Word Logo**: Configure primary and accent wordmarks (e.g., `Abdullah` + `Ahsan.`) with real-time live preview and initials monogram generation.

### 4. Page Elements CMS (`admin/pages`)
Edit both static subviews and dynamic database-driven sections across all 8 main pages:
- **Home**: Hero, About, Counter Stats, Services, Projects, Resume, Skills, Pricing, Blog, FAQ, Testimonials, Footer.
- **About**: Narrative Bio, Philosophy, Metric Cards, Milestone Highlights.
- **Services**: Offerings, Deliverables, Feature Matrix, Call-to-Action.
- **Portfolio / Projects**: Filterable Category Tags, Showcase Cards, Client & Live URL links.
- **Resume**: Downloadable PDF CV manager, Skills Radar, Career & Education Timelines.
- **Blog**: Article publisher with Summernote dark WYSIWYG editor, categories, cover photos, and tags.
- **FAQ**: Accordion Q&A items with category filters.
- **Contact**: Interactive contact cards (Email, WhatsApp, Phone, Location) and AJAX lead capture form.

### 5. Lead Capture & Inquiries Manager
- Real-time contact form with client-side and server-side validation.
- Unread badge indicators, detail modals, status tracking (New, Read, Replied), and direct email reply triggers.

### 6. Toastr Notification System
- 6 notification statuses: `Success`, `Warning`, `Danger`, `Error`, `Info`, `Important`.
- Custom SVG icons, dark theme styling, animated countdown bars, and automatic timeout handling.

### 7. System Maintenance Mode
- Instant GUI toggle to place public frontend into maintenance while preserving admin access.
- Customizable downtime headline, explanatory narrative, and estimated restoration duration.

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
APP_VERSION=1.0.0
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

Start Laravel's built-in development server:

```bash
php artisan serve
```

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
- Track read/unread statuses with badge counts.
- Click **Reply via Email** to open your default email client with the sender pre-filled.
- Delete or archive processed inquiries.

---

### 7. Performance & Cache Optimization

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

### 8. Queue & Background Processing

For asynchronous mail sending (e.g. password resets or notifications via `QUEUE_CONNECTION=database`):

```bash
php artisan queue:work --tries=3 --timeout=90
```

---

## Directory Structure

```plaintext
portfolio/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin Suite (Pages, Settings, Blog, Messages, etc.)
│   │   │   ├── Auth/           # Authentication Controllers (Login, Password Reset)
│   │   │   └── Frontend/       # Multi-Theme Frontend Routing & Inquiries
│   │   └── Middleware/         # Admin Authentication & Role Verification
│   ├── Models/                 # Eloquent Models (Project, Service, Blog, SiteSetting, etc.)
│   └── Notifications/          # Email & Database Notifications
├── config/                     # Framework & App Configurations (Cache, Database, Auth, etc.)
├── database/
│   ├── migrations/             # Database Schema Migrations
│   └── seeders/                # Demo Content & Admin Seeders
├── public/
│   ├── images/defaults/        # Default Logos, Favicons, and Placeholders
│   ├── uploads/                # User Uploaded Media (Projects, Avatars, Settings)
│   └── build/                  # Compiled Production Vite Assets
├── resources/
│   ├── css/                    # Tailwind CSS Architecture
│   ├── js/                     # Application Scripts & Tooling
│   └── views/
│       ├── admin/              # Admin Panel Views
│       ├── auth/               # Login & Password Recovery Views
│       ├── frontend/
│       │   └── themes/         # 6 Switchable Theme Layouts & Partials
│       │       ├── app_developer/
│       │       ├── app_software_developer/
│       │       ├── developer/
│       │       ├── digital_designer_illustrator/
│       │       ├── graphic_designer/
│       │       └── uiux_designer/
│       └── partials/           # Toastr Notifications & Global Partials
├── routes/
│   ├── web.php                 # Public Frontend & Protected Admin Routes
│   └── console.php             # Custom Artisan Maintenance Commands
├── .env.example                # Documented Environment Variable Blueprint
├── composer.json               # PHP Dependencies
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

### [`v1.0.0`](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.0.0) — *Official Public Release* (October 2026)

- **Multi-Theme Engine**: 6 distinct frontend portfolio personas (`developer`, `digital_designer_illustrator`, `graphic_designer`, `uiux_designer`, `app_developer`, `app_software_developer`).
- **Admin Control Panel**: Dark control center with real-time statistics and responsive sidebar navigation.
- **Brand & Logo Studio**:
  - Vector Software Logo & Mini Monogram uploads.
  - Browser Favicon (`.ico`/`.svg`) and Avatar Placeholders.
  - Two-Word Logo: Dynamic primary and accent wordmarks with real-time browser preview, monogram initials generator, and optional graphic upload.
- **Page Elements CMS**: In-browser editor for static subviews and database-driven dynamic section cards across all 8 pages.
- **Toastr Notification System**: 6 distinct status levels (`Success`, `Warning`, `Danger`, `Error`, `Info`, `Important`) with custom SVG icons.
- **Inquiries & Message Hub**: AJAX contact form lead capture with unread status tracking and direct email reply integration.
- **System Maintenance Mode**: Instant GUI toggle to take frontend offline with customized downtime message and duration banner.

---

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
