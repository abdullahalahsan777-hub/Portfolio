# Windsurf Cascade Project Architecture Rules

## Stack Profile
- **Backend**: Laravel 12.x / PHP 8.2+ / MySQL 8.0+ / SQLite 3
- **Frontend**: Tailwind CSS v4, Flowbite Dark Suite, SortableJS, Alpine.js, AngularJS Slider
- **Asset Engine**: Vite 7 (`@tailwindcss/vite`, `laravel-vite-plugin`)

## Operational Guidelines
- Before editing models or controllers, inspect `.agents/skills/laravel-php8.md`.
- Before styling components, review `.agents/skills/tailwind-flowbite.md` and `.agents/skills/material-ui-ux.md`.
- Verify all changes with `php artisan test` and `npm run build`.
- When creating migrations, always ensure rollback `down()` methods are properly defined.
