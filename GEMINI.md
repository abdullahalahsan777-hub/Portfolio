# Gemini & Antigravity Agent Guide — Portfolio Studio CMS

> System context and operational directives for Google DeepMind Gemini models and Antigravity agents.

## Project DNA
- **Framework**: Laravel 12.x / PHP 8.2+ (PHP 8.3+ strictly compatible)
- **Frontend**: Tailwind CSS v4, Flowbite Dark Suite, SortableJS, Alpine.js, AngularJS Slider, Material 3 dynamic palette
- **Build**: Vite 7 (`@tailwindcss/vite`, `laravel-vite-plugin`)
- **Themes**: 7 standardized themes under `resources/views/frontend/themes/`

## High-Priority Guardrails
- **No Static Data**: All frontend content must originate from database queries passed by controllers or view composers.
- **Port Authority**: Server port is governed strictly by `SERVER_PORT` in `.env`. Never use port 8000 as a static fallback.
- **Sequential Ordering**: Sort ordering is managed automatically by `AutoSortOrderById` trait and scoped per theme. Reordering uses SortableJS AJAX transactions.
- **Testing Standard**: Every feature or fix must pass `php artisan test` and `npm run build` cleanly.
- **Windows Command Safety**: On Windows PowerShell, avoid raw `&&` chains; execute commands via `cmd /c "command1 && command2"` or chain with `;`.

## Agent Skills Reference
Canonical agent documentation is in `.agents/`:
- `.agents/skills/laravel-php8.md` — Eloquent, FormRequests, strict typing
- `.agents/skills/tailwind-flowbite.md` — Tailwind v4, Flowbite dark UI
- `.agents/skills/material-ui-ux.md` — 9-color Material palette, contrast calculation
- `.agents/skills/alpinejs-reactive.md` — Micro-interactions, modal management
- `.agents/skills/jquery-datatables-sortable.md` — Drag-and-drop sequencing
- `.agents/skills/nodejs-vite-pipeline.md` — Vite 7 build optimization
- `.agents/skills/angularjs-slider.md` — AngularJS hero slider framework bridge
- `.agents/skills/conversation-inquiry.md` — Client communications mailbox
- `.agents/skills/post-deploy-verification.md` — Pre/post-deploy verification
- `.agents/personas/` — Lead Architect, UI/UX Designer, QA Engineer, Context Inference
