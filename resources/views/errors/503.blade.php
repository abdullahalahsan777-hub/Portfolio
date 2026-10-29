<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>503 Service Unavailable — System Upgrade in Progress</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#070707] text-[#ffffff] min-h-screen flex items-center justify-center p-4 antialiased selection:bg-[#00ff88] selection:text-[#070707] font-['Plus_Jakarta_Sans'] overflow-x-hidden relative">

    <!-- Ambient Glowing Orbs -->
    <div class="fixed top-1/4 left-1/4 w-[500px] h-[500px] bg-amber-500/10 rounded-full blur-[160px] pointer-events-none -z-10 animate-pulse"></div>
    <div class="fixed bottom-1/4 right-1/4 w-[450px] h-[450px] bg-emerald-500/5 rounded-full blur-[160px] pointer-events-none -z-10"></div>

    <main class="w-full max-w-2xl text-center space-y-8 relative z-10 py-12">
        
        <!-- Status Indicator Pill -->
        <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-[#141414] border border-amber-500/30 text-amber-400 text-xs font-mono shadow-lg shadow-amber-500/10">
            <span class="w-2.5 h-2.5 rounded-full bg-amber-400 animate-ping"></span>
            <span class="font-bold tracking-wider uppercase">HTTP 503 &bull; SERVICE UNAVAILABLE</span>
        </div>

        <!-- Animated Server / Upgrade Graphic -->
        <div class="relative w-24 h-24 mx-auto flex items-center justify-center">
            <div class="absolute inset-0 rounded-3xl bg-gradient-to-tr from-amber-500/20 to-emerald-500/10 border border-white/10 blur-sm"></div>
            <div class="relative w-20 h-20 rounded-2xl bg-[#111111] border border-white/10 flex items-center justify-center text-amber-400 text-3xl shadow-2xl">
                <svg class="w-10 h-10 animate-spin" style="animation-duration: 12s;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
        </div>

        <!-- Headline & Explanation -->
        <div class="space-y-3">
            <h1 class="text-3xl sm:text-5xl font-black font-['Outfit'] uppercase tracking-tight text-white leading-tight">
                {{ $title ?? 'System Upgrade in Progress' }}
            </h1>
            <p class="text-sm sm:text-base text-neutral-400 max-w-xl mx-auto leading-relaxed">
                {{ $message ?? 'The frontend portfolio and client services are temporarily paused while our infrastructure undergoes an scheduled performance upgrade. We apologize for the inconvenience and will be fully operational shortly.' }}
            </p>
        </div>

        <!-- Diagnostic Upgrade Timeline Card -->
        <div class="p-6 rounded-3xl bg-[#111111] border border-white/10 shadow-2xl text-left space-y-4 max-w-lg mx-auto">
            <div class="flex items-center justify-between text-xs font-mono pb-3 border-b border-white/5">
                <span class="text-neutral-400 uppercase">SERVER STATUS</span>
                <span class="text-amber-400 font-bold uppercase flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                    UPGRADING INFRASTRUCTURE
                </span>
            </div>

            <!-- Steps -->
            <div class="space-y-2.5 text-xs">
                <div class="flex items-center justify-between text-neutral-300">
                    <span class="flex items-center gap-2">
                        <span class="text-[#00ff88]">✓</span>
                        <span>Database &amp; Schema Migration</span>
                    </span>
                    <span class="font-mono text-[10px] text-emerald-400 uppercase">COMPLETE</span>
                </div>
                <div class="flex items-center justify-between text-white font-semibold">
                    <span class="flex items-center gap-2">
                        <span class="text-amber-400 animate-spin">⟳</span>
                        <span>Performance Caching &amp; Core Engine</span>
                    </span>
                    <span class="font-mono text-[10px] text-amber-400 uppercase">IN PROGRESS</span>
                </div>
                <div class="flex items-center justify-between text-neutral-500">
                    <span class="flex items-center gap-2">
                        <span>○</span>
                        <span>Production Gateway Warmup</span>
                    </span>
                    <span class="font-mono text-[10px] text-neutral-500 uppercase">PENDING</span>
                </div>
            </div>

            <div class="pt-3 border-t border-white/5 flex items-center justify-between text-[11px] font-mono text-neutral-400">
                <span>{{ $estimatedTime ?? 'Estimated time: 15–30 minutes' }}</span>
                <span>HTTP: 503</span>
            </div>
        </div>

        <!-- Staff & Admin Access Point -->
        <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4 text-xs">
            @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('admin.maintenance.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-emerald-500 hover:bg-emerald-400 text-black font-extrabold uppercase tracking-wider transition-all hover:scale-105 shadow-xl shadow-emerald-500/20">
                    <svg class="w-4 h-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span>Admin Session: Open Hub &amp; Upgrade Server Status &rarr;</span>
                </a>
                <a href="{{ url('/?preview=1') }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-full bg-white/10 hover:bg-white/20 text-neutral-300 hover:text-white transition-all font-mono text-[11px]">
                    <span>Admin Preview Live Frontend</span> ↗
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-white/10 hover:bg-white/20 text-white border border-white/15 font-bold uppercase tracking-wider transition-all hover:scale-105 shadow-lg">
                    <svg class="w-4 h-4 text-[#00ff88]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span>Admin Login &amp; Server Upgrade</span>
                </a>
            @endif
            
            @if(!empty($contactEmail))
                <a href="mailto:{{ $contactEmail }}" class="inline-flex items-center gap-1.5 text-neutral-400 hover:text-white transition-colors">
                    <span>Contact Operations</span> ↗
                </a>
            @endif
        </div>

        <!-- Micro Footer -->
        <div class="text-[11px] font-mono text-neutral-600">
            &copy; {{ date('Y') }} Platform Operations &bull; Automated Deployment Sentinel
        </div>

    </main>

</body>
</html>
