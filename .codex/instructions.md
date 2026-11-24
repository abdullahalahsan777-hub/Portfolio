# Codex Developer Instructions — Portfolio Studio CMS

## Project Overview
Portfolio Studio CMS is a modern multi-theme portfolio application developed with Laravel 12.x, PHP 8.2+, Tailwind CSS v4, Flowbite, and Vite 7.

## Rules & Constraints
1. **Dynamic Content Enforcement**: Zero static data in Blade views; all models are queried dynamically.
2. **Server Port Authority**: Port is governed strictly by `SERVER_PORT` in `.env`.
3. **Sort Ordering**: Automatic sequential ordering via `AutoSortOrderById` trait.
4. **Theme Architecture**: All 7 themes extend `frontend.layouts.frontend`.
5. **Quality Gate**: Execute `php artisan test` and `npm run build` after changes.

For full skills and personas, inspect `.agents/README.md` and `.agents/agents-manifest.json`.
