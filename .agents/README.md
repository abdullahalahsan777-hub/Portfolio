# Portfolio Studio — AI Agent Architecture & Skills Engine

Welcome to the **Multi-Agent Developer Intelligence System** for the Portfolio Multi-Theme CMS repository.

This directory (`.agents/`) contains universal rulebooks, skills, and personas designed to guide AI coding assistants, autonomous agents, and human developers to build, test, and maintain this codebase with maximum quality, zero regressions, and strict adherence to architectural standards.

---

## Supported AI Agents

The configurations in this project bridge seamlessly across all major AI development tools:

| Agent / Tool | Config File(s) | Description |
| :--- | :--- | :--- |
| **Google Gemini / Antigravity** | [`GEMINI.md`](../GEMINI.md), [`.gemini/config.json`](../.gemini/config.json) | High-throughput reasoning & agentic execution via Google Antigravity & Gemini CLI. |
| **Anthropic Claude Code** | [`CLAUDE.md`](../CLAUDE.md), [`.claude/settings.json`](../.claude/settings.json) | Deep reasoning, automated terminal command execution, and codebase auditing. |
| **Cursor IDE** | [`.cursorrules`](../.cursorrules), [`.cursor/rules/*.mdc`](../.cursor/rules/) | Context-aware inline autocomplete, chat, composer, and semantic glob rules. |
| **Windsurf / Windframe** | [`.windsurfrules`](../.windsurfrules), [`.windsurf/rules/`](../.windsurf/rules/) | Codeium Cascade multi-file agent execution with directory scope boundaries. |
| **OpenAI ChatGPT / GitHub Copilot** | [`.github/copilot-instructions.md`](../.github/copilot-instructions.md), [`chatgpt-instructions.md`](../chatgpt-instructions.md) | GPT-4o / o1 / Copilot Chat architectural system instructions. |
| **Cognition Devin** | [`devin.json`](../devin.json), [`.devin/instructions.md`](../.devin/instructions.md) | Autonomous software engineer runbook, validation gates, and build pipelines. |
| **Block Goose / Codex CLI** | [`.goosehints`](../.goosehints), [`.codex/instructions.md`](../.codex/instructions.md) | Extensible developer agent context hints and command execution instructions. |

---

## Directory Organization

```
.agents/
├── README.md                           # This guide
├── agents-manifest.json                # Machine-readable registry of skills and personas
├── personas/                           # Specialized engineering role behaviors
│   ├── lead-fullstack-architect.md     # System design, zero-static data policy, DRY & security
│   ├── modern-ui-ux-designer.md        # Awwwards aesthetics, micro-interactions, dark mode elegance
│   ├── qa-deploy-engineer.md           # Automated testing, self-healing updates, Git version matrix
│   └── context-inference-expert.md     # Anti-regression, historical decision adherence, zero-assumption
└── skills/                             # Technology-specific implementation standards
    ├── laravel-php8.md                 # Laravel 11/12+ & PHP 8.3+ architectural rules
    ├── tailwind-flowbite.md            # Tailwind CSS v4 & Flowbite Dark UI suite
    ├── material-ui-ux.md               # Material 3 dynamic palette & contrast system
    ├── alpinejs-reactive.md            # Alpine.js state & reactive micro-components
    ├── jquery-datatables-sortable.md   # jQuery, DataTables & SortableJS drag-and-drop
    ├── nodejs-vite-pipeline.md         # Node.js & Vite 7 build pipeline
    ├── angularjs-slider.md             # AngularJS dynamic slider & legacy framework bridge
    ├── react-phosphor-icons.md         # Phosphor web icons & SVG design system
    ├── conversation-inquiry.md         # Inquiry mailbox, UUID draft autosave, messaging
    └── post-deploy-verification.md     # Automated verification, test commands, deployment checklist
```

---

## Core Project Tenets (Every Agent MUST Obey)

1. **Zero Hardcoded Static Data**: All portfolio content (projects, blogs, services, resume items, pricing, FAQs, testimonials) MUST be queried dynamically from MySQL/SQLite via Eloquent. Hardcoded arrays in Blade views are strictly prohibited.
2. **Theme-Scoped Isolation**: Sort order (`sort_order`) and content queries must be scoped to the active `theme` (and `type` where applicable) using the `AutoSortOrderById` trait. Never alter sequencing across themes.
3. **Unified Frontend Layout**: All 7 frontend themes (`developer`, `uiux_designer`, `graphic_designer`, `app_developer`, `app_software_developer`, `digital_designer_illustrator`, `laravel_developer`) MUST extend `frontend.layouts.frontend`.
4. **Dynamic Material Palette**: Every accent color is governed dynamically by `--theme-primary`, `--theme-primary-glow`, and calculated contrast `--theme-on-primary`.
5. **Port Governance**: The server port is strictly governed by `SERVER_PORT` in `.env` (default: 8044). Never hardcode port 8000.
6. **Strict Verification**: After every change, execute:
   ```bash
   npm run build && php artisan view:clear && php artisan test
   ```
