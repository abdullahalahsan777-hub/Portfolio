@extends('admin.layout')

@section('title', 'View User — ' . $user->name)
@section('page_title', 'Users & Permissions')
@section('page_subtitle', 'System Accounts / View Profile')

@section('content')
<div class="space-y-6 max-w-5xl">
    <!-- Header Navigation & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-1">
                <a href="{{ route('admin.users.index') }}" class="hover:text-indigo-400 transition-colors">&larr; Users & Permissions</a>
                <span>/</span>
                <span class="text-indigo-400 font-bold">User #{{ $user->id }}</span>
            </div>
            <h1 class="text-2xl font-black text-white tracking-tight flex items-center gap-3">
                <span>{{ $user->name }}</span>
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-mono font-bold uppercase {{ $user->isAdmin() ? 'bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 shadow-sm shadow-indigo-500/20' : 'bg-slate-800 text-slate-400 border border-white/5' }}">
                    {{ $user->role }}
                </span>
                @if($user->id === auth()->id())
                    <span class="px-2 py-0.5 rounded-md text-[10px] font-mono font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/30">
                        Current Session
                    </span>
                @endif
            </h1>
        </div>

        <div class="flex items-center gap-2.5 flex-wrap">
            <a href="{{ route('admin.users.index') }}"
                class="px-3.5 py-2 rounded-xl text-xs font-mono font-bold text-slate-300 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition-all flex items-center gap-1.5 shadow-sm">
                &larr; Back to List
            </a>
            <a href="{{ route('admin.users.edit', $user) }}"
                class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 shadow-lg shadow-indigo-600/30 transition-all flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span>Edit User</span>
            </a>
            @if($user->id !== auth()->id())
                <form action="{{ route('admin.users.toggleRole', $user) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="px-3.5 py-2 rounded-xl text-xs font-mono font-bold {{ $user->isAdmin() ? 'text-amber-300 hover:text-amber-200 bg-amber-500/10 hover:bg-amber-500/20 border border-amber-500/30' : 'text-indigo-300 hover:text-indigo-200 bg-indigo-500/10 hover:bg-indigo-500/20 border border-indigo-500/30' }} transition-all flex items-center gap-1.5 cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span>{{ $user->isAdmin() ? 'Make User' : 'Make Admin' }}</span>
                    </button>
                </form>

                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                    onsubmit="return confirm('Permanently delete user [{{ $user->name }}]? This action cannot be undone.')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-3 py-2 rounded-xl text-xs font-mono font-bold text-rose-400 hover:text-white bg-rose-500/10 hover:bg-rose-500/30 border border-rose-500/20 transition-all flex items-center gap-1.5 cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span>Delete</span>
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Hero Card Profile Banner -->
    <div class="rounded-3xl bg-[#09101d] border border-white/10 shadow-2xl p-6 sm:p-8 relative overflow-hidden">
        <!-- Top Gradient Line -->
        <div class="h-1 w-full absolute top-0 left-0 right-0" style="background: linear-gradient(90deg, #6366f1, #8b5cf6, #ec4899);"></div>

        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 relative z-10">
            <!-- Avatar Display -->
            <div class="relative shrink-0">
                @if(!empty($user->avatar))
                    <img src="{{ str_starts_with($user->avatar, 'http') ? $user->avatar : asset($user->avatar) }}"
                        alt="{{ $user->name }}"
                        class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl object-cover border-2 border-indigo-500/40 shadow-xl bg-slate-900">
                @else
                    <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl {{ $user->isAdmin() ? 'bg-gradient-to-br from-indigo-600 to-purple-700 text-white shadow-indigo-600/30' : 'bg-gradient-to-br from-slate-700 to-slate-900 text-slate-300' }} border-2 border-white/10 shadow-xl flex items-center justify-center font-black text-3xl font-mono">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
                <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-lg bg-[#09101d] border border-white/10 flex items-center justify-center shadow">
                    @if($user->isAdmin())
                        <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    @else
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    @endif
                </div>
            </div>

            <!-- Profile Info Summary -->
            <div class="space-y-2 flex-1 min-w-0">
                <div class="flex items-center gap-3 flex-wrap">
                    <h2 class="text-xl sm:text-2xl font-black text-white tracking-tight truncate">{{ $user->name }}</h2>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-mono font-bold uppercase {{ $user->isAdmin() ? 'bg-indigo-500/20 text-indigo-300 border border-indigo-500/30' : 'bg-slate-800 text-slate-400' }}">
                        {{ $user->role }}
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-400 font-mono flex items-center gap-2 flex-wrap">
                    <span class="text-slate-300">{{ $user->email }}</span>
                    @if($user->phone)
                        <span>•</span>
                        <span>{{ $user->phone }}</span>
                    @endif
                    @if($user->location)
                        <span>•</span>
                        <span>{{ $user->location }}</span>
                    @endif
                </p>
                @if($user->bio)
                    <p class="text-xs text-slate-300 leading-relaxed pt-1 max-w-2xl italic">{{ $user->bio }}</p>
                @endif
            </div>

            <!-- Fast Stat Pill Badges -->
            <div class="flex sm:flex-col items-center sm:items-end gap-2 shrink-0 border-t sm:border-t-0 sm:border-l border-white/10 pt-4 sm:pt-0 sm:pl-6 w-full sm:w-auto justify-between">
                <div class="text-left sm:text-right">
                    <span class="block text-[10px] font-mono text-slate-500 uppercase">Joined</span>
                    <span class="text-xs font-mono font-bold text-slate-300">{{ $user->created_at->format('M d, Y') }}</span>
                </div>
                <div class="text-left sm:text-right">
                    <span class="block text-[10px] font-mono text-slate-500 uppercase">Account Status</span>
                    <span class="inline-flex items-center gap-1.5 text-xs font-mono font-bold text-emerald-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Active
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Information Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- 1. Account & Identity Details -->
        <div class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
            <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                <span class="w-2.5 h-2.5 rounded-full bg-indigo-400"></span>
                <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-indigo-300">Identity & Contact</h3>
            </div>
            <dl class="space-y-3.5 text-xs">
                <div class="flex items-center justify-between py-1 border-b border-white/5">
                    <dt class="font-mono text-slate-400">Full Name</dt>
                    <dd class="font-bold text-white text-right">{{ $user->name }}</dd>
                </div>
                <div class="flex items-center justify-between py-1 border-b border-white/5">
                    <dt class="font-mono text-slate-400">Email Address</dt>
                    <dd class="font-mono text-indigo-300 text-right">{{ $user->email }}</dd>
                </div>
                <div class="flex items-center justify-between py-1 border-b border-white/5">
                    <dt class="font-mono text-slate-400">Phone Contact</dt>
                    <dd class="font-mono text-slate-200 text-right">{{ $user->phone ?? 'Not specified' }}</dd>
                </div>
                <div class="flex items-center justify-between py-1 border-b border-white/5">
                    <dt class="font-mono text-slate-400">Location / City</dt>
                    <dd class="text-slate-200 text-right">{{ $user->location ?? 'Not specified' }}</dd>
                </div>
                <div class="flex items-center justify-between py-1">
                    <dt class="font-mono text-slate-400">Assigned Role</dt>
                    <dd>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold uppercase {{ $user->isAdmin() ? 'bg-indigo-500/20 text-indigo-300 border border-indigo-500/30' : 'bg-slate-800 text-slate-400' }}">
                            {{ $user->role }}
                        </span>
                    </dd>
                </div>
            </dl>
        </div>

        <!-- 2. Security & Authentication -->
        <div class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
            <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-emerald-300">Authentication & Access</h3>
            </div>
            <dl class="space-y-3.5 text-xs">
                <div class="flex items-center justify-between py-1 border-b border-white/5">
                    <dt class="font-mono text-slate-400">Auth Method</dt>
                    <dd class="font-mono text-slate-200 text-right">
                        @if(!empty($user->provider))
                            <span class="capitalize text-cyan-400 font-bold">{{ $user->provider }} OAuth</span>
                        @else
                            <span class="text-slate-300">Local Email & Password</span>
                        @endif
                    </dd>
                </div>
                <div class="flex items-center justify-between py-1 border-b border-white/5">
                    <dt class="font-mono text-slate-400">Password Security</dt>
                    <dd class="font-mono text-emerald-400 text-right flex items-center gap-1.5 justify-end">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span>Encrypted (Bcrypt)</span>
                    </dd>
                </div>
                <div class="flex items-center justify-between py-1 border-b border-white/5">
                    <dt class="font-mono text-slate-400">System User ID</dt>
                    <dd class="font-mono text-slate-400 text-right">#UID-{{ sprintf('%04d', $user->id) }}</dd>
                </div>
                <div class="flex items-center justify-between py-1 border-b border-white/5">
                    <dt class="font-mono text-slate-400">Account Created</dt>
                    <dd class="font-mono text-slate-300 text-right">{{ $user->created_at->format('M d, Y • h:i A') }}</dd>
                </div>
                <div class="flex items-center justify-between py-1">
                    <dt class="font-mono text-slate-400">Last Profile Update</dt>
                    <dd class="font-mono text-slate-300 text-right">{{ $user->updated_at->diffForHumans() }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Biography / Notes Box if present -->
    @if($user->bio)
        <div class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-2">
            <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-slate-400">Biography / User Notes</h3>
            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">{{ $user->bio }}</p>
        </div>
    @endif
</div>
@endsection
