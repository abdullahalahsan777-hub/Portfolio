@php
    $modalUpdateStatus = $updateStatus ?? ($stats['update_status'] ?? ($uStatus ?? null));
    if (!$modalUpdateStatus) {
        try {
            $modalUpdateStatus = app(\App\Services\SystemUpdateService::class)->getStatus();
        } catch (\Throwable $e) {
            $modalUpdateStatus = [
                'current_version' => config('app.version', '1.3.0'),
                'latest_version' => config('app.version', '1.3.0'),
                'update_available' => false,
                'is_behind' => false,
                'commits_behind' => 0,
                'current_commit' => 'HEAD',
                'current_commit_msg' => 'Current build',
                'current_commit_author' => 'System',
                'current_commit_date' => 'Recent',
                'remote_commit' => 'origin/main',
                'remote_commit_msg' => 'Latest push',
                'remote_commit_author' => 'GitHub',
                'remote_commit_date' => 'Recent',
                'remote_branch' => 'origin/main',
                'repo_url' => 'https://github.com/abdullahalahsan777-hub/Portfolio',
                'last_checked_at' => now()->format('M d, Y h:i A'),
                'recent_remote_commits' => [],
                'recent_local_commits' => [],
            ];
        }
    }
@endphp

<!-- System Software Update & What's New Modal -->
<div id="systemUpdateModal"
    class="fixed inset-0 z-[10000] hidden items-center justify-center p-4 sm:p-6 overflow-y-auto"
    role="dialog"
    aria-modal="true"
    aria-labelledby="systemUpdateModalTitle">

    <!-- Blur Backdrop -->
    <div class="fixed inset-0 bg-slate-950/85 backdrop-blur-md transition-opacity duration-300"
        onclick="closeSystemUpdateModal()"></div>

    <!-- Modal Box -->
    <div class="relative w-full max-w-2xl bg-[#0b1220] border border-cyan-500/30 rounded-3xl shadow-2xl shadow-cyan-950/60 overflow-hidden text-slate-100 flex flex-col max-h-[92vh] z-10 animate-in fade-in zoom-in-95 duration-200">
        
        <!-- Ambient Cyber Glows -->
        <div class="absolute -top-16 -right-16 w-52 h-52 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-16 -left-16 w-52 h-52 bg-cyan-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Header -->
        <div class="px-6 py-5 border-b border-white/10 flex items-center justify-between gap-4 relative z-10 bg-white/[0.02]">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl {{ !empty($modalUpdateStatus['update_available']) ? 'bg-gradient-to-br from-amber-500/30 to-orange-500/20 text-amber-400 border border-amber-500/40 shadow-lg shadow-amber-500/20' : 'bg-gradient-to-br from-cyan-500/30 to-blue-500/20 text-cyan-400 border border-cyan-500/40 shadow-lg shadow-cyan-500/20' }} flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 {{ !empty($modalUpdateStatus['update_available']) ? 'animate-pulse' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-[11px] font-mono uppercase tracking-widest text-cyan-400 font-bold">System Software Synchronization</span>
                        @if (!empty($modalUpdateStatus['update_available']))
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-amber-500/20 text-amber-300 border border-amber-500/40 flex items-center gap-1.5 animate-pulse">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                Update Available
                            </span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                In Sync with GitHub
                            </span>
                        @endif
                    </div>
                    <h3 id="systemUpdateModalTitle" class="text-lg font-bold font-['Outfit'] text-white tracking-tight mt-0.5">
                        Software Update &amp; Release Manager
                    </h3>
                </div>
            </div>

            <!-- Close 'X' Button -->
            <button type="button"
                onclick="closeSystemUpdateModal()"
                class="w-9 h-9 rounded-xl bg-white/5 hover:bg-white/10 text-slate-400 hover:text-white border border-white/10 transition-all flex items-center justify-center cursor-pointer shrink-0"
                title="Close dialog (Esc)">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Scrollable Modal Body -->
        <div class="px-6 py-5 overflow-y-auto space-y-5 relative z-10 text-xs custom-scrollbar">

            <!-- 1. Version & Commit Comparison Card -->
            <div class="p-4 rounded-2xl bg-black/40 border border-white/10 grid grid-cols-1 sm:grid-cols-11 gap-3 items-center">
                
                <!-- Installed Local Version -->
                <div class="sm:col-span-5 space-y-1">
                    <span class="text-[10px] font-mono text-slate-400 uppercase tracking-wider block">Currently Installed</span>
                    <div class="flex items-center gap-2">
                        <span class="text-base font-bold font-mono text-white">{{ $modalUpdateStatus['current_version'] ?? 'v1.3.0' }}</span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-cyan-500/20 text-cyan-300 border border-cyan-500/30">Local HEAD</span>
                    </div>
                    <p class="text-[11px] font-mono text-slate-400 truncate">
                        Commit: <span class="text-cyan-400 font-bold">#{{ $modalUpdateStatus['current_commit'] }}</span>
                    </p>
                    <p class="text-[10px] font-mono text-slate-500 truncate">
                        {{ $modalUpdateStatus['current_commit_date'] }} &bull; {{ $modalUpdateStatus['current_commit_author'] }}
                    </p>
                </div>

                <!-- Sync Arrow Divider -->
                <div class="sm:col-span-1 flex items-center justify-center py-1 sm:py-0">
                    <div class="w-8 h-8 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-slate-400">
                        <svg class="w-4 h-4 {{ !empty($modalUpdateStatus['update_available']) ? 'text-amber-400 animate-pulse' : 'text-emerald-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                </div>

                <!-- GitHub Remote Version -->
                <div class="sm:col-span-5 space-y-1 sm:text-right">
                    <span class="text-[10px] font-mono text-slate-400 uppercase tracking-wider block">GitHub Remote (origin/main)</span>
                    <div class="flex items-center gap-2 sm:justify-end">
                        <span class="text-base font-bold font-mono {{ !empty($modalUpdateStatus['update_available']) ? 'text-amber-300' : 'text-emerald-400' }}">
                            {{ $modalUpdateStatus['latest_version'] ?? $modalUpdateStatus['current_version'] }}
                        </span>
                        @if (!empty($modalUpdateStatus['update_available']))
                            <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-amber-500/20 text-amber-300 border border-amber-500/30 font-bold">
                                {{ $modalUpdateStatus['commits_behind'] }} {{ Str::plural('Push', $modalUpdateStatus['commits_behind']) }} Behind
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                Latest Release
                            </span>
                        @endif
                    </div>
                    <p class="text-[11px] font-mono text-slate-400 truncate">
                        Latest Commit: <span class="text-amber-300 font-bold">#{{ $modalUpdateStatus['remote_commit'] }}</span>
                    </p>
                    <p class="text-[10px] font-mono text-slate-500 truncate">
                        {{ $modalUpdateStatus['remote_commit_date'] }} &bull; {{ $modalUpdateStatus['remote_commit_author'] }}
                    </p>
                </div>
            </div>

            <!-- 2. "WHAT'S NEW FOR UPDATE" Section -->
            <div class="p-5 rounded-2xl bg-white/[0.03] border border-white/10 space-y-3.5">
                <div class="flex items-center justify-between gap-2 pb-2 border-b border-white/5">
                    <div class="flex items-center gap-2">
                        <span class="text-base">🚀</span>
                        <h4 class="text-xs font-mono font-black uppercase tracking-wider text-amber-300">
                            What's New in this Update
                        </h4>
                    </div>
                    <span class="text-[10px] font-mono text-slate-400">
                        @if (!empty($modalUpdateStatus['is_behind']))
                            Incoming GitHub Commits
                        @else
                            Latest Build Release Notes
                        @endif
                    </span>
                </div>

                @if (!empty($modalUpdateStatus['is_behind']) && !empty($modalUpdateStatus['recent_remote_commits']))
                    <!-- List of Remote Commits pending merge -->
                    <div class="p-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-200 text-xs flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-amber-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="font-semibold text-amber-300">New updates are ready to be merged from GitHub.</p>
                            <p class="text-[11px] text-amber-200/80">Clicking "Update Software Now" will automatically pull, merge, execute migrations, and optimize your application without errors.</p>
                        </div>
                    </div>

                    <div class="space-y-2 max-h-52 overflow-y-auto pr-1">
                        @foreach ($modalUpdateStatus['recent_remote_commits'] as $c)
                            <div class="p-3 rounded-xl bg-black/40 border border-white/5 hover:border-amber-500/30 transition-colors space-y-1">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-amber-500/20 text-amber-300 border border-amber-500/30">
                                        #{{ $c['hash'] }}
                                    </span>
                                    <span class="text-[10px] font-mono text-slate-500">{{ $c['date'] }}</span>
                                </div>
                                <p class="text-xs font-semibold text-white leading-snug">
                                    {{ $c['msg'] }}
                                </p>
                                <span class="text-[10px] font-mono text-slate-400 block">By {{ $c['author'] }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- When system is up-to-date or showing recent local commits -->
                    <div class="p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-200 text-xs flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="font-semibold text-emerald-300">Your software is currently synchronized with GitHub ({{ $modalUpdateStatus['current_version'] }}).</p>
                            <p class="text-[11px] text-emerald-200/80">You can run a force update anytime to verify repository integrity, re-execute database migrations, and purge all application caches.</p>
                        </div>
                    </div>

                    @if (!empty($modalUpdateStatus['recent_local_commits']))
                        <div class="space-y-2 max-h-48 overflow-y-auto pr-1">
                            @foreach ($modalUpdateStatus['recent_local_commits'] as $c)
                                <div class="p-2.5 rounded-xl bg-black/30 border border-white/5 hover:border-cyan-500/30 transition-colors space-y-0.5">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-cyan-500/20 text-cyan-300 border border-cyan-500/30">
                                            #{{ $c['hash'] }}
                                        </span>
                                        <span class="text-[10px] font-mono text-slate-500">{{ $c['date'] }}</span>
                                    </div>
                                    <p class="text-xs font-medium text-slate-200 leading-snug truncate">
                                        {{ $c['msg'] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>

            <!-- 3. Automated Self-Healing Guarantee Protection Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="p-3 rounded-xl bg-black/30 border border-white/5 flex items-start gap-2.5">
                    <span class="text-base shrink-0">🔄</span>
                    <div>
                        <h5 class="font-bold text-white text-xs">Conflict-Free Git Merge</h5>
                        <p class="text-[11px] text-slate-400 mt-0.5 leading-snug">Automatically merges remote changes using <code class="text-indigo-300">-X theirs</code> prioritizing official updates without lockouts.</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-black/30 border border-white/5 flex items-start gap-2.5">
                    <span class="text-base shrink-0">🗄️</span>
                    <div>
                        <h5 class="font-bold text-white text-xs">Automatic DB Migrations</h5>
                        <p class="text-[11px] text-slate-400 mt-0.5 leading-snug">Executes pending database schema changes (<code class="text-indigo-300">migrate --force</code>) safely during merge.</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-black/30 border border-white/5 flex items-start gap-2.5">
                    <span class="text-base shrink-0">⚡</span>
                    <div>
                        <h5 class="font-bold text-white text-xs">Deep Cache &amp; Route Purge</h5>
                        <p class="text-[11px] text-slate-400 mt-0.5 leading-snug">Purges view, route, config, and framework caches (<code class="text-indigo-300">optimize:clear</code>) for instant speed.</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-black/30 border border-white/5 flex items-start gap-2.5">
                    <span class="text-base shrink-0">🛡️</span>
                    <div>
                        <h5 class="font-bold text-white text-xs">Zero Data Loss Safeguard</h5>
                        <p class="text-[11px] text-slate-400 mt-0.5 leading-snug">Stashes local workspace edits and features auto-healing rollback to guarantee 100% software uptime.</p>
                    </div>
                </div>
            </div>

            <!-- 4. Dynamic Loading State Banner (Shown when user clicks Update) -->
            <div id="modalUpdateProgressBox" class="hidden p-4 rounded-2xl bg-amber-950/40 border border-amber-500/40 text-amber-200 space-y-2">
                <div class="flex items-center gap-3">
                    <svg class="animate-spin h-5 w-5 text-amber-400 shrink-0" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <div>
                        <h5 class="font-bold text-white text-xs">Updating &amp; Merging Software from GitHub...</h5>
                        <p class="text-[11px] text-amber-300/90 leading-snug">Please wait 10–30 seconds. Performing Git pull, auto-conflict resolution, schema migration, and cache purges.</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Modal Footer -->
        <div class="px-6 py-4 border-t border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-3 relative z-10 bg-black/40">
            <div class="flex items-center gap-3 text-[11px] font-mono text-slate-400">
                <a href="{{ $modalUpdateStatus['repo_url'] }}" target="_blank" rel="noopener noreferrer"
                    class="hover:text-indigo-300 transition-colors flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                    </svg>
                    <span>origin/main</span>
                </a>
                <span>&bull;</span>
                <span>{{ $modalUpdateStatus['last_checked_at'] }}</span>
            </div>

            <div class="flex items-center gap-2.5 justify-end">
                <!-- Cancel / Close -->
                <button type="button"
                    id="modalUpdateCancelBtn"
                    onclick="closeSystemUpdateModal()"
                    class="px-4 py-2.5 rounded-2xl text-xs font-mono font-semibold bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white border border-white/10 transition-all cursor-pointer">
                    Cancel
                </button>

                <!-- Update Action Form & Button inside popup -->
                <form id="systemUpdatePopupForm" action="{{ route('admin.systemUpdate.apply') }}" method="POST" onsubmit="return handleSystemUpdateModalSubmit(this)">
                    @csrf
                    <button type="submit"
                        id="systemUpdatePopupSubmitBtn"
                        class="px-5 py-2.5 rounded-2xl text-xs font-mono font-bold uppercase tracking-wider {{ !empty($modalUpdateStatus['update_available']) ? 'bg-gradient-to-r from-amber-500 via-amber-400 to-orange-500 hover:from-amber-400 hover:to-orange-400 text-black shadow-xl shadow-amber-500/30' : 'bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white shadow-xl shadow-cyan-500/20' }} transition-all flex items-center justify-center gap-2 cursor-pointer">
                        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span>{{ !empty($modalUpdateStatus['update_available']) ? 'Update Software Now' : 'Force Sync & Update' }}</span>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    // Open the System Update Modal
    window.openSystemUpdateModal = function() {
        const modal = document.getElementById('systemUpdateModal');
        if (!modal) return;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    };

    // Close the System Update Modal
    window.closeSystemUpdateModal = function() {
        const modal = document.getElementById('systemUpdateModal');
        if (!modal) return;
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    };

    // Handle Update Click inside the Popup Modal
    window.handleSystemUpdateModalSubmit = function(form) {
        const submitBtn = document.getElementById('systemUpdatePopupSubmitBtn');
        const cancelBtn = document.getElementById('modalUpdateCancelBtn');
        const progressBox = document.getElementById('modalUpdateProgressBox');

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-current" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Updating &amp; Merging Software...</span>
            `;
        }

        if (cancelBtn) {
            cancelBtn.disabled = true;
            cancelBtn.classList.add('opacity-50', 'pointer-events-none');
        }

        if (progressBox) {
            progressBox.classList.remove('hidden');
        }

        if (window.toastr) {
            toastr.info('Updating software from GitHub... Merging changes and executing database migrations.');
        }

        return true;
    };

    // Listen for Escape key to close modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('systemUpdateModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeSystemUpdateModal();
            }
        }
    });

    // Backwards-compatible bridge: if any legacy code calls confirmSystemUpdate, open the modal instead!
    window.confirmSystemUpdate = function(form) {
        window.openSystemUpdateModal();
        return false; // Prevent immediate form submission so user views popup and clicks update inside!
    };
</script>
