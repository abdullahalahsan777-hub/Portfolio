<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Create Account — Portfolio Platform</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#071e1b] text-slate-100 min-h-screen flex items-center justify-center p-4 antialiased selection:bg-[#f5b82e] selection:text-black">
        <div class="w-full max-w-md space-y-6">
            <div class="text-center space-y-2">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
                    <div class="w-10 h-10 rounded-xl bg-[#f5b82e] text-[#071e1b] flex items-center justify-center font-extrabold text-xl shadow-lg">
                        &alpha;
                    </div>
                    <span class="font-extrabold text-2xl text-white">Alex Rivera</span>
                </a>
                <h1 class="text-xl font-bold text-white">Create Client Portal Account</h1>
                <p class="text-xs text-slate-400">Track project milestones, contracts, and direct messages</p>
            </div>

            <div class="p-8 rounded-3xl bg-[#092723] border border-white/10 shadow-2xl space-y-6">
                @if($errors->any())
                    <div class="p-3 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-xs font-mono text-slate-300 mb-1.5">Full Name *</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="John Doe"
                            class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-[#f5b82e] transition-colors"
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-mono text-slate-300 mb-1.5">Email Address *</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="john@example.com"
                            class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-[#f5b82e] transition-colors"
                        >
                    </div>

                    <div>
                        <label for="phone" class="block text-xs font-mono text-slate-300 mb-1.5">Phone Number</label>
                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="+1 (555) 000-0000"
                            class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-[#f5b82e] transition-colors"
                        >
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-xs font-mono text-slate-300 mb-1.5">Password *</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                placeholder="&bull;&bull;&bull;&bull;&bull;&bull;"
                                class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-[#f5b82e] transition-colors"
                            >
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-xs font-mono text-slate-300 mb-1.5">Confirm *</label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                required
                                placeholder="&bull;&bull;&bull;&bull;&bull;&bull;"
                                class="w-full px-4 py-3 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-[#f5b82e] transition-colors"
                            >
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full py-3.5 px-4 rounded-xl font-extrabold text-xs uppercase tracking-wider bg-[#f5b82e] text-[#071e1b] hover:bg-[#e5a922] shadow-xl transition-all hover:scale-[1.01] active:scale-[0.99]"
                    >
                        Register Account
                    </button>
                </form>

                <div class="pt-4 border-t border-white/10 text-center text-xs text-slate-400 flex items-center justify-between">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">&larr; Back to Portfolio</a>
                    <a href="{{ route('login') }}" class="text-[#f5b82e] hover:underline font-semibold">Already have an account? Sign In &rarr;</a>
                </div>
            </div>
        </div>
    </body>
</html>
