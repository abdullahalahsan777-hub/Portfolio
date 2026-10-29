@extends('admin.layout')

@section('title', 'Admin Profile')
@section('page_title', 'Admin Profile')
@section('page_subtitle', 'Personal Profile Details & Overview')

@section('content')
    <div class="space-y-6 w-full">

        <!-- Top Action Breadcrumb Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-2">
            <div>
                <h1 class="text-2xl font-black text-white tracking-tight flex items-center gap-3">
                    <span>Personal Profile</span>
                    <span
                        class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold uppercase bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                        {{ $user->role ?? 'Admin' }}
                    </span>
                </h1>
                <p class="text-xs text-slate-400 mt-1">Overview of your administrative profile, biography, linked assets, and
                    system credentials.</p>
            </div>
            <div class="flex items-center gap-2.5 flex-wrap">
                <a href="{{ route('admin.account') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white shadow-lg shadow-indigo-600/30 transition-all hover:scale-[1.02]">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Account Settings</span>
                </a>
            </div>
        </div>

        <!-- Main Profile Card with Cover Banner -->
        <div class="rounded-3xl bg-[#09101d] border border-white/10 shadow-2xl overflow-hidden relative">
            <!-- Cover Art Banner with Active Theme Gradient & Mesh Glow -->
            <div class="h-48 sm:h-56 relative overflow-hidden transition-all duration-500"
                style="background: {{ $themeGradient ?? 'linear-gradient(135deg, #450a0a 0%, #881337 40%, #09101d 100%)' }};">
                <div class="absolute inset-0 pointer-events-none"
                    style="background: radial-gradient(circle at 18% 30%, {{ $themeColor }}66 0%, transparent 55%), radial-gradient(circle at 82% 65%, {{ $themeColor }}35 0%, transparent 60%), radial-gradient(circle at 50% 100%, #09101d 0%, transparent 80%);">
                </div>

                <div class="absolute inset-0 opacity-20 pointer-events-none"
                    style="background-image: radial-gradient(rgba(255, 255, 255, 0.7) 1px, transparent 1px); background-size: 22px 22px;">
                </div>

                <!-- Active Theme Indicator Badge (Top Left of Cover) -->
                <div class="absolute top-4 left-4 z-10">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-black/60 backdrop-blur-md border border-white/15 text-white text-xs font-mono shadow-xl">
                        <span class="w-2.5 h-2.5 rounded-full animate-pulse shrink-0"
                            style="background-color: {{ $themeColor }}; box-shadow: 0 0 10px {{ $themeColor }};"></span>
                        <span class="font-bold tracking-wide">Theme: {{ $themeName }}</span>
                        <span class="text-[9px] px-1.5 py-0.2 rounded font-bold uppercase tracking-wider"
                            style="background-color: {{ $themeColor }}33; color: {{ $themeColor }};">Active</span>
                    </div>
                </div>

                <!-- Live Website Link Badge (Top Right of Cover) -->
                <div class="absolute top-4 right-4 z-10">
                    <a href="{{ route('home') }}" target="_blank"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-black/60 hover:bg-black/80 backdrop-blur-md border border-white/15 text-white text-xs font-mono transition-all hover:scale-105 shadow-xl">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>View Live Site</span>
                        <svg class="w-3.5 h-3.5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Identity Bar (Avatar overlapping cover) -->
            <div class="px-6 sm:px-8 pb-8 pt-0 relative">
                <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-6 -mt-16 sm:-mt-20 mb-6">

                    <!-- Avatar & Core Info -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-end gap-5">
                        <div class="relative">
                            @if (!empty($user->avatar) && file_exists(public_path($user->avatar)))
                                <img src="{{ asset($user->avatar) }}" alt="{{ $user->name }}"
                                    class="w-28 h-28 sm:w-32 sm:h-32 rounded-3xl object-cover border-4 border-[#09101d] shadow-2xl bg-[#09101d] transition-transform hover:scale-105"
                                    style="box-shadow: 0 12px 35px {{ $themeColor }}40;">
                            @else
                                <div class="w-28 h-28 sm:w-32 sm:h-32 rounded-3xl bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-500 text-white font-black text-4xl flex items-center justify-center border-4 border-[#09101d] shadow-2xl"
                                    style="box-shadow: 0 12px 35px {{ $themeColor }}40;">
                                    {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                                </div>
                            @endif
                            <span
                                class="absolute bottom-1 right-1 w-5 h-5 rounded-full bg-emerald-500 border-2 border-[#09101d] shadow-md"
                                title="Active Admin Session"></span>
                        </div>

                        <div class="space-y-1 sm:pb-2">
                            <div class="flex items-center gap-2.5 flex-wrap">
                                <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                                    {{ $user->name }}</h2>
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold uppercase bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Verified Admin
                                </span>
                            </div>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-400 font-mono">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    {{ $user->email }}
                                </span>
                                @if (!empty($user->location))
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-rose-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $user->location }}
                                    </span>
                                @endif
                                @if (!empty($user->phone))
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-sky-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        {{ $user->phone }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Session & Auth Metadata -->
                    <div class="sm:pb-2 text-right">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-xl bg-white/5 border border-white/10 text-xs font-mono text-slate-300">
                            <span class="text-slate-500">Member Since:</span>
                            <span
                                class="text-white font-bold">{{ $user->created_at ? $user->created_at->format('M d, Y') : 'Active' }}</span>
                        </div>
                    </div>
                </div>

                <!-- 4 Quick Stats Pills -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 pt-4 border-t border-white/10">
                    <a href="{{ route('admin.projects.index') }}"
                        class="p-3.5 rounded-2xl bg-black/30 border border-white/5 hover:border-indigo-500/40 hover:bg-white/5 transition-all group">
                        <span class="text-[10px] font-mono uppercase text-slate-400 block tracking-wider">Projects</span>
                        <span
                            class="text-xl sm:text-2xl font-black text-white group-hover:text-indigo-400 transition-colors">{{ $stats['projects'] ?? 0 }}</span>
                        <span class="text-[10px] text-slate-500 block">Published in portfolio &rarr;</span>
                    </a>

                    <a href="{{ route('admin.blog.index') }}"
                        class="p-3.5 rounded-2xl bg-black/30 border border-white/5 hover:border-purple-500/40 hover:bg-white/5 transition-all group">
                        <span class="text-[10px] font-mono uppercase text-slate-400 block tracking-wider">Articles</span>
                        <span
                            class="text-xl sm:text-2xl font-black text-white group-hover:text-purple-400 transition-colors">{{ $stats['blogs'] ?? 0 }}</span>
                        <span class="text-[10px] text-slate-500 block">Written blog posts &rarr;</span>
                    </a>

                    <a href="{{ route('admin.services.index') }}"
                        class="p-3.5 rounded-2xl bg-black/30 border border-white/5 hover:border-pink-500/40 hover:bg-white/5 transition-all group">
                        <span class="text-[10px] font-mono uppercase text-slate-400 block tracking-wider">Services</span>
                        <span
                            class="text-xl sm:text-2xl font-black text-white group-hover:text-pink-400 transition-colors">{{ $stats['services'] ?? 0 }}</span>
                        <span class="text-[10px] text-slate-500 block">Active offerings &rarr;</span>
                    </a>

                    <a href="{{ route('admin.messages.index') }}"
                        class="p-3.5 rounded-2xl bg-black/30 border border-white/5 hover:border-rose-500/40 hover:bg-white/5 transition-all group">
                        <span class="text-[10px] font-mono uppercase text-slate-400 block tracking-wider">Inquiries</span>
                        <span
                            class="text-xl sm:text-2xl font-black text-white group-hover:text-rose-400 transition-colors">{{ $stats['unread_messages'] ?? 0 }}</span>
                        <span class="text-[10px] text-slate-500 block">Unread messages &rarr;</span>
                    </a>
                </div>

            </div>
        </div>

        <!-- 2 Column Profile Details Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- Left Column: Biography & Contact Details (7 cols) -->
            <div class="lg:col-span-7 space-y-6">

                <!-- Biography Card -->
                <div class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div class="flex items-center gap-2.5">
                            <div
                                class="w-8 h-8 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-white uppercase tracking-wider font-mono">Personal Biography
                            </h3>
                        </div>
                        <a href="{{ route('admin.account') }}#profile-section"
                            class="text-xs text-indigo-400 hover:text-indigo-300 font-mono flex items-center gap-1 hover:underline">
                            <span>Edit Bio</span> &rarr;
                        </a>
                    </div>

                    @if (!empty($user->bio))
                        <div
                            class="text-slate-300 text-xs sm:text-sm leading-relaxed whitespace-pre-line p-4 rounded-2xl bg-black/30 border border-white/5">
                            {{ $user->bio }}
                        </div>
                    @else
                        <div
                            class="p-6 rounded-2xl bg-black/20 border border-dashed border-white/10 text-center space-y-2">
                            <p class="text-xs text-slate-400">No personal biography has been written yet.</p>
                            <a href="{{ route('admin.account') }}#profile-section"
                                class="inline-flex items-center gap-1 text-xs font-bold text-indigo-400 hover:text-indigo-300 hover:underline">
                                <span>Add your bio in Account Settings</span> &rarr;
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Complete Contact & Information Card -->
                <div class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
                    <div class="flex items-center gap-2.5 border-b border-white/10 pb-3">
                        <div class="w-8 h-8 rounded-xl bg-purple-500/10 text-purple-400 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-white uppercase tracking-wider font-mono">Profile Details</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <div class="p-3.5 rounded-2xl bg-black/30 border border-white/5 space-y-1">
                            <span class="text-[10px] font-mono uppercase text-slate-400 block">Full Name</span>
                            <span class="text-white font-bold text-sm block">{{ $user->name }}</span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-black/30 border border-white/5 space-y-1">
                            <span class="text-[10px] font-mono uppercase text-slate-400 block">Email Address</span>
                            <span class="text-white font-mono font-medium block truncate"
                                title="{{ $user->email }}">{{ $user->email }}</span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-black/30 border border-white/5 space-y-1">
                            <span class="text-[10px] font-mono uppercase text-slate-400 block">Phone Number</span>
                            <span
                                class="text-white font-mono block">{{ !empty($user->phone) ? $user->phone : 'Not configured' }}</span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-black/30 border border-white/5 space-y-1">
                            <span class="text-[10px] font-mono uppercase text-slate-400 block">Location</span>
                            <span
                                class="text-white block">{{ !empty($user->location) ? $user->location : 'Not specified' }}</span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-black/30 border border-white/5 space-y-1">
                            <span class="text-[10px] font-mono uppercase text-slate-400 block">Role & Authority</span>
                            <span class="text-indigo-300 font-mono font-bold uppercase block">{{ $user->role ?? 'Admin' }}
                                (Full Access)</span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-black/30 border border-white/5 space-y-1">
                            <span class="text-[10px] font-mono uppercase text-slate-400 block">Auth Provider</span>
                            <span
                                class="text-slate-300 font-mono capitalize block">{{ $user->provider ? $user->provider : 'Local Credentials' }}</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Resume Status & Account Security (5 cols) -->
            <div class="lg:col-span-5 space-y-6">

                <!-- Linked CV / Resume Card -->
                <div class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-xl bg-rose-500/10 text-rose-400 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-white uppercase tracking-wider font-mono">Curriculum Vitae
                                (CV)</h3>
                        </div>
                        <span
                            class="px-2 py-0.5 rounded text-[9px] font-mono font-bold uppercase {{ !empty($cvFile) ? 'bg-emerald-500/20 text-emerald-300' : 'bg-slate-500/20 text-slate-400' }}">
                            {{ !empty($cvFile) ? 'Active' : 'No CV' }}
                        </span>
                    </div>

                    @if (!empty($cvFile))
                        <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-rose-500/20 border border-rose-500/40 text-rose-400 font-black text-xs flex items-center justify-center shrink-0">
                                    PDF
                                </div>
                                <div class="overflow-hidden flex-1">
                                    <span
                                        class="block text-xs font-bold text-white truncate">{{ $cvName ?: 'Resume.pdf' }}</span>
                                    <span class="block text-[10px] font-mono text-slate-400">
                                        {{ !empty($cvSize) ? (is_numeric($cvSize) ? round($cvSize / 1024, 1) . ' KB' : $cvSize) : 'PDF Document' }}
                                        @if (!empty($cvUpdatedAt))
                                            &bull; {{ \Carbon\Carbon::parse($cvUpdatedAt)->diffForHumans() }}
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="pt-2 flex items-center gap-2">
                                <a href="{{ route('cv.download') }}"
                                    class="flex-1 py-2 px-3 rounded-xl bg-white/5 hover:bg-white/10 text-white text-xs font-bold text-center border border-white/10 transition-all flex items-center justify-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    <span>Download PDF</span>
                                </a>
                                <a href="{{ route('admin.account') }}"
                                    class="py-2 px-3 rounded-xl bg-indigo-600/20 hover:bg-indigo-600/30 text-indigo-300 text-xs font-bold border border-indigo-500/30 transition-all">
                                    Replace &rarr;
                                </a>
                            </div>
                        </div>
                    @else
                        <div
                            class="p-4 rounded-2xl bg-black/20 border border-dashed border-white/10 text-center space-y-2">
                            <p class="text-xs text-slate-400">No CV / Resume PDF currently attached.</p>
                            <a href="{{ route('admin.account') }}"
                                class="inline-flex items-center gap-1 text-xs font-bold text-rose-400 hover:text-rose-300 hover:underline">
                                <span>Upload your PDF resume</span> &rarr;
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Security & Permissions Card -->
                <div class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div class="flex items-center gap-2.5">
                            <div
                                class="w-8 h-8 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-white uppercase tracking-wider font-mono">Security & Access
                            </h3>
                        </div>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="flex items-center justify-between p-3 rounded-2xl bg-black/30 border border-white/5">
                            <div class="space-y-0.5">
                                <span class="block text-white font-medium">Password Protection</span>
                                <span class="block text-[11px] text-slate-400 font-mono">Bcrypt Salted Hash</span>
                            </div>
                            <a href="{{ route('admin.account') }}#security-section"
                                class="px-2.5 py-1 rounded-lg bg-white/5 hover:bg-white/10 border border-white/10 text-slate-200 text-[11px] font-bold transition-all">
                                Change
                            </a>
                        </div>

                        <div class="flex items-center justify-between p-3 rounded-2xl bg-black/30 border border-white/5">
                            <div class="space-y-0.5">
                                <span class="block text-white font-medium">Session Status</span>
                                <span class="block text-[11px] text-slate-400 font-mono">Active & Encrypted</span>
                            </div>
                            <span
                                class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                                Secure
                            </span>
                        </div>

                        <div class="flex items-center justify-between p-3 rounded-2xl bg-black/30 border border-white/5">
                            <div class="space-y-0.5">
                                <span class="block text-white font-medium">System Role</span>
                                <span class="block text-[11px] text-slate-400 font-mono">Full Administration Rights</span>
                            </div>
                            <span
                                class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                                Superuser
                            </span>
                        </div>
                    </div>

                    <div class="pt-2">
                        <a href="{{ route('admin.account') }}"
                            class="w-full py-2.5 px-4 rounded-xl text-xs font-bold text-center bg-white/5 hover:bg-white/10 text-white border border-white/10 transition-all block">
                            Open Full Account Settings &rarr;
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
