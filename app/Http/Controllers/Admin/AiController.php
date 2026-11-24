<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class AiController extends Controller
{
    /**
     * Display the AI Agents & AI Skills Intelligence Center.
     */
    public function index(): View
    {
        $manifestPath = base_path('.agents/agents-manifest.json');
        $manifest = [];
        if (File::exists($manifestPath)) {
            $manifest = json_decode(File::get($manifestPath), true) ?? [];
        }

        $agents = $this->getAgentsData();
        $skills = $this->getSkillsData();
        $personas = $this->getPersonasData();

        $systemMetrics = [
            'total_agents' => count($agents),
            'total_skills' => count($skills),
            'total_personas' => count($personas),
            'manifest_version' => $manifest['version'] ?? '1.3.0',
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'server_port' => env('SERVER_PORT', 8044),
            'environment' => app()->environment(),
        ];

        return view('admin.ai.index', compact('manifest', 'agents', 'skills', 'personas', 'systemMetrics'));
    }

    /**
     * Fetch raw content of an AI config or skill file for live preview.
     */
    public function preview(Request $request): JsonResponse
    {
        $path = (string) $request->input('path', '');
        if (empty($path)) {
            return response()->json(['error' => 'Path is required.'], 400);
        }

        // Whitelist allowed base directories/files to prevent directory traversal
        $allowedPrefixes = ['.agents/', '.claude/', '.gemini/', '.cursor/', '.windsurf/', '.github/', '.devin/', '.codex/'];
        $allowedFiles = ['CLAUDE.md', 'GEMINI.md', '.cursorrules', '.windsurfrules', 'chatgpt-instructions.md', 'devin.json', '.goosehints'];

        $cleanPath = ltrim(str_replace(['\\', '..'], ['/', ''], $path), '/');

        $isAllowed = in_array($cleanPath, $allowedFiles, true);
        if (! $isAllowed) {
            foreach ($allowedPrefixes as $prefix) {
                if (str_starts_with($cleanPath, $prefix)) {
                    $isAllowed = true;
                    break;
                }
            }
        }

        if (! $isAllowed) {
            return response()->json(['error' => 'Unauthorized file access.'], 403);
        }

        $fullPath = base_path($cleanPath);
        if (! File::exists($fullPath)) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        return response()->json([
            'path' => $cleanPath,
            'filename' => basename($cleanPath),
            'content' => File::get($fullPath),
            'size' => File::size($fullPath),
            'last_modified' => date('Y-m-d H:i:s', File::lastModified($fullPath)),
        ]);
    }

    /**
     * Structured data for the 7 supported AI coding platforms.
     */
    protected function getAgentsData(): array
    {
        return [
            [
                'id' => 'gemini',
                'name' => 'Google Gemini / Antigravity',
                'vendor' => 'Google DeepMind',
                'config_file' => 'GEMINI.md',
                'rules_dir' => '.gemini/config.json',
                'badge' => 'Primary Engine',
                'color' => 'cyan',
                'accent_hex' => '#06b6d4',
                'role' => 'High-throughput reasoning, full-stack architectural synthesis, shell automation.',
                'capabilities' => ['Deep Reasoning', 'Full-Stack Architecture', 'Shell Automation', 'Multi-Theme Scoping'],
                'description' => 'Configured specifically for Google Antigravity & Gemini CLI. Enforces zero static mock data, server port authority, and sequential theme-scoped ordering.',
            ],
            [
                'id' => 'claude',
                'name' => 'Anthropic Claude Code',
                'vendor' => 'Anthropic',
                'config_file' => 'CLAUDE.md',
                'rules_dir' => '.claude/settings.json',
                'badge' => 'CLI Specialist',
                'color' => 'amber',
                'accent_hex' => '#f59e0b',
                'role' => 'Autonomous CLI coding, context-aware refactoring, and command execution.',
                'capabilities' => ['Autonomous Coding', 'Test Execution', 'Refactoring', 'Strict Typing'],
                'description' => 'Claude Code agent with predefined terminal permissions, preferred cmd shell, and direct mapping to the canonical skills manifest.',
            ],
            [
                'id' => 'cursor',
                'name' => 'Cursor IDE (MDC)',
                'vendor' => 'Anysphere',
                'config_file' => '.cursorrules',
                'rules_dir' => '.cursor/rules/*.mdc',
                'badge' => 'IDE Native',
                'color' => 'indigo',
                'accent_hex' => '#6366f1',
                'role' => 'Context-aware inline autocomplete, Composer agentic edits, and semantic glob rules.',
                'capabilities' => ['MDC File Rules', 'Composer Multi-File', 'Inline Autocomplete', 'Glob Matching'],
                'description' => 'Contains 8 specialized `.cursor/rules/*.mdc` rulebooks covering Laravel, Tailwind/Flowbite, Material 3, Alpine/jQuery, Angular Slider, Vite, Inquiry Mailbox, and QA.',
            ],
            [
                'id' => 'windsurf',
                'name' => 'Windsurf & Windframe',
                'vendor' => 'Codeium',
                'config_file' => '.windsurfrules',
                'rules_dir' => '.windsurf/rules/project-rules.md',
                'badge' => 'Cascade Engine',
                'color' => 'teal',
                'accent_hex' => '#14b8a6',
                'role' => 'Codeium Cascade flow, multi-file code generation, and reactive debugging.',
                'capabilities' => ['Cascade Flow', 'Multi-File Editing', 'Context Awareness', 'Dark UI Styling'],
                'description' => 'Cascade engine guidelines enforcing dynamic Eloquent retrieval, single layout inheritance, and zero cross-theme ordering collisions.',
            ],
            [
                'id' => 'chatgpt-copilot',
                'name' => 'ChatGPT & GitHub Copilot',
                'vendor' => 'OpenAI & Microsoft',
                'config_file' => '.github/copilot-instructions.md',
                'rules_dir' => 'chatgpt-instructions.md',
                'badge' => 'Workspace Guide',
                'color' => 'emerald',
                'accent_hex' => '#10b981',
                'role' => 'Architectural instructions, unit test generation, code explanation, and PR review.',
                'capabilities' => ['Architectural Rules', 'PR Review', 'Unit Testing', 'Doc Synthesis'],
                'description' => 'Dual configuration serving GitHub Copilot Workspace and ChatGPT Custom GPTs with comprehensive project constraints and guidelines.',
            ],
            [
                'id' => 'devin',
                'name' => 'Cognition Devin',
                'vendor' => 'Cognition AI',
                'config_file' => 'devin.json',
                'rules_dir' => '.devin/instructions.md',
                'badge' => 'Autonomous Agent',
                'color' => 'purple',
                'accent_hex' => '#a855f7',
                'role' => 'End-to-end autonomous ticket execution, sandbox validation, and PR verification.',
                'capabilities' => ['Full Sandbox', 'Automated Verification', 'Build Validation', 'PR Generation'],
                'description' => 'Complete Devin execution runbook with environment setup steps, test verification pipelines, and architecture invariants.',
            ],
            [
                'id' => 'goose-codex',
                'name' => 'Block Goose & Codex CLI',
                'vendor' => 'Block & OpenAI',
                'config_file' => '.goosehints',
                'rules_dir' => '.codex/instructions.md',
                'badge' => 'Shell Agent',
                'color' => 'rose',
                'accent_hex' => '#f43f5e',
                'role' => 'Terminal tool calling, command automation, and agentic toolkit execution.',
                'capabilities' => ['CLI Tool Calling', 'Command Scripting', 'Cache Optimization', 'Toolkits'],
                'description' => 'Extensible developer hints and command execution guidelines for Goose CLI and OpenAI Codex agentic developer tools.',
            ],
        ];
    }

    /**
     * Structured data for the 10 AI Engineering Skills.
     */
    protected function getSkillsData(): array
    {
        return [
            [
                'id' => 'laravel-php8',
                'title' => 'Laravel 11+ & PHP 8.3+ Architecture',
                'category' => 'Backend Architecture',
                'file' => '.agents/skills/laravel-php8.md',
                'globs' => 'app/**/*.php, routes/**/*.php, config/**/*.php, database/**/*.php',
                'summary' => 'Strict typing, constructor property promotion, FormRequest validation, AutoSortOrderById trait, zero static fallback arrays, and CSRF protection.',
            ],
            [
                'id' => 'tailwind-flowbite',
                'title' => 'Tailwind CSS v4 & Flowbite Dark UI Suite',
                'category' => 'Frontend & Styling',
                'file' => '.agents/skills/tailwind-flowbite.md',
                'globs' => 'resources/css/**/*.css, resources/views/**/*.blade.php',
                'summary' => 'Tailwind v4 @import "tailwindcss"; setup, Flowbite dark mode components, and standard ISO YYYY-MM-DD autohiding datepickers.',
            ],
            [
                'id' => 'material-ui-ux',
                'title' => 'Material 3 Dynamic Palette & Contrast System',
                'category' => 'Theme & Design Tokens',
                'file' => '.agents/skills/material-ui-ux.md',
                'globs' => 'resources/css/frontend/material_palette_accents.css, resources/views/frontend/partials/palette-switcher.blade.php',
                'summary' => '9-color dynamic accent palette, CSS variables (--theme-primary, --theme-primary-glow, --theme-on-primary), and mathematical YIQ contrast computation.',
            ],
            [
                'id' => 'alpinejs-reactive',
                'title' => 'Alpine.js State & Micro-Interactions',
                'category' => 'Reactivity & Micro-UI',
                'file' => '.agents/skills/alpinejs-reactive.md',
                'globs' => 'resources/views/**/*.blade.php, resources/js/**/*.js',
                'summary' => 'Declarative micro-interactions, x-data state stores, modal managers, transition lifecycles, and zero-FOUC x-cloak directives.',
            ],
            [
                'id' => 'jquery-datatables-sortable',
                'title' => 'jQuery, DataTables & SortableJS Reordering',
                'category' => 'Data Tables & Drag-and-Drop',
                'file' => '.agents/skills/jquery-datatables-sortable.md',
                'globs' => 'resources/views/admin/**/*.blade.php, public/assets/**/*.js',
                'summary' => 'SortableJS drag-and-drop table sequencing, real-time badge updates (#1, #2), AJAX reorder transactions with CSRF tokens, and Toastr feedback.',
            ],
            [
                'id' => 'nodejs-vite-pipeline',
                'title' => 'Node.js & Vite 7 Build Pipeline',
                'category' => 'Asset Tooling & Bundling',
                'file' => '.agents/skills/nodejs-vite-pipeline.md',
                'globs' => 'vite.config.js, package.json, resources/js/**/*.js, resources/css/**/*.css',
                'summary' => 'Vite 7 build optimization, @tailwindcss/vite compiler, manifest verification, and cache busting.',
            ],
            [
                'id' => 'angularjs-slider',
                'title' => 'AngularJS Dynamic Hero Slider Bridge',
                'category' => 'Legacy Framework Bridge',
                'file' => '.agents/skills/angularjs-slider.md',
                'globs' => 'resources/views/frontend/themes/laravel_developer/**/*.blade.php',
                'summary' => 'Dynamic hero slider bridge in laravel_developer theme, isolated ng-app scope, and zero conflict with Alpine.js or Vite bundles.',
            ],
            [
                'id' => 'react-phosphor-icons',
                'title' => 'React & Phosphor Iconography Systems',
                'category' => 'Icons & Visual Assets',
                'file' => '.agents/skills/react-phosphor-icons.md',
                'globs' => 'resources/views/**/*.blade.php',
                'summary' => 'Modern icon system supporting Phosphor web font classes (<i class="ph-...">) and responsive inline SVG vector assets.',
            ],
            [
                'id' => 'conversation-inquiry',
                'title' => 'Conversation, Mailbox & Inquiry Subsystem',
                'category' => 'Communications Engine',
                'file' => '.agents/skills/conversation-inquiry.md',
                'globs' => 'app/Http/Controllers/Admin/MessageController.php, resources/views/admin/messages/**/*.blade.php',
                'summary' => 'Gmail-style dark mode mailbox, folder filtering (Inbox, Sent, Drafts, Important, Trash), background draft autosave with UUID temp_id, and VIP badges.',
            ],
            [
                'id' => 'post-deploy-verification',
                'title' => 'Post-Deploy Test Suite & Verification Checklist',
                'category' => 'QA & Production Release',
                'file' => '.agents/skills/post-deploy-verification.md',
                'globs' => 'tests/**/*.php, phpunit.xml',
                'summary' => 'Automated test suite (php artisan test), view cache compilation checks, self-healing merge verification, and release tag synchronization.',
            ],
        ];
    }

    /**
     * Structured data for the 4 Architectural Personas.
     */
    protected function getPersonasData(): array
    {
        return [
            [
                'id' => 'lead-fullstack-architect',
                'title' => 'Lead Full-Stack Architect',
                'file' => '.agents/personas/lead-fullstack-architect.md',
                'role' => 'System Design, Architecture Integrity, Security & Reliability',
                'summary' => 'Enforces zero static mock data, strict Eloquent query optimization, CSRF protection, and multi-theme layout inheritance under frontend.layouts.frontend.',
            ],
            [
                'id' => 'modern-ui-ux-designer',
                'title' => 'Modern UI/UX Designer',
                'file' => '.agents/personas/modern-ui-ux-designer.md',
                'role' => 'Awwwards-Grade Visuals, Luxury Dark Mode, Micro-Glows & Motion',
                'summary' => 'Champions luxury dark obsidian aesthetics, subtle primary glows, fluid typography, glassmorphism card surfaces, and seamless transitions.',
            ],
            [
                'id' => 'qa-deploy-engineer',
                'title' => 'QA & Deploy Engineer',
                'file' => '.agents/personas/qa-deploy-engineer.md',
                'role' => 'Zero-Regression Testing, Asset Manifests & Self-Healing Deploy',
                'summary' => 'Guarantees 100% green test passes, validates Vite build manifests, verifies zero uncaught runtime/browser errors, and protects update pipelines.',
            ],
            [
                'id' => 'context-inference-expert',
                'title' => 'Context Inference Expert',
                'file' => '.agents/personas/context-inference-expert.md',
                'role' => 'Codebase Reconstruction, Anti-Regression & Design Intent',
                'summary' => 'Analyzes existing codebase conventions and commit history before making edits, preserving architectural integrity with zero blind assumptions.',
            ],
        ];
    }
}
