@extends('admin.layout')

@section('title', 'Add New User')
@section('page_title', 'Create User')
@section('page_subtitle', 'System Accounts')

@section('content')
    <div class="w-full space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-bold text-white">Create New User Account</h1>
            <a href="{{ route('admin.users.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Back to
                Users</a>
        </div>

        @if (isset($errors) && $errors->any())
            <div class="p-3 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST"
            class="p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Full Name *</label>
                    <input type="text" name="name" required value="{{ old('name') }}" placeholder="John Doe"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Email Address *</label>
                    <input type="email" name="email" required value="{{ old('email') }}" placeholder="john@domain.com"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+1 (555) 000-0000"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Account Role *</label>
                    <select name="role"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                        <option value="user">Client User (Frontend Access)</option>
                        <option value="admin">Administrator (Full Admin Access)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-mono text-slate-400 mb-1">Password *</label>
                    <input type="password" name="password" required placeholder="Minimum 6 characters"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500">
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3">
                <a href="{{ route('admin.users.index') }}"
                    class="px-4 py-2.5 rounded-xl text-xs text-slate-400 hover:text-white">Cancel</a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg">
                    Create User
                </button>
            </div>
        </form>
    </div>
@endsection
