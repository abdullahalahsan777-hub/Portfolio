# Skill: Post-Deploy Test Suite & Verification Checklist

## Context & Overview
Every AI Agent and developer working on this codebase MUST run the post-deploy verification suite before committing or completing tasks. This ensures code quality, prevents regressions, and validates application stability.

---

## 1. Core Verification Command
Execute this combined pipeline in terminal:
```bash
npm run build && php artisan view:clear && php artisan test
```

### Breakdown of Steps:
1. `npm run build`: Bundles CSS and JS through Vite. Catches Tailwind syntax errors, missing asset imports, or JS syntax issues.
2. `php artisan view:clear`: Clears pre-compiled Blade templates to force compilation of updated views.
3. `php artisan test`: Executes PHPUnit test suite. All tests must pass (100% green).

---

## 2. Extended Health Checks
When making database, routing, or architectural modifications:
```bash
# 1. Clear all cached states
php artisan optimize:clear

# 2. Verify migrations status
php artisan migrate:status

# 3. Code formatting & linting
composer run lint

# 4. Check route registrations
php artisan route:list --compact
```

---

## 3. Automated Self-Healing Git Verification
In this project, Git release tags are synchronized with `/admin/versions`:
- Ensure Git status is clean (`git status`).
- Check that `resources/views/frontend/layouts/frontend.blade.php` is intact.
- Verify that all 7 themes render cleanly without duplicate `<head>` or `<body>` tags.
- Test port configuration from `.env` (`SERVER_PORT`).
