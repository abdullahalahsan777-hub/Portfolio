@extends('admin.layout')

@section('title', 'Edit User — ' . $user->name)
@section('page_title', 'Users & Permissions')
@section('page_subtitle', 'System Accounts / Edit Account')

@section('content')
<div class="w-full space-y-6 pb-12">
    <!-- Header Navigation -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-1">
                <a href="{{ route('admin.users.index') }}" class="hover:text-indigo-400 transition-colors">&larr; Users & Permissions</a>
                <span>/</span>
                <a href="{{ route('admin.users.show', $user) }}" class="hover:text-indigo-400 transition-colors">User #{{ $user->id }}</a>
                <span>/</span>
                <span class="text-indigo-400 font-bold">Edit</span>
            </div>
            <h1 class="text-2xl font-black text-white tracking-tight flex items-center gap-3">
                <span>Edit User Account</span>
                <span class="text-sm font-normal text-slate-400">({{ $user->name }})</span>
            </h1>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.users.show', $user) }}"
                class="px-3.5 py-2 rounded-xl text-xs font-mono font-bold text-slate-300 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition-all flex items-center gap-1.5 shadow-sm">
                <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span>View Profile</span>
            </a>
            <a href="{{ route('admin.users.index') }}"
                class="px-3.5 py-2 rounded-xl text-xs font-mono font-bold text-slate-400 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition-all">
                &larr; Back to Users
            </a>
        </div>
    </div>

    @if(isset($errors) && $errors->any())
        <div class="p-4 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-300 text-xs space-y-1">
            <div class="font-bold flex items-center gap-2">
                <svg class="w-4 h-4 text-rose-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Please fix the following validation errors:</span>
            </div>
            <ul class="list-disc list-inside pl-1 text-[11px] text-rose-400 space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Card 1: Avatar & Personal Information -->
        <div class="p-6 sm:p-7 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-6">
            <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                <span class="w-2.5 h-2.5 rounded-full bg-indigo-400"></span>
                <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-indigo-300">Personal & Profile Details</h3>
            </div>

            <!-- Avatar Uploader & Preview -->
            <div class="flex flex-col sm:flex-row items-center gap-5 p-4 rounded-2xl bg-black/30 border border-white/5">
                <div class="relative shrink-0">
                    <img id="avatar-preview"
                        src="{{ !empty($user->avatar) ? (str_starts_with($user->avatar, 'http') ? $user->avatar : asset($user->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=6366f1&color=fff&size=128' }}"
                        alt="{{ $user->name }}"
                        class="w-20 h-20 rounded-2xl object-cover border-2 border-indigo-500/30 shadow-lg bg-slate-900">
                </div>
                <div class="flex-1 w-full space-y-1.5">
                    <label class="block text-xs font-mono text-slate-300 font-bold">Profile Photo / Avatar</label>
                    <input type="file" name="avatar" accept="image/*" onchange="previewUserAvatar(event)"
                        class="w-full px-3 py-2 rounded-xl bg-[#060b13] border border-white/10 text-slate-300 text-xs file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-indigo-600/20 file:text-indigo-300 hover:file:bg-indigo-600/30 cursor-pointer">
                    <p class="text-[10px] text-slate-500 font-mono">Accepts JPG, PNG, WEBP, or SVG under 2MB. Leave empty to keep existing image.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Full Name *</label>
                    <input type="text" name="name" required value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs sm:text-sm focus:outline-none focus:border-indigo-500 transition-colors">
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Email Address *</label>
                    <input type="email" name="email" required value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs sm:text-sm font-mono focus:outline-none focus:border-indigo-500 transition-colors">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+1 (555) 000-0000"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs sm:text-sm font-mono focus:outline-none focus:border-indigo-500 transition-colors">
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1.5">Location / City</label>
                    <input type="text" name="location" value="{{ old('location', $user->location) }}" placeholder="e.g. New York, USA"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs sm:text-sm focus:outline-none focus:border-indigo-500 transition-colors">
                </div>
            </div>

            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1.5">Biography / Notes</label>
                <textarea name="bio" rows="3" placeholder="Brief background, specialization, or notes about this user..."
                    class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs sm:text-sm leading-relaxed focus:outline-none focus:border-indigo-500 transition-colors resize-none">{{ old('bio', $user->bio) }}</textarea>
            </div>
        </div>

        <!-- Card 2: Role & Permissions -->
        <div class="p-6 sm:p-7 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
            <div class="flex items-center gap-2 pb-3 border-b border-white/5">
                <span class="w-2.5 h-2.5 rounded-full bg-purple-400"></span>
                <h3 class="text-xs font-mono font-bold uppercase tracking-wider text-purple-300">Account Role & Access Privileges</h3>
            </div>

            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1.5">Assigned System Role *</label>
                @if($user->id === auth()->id())
                    <input type="hidden" name="role" value="admin">
                    <div class="p-3.5 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span class="text-xs font-bold text-white uppercase font-mono">Administrator (Full Access)</span>
                        </div>
                        <span class="text-[10px] font-mono text-indigo-300">Current session cannot be demoted</span>
                    </div>
                @else
                    <select name="role" class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs sm:text-sm focus:outline-none focus:border-indigo-500 transition-colors">
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Client User (Frontend client portal access)</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrator (Complete studio & management panel access)</option>
                    </select>
                @endif
                <p class="text-[10px] text-slate-500 mt-1 font-mono">Administrators have full administrative authority including settings, users, and content controls.</p>
            </div>
        </div>

        <!-- Form Actions Bar -->
        <div class="p-5 rounded-2xl bg-[#09101d] border border-white/10 shadow-xl flex flex-col sm:flex-row items-center justify-between gap-3">
            <a href="{{ route('admin.users.index') }}"
                class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-xs font-mono font-bold text-slate-400 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition-all text-center">
                Cancel
            </a>

            <div class="flex items-center gap-2.5 w-full sm:w-auto">
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg shadow-indigo-600/30 transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Save Changes</span>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function previewUserAvatar(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('avatar-preview');
                if (preview) {
                    preview.src = e.target.result;
                }
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
