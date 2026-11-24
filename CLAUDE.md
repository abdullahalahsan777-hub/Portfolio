# Claude Code Developer Guide — Portfolio Studio CMS

> Multi-Theme Developer & Designer Portfolio CMS (Laravel 12.x / PHP 8.2+ / Tailwind CSS v4 / Flowbite / Vite 7)

## Core Architectural Rules
1. **Zero Hardcoded Data**: Never hardcode portfolio projects, blog posts, services, or testimonials in Blade templates. All data must be fetched dynamically via Eloquent.
2. **Server Port Authority**: Port is governed strictly by `SERVER_PORT` in `.env` (default: 8044). Never hardcode port 8000 or custom ports.
3. **Multi-Theme Standardization**: All 7 frontend themes (`developer`, `uiux_designer`, `graphic_designer`, `app_developer`, `app_software_developer`, `digital_designer_illustrator`, `laravel_developer`) extend `frontend.layouts.frontend`.
4. **Theme-Scoped Sort Ordering**: Use `AutoSortOrderById` trait for automated sequential sort order per theme. Never re-introduce manual sort inputs in create/edit forms.
5. **Tailwind CSS v4 & Flowbite**: Use `@import "tailwindcss";` in `resources/css/app.css`. Flowbite components must support dark mode. Datepickers must format as `YYYY-MM-DD`.
6. **Material Palette**: 9 dynamic accent colors with CSS variables `--theme-primary`, `--theme-primary-glow`, and `--theme-on-primary` (calculated via YIQ formula).

## Essential Commands

```bash
# Development Launch
./dev.sh            # Linux / macOS / Git Bash
dev.bat             # Windows

# Asset Compilation
npm run dev         # Hot module replacement
npm run build       # Production compilation

# Artisan Operations
php artisan serve   # Runs on SERVER_PORT from .env
php artisan test    # Execute PHPUnit test suite
php artisan optimize:clear # Clear all caches (config, route, view)
php artisan migrate # Run database migrations
```

## AI Agent & Skills Knowledge Base
All canonical skills and personas are located in `.agents/`:
- `.agents/agents-manifest.json` — Machine-readable registry
- `.agents/skills/` — Technology and domain-specific rulebooks
- `.agents/personas/` — Architectural and design personas
