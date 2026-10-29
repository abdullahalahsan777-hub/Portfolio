<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('code') - @yield('title') &bull; Portfolio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        .font-headline {
            font-family: 'Outfit', sans-serif;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
        .grid-bg {
            background-size: 32px 32px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        }
    </style>
</head>
<body class="bg-[#050811] text-slate-100 min-h-screen flex flex-col justify-between p-4 sm:p-6 antialiased selection:bg-[#0090e7] selection:text-white relative overflow-x-hidden">

    <div class="fixed inset-0 grid-bg pointer-events-none -z-20"></div>

    <div class="fixed top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full blur-[160px] pointer-events-none -z-10 opacity-20"
        style="background: @yield('accent_color', '#0090e7');"></div>

    <header class="w-full max-w-5xl mx-auto flex items-center justify-between py-4 relative z-10">
        <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 via-purple-600 to-pink-500 p-[1.5px] shadow-lg group-hover:scale-105 transition-transform">
                <div class="w-full h-full bg-[#09101d] rounded-[10px] flex items-center justify-center font-bold text-white text-xs">
                    P
                </div>
            </div>
            <div class="text-left">
                <span class="block text-sm font-bold text-white group-hover:text-indigo-300 transition-colors">Portfolio</span>
                <span class="block text-[10px] font-mono text-slate-400">Error Handling Center</span>
            </div>
        </a>

        <div class="flex items-center gap-2">
            <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono bg-white/5 border border-white/10 text-slate-300">
                <span class="w-2 h-2 rounded-full" style="background: @yield('accent_color', '#0090e7');"></span>
                @yield('category', 'HTTP Protocol')
            </span>
            <a href="{{ url('/') }}" class="text-xs font-medium text-slate-400 hover:text-white transition-colors px-3 py-1.5 rounded-lg hover:bg-white/5">
                Home &rarr;
            </a>
        </div>
    </header>

    <main class="w-full max-w-3xl mx-auto my-auto text-center relative z-10 py-8">
        
        <div class="relative mb-6 select-none pointer-events-none">
            <span class="text-8xl sm:text-9xl md:text-[11rem] font-black font-headline tracking-tighter opacity-10 block leading-none"
                  style="color: @yield('accent_color', '#0090e7');">
                @yield('code')
            </span>
            
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-[#09101d]/90 backdrop-blur-xl border border-white/15 text-xs font-mono shadow-2xl">
                    <span class="w-2.5 h-2.5 rounded-full animate-ping" style="background: @yield('accent_color', '#0090e7');"></span>
                    <span class="font-bold tracking-wider uppercase text-white">
                        HTTP @yield('code') &bull; @yield('category', 'ERROR')
                    </span>
                </div>
            </div>
        </div>

        <div class="relative w-20 h-20 mx-auto mb-6 flex items-center justify-center">
            <div class="absolute inset-0 rounded-2xl blur-md opacity-50" style="background: @yield('accent_color', '#0090e7');"></div>
            <div class="relative w-16 h-16 rounded-2xl bg-[#09101d] border border-white/15 flex items-center justify-center shadow-xl text-white">
                @yield('icon')
            </div>
        </div>

        <div class="space-y-3 max-w-xl mx-auto">
            <h1 class="text-2xl sm:text-4xl font-extrabold font-headline uppercase tracking-tight text-white leading-tight">
                @yield('title')
            </h1>
            <p class="text-sm sm:text-base text-slate-300 leading-relaxed">
                @yield('description')
            </p>
        </div>

        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <a href="{{ url('/') }}"
                class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white text-xs sm:text-sm font-semibold shadow-lg shadow-indigo-600/30 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Return to Homepage</span>
            </a>

            <button type="button" onclick="window.history.back()"
                class="px-5 py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 text-xs sm:text-sm font-medium transition-all flex items-center gap-2 cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Go Back</span>
            </button>

            @if(Route::has('contact'))
            <a href="{{ route('contact') }}"
                class="px-4 py-2.5 rounded-xl bg-black/40 hover:bg-white/5 text-slate-400 hover:text-slate-200 border border-white/5 text-xs sm:text-sm transition-all flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <span>Contact</span>
            </a>
            @endif
        </div>

        <div class="mt-10 p-5 rounded-2xl bg-[#09101d]/60 border border-white/10 text-left space-y-3 max-w-lg mx-auto backdrop-blur-md">
            <div class="flex items-center justify-between text-xs font-mono pb-2 border-b border-white/5">
                <span class="text-slate-400 uppercase">DIAGNOSTIC METADATA</span>
                <span class="font-bold uppercase text-[11px]" style="color: @yield('accent_color', '#0090e7');">
                    CODE: @yield('code')
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[11px] font-mono text-slate-400">
                <div>
                    <span class="text-slate-500">Path:</span>
                    <span class="text-slate-200 truncate inline-block max-w-[170px] align-bottom">/{{ request()->path() }}</span>
                </div>
                <div>
                    <span class="text-slate-500">Method:</span>
                    <span class="text-slate-200">{{ request()->method() }}</span>
                </div>
                <div>
                    <span class="text-slate-500">Timestamp:</span>
                    <span class="text-slate-200">{{ date('Y-m-d H:i:s') }} UTC</span>
                </div>
                <div>
                    <span class="text-slate-500">Environment:</span>
                    <span class="text-slate-200">{{ config('app.env', 'production') }}</span>
                </div>
            </div>
        </div>

    </main>

    <footer class="w-full max-w-5xl mx-auto py-4 text-center text-xs font-mono text-slate-500 border-t border-white/5 flex flex-col sm:flex-row items-center justify-between gap-2 relative z-10">
        <div>
            <span>Portfolio Studio</span> &bull; <span>v{{ config('app.version', '1.0.0') }}</span>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ url('/') }}" class="hover:text-slate-300 transition-colors">Home</a>
            <span>&bull;</span>
            <a href="{{ route('home') }}?theme=developer" class="hover:text-slate-300 transition-colors">Themes</a>
            <span>&bull;</span>
            <a href="javascript:location.reload()" class="hover:text-indigo-400 transition-colors">Reload</a>
        </div>
    </footer>

</body>
</html>
