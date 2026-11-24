@extends('admin.layout')

@section('title', 'AI Agents & Skills Intelligence Center')
@section('page_title', 'AI Agents & Skills')
@section('page_subtitle', 'Superadmin Developer Intelligence Hub')

@section('content')
<div x-data="{
    activeTab: 'agents',
    previewModal: false,
    previewTitle: '',
    previewPath: '',
    previewContent: '',
    previewLoading: false,
    previewToken: 0,
    loadPreview(filePath, title) {
        if (!filePath) return;
        const currentToken = ++this.previewToken;
        this.previewTitle = title || filePath;
        this.previewPath = filePath;
        this.previewLoading = true;
        this.previewModal = true;
        this.previewContent = 'Loading rule content...';

        const previewUrl = '{{ route('admin.ai.agent.preview', [], false) }}?path=' + encodeURIComponent(filePath);

        fetch(previewUrl, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => {
            if (!res.ok) {
                return res.json().catch(() => ({ error: `HTTP ${res.status}: ${res.statusText || 'Failed to load file.'}` }));
            }
            return res.json();
        })
        .then(data => {
            if (this.previewToken !== currentToken) {
                return;
            }
            this.previewLoading = false;
            if (data && typeof data.content === 'string') {
                this.previewContent = data.content;
            } else {
                this.previewContent = (data && typeof data.error === 'string') ? data.error : 'Failed to load file content.';
            }
        })
        .catch(err => {
            if (this.previewToken !== currentToken) {
                return;
            }
            this.previewLoading = false;
            this.previewContent = 'Network error loading preview: ' + err.message;
        });
    },
    copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            toastr.success('Rule contents copied to clipboard!');
        });
    }
}" class="space-y-6">

    <!-- 1. Superadmin Header Banner -->
    <div class="relative overflow-hidden p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-[#09101d] via-[#0d1627] to-[#071322] border border-cyan-500/20 shadow-2xl">
        <!-- Glow Orbs -->
        <div class="absolute -top-12 -right-12 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="space-y-3 max-w-3xl">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-cyan-500/20 to-indigo-500/20 text-cyan-400 flex items-center justify-center border border-cyan-500/30 shadow-lg shadow-cyan-500/10 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <h1 class="text-2xl font-black text-white tracking-tight">AI Agents &amp; Skills Intelligence Center</h1>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-mono font-bold bg-rose-500/15 text-rose-300 border border-rose-500/30 flex items-center gap-1.5 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-400 animate-ping"></span>
                                Superadmin Exclusive
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-mono font-bold bg-cyan-500/15 text-cyan-300 border border-cyan-500/30">
                                Manifest v{{ $systemMetrics['manifest_version'] }}
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-400 mt-1">
                            Universal Developer Intelligence System operating from canonical rulebooks under <code class="text-cyan-300 bg-cyan-950/40 px-1.5 py-0.5 rounded font-mono text-xs">.agents/</code>.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 flex-wrap">
                <button type="button" @click="loadPreview('.agents/agents-manifest.json', 'Manifest: agents-manifest.json')"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-mono font-bold bg-cyan-500/15 hover:bg-cyan-500/25 text-cyan-300 border border-cyan-500/30 transition-all shadow-sm cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Inspect Raw Manifest</span>
                </button>
                <button type="button" @click="loadPreview('.agents/README.md', 'Architecture Guide: .agents/README.md')"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-mono font-bold bg-white/5 hover:bg-white/10 text-white border border-white/10 transition-all shadow-sm cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>Architecture Guide</span>
                </button>
            </div>
        </div>
    </div>

    <!-- 2. System Intelligence Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Metric 1: AI Platforms -->
        <div class="p-5 rounded-2xl bg-[#09101d] border border-white/10 shadow-lg relative overflow-hidden group hover:border-cyan-500/30 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs font-mono font-bold text-slate-400 uppercase tracking-wider">AI Coding Agents</span>
                <span class="w-8 h-8 rounded-xl bg-cyan-500/15 text-cyan-400 flex items-center justify-center border border-cyan-500/20 font-bold text-xs">07</span>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-2xl font-black text-white font-mono">{{ $systemMetrics['total_agents'] }}</span>
                <span class="text-xs text-cyan-300 font-mono">Platforms Active</span>
            </div>
            <p class="text-[11px] text-slate-500 mt-1 truncate">Gemini, Claude, Cursor, Windsurf, Copilot, Devin, Goose</p>
        </div>

        <!-- Metric 2: Modular Skills -->
        <div class="p-5 rounded-2xl bg-[#09101d] border border-white/10 shadow-lg relative overflow-hidden group hover:border-indigo-500/30 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs font-mono font-bold text-slate-400 uppercase tracking-wider">Engineering Skills</span>
                <span class="w-8 h-8 rounded-xl bg-indigo-500/15 text-indigo-400 flex items-center justify-center border border-indigo-500/20 font-bold text-xs">10</span>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-2xl font-black text-white font-mono">{{ $systemMetrics['total_skills'] }}</span>
                <span class="text-xs text-indigo-300 font-mono">Rulebooks Standardized</span>
            </div>
            <p class="text-[11px] text-slate-500 mt-1 truncate">Laravel PHP 8.3+, Tailwind v4, Flowbite, Material 3, Alpine, Vite 7</p>
        </div>

        <!-- Metric 3: Personas -->
        <div class="p-5 rounded-2xl bg-[#09101d] border border-white/10 shadow-lg relative overflow-hidden group hover:border-purple-500/30 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs font-mono font-bold text-slate-400 uppercase tracking-wider">Architect Personas</span>
                <span class="w-8 h-8 rounded-xl bg-purple-500/15 text-purple-400 flex items-center justify-center border border-purple-500/20 font-bold text-xs">04</span>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-2xl font-black text-white font-mono">{{ $systemMetrics['total_personas'] }}</span>
                <span class="text-xs text-purple-300 font-mono">Strategic Roles</span>
            </div>
            <p class="text-[11px] text-slate-500 mt-1 truncate">Lead Architect, UI/UX Designer, QA Engineer, Context Inference</p>
        </div>

        <!-- Metric 4: Access Governance -->
        <div class="p-5 rounded-2xl bg-[#09101d] border border-white/10 shadow-lg relative overflow-hidden group hover:border-emerald-500/30 transition-all">
            <div class="flex items-center justify-between">
                <span class="text-xs font-mono font-bold text-slate-400 uppercase tracking-wider">SuperAdmin Guard</span>
                <span class="w-8 h-8 rounded-xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center border border-emerald-500/20 font-bold text-xs">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </span>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-base font-bold text-emerald-400 font-mono truncate">{{ auth()->user()->email }}</span>
            </div>
            <p class="text-[11px] text-emerald-300/80 mt-1 font-mono">Port Authority :{{ $systemMetrics['server_port'] }} &bull; Laravel {{ $systemMetrics['laravel_version'] }}</p>
        </div>
    </div>

    <!-- 3. Navigation Tabs -->
    <div class="flex items-center gap-2 p-1.5 rounded-2xl bg-[#0c1424] border border-white/10 w-fit overflow-x-auto max-w-full">
        <button type="button" @click="activeTab = 'agents'"
            :class="activeTab === 'agents' ? 'bg-cyan-600 text-white font-bold shadow-lg shadow-cyan-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5'"
            class="px-4 py-2 rounded-xl text-xs font-medium transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span>AI Coding Agents (7)</span>
        </button>

        <button type="button" @click="activeTab = 'skills'"
            :class="activeTab === 'skills' ? 'bg-indigo-600 text-white font-bold shadow-lg shadow-indigo-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5'"
            class="px-4 py-2 rounded-xl text-xs font-medium transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
            </svg>
            <span>Engineering Skills (10)</span>
        </button>

        <button type="button" @click="activeTab = 'personas'"
            :class="activeTab === 'personas' ? 'bg-purple-600 text-white font-bold shadow-lg shadow-purple-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5'"
            class="px-4 py-2 rounded-xl text-xs font-medium transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span>Architect Personas (4)</span>
        </button>

        <button type="button" @click="activeTab = 'manifest'"
            :class="activeTab === 'manifest' ? 'bg-emerald-600 text-white font-bold shadow-lg shadow-emerald-600/30' : 'text-slate-400 hover:text-white hover:bg-white/5'"
            class="px-4 py-2 rounded-xl text-xs font-medium transition-all flex items-center gap-2 whitespace-nowrap cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
            </svg>
            <span>Manifest &amp; Status</span>
        </button>
    </div>

    <!-- TAB 1: AI CODING AGENTS -->
    <div x-show="activeTab === 'agents'" x-cloak class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($agents as $agent)
            <div class="rounded-3xl bg-[#09101d] border border-white/10 hover:border-cyan-500/40 p-6 flex flex-col justify-between transition-all shadow-xl group">
                <div class="space-y-4">
                    <!-- Top header -->
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <span class="text-[10px] font-mono uppercase tracking-wider text-slate-400">{{ $agent['vendor'] }}</span>
                            <h3 class="text-base font-bold text-white group-hover:text-cyan-300 transition-colors mt-0.5">{{ $agent['name'] }}</h3>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-white/5 text-slate-300 border border-white/10 shrink-0">
                            {{ $agent['badge'] }}
                        </span>
                    </div>

                    <!-- Description & Role -->
                    <p class="text-xs text-slate-400 leading-relaxed">{{ $agent['description'] }}</p>

                    <!-- Key Configuration Paths -->
                    <div class="p-3 rounded-2xl bg-white/[0.02] border border-white/5 space-y-2 text-xs font-mono">
                        <div class="flex items-center justify-between text-slate-400">
                            <span class="text-[10px] uppercase text-slate-500">Root Config:</span>
                            <button type="button" @click="loadPreview('{{ $agent['config_file'] }}', 'Config: {{ $agent['config_file'] }}')"
                                class="text-cyan-400 hover:text-cyan-300 hover:underline flex items-center gap-1 cursor-pointer">
                                <span>{{ $agent['config_file'] }}</span>
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                            </button>
                        </div>
                        <div class="flex items-center justify-between text-slate-400">
                            <span class="text-[10px] uppercase text-slate-500">Rules Scope:</span>
                            <span class="text-slate-300 truncate max-w-[160px]">{{ $agent['rules_dir'] }}</span>
                        </div>
                    </div>

                    <!-- Capability Tags -->
                    <div class="flex flex-wrap gap-1.5 pt-1">
                        @foreach($agent['capabilities'] as $cap)
                        <span class="px-2 py-0.5 rounded-lg text-[10px] font-mono bg-white/5 text-slate-300 border border-white/5">
                            {{ $cap }}
                        </span>
                        @endforeach
                    </div>
                </div>

                <!-- Footer Action -->
                <div class="pt-5 mt-5 border-t border-white/5 flex items-center justify-between">
                    <span class="text-[10px] font-mono text-emerald-400 flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        Active &amp; Mapped
                    </span>
                    <button type="button" @click="loadPreview('{{ $agent['config_file'] }}', 'Inspect Rules: {{ $agent['name'] }}')"
                        class="px-3 py-1.5 rounded-xl text-xs font-mono font-bold bg-white/5 hover:bg-cyan-500/20 text-slate-300 hover:text-cyan-300 border border-white/10 hover:border-cyan-500/30 transition-all cursor-pointer">
                        Inspect Rules &rarr;
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- TAB 2: AI ENGINEERING SKILLS -->
    <div x-show="activeTab === 'skills'" x-cloak class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($skills as $skill)
            <div class="rounded-3xl bg-[#09101d] border border-white/10 hover:border-indigo-500/40 p-6 flex flex-col justify-between transition-all shadow-xl group">
                <div class="space-y-3">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-indigo-500/15 text-indigo-300 border border-indigo-500/30">
                                {{ $skill['category'] }}
                            </span>
                            <h3 class="text-base font-bold text-white group-hover:text-indigo-300 transition-colors mt-2">{{ $skill['title'] }}</h3>
                        </div>
                        <span class="text-[11px] font-mono text-slate-500">ID: {{ $skill['id'] }}</span>
                    </div>

                    <p class="text-xs text-slate-400 leading-relaxed">{{ $skill['summary'] }}</p>

                    <div class="p-3 rounded-2xl bg-white/[0.02] border border-white/5 space-y-1.5 font-mono text-xs">
                        <span class="text-[10px] uppercase text-slate-500 block">Target File Globs:</span>
                        <code class="text-indigo-300 text-[11px] block break-all">{{ $skill['globs'] }}</code>
                    </div>
                </div>

                <div class="pt-4 mt-4 border-t border-white/5 flex items-center justify-between">
                    <span class="text-[10px] font-mono text-slate-500 truncate max-w-[200px]">{{ $skill['file'] }}</span>
                    <button type="button" @click="loadPreview('{{ $skill['file'] }}', 'Skill: {{ $skill['title'] }}')"
                        class="px-3 py-1.5 rounded-xl text-xs font-mono font-bold bg-white/5 hover:bg-indigo-500/20 text-slate-300 hover:text-indigo-300 border border-white/10 hover:border-indigo-500/30 transition-all cursor-pointer">
                        View Rulebook &rarr;
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- TAB 3: ARCHITECTURAL PERSONAS -->
    <div x-show="activeTab === 'personas'" x-cloak class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @foreach($personas as $persona)
            <div class="rounded-3xl bg-[#09101d] border border-white/10 hover:border-purple-500/40 p-6 flex flex-col justify-between transition-all shadow-xl group">
                <div class="space-y-3">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-purple-500/15 text-purple-300 border border-purple-500/30">
                                Engineering Persona
                            </span>
                            <h3 class="text-base font-bold text-white group-hover:text-purple-300 transition-colors mt-2">{{ $persona['title'] }}</h3>
                        </div>
                        <span class="text-[11px] font-mono text-slate-500">ID: {{ $persona['id'] }}</span>
                    </div>

                    <div class="p-3 rounded-2xl bg-purple-500/[0.04] border border-purple-500/10">
                        <span class="text-[10px] font-mono uppercase text-purple-400 block font-bold">Strategic Mandate:</span>
                        <p class="text-xs text-slate-300 mt-1">{{ $persona['role'] }}</p>
                    </div>

                    <p class="text-xs text-slate-400 leading-relaxed">{{ $persona['summary'] }}</p>
                </div>

                <div class="pt-4 mt-4 border-t border-white/5 flex items-center justify-between">
                    <span class="text-[10px] font-mono text-slate-500">{{ $persona['file'] }}</span>
                    <button type="button" @click="loadPreview('{{ $persona['file'] }}', 'Persona: {{ $persona['title'] }}')"
                        class="px-3 py-1.5 rounded-xl text-xs font-mono font-bold bg-white/5 hover:bg-purple-500/20 text-slate-300 hover:text-purple-300 border border-white/10 hover:border-purple-500/30 transition-all cursor-pointer">
                        Read Persona Directives &rarr;
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- TAB 4: MANIFEST & STATUS -->
    <div x-show="activeTab === 'manifest'" x-cloak class="space-y-6">
        <div class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-white">agents-manifest.json Registry</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Machine-readable single source of truth for all coding agents and skills.</p>
                </div>
                <button type="button" @click="copyToClipboard(JSON.stringify(@js($manifest), null, 2))"
                    class="px-3 py-1.5 rounded-xl text-xs font-mono font-bold bg-white/5 hover:bg-emerald-500/20 text-slate-300 hover:text-emerald-300 border border-white/10 transition-all cursor-pointer">
                    Copy JSON Manifest
                </button>
            </div>

            <div class="p-4 rounded-2xl bg-[#060a12] border border-white/5 max-h-[500px] overflow-y-auto">
                <pre class="text-xs font-mono text-cyan-300 leading-relaxed"><code>{{ json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</code></pre>
            </div>
        </div>
    </div>

    <!-- LIVE FILE PREVIEW MODAL -->
    <div x-show="previewModal" x-cloak style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md transition-opacity">
        <div @click.away="previewModal = false"
            class="w-full max-w-4xl max-h-[85vh] flex flex-col rounded-3xl bg-[#0c1424] border border-white/15 shadow-2xl overflow-hidden">
            <!-- Modal Header -->
            <div class="p-5 border-b border-white/10 flex items-center justify-between bg-white/[0.02]">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-cyan-500/15 text-cyan-400 flex items-center justify-center border border-cyan-500/30">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-white" x-text="previewTitle"></h4>
                        <span class="text-[11px] font-mono text-slate-400 block truncate" x-text="previewPath"></span>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <button type="button" @click="copyToClipboard(previewContent)"
                        class="px-3 py-1.5 rounded-xl text-xs font-mono font-bold bg-white/5 hover:bg-white/10 text-slate-300 border border-white/10 transition-all cursor-pointer">
                        Copy File Content
                    </button>
                    <button type="button" @click="previewModal = false"
                        class="p-2 rounded-xl bg-white/5 hover:bg-rose-500/20 text-slate-400 hover:text-rose-300 border border-white/10 transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto flex-1 bg-[#060a12]" style="scrollbar-width: none; -ms-overflow-style: none;">
                <div x-show="previewLoading" class="py-12 text-center text-slate-400 font-mono text-xs">
                    <svg class="w-6 h-6 animate-spin text-cyan-400 mx-auto mb-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                    </svg>
                    Loading file contents...
                </div>
                <pre x-show="!previewLoading" class="text-xs font-mono text-slate-300 leading-relaxed whitespace-pre-wrap"><code x-text="previewContent"></code></pre>
            </div>
        </div>
    </div>

</div>
@endsection
