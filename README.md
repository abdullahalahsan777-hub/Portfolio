# 🌟 Portfolio — Complete Multi-Theme Developer & Designer Studio

> **Complete multi theme portfolio with admin panel to mantainance everythings.**

[![Laravel 12](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP 8.2+](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS 3.4](https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-6.x-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)
[![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-emerald.svg?style=for-the-badge)](LICENSE)

---

## 📖 Table of Contents

- [About The Software](#-about-the-software)
- [Signature Themes](#-signature-themes)
- [Key Features](#-key-features)
- [System Architecture & Tech Stack](#-system-architecture--tech-stack)
- [System Requirements](#-system-requirements)
- [Installation Guide](#-installation-guide)
- [Default Admin Credentials](#-default-admin-credentials)
- [Maintenance & Operations Manual](#-maintenance--operations-manual)
  - [1. Switching Themes](#1-switching-themes)
  - [2. System Maintenance Mode](#2-system-maintenance-mode)
  - [3. Brand & Image Upload Studio](#3-brand--image-upload-studio)
  - [4. Two-Word Logo Configuration](#4-two-word-logo-configuration)
  - [5. Dynamic Page Elements Management](#5-dynamic-page-elements-management)
  - [6. Message & Inquiry Center](#6-message--inquiry-center)
  - [7. Performance & Cache Optimization](#7-performance--cache-optimization)
  - [8. Queue & Background Processing](#8-queue--background-processing)
- [Project Directory Structure](#-project-directory-structure)
- [Security Best Practices](#-security-best-practices)
- [Troubleshooting & FAQ](#-troubleshooting--faq)
- [License](#-license)

---

## 💡 About The Software

**Portfolio Studio** is an all-in-one personal branding and creative showcase engine engineered for software engineers, digital illustrators, visual designers, mobile app developers, and full-stack creators.

Unlike static HTML templates or rigid CMS tools, this software couples **6 dynamic frontend themes** with an **Obsidian Dark Glassmorphic Admin Control Panel**. Every headline, counter metric, project showcase, blog article, brand logo, navigation wordmark, FAQ item, and customer inquiry is administered live from the web dashboard without modifying code.

---

## 🎨 Signature Themes

The application includes 6 themes with dedicated navigation structures, typography pairings, color systems, and interactive widgets:

| Theme Identifier | Persona & Niche | Visual Aesthetic | Accent Color |
| :--- | :--- | :--- | :--- |
| `developer` | Software Engineers & Backend Architects | Minimalist Glint Dark, Hexagon Monogram | `#00ff88` (Neon Emerald) |
| `digital_designer_illustrator` | 3D Artists, Illustrators & Creatives | Blayden Editorial, High-Fashion Serif & Pill Cards | `#e26d9b` (Rose Champagne) |
| `graphic_designer` | Brand Identity & Graphic Designers | Obsidian Studio, Dual-Tier Header, Gallery Grids | `#a855f7` (Electric Violet) |
| `uiux_designer` | Product Designers & UI/UX Leads | High-Contrast Wireframe, Asymmetric Layouts | `#ccff00` (Cyber Lime) |
| `app_developer` | Mobile & iOS/Android Developers | High-Velocity Crimson, Tech Stack Badges | `#ff0033` (Vibrant Crimson) |
| `app_software_developer` | Enterprise & SaaS Engineers | Sunset Obsidian, Modern Tech Metrics | `#ff6b00` (Warm Amber) |

---

## 🚀 Key Features

### 1. 🎛️ Real-Time Theme Engine
- Switch between all 6 themes on the fly via the Admin Panel or URL parameter.
- Supports **Dark Mode**, **Light Mode**, and **System Preference Auto-Detection**.
- Persistent user theme preferences saved in session and database.

### 2. 🛡️ Obsidian Glassmorphic Admin Control Panel
- Handcrafted obsidian dark interface (`#09101d`) with backdrop blur, custom scrollbars, and squircle card layouts.
- Real-time stat counters: total inquiries, completed projects, active articles, and system status.
- Quick navigation shortcuts with keyboard-friendly workflows.

### 3. 🖼️ Brand Assets & Two-Word Logo Studio
- **Software Logo**: Upload vector SVG or high-resolution PNG for desktop branding.
- **Browser Favicon**: Upload `.ico` or `.svg` browser tab icons.
- **Mini Logo**: Compact monogram icon for mobile headers and collapsed states.
- **Default Avatar**: Upload default profile placeholder photos.
- **Two-Word Logo**: Configure primary and accent wordmarks (e.g., `Abdullah` + `Ahsan.`) with real-time live preview and initials monogram generation.

### 4. 📄 Dynamic Page Elements CMS (`admin/pages`)
Edit both static subviews and dynamic database-driven sections across all 8 main pages:
- **Home**: Hero, About, Counter Stats, Services, Projects, Resume, Skills, Pricing, Blog, FAQ, Testimonials, Footer.
- **About**: Narrative Bio, Philosophy, Executive Metric Cards, Milestone Highlights.
- **Services**: Offerings, Value Proposition, Feature Matrix, Call-to-Action.
- **Portfolio / Projects**: Filterable Category Tags, Showcase Cards, Client & Live URL links.
- **Resume**: Downloadable PDF CV manager, Skills Radar, Career & Education Timelines.
- **Blog**: Article publisher with Summernote dark WYSIWYG editor, categories, cover photos, and tags.
- **FAQ**: Accordion Q&A items with category filters.
- **Contact**: Interactive contact cards (Email, WhatsApp, Phone, Location) and AJAX lead capture form.

### 5. 📬 Lead Capture & Inquiries Manager
- Real-time contact form with client-side and server-side validation.
- Unread badge indicators, detail modals, status tracking (New, Read, Replied), and direct email reply triggers.

### 6. 🔔 Obsidian Glassmorphic Toastr Notification System
- 6 distinct notification statuses: `Success`, `Warning`, `Danger`, `Error`, `Info`, `Important`.
- Custom SVG squircle icons, dark glass blur, animated progress countdown bars, and automatic timeout handling.

### 7. 🚧 System Maintenance Mode
- Instant GUI toggle to place public frontend into maintenance while preserving admin access.
- Customizable downtime headline, explanatory narrative, and estimated restoration duration.

---

## 🛠️ System Architecture & Tech Stack

- **Backend Framework**: [Laravel 12.x](https://laravel.com)
- **Programming Language**: PHP 8.2 or 8.3
- **Database Engine**: MySQL 8.0+ / MariaDB 10.4+
- **Frontend Layer**: Blade Template Engine + Tailwind CSS 3.4
- **Asset Bundler**: Vite 6.x
- **Rich Text Editor**: Summernote Lite (Obsidian Dark Theme)
- **Form UI Enhancement**: Select2 (Dark Themed Dropdowns)
- **Icons**: Phosphor Icons & Custom SVG Squircle Iconography
- **Notification Suite**: Custom Obsidian Toastr 2.x

---

## 📋 System Requirements

Ensure your server or local environment meets the following specifications:

- **PHP Version**: `>= 8.2.0`
- **PHP Extensions**:
  - `BCMath`
  - `Ctype`
  - `cURL`
  - `DOM`
  - `Fileinfo`
  - `JSON`
  - `Mbstring`
  - `OpenSSL`
  - `PCRE`
  - `PDO` & `PDO_MySQL`
  - `Tokenizer`
  - `XML`
- **Database**: MySQL 5.7+ / MySQL 8.0+ / MariaDB 10.4+
- **Package Managers**:
  - [Composer](https://getcomposer.org/) `>= 2.2.0`
  - [Node.js](https://nodejs.org/) `>= 18.0.0` & `npm` `>= 9.0.0`
- **Local Server**: Apache (XAMPP / WampServer / Laragon) or Nginx

---

## ⚙️ Installation Guide

Follow these step-by-step instructions to get a local instance up and running in minutes:

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

Generate the unique application encryption key:

```bash
php artisan key:generate
```

Open `.env` in your text editor and set your local database credentials:

```env
APP_NAME="Portfolio Studio"
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

Ensure your MySQL server is running (e.g. via XAMPP Control Panel), create the `portfolio` database if it doesn't already exist, and execute:

```bash
php artisan migrate --seed
```

This creates all database tables and seeds:
- The default **Administrator** user account.
- Complete demo portfolio content (projects, skills, services, FAQs, testimonials, pricing plans, and articles).
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

## 🔑 Default Admin Credentials

Upon running `php artisan db:seed`, the system creates the default administrator:

| Parameter | Default Value | Notes |
| :--- | :--- | :--- |
| **Login URL** | `/login` or `/admin` | Auto-redirects to Admin Dashboard upon login |
| **Email Address** | `admin@portfolio.local` | Can be updated in Admin > Profile Settings |
| **Password** | `admin123` | Please change this upon first login |
| **Access Role** | `admin` | Full system privileges |

---

## 🛠️ Maintenance & Operations Manual

### 1. Switching Themes

You can change the active theme anytime without touching code:
1. Log in to the Admin Control Panel.
2. Navigate to **System Settings > Theme Settings** (`/admin/settings/theme`).
3. Select any of the 6 themes (`developer`, `digital_designer_illustrator`, `graphic_designer`, `uiux_designer`, `app_developer`, `app_software_developer`).
4. Select your preferred color mode: **Dark**, **Light**, or **System**.
5. Click **Apply Theme Changes**.

*Via Command Line (Tinker):*
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

### 3. Brand & Image Upload Studio

Manage all visual brand marks under **System Settings > Image Upload** (`/admin/settings/images`):

1. **Software Logo**: Used in large branding locations and document headers.
2. **Favicon**: Displayed in browser tabs and mobile bookmark cards.
3. **Mini Logo**: Square monogram icon for compact headers.
4. **Placeholder Avatar**: Default profile photo placeholder.
5. Click the blue **Upload** button on any card to choose a new file, and click **SAVE IMAGES**.

---

### 4. Two-Word Logo Configuration

Modern websites often use two-word logos with distinctive colors (e.g. `Abdullah` in white + `Ahsan.` in theme accent):

1. Go to **System Settings > Image Upload** (`/admin/settings/images`).
2. Locate the **Two-Word Logo** card.
3. Enter your **Word 1 (Primary)** and **Word 2 (Accent)**.
4. Watch the preview box update live in real time.
5. *(Optional)* Click **Upload** to supply a graphic logo file instead of text.
6. Click **SAVE IMAGES** to persist changes across all theme navigation headers.

---

### 5. Dynamic Page Elements Management

Control every content block across all 8 core website pages under **Page Elements** (`/admin/pages`):

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
- Track read/unread statuses with responsive badge counts.
- Click **Reply via Email** to trigger your default email client with sender pre-filled.
- Delete or archive processed inquiries.

---

### 7. Performance & Cache Optimization

When making configuration changes, updating stylesheets, or deploying to production, execute these performance maintenance commands:

```bash
# 1. Clear application caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# 2. Re-cache for maximum production performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. One-line production optimization
php artisan optimize
```

---

### 8. Queue & Background Processing

If you configure asynchronous mail sending (e.g. password resets or contact notifications via `QUEUE_CONNECTION=database`):

```bash
# Run the queue worker process
php artisan queue:work --tries=3 --timeout=90
```

---

## 📂 Project Directory Structure

```plaintext
portfolio/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Complete Admin Suite (Pages, Settings, Blog, Messages, etc.)
│   │   │   ├── Auth/           # Authentication Controllers (Login, Password Reset)
│   │   │   └── Frontend/       # Multi-Theme Frontend Routing & Inquiries
│   │   └── Middleware/         # Admin Authentication & Role Verification
│   ├── Models/                 # Eloquent Models (Project, Service, Blog, SiteSetting, etc.)
│   └── Notifications/          # Email & Database Notifications
├── config/                     # Framework & App Configurations (Cache, Database, Auth, etc.)
├── database/
│   ├── migrations/             # Database Schema Migrations
│   └── seeders/                # Comprehensive Demo Content & Admin Seeders
├── public/
│   ├── images/defaults/        # Default Logos, Favicons, and Placeholders
│   ├── uploads/                # User Uploaded Media (Projects, Avatars, Settings)
│   └── build/                  # Compiled Production Vite Assets
├── resources/
│   ├── css/                    # Tailwind CSS Architecture
│   ├── js/                     # Application Scripts & Tooling
│   └── views/
│       ├── admin/              # Obsidian Dark Glassmorphic Admin Views
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

## 🔒 Security Best Practices

1. **Environment Protection**: Never commit your `.env` file to version control. Keep `.env` in `.gitignore`.
2. **App Debug Mode**: In production environments, always set `APP_DEBUG=false` in `.env`.
3. **Admin Password**: Immediately update the seeded password (`admin123`) after installation via **Admin > Profile Settings**.
4. **File Permissions**:
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```
5. **Secure Cookies & HTTPS**: When deploying to production with SSL, set `SESSION_SECURE_COOKIE=true` in `.env`.

---

## ❓ Troubleshooting & FAQ

#### Q: Uploaded images or resumes return 404 Not Found.
**A:** Run `php artisan storage:link` to create the symbolic link between `storage/app/public` and `public/storage`. Also verify folder permissions on `public/uploads`.

#### Q: Missing environment variable warnings in your IDE (`Env [...] not found`).
**A:** All optional framework keys have been documented with safe fallbacks in `.env` and `.env.example`. Simply press `Ctrl + S` in the open config file to allow your language server to re-index `.env`.

#### Q: Styles or JavaScript updates do not reflect in the browser.
**A:** Run `npm run build` to recompile assets with Vite, followed by `php artisan view:clear`.

#### Q: Database connection error (`Access denied for user 'root'`).
**A:** Check `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env` and verify your MySQL service is running in XAMPP or your hosting control panel.

---

## 📄 License

This software is open-source software licensed under the [MIT License](LICENSE).

---

<p align="center">
  Crafted with ❤️ for creators, engineers, and designers.
</p>
