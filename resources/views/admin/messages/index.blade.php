@extends('admin.layout')

@section('title', 'Client Inquiries')
@section('page_title', 'Inbox & Inquiries')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-white">Contact Submissions</h1>
                <p class="text-xs text-slate-400">Direct inquiries submitted by visitors from the website contact form.</p>
            </div>
            <span class="text-xs font-mono text-slate-400">{{ $messages->count() }} Total Messages</span>
        </div>

        <!-- TOP THEME FILTER COMPONENT (Select2 / Selectpicker / AngularJS Style) -->
        @include('admin.components.theme-filter', [
            'elementName' => 'Inquiries',
        ])

        <div class="p-6 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-white/10 text-slate-400 font-mono uppercase text-[10px]">
                        <th class="pb-3 pl-3">Status</th>
                        <th class="pb-3">Client</th>
                        <th class="pb-3">Contact</th>
                        <th class="pb-3">Service Interest</th>
                        <th class="pb-3">Received</th>
                        <th class="pb-3 pr-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($messages as $msg)
                        <tr data-theme="all"
                            class="hover:bg-white/[0.02] transition-colors {{ !$msg->is_read ? 'bg-amber-500/[0.03]' : '' }}">
                            <td class="py-4 pl-3">
                                <span
                                    class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase {{ $msg->is_read ? 'bg-slate-800 text-slate-400' : 'bg-amber-500/20 text-amber-300 border border-amber-500/30' }}">
                                    {{ $msg->is_read ? 'Read' : 'New' }}
                                </span>
                            </td>
                            <td class="py-4 font-bold text-white">{{ $msg->name }}</td>
                            <td class="py-4 font-mono text-slate-300">
                                <div>{{ $msg->email }}</div>
                                <div class="text-[10px] text-slate-500">{{ $msg->phone ?? '—' }}</div>
                            </td>
                            <td class="py-4 font-mono text-indigo-400">{{ $msg->service_type ?? 'General' }}</td>
                            <td class="py-4 text-slate-500 font-mono">{{ $msg->created_at->diffForHumans() }}</td>
                            <td class="py-4 pr-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.messages.show', $msg) }}"
                                        class="px-3 py-1 rounded-lg text-xs bg-indigo-600/30 hover:bg-indigo-600 text-indigo-300 hover:text-white transition-colors">
                                        View
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST"
                                        onsubmit="return confirm('Delete this inquiry?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 text-slate-500 hover:text-rose-400">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">No contact inquiries in inbox yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
