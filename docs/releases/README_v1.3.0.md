# Portfolio Studio — Version v1.3.0

> **Current Stable Production Release**  
> Theme-Scoped Sort Ordering Engine, Interactive Drag-and-Drop Reordering, Flowbite Dark UI Suite, and Native GitHub Auto-Sync & Self-Healing Merge.

[![Version](https://img.shields.io/badge/Version-v1.3.0-00e5ff?style=flat-square&logo=git&logoColor=black)](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.3.0)
[![Status](https://img.shields.io/badge/Status-Active_Latest-emerald?style=flat-square)](https://github.com/abdullahalahsan777-hub/Portfolio)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)

---

## Release Overview

| Attribute | Specification |
| :--- | :--- |
| **Version Tag** | `v1.3.0` |
| **Release Name** | Theme-Scoped Sort Ordering Engine, Flowbite Dark UI & Universal Multi-Agent Intelligence System |
| **Release Date** | November 10, 2026 |
| **Commit Target** | Official Release Tag & HEAD |
| **Software Status** | **Current Active Version** (Universal Latest Release) |
| **Automatic Update Support** | **Built-in Self-Healing GitHub Synchronization Engine** |

---

## What's New in Version v1.3.0

### 1. Theme-Scoped Sort Order Sequencing
- Independent `1..N` sort order sequencing across all 9 Website modules (**Services**, **Projects**, **Galleries**, **Skills**, **Resume Items**, **Pricing**, **Testimonials**, **Blog**, **FAQs**).
- Prevents cross-theme ordering collisions so reordering in one theme does not alter the sequencing in another theme.

### 2. AutoSortOrderById Trait
- Model creation automatically assigns the next sequential integer order based on `theme` (and `type` for resume items).
- Removed redundant manual order number input fields from all Create and Edit forms across the admin panel.

### 3. SortableJS Drag-and-Drop Reordering
- Interactive drag handles with real-time UI badge updates (`#1`, `#2`, `#3`, ...).
- Asynchronous AJAX reorder transactions saving changes instantly to the database without page reload.

### 4. Flowbite Dark UI Suite & Native Datepicker
- Integrated Flowbite Tailwind dark components.
- Auto-hiding datepicker with standard ISO `YYYY-MM-DD` formatting and custom SVG calendar trigger icons.

### 5. Zero Static Data Enforcement
- 100% elimination of hardcoded array fallbacks across all frontend themes and admin modules.
- All portfolio items, blogs, skills, and profile details are dynamically queried and served directly from MySQL.

### 6. Automated GitHub Sync & Self-Healing Update System
- Live GitHub remote synchronization comparing local HEAD against `origin/main`.
- Interactive **"What's New in this Update"** popup modal with commit history and release highlights.
- Conflict-free Git merge (`-X theirs`) prioritizing official remote updates without lockouts.
- Automatic database migrations execution (`php artisan migrate --force`).
- Deep cache purge and optimization (`optimize:clear`, `view:clear`, `cache:clear`).

### 7. Universal AI Multi-Agent & Skills Intelligence System
- **Supported AI Coding Agents**: Native, interoperable configuration files for all major AI coding platforms:
  - **Gemini / Antigravity**: [`GEMINI.md`](../../GEMINI.md) and [`.gemini/config.json`](../../.gemini/config.json)
  - **Claude Code**: [`CLAUDE.md`](../../CLAUDE.md) and [`.claude/settings.json`](../../.claude/settings.json)
  - **Cursor**: [`.cursorrules`](../../.cursorrules) and [`.cursor/rules/*.mdc`](../../.cursor/rules/)
  - **Windsurf / Windframe**: [`.windsurfrules`](../../.windsurfrules) and [`.windsurf/rules/project-rules.md`](../../.windsurf/rules/project-rules.md)
  - **ChatGPT / GitHub Copilot**: [`.github/copilot-instructions.md`](../../.github/copilot-instructions.md) and [`chatgpt-instructions.md`](../../chatgpt-instructions.md)
  - **Devin**: [`devin.json`](../../devin.json) and [`.devin/instructions.md`](../../.devin/instructions.md)
  - **Goose / Codex**: [`.goosehints`](../../.goosehints) and [`.codex/instructions.md`](../../.codex/instructions.md)
- **10 Core Engineering Skills** ([`.agents/skills/`](../../.agents/skills/)):
  1. `laravel-php8.md`: Laravel 11/12+ & PHP 8.3+ architecture, `AutoSortOrderById`, FormRequests.
  2. `tailwind-flowbite.md`: Tailwind CSS v4 `@import "tailwindcss";`, Flowbite dark mode, ISO `YYYY-MM-DD` datepicker.
  3. `material-ui-ux.md`: Material 3 dynamic palette (9 accents), YIQ contrast formula, zero-FOUC head execution.
  4. `alpinejs-reactive.md`: Alpine.js micro-interactions, modal management, transition lifecycle.
  5. `jquery-datatables-sortable.md`: SortableJS drag-and-drop table reordering, jQuery DataTables, Toastr notifications.
  6. `nodejs-vite-pipeline.md`: Node.js & Vite 7 build pipeline, `@tailwindcss/vite`, bundle optimization.
  7. `angularjs-slider.md`: AngularJS dynamic hero slider bridge and framework coexistence.
  8. `react-phosphor-icons.md`: Phosphor icons and inline SVG vector assets.
  9. `conversation-inquiry.md`: Gmail-style mailbox, client inquiry engine, draft autosaving with UUID `temp_id`.
  10. `post-deploy-verification.md`: Automated test suites and release verification checklist.
- **4 Architectural Personas** ([`.agents/personas/`](../../.agents/personas/)):
  - `lead-fullstack-architect.md`: Architecture integrity, zero hardcoded data, security-by-design.
  - `modern-ui-ux-designer.md`: Awwwards-caliber aesthetics, dark luxury, micro-glows, glassmorphism.
  - `qa-deploy-engineer.md`: 100% green tests, asset manifest verification, self-healing updates.
  - `context-inference-expert.md`: Deep repository pattern reconstruction, single source of truth, anti-regression guards.
- **Unified Machine-Readable Registry**: [`.agents/agents-manifest.json`](../../.agents/agents-manifest.json).

---

## Server Port Configuration

The server port is configured **exclusively via `SERVER_PORT` in your `.env` file**:

```env
SERVER_PORT=8044
APP_URL=http://127.0.0.1:8044
```

Whenever `SERVER_PORT` is changed in `.env`, the entire application automatically adopts that port across:
- `php artisan serve` (auto-defaults to `SERVER_PORT` from `.env`)
- `dev.sh` / `dev.bat` launcher scripts
- OAuth redirect callbacks (Google & Facebook)
- Admin layout telemetry and Live Site navigation

---

## Launch the Application

```bash
# Option 1: Using automated dev script
./dev.sh         # Linux / macOS / Git Bash
dev.bat          # Windows Command Prompt / PowerShell

# Option 2: Using Composer
composer run dev

# Option 3: Direct Artisan serve
php artisan serve
```

---

## Keeping Software Updated

To update this software at any time:
1. Navigate to **Admin Dashboard**, **System Maintenance**, or **Version Control** (`/admin/versions`).
2. Click **Update Software Now** / **Check GitHub**.
3. Inspect the **"What's New in this Update"** popup modal.
4. Click **Confirm & Update Now** to automatically merge the latest GitHub release.

