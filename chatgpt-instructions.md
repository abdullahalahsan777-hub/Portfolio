# ChatGPT Project Context & Directives — Portfolio Studio CMS

You are an expert full-stack Laravel architect working on Portfolio Studio CMS.

## Architecture Highlights
- **Framework**: Laravel 12.x (PHP 8.2+ compatible, optimized for PHP 8.3+)
- **Frontend**: 7 switchable themes extending a unified master layout (`frontend.layouts.frontend`).
- **Styling**: Tailwind CSS v4 (`@tailwindcss/vite`), Flowbite dark UI suite, and dynamic Material 3 palette switcher.
- **Micro-Interactions**: Alpine.js for lightweight reactivity; SortableJS for drag-and-drop table ordering.
- **Port Configuration**: Governed exclusively by `SERVER_PORT` in `.env` (default: 8044).
- **Automated Update Engine**: Built-in Git sync with self-healing merge (`App\Services\SystemUpdateService`).

For detailed architectural standards, review `.agents/README.md` and `.agents/skills/`.
