# Devin Autonomous Agent Runbook — Portfolio Studio CMS

## Setup & Verification
1. Ensure dependencies are installed: `composer install` and `npm install`.
2. Compile frontend assets: `npm run build`.
3. Verify tests: `php artisan test`.
4. Ensure `.env` contains valid `APP_KEY` and `SERVER_PORT=8044`.

## Core Invariants
- Never commit hardcoded mock data into Blade templates. All data must be fetched via Eloquent.
- Maintain theme-scoped sorting via `AutoSortOrderById`.
- Ensure all 7 frontend themes inherit `frontend.layouts.frontend`.
- Consult `.agents/agents-manifest.json` for skills and architectural guides.
