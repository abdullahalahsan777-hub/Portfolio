@extends('admin.layout')

@section('title', 'Account Settings')
@section('page_title', 'Account Settings')
@section('page_subtitle', 'Personal Profile, Location & Bio')

@section('content')
    <div class="space-y-6 w-full">
        <div>
            <h1 class="text-2xl font-extrabold text-white">Account Settings</h1>
            <p class="text-xs text-slate-400">Manage your administrative credentials, personal bio, location, and account
                security.</p>
        </div>

        <!-- User Header Card -->
        <div class="p-3 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        @if (!empty($user->avatar) && file_exists(public_path($user->avatar)))
                            <img id="headerAvatarImg" src="{{ asset($user->avatar) }}" alt="{{ $user->name }}"
                                class="w-16 h-16 rounded-2xl object-cover border-2 border-indigo-500/40 shadow-lg shadow-indigo-600/30">
                            <div id="headerAvatarFallback"
                                class="hidden w-16 h-16 rounded-2xl bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-500 text-white font-extrabold text-2xl flex items-center justify-center shadow-lg shadow-indigo-600/30">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @else
                            <img id="headerAvatarImg" src="" alt="{{ $user->name }}"
                                class="hidden w-16 h-16 rounded-2xl object-cover border-2 border-indigo-500/40 shadow-lg shadow-indigo-600/30">
                            <div id="headerAvatarFallback"
                                class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-500 text-white font-extrabold text-2xl flex items-center justify-center shadow-lg shadow-indigo-600/30">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="text-lg font-bold text-white">{{ $user->name }}</h2>
                            <span
                                class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold uppercase bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                                {{ $user->role }}
                            </span>
                        </div>
                        <div class="flex flex-wrap items-center gap-3 text-xs font-mono text-slate-400 mt-1">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ $user->email }}
                            </span>

                            @if (!empty($user->location))
                                <span class="flex items-center gap-1 text-slate-300">
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
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" viewBox="0 0 24 24"
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

                <div class="flex items-center gap-2 font-mono text-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-emerald-400">Active Admin Session</span>
                </div>
            </div>
        </div>

        <!-- CV / Resume PDF Document Management Card -->
        <div class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl relative overflow-hidden">
            <div class="absolute -top-20 -right-20 w-60 h-60 bg-rose-500/10 rounded-full blur-3xl pointer-events-none">
            </div>

            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 relative z-10">
                <!-- Left Info & Current Status -->
                <div class="space-y-3 max-w-xl">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-2xl bg-rose-500/15 border border-rose-500/30 text-rose-400 flex items-center justify-center font-bold shadow-md shrink-0">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-6 4h4" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-white flex items-center gap-2">
                                <span>Curriculum Vitae (CV) PDF Document</span>
                                @if (!empty($cvFile) && file_exists(public_path($cvFile)))
                                    <span
                                        class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                        Active PDF Live
                                    </span>
                                @else
                                    <span
                                        class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-amber-500/20 text-amber-300 border border-amber-500/30">
                                        Default Document
                                    </span>
                                @endif
                            </h2>
                            <p class="text-xs text-slate-400 mt-0.5">
                                Upload your official PDF resume. When visitors click the <strong
                                    class="text-rose-400">"Download CV"</strong> button on your live website, this PDF will
                                be downloaded immediately.
                            </p>
                        </div>
                    </div>

                    @if (!empty($cvFile) && file_exists(public_path($cvFile)))
                        <!-- Currently Active PDF File Details -->
                        <div
                            class="p-3.5 rounded-2xl bg-black/40 border border-white/5 flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3 overflow-hidden">
                                <div
                                    class="w-8 h-8 rounded-xl bg-rose-500/20 text-rose-300 flex items-center justify-center font-mono font-bold text-xs shrink-0">
                                    PDF
                                </div>
                                <div class="overflow-hidden min-w-0">
                                    <span
                                        class="text-xs font-bold text-white block truncate">{{ $cvName ?: basename($cvFile) }}</span>
                                    <div class="flex items-center gap-2 text-[10px] font-mono text-slate-400">
                                        <span>{{ $cvSize ?: 'PDF Document' }}</span>
                                        <span>&bull;</span>
                                        <span>{{ $cvUpdatedAt ? \Carbon\Carbon::parse($cvUpdatedAt)->diffForHumans() : 'Active' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-2 shrink-0">
                                <!-- Test Download -->
                                <a href="{{ route('cv.download') }}" target="_blank"
                                    class="px-3 py-1.5 rounded-xl text-xs font-semibold bg-emerald-600/20 hover:bg-emerald-600 text-emerald-300 hover:text-white border border-emerald-500/30 transition-all flex items-center gap-1.5 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    <span>Download PDF</span>
                                </a>

                                <!-- Remove PDF -->
                                <form action="{{ route('admin.account.deletePdf') }}" method="POST"
                                    onsubmit="return confirm('Remove this uploaded CV PDF file? The system will revert to the default document.');"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Remove PDF"
                                        class="p-1.5 rounded-xl text-slate-400 hover:text-rose-400 hover:bg-white/5 transition-all">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Default State Information -->
                        <div
                            class="p-3.5 rounded-2xl bg-black/40 border border-white/5 flex items-center justify-between gap-4 text-xs text-slate-400">
                            <div class="flex items-center gap-2.5">
                                <svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Standard default CV document is active. Upload your personalized PDF below to replace
                                    it.</span>
                            </div>
                            <a href="{{ route('cv.download') }}" target="_blank"
                                class="text-xs font-mono text-indigo-400 hover:text-white shrink-0 flex items-center gap-1">
                                Test Download &rarr;
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Right: Interactive Upload Form -->
                <div class="lg:w-96 shrink-0">
                    <form action="{{ route('admin.account.uploadPdf') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-3">
                        @csrf

                        <label for="resume_pdf_input"
                            class="group cursor-pointer block p-5 rounded-2xl border-2 border-dashed border-white/15 hover:border-rose-500/50 bg-black/30 hover:bg-rose-500/5 transition-all text-center">
                            <input type="file" id="resume_pdf_input" name="resume_pdf" accept="application/pdf,.pdf"
                                required class="hidden" onchange="previewPdfSelection(this)">

                            <div class="space-y-2">
                                <div
                                    class="w-10 h-10 rounded-xl bg-rose-500/10 text-rose-400 border border-rose-500/20 flex items-center justify-center mx-auto group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l4-4m0 0l4 4m-4-4v12" />
                                    </svg>
                                </div>
                                <div id="pdfUploadPrompt">
                                    <span
                                        class="text-xs font-bold text-white block group-hover:text-rose-300 transition-colors">
                                        {{ !empty($cvFile) ? 'Choose New PDF to Replace' : 'Select PDF Resume to Upload' }}
                                    </span>
                                    <span class="text-[11px] font-mono text-slate-400 block mt-0.5">Click or drag & drop
                                        &bull; PDF up to 25MB</span>
                                </div>
                                <div id="pdfSelectedInfo"
                                    class="hidden text-xs font-mono text-rose-300 font-bold break-all">
                                    <!-- Populated dynamically by JS -->
                                </div>
                            </div>
                        </label>

                        @error('resume_pdf')
                            <span class="text-[11px] text-rose-400 mt-1 block">{{ $message }}</span>
                        @enderror

                        <button type="submit" id="pdfSubmitBtn"
                            class="w-full py-2.5 px-4 rounded-xl text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-500 hover:to-pink-500 text-white shadow-lg shadow-rose-600/30 transition-all flex items-center justify-center gap-2 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <span>Save & Upload PDF</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Personal Information Card -->
            <div id="profile-section"
                class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-5 scroll-mt-20">
                <div class="flex items-center gap-3 border-b border-white/10 pb-4">
                    <div
                        class="w-8 h-8 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center text-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-white">Profile Information</h2>
                        <p class="text-[11px] text-slate-400">Update your personal details, location, and biography</p>
                    </div>
                </div>

                <form action="{{ route('admin.account.profile') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    <!-- Profile Photo / Avatar with Live Interactive Preview -->
                    <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-mono text-slate-300 font-bold">Profile Avatar</label>
                            <span class="text-[10px] font-mono text-slate-400">JPG, PNG, WEBP &bull; Max 2MB</span>
                        </div>

                        <div class="flex items-center gap-4">
                            <!-- Preview Thumbnail Box -->
                            <div class="relative group cursor-pointer shrink-0"
                                onclick="document.getElementById('avatarInput').click()"
                                title="Click to choose a new photo">
                                <div
                                    class="w-16 h-16 sm:w-18 sm:h-18 rounded-2xl overflow-hidden border-2 border-indigo-500/40 shadow-md bg-[#0c1424] flex items-center justify-center relative">
                                    @if (!empty($user->avatar) && file_exists(public_path($user->avatar)))
                                        <img id="avatarPreview" src="{{ asset($user->avatar) }}"
                                            alt="{{ $user->name }}" class="w-full h-full object-cover">
                                        <div id="avatarFallback"
                                            class="hidden w-full h-full bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-500 text-white font-extrabold text-2xl flex items-center justify-center">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @else
                                        <img id="avatarPreview" src="" alt="Preview"
                                            class="hidden w-full h-full object-cover">
                                        <div id="avatarFallback"
                                            class="w-full h-full bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-500 text-white font-extrabold text-2xl flex items-center justify-center">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif

                                    <!-- Hover Camera Overlay -->
                                    <div
                                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white">
                                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Small Corner Icon Badge -->
                                <div
                                    class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-indigo-600 text-white flex items-center justify-center shadow-lg border border-black/40 text-[10px]">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Action Buttons & Filename -->
                            <div class="flex-1 space-y-1.5">
                                <div class="flex flex-wrap items-center gap-2">
                                    <button type="button" onclick="document.getElementById('avatarInput').click()"
                                        class="px-3.5 py-1.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold shadow-md shadow-indigo-600/30 transition-all flex items-center gap-1.5 cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                        <span
                                            id="avatarBtnText">{{ !empty($user->avatar) && file_exists(public_path($user->avatar)) ? 'Change Photo' : 'Upload Photo' }}</span>
                                    </button>

                                    <button type="button" id="removeAvatarBtn" onclick="resetAvatarPreview()"
                                        class="hidden px-2.5 py-1.5 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-300 text-xs font-mono transition-all border border-rose-500/20 cursor-pointer">
                                        Cancel
                                    </button>
                                </div>

                                <p id="avatarFileName" class="text-[11px] font-mono text-slate-400 truncate">
                                    @if (!empty($user->avatar) && file_exists(public_path($user->avatar)))
                                        Current Photo: {{ basename($user->avatar) }}
                                    @else
                                        No photo uploaded yet (click to select)
                                    @endif
                                </p>

                                <!-- Hidden Native File Input -->
                                <input type="file" id="avatarInput" name="avatar"
                                    accept="image/jpeg,image/png,image/webp,image/gif,image/svg+xml"
                                    onchange="previewAvatar(this)" class="hidden">
                            </div>
                        </div>

                        @error('avatar')
                            <span class="text-[11px] text-rose-400 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Full Name -->
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5 font-medium">Full Name</label>
                        <div class="relative">
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                        </div>
                        @error('name')
                            <span class="text-[11px] text-rose-400 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5 font-medium">Email Address (Login
                            Identifier)</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required readonly
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                        @error('email')
                            <span class="text-[11px] text-rose-400 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone & Location Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1.5 font-medium">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                placeholder="+1 (555) 000-0000"
                                class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs font-mono focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                            @error('phone')
                                <span class="text-[11px] text-rose-400 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-mono text-slate-400 mb-1.5 font-medium">Location</label>
                            <div class="relative">
                                <input type="text" name="location" value="{{ old('location', $user->location) }}"
                                    placeholder="e.g. Dhaka, Bangladesh"
                                    class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                            </div>
                            @error('location')
                                <span class="text-[11px] text-rose-400 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Biography -->
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5 font-medium">Bio / About
                            Yourself</label>
                        <textarea name="bio" rows="4"
                            placeholder="Share a short summary of your background, experience, or design & development philosophy..."
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all resize-none">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <span class="text-[11px] text-rose-400 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-2.5 px-4 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg shadow-indigo-600/30 transition-all cursor-pointer">
                            Save Profile Details
                        </button>
                    </div>
                </form>
            </div>

            <!-- Security / Password Card -->
            <div id="security-section"
                class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-5 scroll-mt-20">
                <div class="flex items-center gap-3 border-b border-white/10 pb-4">
                    <div class="w-8 h-8 rounded-xl bg-rose-500/10 text-rose-400 flex items-center justify-center text-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-bold text-white">Security & Password</h2>
                        <p class="text-[11px] text-slate-400">Change your administrative account login password</p>
                    </div>
                </div>

                <form action="{{ route('admin.account.password') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5 font-medium">Current Password</label>
                        <input type="password" name="current_password" required placeholder="••••••••"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition-all">
                        @error('current_password')
                            <span class="text-[11px] text-rose-400 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5 font-medium">New Password</label>
                        <input type="password" name="password" required placeholder="Minimum 6 characters"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition-all">
                        @error('password')
                            <span class="text-[11px] text-rose-400 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1.5 font-medium">Confirm New
                            Password</label>
                        <input type="password" name="password_confirmation" required placeholder="Re-enter new password"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition-all">
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-2.5 px-4 rounded-xl font-bold text-xs uppercase tracking-wider bg-rose-600/90 hover:bg-rose-600 text-white shadow-lg shadow-rose-600/20 transition-all cursor-pointer">
                            Update Password
                        </button>
                    </div>
                </form>

                <div class="p-4 rounded-2xl bg-white/[0.02] border border-white/5 space-y-2 mt-4">
                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-slate-400 block">Security
                        Recommendations</span>
                    <ul class="text-[11px] text-slate-400 space-y-1 list-disc list-inside">
                        <li>Use a unique, high-entropy password of at least 8 characters.</li>
                        <li>Avoid reusing passwords from personal or external accounts.</li>
                        <li>Session cookies are encrypted and invalidated automatically upon logout.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        const initialAvatarSrc =
            "{{ !empty($user->avatar) && file_exists(public_path($user->avatar)) ? asset($user->avatar) : '' }}";

        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Validate file size (2MB limit)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size exceeds 2MB limit. Please choose a smaller image.');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImg = document.getElementById('avatarPreview');
                    const fallback = document.getElementById('avatarFallback');
                    const headerImg = document.getElementById('headerAvatarImg');
                    const headerFallback = document.getElementById('headerAvatarFallback');
                    const fileName = document.getElementById('avatarFileName');
                    const removeBtn = document.getElementById('removeAvatarBtn');
                    const btnText = document.getElementById('avatarBtnText');

                    if (previewImg) {
                        previewImg.src = e.target.result;
                        previewImg.classList.remove('hidden');
                    }
                    if (fallback) {
                        fallback.classList.add('hidden');
                    }

                    if (headerImg) {
                        headerImg.src = e.target.result;
                        headerImg.classList.remove('hidden');
                    }
                    if (headerFallback) {
                        headerFallback.classList.add('hidden');
                    }

                    if (fileName) {
                        fileName.textContent = 'Selected: ' + file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
                        fileName.classList.add('text-emerald-400');
                        fileName.classList.remove('text-slate-400');
                    }

                    if (removeBtn) {
                        removeBtn.classList.remove('hidden');
                    }

                    if (btnText) {
                        btnText.textContent = 'Change Photo';
                    }
                };
                reader.readAsDataURL(file);
            }
        }

        function resetAvatarPreview() {
            const input = document.getElementById('avatarInput');
            const previewImg = document.getElementById('avatarPreview');
            const fallback = document.getElementById('avatarFallback');
            const headerImg = document.getElementById('headerAvatarImg');
            const headerFallback = document.getElementById('headerAvatarFallback');
            const fileName = document.getElementById('avatarFileName');
            const removeBtn = document.getElementById('removeAvatarBtn');
            const btnText = document.getElementById('avatarBtnText');

            if (input) input.value = '';

            if (initialAvatarSrc) {
                if (previewImg) {
                    previewImg.src = initialAvatarSrc;
                    previewImg.classList.remove('hidden');
                }
                if (fallback) fallback.classList.add('hidden');
                if (headerImg) {
                    headerImg.src = initialAvatarSrc;
                    headerImg.classList.remove('hidden');
                }
                if (headerFallback) headerFallback.classList.add('hidden');
                if (fileName) {
                    fileName.textContent = 'Current Photo: ' + initialAvatarSrc.split('/').pop();
                    fileName.classList.remove('text-emerald-400');
                    fileName.classList.add('text-slate-400');
                }
                if (btnText) btnText.textContent = 'Change Photo';
            } else {
                if (previewImg) {
                    previewImg.src = '';
                    previewImg.classList.add('hidden');
                }
                if (fallback) fallback.classList.remove('hidden');
                if (headerImg) {
                    headerImg.src = '';
                    headerImg.classList.add('hidden');
                }
                if (headerFallback) headerFallback.classList.remove('hidden');
                if (fileName) {
                    fileName.textContent = 'No photo uploaded yet (click to select)';
                    fileName.classList.remove('text-emerald-400');
                    fileName.classList.add('text-slate-400');
                }
                if (btnText) btnText.textContent = 'Upload Photo';
            }

            if (removeBtn) removeBtn.classList.add('hidden');
        }

        function previewPdfSelection(input) {
            if (input.files && input.files[0]) {
                var file = input.files[0];
                var sizeMB = (file.size / (1024 * 1024)).toFixed(2);
                var sizeKB = (file.size / 1024).toFixed(1);
                var displaySize = file.size >= 1048576 ? sizeMB + ' MB' : sizeKB + ' KB';

                var infoDiv = document.getElementById('pdfSelectedInfo');
                var promptDiv = document.getElementById('pdfUploadPrompt');

                if (infoDiv) {
                    infoDiv.innerHTML =
                        '<div class="p-2 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 font-sans space-y-1">' +
                        '<div class="flex items-center justify-center gap-1.5 text-emerald-400 font-bold text-xs">' +
                        '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>' +
                        '<span>Selected:</span>' +
                        '</div>' +
                        '<div class="font-mono text-[11px] truncate">' + file.name + '</div>' +
                        '<div class="text-[10px] text-slate-400 font-mono">File Size: ' + displaySize + '</div>' +
                        '</div>';
                    infoDiv.classList.remove('hidden');
                }
                if (promptDiv) {
                    promptDiv.classList.add('hidden');
                }
            }
        }
    </script>
@endsection
