@extends('admin.layout')

@section('title', 'Version Control & Software Releases')
@section('page_title', 'Software Releases')
@section('page_subtitle', 'Version Control Hub')

@section('content')
    <div class="space-y-6">

        <!-- 1. Header with Repository Overview -->
        <div
            class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-12 p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl">
            <div class="col-span-1 md:col-span-3 lg:col-span-9 space-y-1.5">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-2xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center border border-indigo-500/30 shadow-inner">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-black text-white tracking-tight flex items-center gap-2">
                            <span>Version Control &amp; Software Releases</span>
                            <span
                                class="px-2.5 py-0.5 rounded-full text-xs font-mono font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                {{ $currentVersion['version'] }} (Current)
                            </span>
                        </h1>
                        <p class="text-xs text-slate-400 font-mono">
                            GitHub Tagged Releases, Version-Wise Feature Distribution &amp; Direct Downloads
                        </p>
                    </div>
                </div>
            </div>

            <!-- Global Actions -->
            <div
                class="col-span-1 md:col-span-1 lg:col-span-3 flex flex-col flex-wrap sm:flex-row sm:items-center justify-between gap-4">
                <a href="{{ $repoUrl }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-semibold bg-white/5 hover:bg-white/10 text-white border border-white/10 hover:border-white/20 transition-all shadow-sm">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                    </svg>
                    <span>View GitHub Repository</span>
                </a>
                <a href="{{ route('admin.versions.download', ['version' => $currentVersion['version'], 'format' => 'zip']) }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-semibold bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg shadow-indigo-600/30 transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    <span>Download Latest ({{ $currentVersion['version'] }}.zip)</span>
                </a>
            </div>
        </div>

        <!-- 2. Foundational Architecture Banner (Unified Across All Versions) -->
        <div
            class="p-6 rounded-3xl bg-gradient-to-br from-[#0c1424] via-[#09101d] to-[#0d1627] border border-indigo-500/30 shadow-xl space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-white/10">
                <div class="flex items-center gap-2.5">
                    <div
                        class="w-7 h-7 rounded-xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center text-xs font-bold border border-indigo-500/30">
                        &infin;
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-white tracking-tight">Foundational Core Architecture Across All
                            Versions</h2>
                        <p class="text-[11px] font-mono text-slate-400">
                            The following foundational modules remain unified, stable, and identical in every software
                            release:
                        </p>
                    </div>
                </div>
                <span
                    class="text-[10px] font-mono font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-indigo-500/10 text-indigo-300 border border-indigo-500/20">
                    Always Retained
                </span>
            </div>

            <!-- Core Modules Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach ($coreModules as $modName => $modDesc)
                    <div
                        class="p-3.5 rounded-2xl bg-white/[0.02] border border-white/5 hover:border-indigo-500/30 transition-all space-y-1">
                        <div class="flex items-center gap-2 text-xs font-bold text-white font-mono">
                            <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                            <span>{{ $modName }}</span>
                        </div>
                        <p class="text-[11px] text-slate-400 leading-relaxed font-sans">
                            {{ $modDesc }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 3. Software Version Releases Matrix (v1.2.0 to v1.0.0) -->
        <div class="space-y-4">
            <div class="flex items-center justify-between px-1">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                    <h2 class="text-sm font-bold text-white uppercase tracking-wider font-mono">
                        Available Stable Releases ({{ count($versions) }} Releases)
                    </h2>
                </div>
                <span class="text-xs font-mono text-slate-400">
                    All versions tagged and downloadable via GitHub
                </span>
            </div>

            <div class="space-y-5">
                @foreach ($versions as $release)
                    <div
                        class="rounded-3xl bg-[#09101d] border {{ $release['is_current'] ? 'border-indigo-500/60 shadow-2xl shadow-indigo-500/10' : 'border-white/10' }} p-6 space-y-5 transition-all group">

                        <!-- Card Header: Version Tag, Release Date, Status, Downloads -->
                        <div
                            class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-4 border-b border-white/10">
                            <div class="space-y-1">
                                <div class="flex items-center gap-3 flex-wrap">
                                    <span
                                        class="text-xl font-black font-mono text-white tracking-tight flex items-center gap-2">
                                        <span>{{ $release['version'] }}</span>
                                        @if ($release['is_current'])
                                            <span
                                                class="px-2.5 py-0.5 rounded-full text-xs font-mono font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 flex items-center gap-1.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                                Current Active Version
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-white/5 text-slate-300 border border-white/10">
                                                Stable Release
                                            </span>
                                        @endif
                                    </span>
                                </div>
                                <h3 class="text-sm font-bold text-slate-200">
                                    {{ $release['name'] }}
                                </h3>
                                <div class="flex items-center gap-3 text-xs font-mono text-slate-400 flex-wrap">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>Released: <strong
                                                class="text-white">{{ $release['release_date'] }}</strong></span>
                                    </span>
                                    <span class="text-slate-600">&bull;</span>
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                        </svg>
                                        <span>Commit: <code
                                                class="px-1.5 py-0.5 rounded bg-white/5 text-indigo-300">{{ $release['commit'] }}</code></span>
                                    </span>
                                </div>
                            </div>

                            <!-- Download Buttons for this Version -->
                            <div class="flex items-center gap-2 flex-wrap">
                                <a href="{{ route('admin.versions.download', ['version' => $release['version'], 'format' => 'zip']) }}"
                                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold bg-white/5 hover:bg-indigo-600/20 text-slate-200 hover:text-white border border-white/10 hover:border-indigo-500/40 transition-all shadow-sm">
                                    <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    <span>Download .ZIP</span>
                                </a>
                                <a href="{{ route('admin.versions.download', ['version' => $release['version'], 'format' => 'tar.gz']) }}"
                                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold bg-white/5 hover:bg-indigo-600/20 text-slate-200 hover:text-white border border-white/10 hover:border-indigo-500/40 transition-all shadow-sm">
                                    <svg class="w-3.5 h-3.5 text-cyan-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    <span>Download .TAR.GZ</span>
                                </a>
                                <a href="{{ $repoUrl }}/releases/tag/{{ $release['version'] }}" target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold bg-white/5 hover:bg-white/10 text-slate-400 hover:text-white border border-white/10 transition-all"
                                    title="View release tag on GitHub">
                                    <span>GitHub Tag</span> &rarr;
                                </a>
                            </div>
                        </div>

                        <!-- Summary -->
                        <p class="text-xs text-slate-300 leading-relaxed font-sans">
                            {{ $release['summary'] }}
                        </p>

                        <!-- Two-Column Architecture Division -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 pt-2">
                            <!-- Left Column: Foundational Modules -->
                            <div class="p-4 rounded-2xl bg-white/[0.02] border border-white/5 space-y-2.5">
                                <div class="flex items-center justify-between pb-2 border-b border-white/5">
                                    <span
                                        class="text-[11px] font-bold uppercase tracking-wider text-slate-300 font-mono flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span>
                                        Foundational Baseline (Retained)
                                    </span>
                                    <span class="text-[10px] font-mono text-slate-500">Universal Core</span>
                                </div>
                                <ul class="space-y-1.5 text-xs text-slate-400 font-sans">
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-400 mt-0.5">&#10003;</span>
                                        <span><strong>Website Group Module:</strong> Full studio content editor for Home,
                                            About, Contact, Services, Projects, Skills, Resume, Blog, FAQ, Pricing, and
                                            Testimonials.</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-400 mt-0.5">&#10003;</span>
                                        <span><strong>Authentication System:</strong> Secure login, user registration,
                                            password recovery, and session guard synchronization.</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-400 mt-0.5">&#10003;</span>
                                        <span><strong>Settings Subsystems:</strong> General website settings, Image &amp;
                                            Media assets, Theme settings, and Social links.</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-emerald-400 mt-0.5">&#10003;</span>
                                        <span><strong>Account Management:</strong> Profile updates, avatar uploads, and
                                            password security.</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Right Column: Features Specific to this Version -->
                            <div class="p-4 rounded-2xl bg-indigo-950/20 border border-indigo-500/20 space-y-2.5">
                                <div class="flex items-center justify-between pb-2 border-b border-indigo-500/20">
                                    <span
                                        class="text-[11px] font-bold uppercase tracking-wider text-indigo-300 font-mono flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                                        Features &amp; Subsystems Introduced in {{ $release['version'] }}
                                    </span>
                                    <span
                                        class="text-[10px] font-mono text-indigo-400 font-semibold">{{ count($release['version_features']) }}
                                        Features</span>
                                </div>
                                <div class="space-y-2 text-xs">
                                    @foreach ($release['version_features'] as $fTitle => $fDesc)
                                        <div class="space-y-0.5">
                                            <div class="font-bold text-white font-mono flex items-center gap-1.5">
                                                <span class="text-indigo-400">&bull;</span>
                                                <span>{{ $fTitle }}</span>
                                            </div>
                                            <p class="text-slate-400 text-[11px] leading-relaxed pl-3 font-sans">
                                                {{ $fDesc }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
