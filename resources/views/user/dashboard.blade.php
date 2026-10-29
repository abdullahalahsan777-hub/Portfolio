<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Client Portal Dashboard — Alex Rivera</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#071e1b] text-slate-100 min-h-screen antialiased selection:bg-[#f5b82e] selection:text-black">
        <!-- Top Navigation -->
        <header class="border-b border-white/10 bg-black/40 backdrop-blur-md sticky top-0 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="w-9 h-9 rounded-xl bg-[#f5b82e] text-[#071e1b] flex items-center justify-center font-extrabold text-base shadow">
                            &alpha;
                        </div>
                        <span class="font-extrabold text-lg text-white">Alex Rivera</span>
                    </a>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-mono bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Client Portal</span>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="text-xs text-slate-300 hover:text-white flex items-center gap-1 font-mono">
                        <span>&larr; View Portfolio</span>
                    </a>
                    <div class="h-4 w-px bg-white/20"></div>
                    <span class="text-xs font-medium text-white">{{ $user->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-rose-500/20 hover:bg-rose-500/30 text-rose-300 transition-colors">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">
            <!-- Welcome Banner -->
            <div class="p-8 rounded-3xl bg-[#092723] border border-white/10 shadow-2xl flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-1">
                    <span class="text-xs font-mono text-[#f5b82e] uppercase tracking-widest">Client Account</span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-white">Welcome, {{ $user->name }}</h1>
                    <p class="text-xs sm:text-sm text-slate-400">Manage your profile, view submitted project inquiries, and request consultations.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}#contact" class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider bg-[#f5b82e] text-[#071e1b] hover:bg-[#e5a922] transition-all shadow-lg">
                        Submit New Inquiry
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Left: Project Inquiries Sent -->
                <div class="lg:col-span-8 space-y-6">
                    <div class="p-6 rounded-3xl bg-[#092723] border border-white/10 shadow-xl space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-bold text-white">My Project Inquiries</h2>
                            <span class="text-xs font-mono text-slate-400">{{ $myMessages->count() }} Submissions</span>
                        </div>

                        <div class="space-y-3">
                            @forelse($myMessages as $msg)
                                <div class="p-4 rounded-2xl bg-black/30 border border-white/5 space-y-2">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span class="px-2 py-0.5 rounded text-[10px] font-mono font-semibold bg-[#f5b82e]/15 text-[#f5b82e] border border-[#f5b82e]/30">
                                                {{ $msg->service_type ?? 'General Inquiry' }}
                                            </span>
                                            <span class="text-xs text-slate-400 font-mono">{{ $msg->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <span class="text-xs font-mono {{ $msg->is_read ? 'text-emerald-400' : 'text-amber-400' }}">
                                            {{ $msg->is_read ? '&check; Reviewed by Alex' : '&bull; In Review' }}
                                        </span>
                                    </div>
                                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">{{ $msg->message }}</p>
                                </div>
                            @empty
                                <div class="text-center py-8 text-slate-400 text-xs">
                                    No project inquiries found under <span class="font-mono text-[#f5b82e]">{{ $user->email }}</span>.
                                    <br><a href="{{ route('home') }}#contact" class="text-white underline mt-2 inline-block">Send a proposal from the home page.</a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Right: Account Settings -->
                <div class="lg:col-span-4 space-y-6">
                    <!-- Profile Details -->
                    <div class="p-6 rounded-3xl bg-[#092723] border border-white/10 shadow-xl space-y-4">
                        <h2 class="text-lg font-bold text-white">Personal Information</h2>
                        <form action="{{ route('user.profile.update') }}" method="POST" class="space-y-3">
                            @csrf
                            <div>
                                <label class="block text-xs font-mono text-slate-400 mb-1">Full Name</label>
                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    required
                                    class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-[#f5b82e]"
                                >
                            </div>

                            <div>
                                <label class="block text-xs font-mono text-slate-400 mb-1">Email (Account ID)</label>
                                <input
                                    type="email"
                                    disabled
                                    value="{{ $user->email }}"
                                    class="w-full px-3 py-2 rounded-xl bg-black/20 border border-white/5 text-slate-400 text-xs cursor-not-allowed font-mono"
                                >
                            </div>

                            <div>
                                <label class="block text-xs font-mono text-slate-400 mb-1">Phone</label>
                                <input
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone', $user->phone) }}"
                                    placeholder="+1 (555) 000-0000"
                                    class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-[#f5b82e]"
                                >
                            </div>

                            <div>
                                <label class="block text-xs font-mono text-slate-400 mb-1">Location</label>
                                <input
                                    type="text"
                                    name="location"
                                    value="{{ old('location', $user->location) }}"
                                    placeholder="City, Country"
                                    class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-[#f5b82e]"
                                >
                            </div>

                            <div>
                                <label class="block text-xs font-mono text-slate-400 mb-1">Bio / About</label>
                                <textarea
                                    name="bio"
                                    rows="3"
                                    placeholder="Write a brief intro about yourself..."
                                    class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-[#f5b82e] resize-none"
                                >{{ old('bio', $user->bio) }}</textarea>
                            </div>

                            <button type="submit" class="w-full py-2.5 px-4 rounded-xl font-bold text-xs bg-slate-800 hover:bg-slate-700 text-white transition-all">
                                Update Info
                            </button>
                        </form>
                    </div>

                    <!-- Change Password -->
                    <div class="p-6 rounded-3xl bg-[#092723] border border-white/10 shadow-xl space-y-4">
                        <h2 class="text-lg font-bold text-white">Security & Password</h2>
                        <form action="{{ route('user.password.update') }}" method="POST" class="space-y-3">
                            @csrf
                            <div>
                                <label class="block text-xs font-mono text-slate-400 mb-1">Current Password</label>
                                <input
                                    type="password"
                                    name="current_password"
                                    required
                                    class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-[#f5b82e]"
                                >
                            </div>

                            <div>
                                <label class="block text-xs font-mono text-slate-400 mb-1">New Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    required
                                    class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-[#f5b82e]"
                                >
                            </div>

                            <div>
                                <label class="block text-xs font-mono text-slate-400 mb-1">Confirm New Password</label>
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    class="w-full px-3 py-2 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-[#f5b82e]"
                                >
                            </div>

                            <button type="submit" class="w-full py-2.5 px-4 rounded-xl font-bold text-xs bg-slate-800 hover:bg-slate-700 text-white transition-all">
                                Change Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
