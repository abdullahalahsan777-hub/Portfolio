<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HTTP Error Pages Suite &bull; Portfolio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-headline { font-family: 'Outfit', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
        .grid-bg {
            background-size: 32px 32px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        }
    </style>
</head>
<body class="bg-[#050811] text-slate-100 min-h-screen p-4 sm:p-8 antialiased selection:bg-[#0090e7] selection:text-white relative overflow-x-hidden">

    <div class="fixed inset-0 grid-bg pointer-events-none -z-20"></div>
    <div class="fixed top-12 left-1/3 w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[160px] pointer-events-none -z-10"></div>
    <div class="fixed bottom-12 right-1/3 w-[500px] h-[500px] bg-rose-600/10 rounded-full blur-[160px] pointer-events-none -z-10"></div>

    <div class="max-w-6xl mx-auto space-y-10">

        <!-- Top Header -->
        <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-white/10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-mono text-indigo-400 mb-2">
                    <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                    <span>HTTP PROTOCOL SUITE</span>
                </div>
                <h1 class="text-2xl sm:text-4xl font-extrabold font-headline text-white tracking-tight">
                    Custom Error Pages
                </h1>
                <p class="text-xs sm:text-sm text-slate-400 mt-1 max-w-2xl">
                    Production-ready 4xx client error and 5xx server error templates with custom styling, metadata diagnostics, and quick navigation.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}"
                    class="px-4 py-2 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-xs font-medium text-slate-300 hover:text-white transition-all flex items-center gap-1.5">
                    &larr; Admin Dashboard
                </a>
                <a href="{{ url('/') }}"
                    class="px-4 py-2 rounded-xl bg-[#0090e7] hover:bg-[#0090e7]/90 text-white text-xs font-semibold shadow-lg shadow-[#0090e7]/20 transition-all flex items-center gap-1.5">
                    Live Website &rarr;
                </a>
            </div>
        </header>

        <!-- 4xx Client Errors Section -->
        <section class="space-y-4">
            <div class="flex items-center gap-3">
                <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                <h2 class="text-xl font-bold font-headline text-white tracking-tight">4xx — Client Errors</h2>
                <span class="text-xs font-mono text-slate-500">({{ count($errors['4xx']) }} error templates)</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($errors['4xx'] as $code => $err)
                    <div class="p-5 rounded-2xl bg-[#09101d] border border-white/10 hover:border-white/25 transition-all flex flex-col justify-between space-y-4 shadow-xl group">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-mono font-bold"
                                      style="background: {{ $err['color'] }}20; color: {{ $err['color'] }}; border: 1px solid {{ $err['color'] }}40;">
                                    HTTP {{ $code }}
                                </span>
                                <span class="text-[10px] font-mono text-slate-500">Client Error</span>
                            </div>
                            <h3 class="text-base font-bold text-white group-hover:text-indigo-300 transition-colors">
                                {{ $err['title'] }}
                            </h3>
                            <p class="text-xs text-slate-400 leading-relaxed">
                                {{ $err['desc'] }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-white/5 flex items-center justify-between">
                            <span class="text-[11px] font-mono text-slate-500">/errors/{{ $code }}</span>
                            <a href="{{ url('/errors/' . $code) }}" target="_blank"
                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-white/5 hover:bg-white/10 text-xs font-medium text-slate-200 hover:text-white border border-white/10 transition-all">
                                <span>Preview</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 5xx Server Errors Section -->
        <section class="space-y-4 pt-4">
            <div class="flex items-center gap-3">
                <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                <h2 class="text-xl font-bold font-headline text-white tracking-tight">5xx — Server Errors</h2>
                <span class="text-xs font-mono text-slate-500">({{ count($errors['5xx']) }} error templates)</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($errors['5xx'] as $code => $err)
                    <div class="p-5 rounded-2xl bg-[#09101d] border border-white/10 hover:border-white/25 transition-all flex flex-col justify-between space-y-4 shadow-xl group">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="px-2.5 py-1 rounded-lg text-xs font-mono font-bold"
                                      style="background: {{ $err['color'] }}20; color: {{ $err['color'] }}; border: 1px solid {{ $err['color'] }}40;">
                                    HTTP {{ $code }}
                                </span>
                                <span class="text-[10px] font-mono text-slate-500">Server Error</span>
                            </div>
                            <h3 class="text-base font-bold text-white group-hover:text-rose-300 transition-colors">
                                {{ $err['title'] }}
                            </h3>
                            <p class="text-xs text-slate-400 leading-relaxed">
                                {{ $err['desc'] }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-white/5 flex items-center justify-between">
                            <span class="text-[11px] font-mono text-slate-500">/errors/{{ $code }}</span>
                            <a href="{{ url('/errors/' . $code) }}" target="_blank"
                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-white/5 hover:bg-white/10 text-xs font-medium text-slate-200 hover:text-white border border-white/10 transition-all">
                                <span>Preview</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Footer -->
        <footer class="pt-8 pb-4 border-t border-white/5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs font-mono text-slate-500">
            <div>
                <span>Portfolio Studio Error Handling Suite</span> &bull; <span>v{{ config('app.version', '1.0.0') }}</span>
            </div>
            <div>
                <span>All 12 status codes active</span>
            </div>
        </footer>

    </div>

</body>
</html>
