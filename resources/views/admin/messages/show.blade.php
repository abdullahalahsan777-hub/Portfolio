@extends('admin.layout')

@section('title', 'View Inquiry')
@section('page_title', 'Message Details')
@section('page_subtitle', 'Group: Website')

@push('styles')
    <style>
        /* =========================================================================
                                       COMPOSER THEME STYLING (Dark Obsidian Mode & Clean Light Mode)
                                       ========================================================================= */
        /* Dark Theme (Default - Matches Admin Obsidian Aesthetic) */
        .composer-dark {
            background-color: #09101d !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
            color: #f1f5f9 !important;
        }

        .composer-dark #composer_header {
            background-color: #0d1627 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
        }

        .composer-dark .composer-title {
            color: #ffffff !important;
        }

        .composer-dark .composer-header-actions button {
            color: #94a3b8 !important;
        }

        .composer-dark .composer-header-actions button:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
        }

        .composer-dark #composer_body_section {
            background-color: #09101d !important;
        }

        .composer-dark #row_to,
        .composer-dark #composer_cc_row,
        .composer-dark #composer_bcc_row,
        .composer-dark #row_subject {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        .composer-dark .composer-label {
            color: #94a3b8 !important;
        }

        .composer-dark .composer-input {
            color: #ffffff !important;
        }

        .composer-dark .composer-input::placeholder {
            color: #64748b !important;
        }

        .composer-dark .composer-textarea {
            color: #f1f5f9 !important;
        }

        .composer-dark .composer-textarea::placeholder {
            color: #64748b !important;
        }

        .composer-dark .composer-chip {
            background-color: #0d1627 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #cbd5e1 !important;
        }

        .composer-dark #composer_footer {
            background-color: #09101d !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        .composer-dark .composer-icon-btn {
            color: #94a3b8 !important;
        }

        .composer-dark .composer-icon-btn:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
        }

        .composer-dark .composer-menu {
            background-color: #0d1627 !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
            color: #f1f5f9 !important;
        }

        .composer-dark .composer-menu button:hover {
            background-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* Light Theme (Clean Mail Mode) */
        .composer-light {
            background-color: #ffffff !important;
            border-color: #cbd5e1 !important;
            color: #1e293b !important;
        }

        .composer-light #composer_header {
            background-color: #f2f6fc !important;
            border-color: #e2e8f0 !important;
        }

        .composer-light .composer-title {
            color: #1f2937 !important;
        }

        .composer-light .composer-header-actions button {
            color: #4b5563 !important;
        }

        .composer-light .composer-header-actions button:hover {
            background-color: #e2e8f0 !important;
            color: #111827 !important;
        }

        .composer-light #composer_body_section {
            background-color: #ffffff !important;
        }

        .composer-light #row_to,
        .composer-light #composer_cc_row,
        .composer-light #composer_bcc_row,
        .composer-light #row_subject {
            border-color: #f1f5f9 !important;
        }

        .composer-light .composer-label {
            color: #64748b !important;
        }

        .composer-light .composer-input {
            color: #0f172a !important;
        }

        .composer-light .composer-input::placeholder {
            color: #94a3b8 !important;
        }

        .composer-light .composer-textarea {
            color: #1e293b !important;
        }

        .composer-light .composer-textarea::placeholder {
            color: #94a3b8 !important;
        }

        .composer-light .composer-chip {
            background-color: #f8fafc !important;
            border-color: #e2e8f0 !important;
            color: #334155 !important;
        }

        .composer-light #composer_footer {
            background-color: #ffffff !important;
            border-color: #f1f5f9 !important;
        }

        .composer-light .composer-icon-btn {
            color: #64748b !important;
        }

        .composer-light .composer-icon-btn:hover {
            background-color: #f1f5f9 !important;
            color: #0f172a !important;
        }

        .composer-light .composer-menu {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            color: #334155 !important;
        }

        .composer-light .composer-menu button:hover {
            background-color: #f1f5f9 !important;
        }
    </style>
@endpush

@section('content')
    <div class="max-full space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.messages.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Back to
                Inbox</a>
            <div class="flex items-center gap-2">
                <form action="{{ route('admin.messages.toggleRead', $message) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-3 py-1.5 rounded-lg text-xs bg-slate-800 hover:bg-slate-700 text-slate-300">
                        Mark as {{ $message->is_read ? 'Unread' : 'Read' }}
                    </button>
                </form>
                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                    onsubmit="return confirm('Delete this inquiry?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-3 py-1.5 rounded-lg text-xs bg-rose-500/20 hover:bg-rose-500/30 text-rose-300">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <!-- Alert / Flash Message container -->
        <div id="reply_status_alert"
            class="hidden p-4 rounded-2xl text-xs flex items-center justify-between transition-all">
            <div class="flex items-center gap-2 font-semibold" id="reply_status_text"></div>
            <button type="button" onclick="document.getElementById('reply_status_alert').classList.add('hidden')"
                class="text-slate-400 hover:text-white">&times;</button>
        </div>

        <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-6">
            <div class="border-b border-white/10 pb-6 flex items-start justify-between gap-4">
                <div>
                    <!-- Subject & Service Type Badge -->
                    <div class="flex items-center gap-2 flex-wrap mb-2">
                        <span
                            class="px-2.5 py-1 rounded-full text-[10px] font-mono font-bold uppercase bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                            {{ $message->subject ?: ($message->service_type ?: 'General Inquiry') }}
                        </span>
                        @if (!empty($message->service_type) && !empty($message->subject) && $message->service_type !== $message->subject)
                            <span
                                class="px-2.5 py-0.5 rounded-full text-[10px] font-mono text-slate-400 bg-white/5 border border-white/10">
                                Service: {{ $message->service_type }}
                            </span>
                        @endif
                    </div>

                    <!-- Client Name -->
                    <h1 class="text-2xl font-extrabold text-white">{{ $message->name }}</h1>

                    <!-- Subject & Service Details Row -->
                    <div class="mt-2.5 flex items-center gap-2 text-xs font-mono text-slate-300 flex-wrap">
                        <span class="text-slate-500 uppercase tracking-wider">Subject:</span>
                        <span
                            class="font-bold text-indigo-300">{{ $message->subject ?: ($message->service_type ?: 'General Inquiry') }}</span>
                        @if (!empty($message->service_type) && $message->service_type !== $message->subject)
                            <span class="text-slate-600">•</span>
                            <span class="text-slate-500 uppercase tracking-wider">Service:</span>
                            <span class="text-slate-300 font-semibold">{{ $message->service_type }}</span>
                        @endif
                    </div>

                    <!-- Contact Info -->
                    <div class="text-xs font-mono text-slate-400 mt-2 flex flex-wrap gap-4">
                        <span>Email: <a href="mailto:{{ $message->email }}"
                                class="text-indigo-400 hover:underline">{{ $message->email }}</a></span>
                        @if ($message->phone)
                            <span>Phone: <a href="tel:{{ $message->phone }}"
                                    class="text-slate-300">{{ $message->phone }}</a></span>
                        @endif
                    </div>
                </div>
                <div class="text-xs font-mono text-slate-500 text-right shrink-0">
                    {{ $message->created_at->format('M d, Y h:i A') }}
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-mono uppercase text-slate-400 tracking-wider">Message Content</label>
                <div
                    class="p-6 rounded-2xl bg-black/40 border border-white/5 text-slate-200 text-sm leading-relaxed whitespace-pre-wrap">
                    {{ $message->message }}
                </div>
            </div>

            <div class="pt-4 border-t border-white/10 flex items-center justify-between flex-wrap gap-3">
                <div class="flex items-center gap-3">
                    <button type="button" onclick="openComposer()"
                        class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg flex items-center gap-2 transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>Reply via Email</span> &rarr;
                    </button>
                    <a href="{{ route('admin.messages.previewReply', $message) }}" target="_blank"
                        class="px-4 py-2 rounded-xl text-xs font-mono font-medium bg-white/5 hover:bg-white/10 text-slate-300 border border-white/10 transition-all flex items-center gap-1.5"
                        title="Preview rendered HTML email reply template">
                        <span>Preview Template</span>
                        <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>
                <div class="flex items-center gap-3 text-xs font-mono text-slate-500">
                    <span class="inline-flex items-center gap-1 text-[11px] text-emerald-400 font-mono">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Queue Worker Active
                    </span>
                    <span>ID: #{{ $message->id }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- =========================================================================
                                     POPUP EMAIL COMPOSER (Supports Dark & Light Theme)
                                     ========================================================================= -->
    <div id="mail_composer_modal" class="hidden fixed z-50 transition-all duration-200">
        <!-- Main Composer Window -->
        <div id="composer_window"
            class="w-[580px] max-w-[95vw] rounded-t-2xl shadow-2xl border flex flex-col font-sans overflow-hidden transition-all duration-200 composer-dark">

            <!-- Window Title Bar -->
            <div id="composer_header"
                class="px-4 py-2.5 flex items-center justify-between border-b select-none cursor-pointer"
                onclick="handleHeaderBarClick(event)">
                <div class="flex items-center gap-2 overflow-hidden">
                    <span class="text-xs sm:text-sm font-semibold composer-title">Reply via Email</span>
                    <span class="text-[9px] font-mono px-1.5 py-0.5 rounded bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">Queued</span>
                    <span id="composer_minimized_snippet" class="hidden text-xs truncate max-w-[260px] opacity-70">
                        — {{ $message->email }}
                    </span>
                </div>
                <div class="flex items-center gap-1 composer-header-actions">
                    <!-- Theme Mode Toggle (Dark / Light) -->
                    <button type="button" onclick="toggleComposerTheme(event)" id="composer_theme_btn"
                        title="Toggle Dark / Light Theme"
                        class="w-7 h-7 flex items-center justify-center rounded transition-colors cursor-pointer">
                        <!-- Sun icon (shown in dark mode) -->
                        <svg id="theme_icon_sun" class="w-3.5 h-3.5 text-amber-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <!-- Moon icon (shown in light mode) -->
                        <svg id="theme_icon_moon" class="w-3.5 h-3.5 text-slate-600 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <!-- Minimize button -->
                    <button type="button" onclick="toggleMinimizeComposer(event)" title="Minimize"
                        class="w-7 h-7 flex items-center justify-center rounded transition-colors cursor-pointer">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                    </button>
                    <!-- Maximize / Restore button -->
                    <button type="button" onclick="toggleMaximizeComposer(event)" id="composer_expand_btn"
                        title="Full screen"
                        class="w-7 h-7 flex items-center justify-center rounded transition-colors cursor-pointer">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <polyline points="9 21 3 21 3 15"></polyline>
                            <line x1="21" y1="3" x2="14" y2="10"></line>
                            <line x1="3" y1="21" x2="10" y2="14"></line>
                        </svg>
                    </button>
                    <!-- Close button -->
                    <button type="button" onclick="closeComposer(event)" title="Save & Close"
                        class="w-7 h-7 flex items-center justify-center rounded transition-colors cursor-pointer">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Composer Body Container -->
            <div id="composer_body_section" class="flex flex-col">
                <form id="mail_composer_form" onsubmit="sendReplyViaAjax(event)" class="flex flex-col">
                    @csrf

                    <!-- "To" Field Row -->
                    <div id="row_to" class="px-4 py-2 border-b flex items-center gap-2">
                        <span class="text-xs font-medium select-none w-8 composer-label">To</span>
                        <input type="email" name="to" id="composer_to_input" required
                            value="{{ $message->email }}"
                            class="flex-1 bg-transparent text-xs sm:text-sm border-0 focus:outline-none focus:ring-0 p-0 composer-input">
                        <div class="flex items-center gap-2 text-xs select-none composer-label">
                            <button type="button" onclick="toggleCcRow()"
                                class="hover:underline font-medium cursor-pointer">Cc</button>
                            <button type="button" onclick="toggleBccRow()"
                                class="hover:underline font-medium cursor-pointer">Bcc</button>
                        </div>
                    </div>

                    <!-- Cc Row (collapsible) -->
                    <div id="composer_cc_row" class="hidden px-4 py-1.5 border-b flex items-center gap-2">
                        <span class="text-xs font-medium select-none w-8 composer-label">Cc</span>
                        <input type="text" name="cc" id="composer_cc_input"
                            placeholder="Recipients (comma separated)"
                            class="flex-1 bg-transparent text-xs sm:text-sm border-0 focus:outline-none focus:ring-0 p-0 composer-input">
                    </div>

                    <!-- Bcc Row (collapsible) -->
                    <div id="composer_bcc_row" class="hidden px-4 py-1.5 border-b flex items-center gap-2">
                        <span class="text-xs font-medium select-none w-8 composer-label">Bcc</span>
                        <input type="text" name="bcc" id="composer_bcc_input"
                            placeholder="Recipients (comma separated)"
                            class="flex-1 bg-transparent text-xs sm:text-sm border-0 focus:outline-none focus:ring-0 p-0 composer-input">
                    </div>

                    <!-- Subject Field Row -->
                    <div id="row_subject" class="px-4 py-2 border-b">
                        <input type="text" name="subject" id="composer_subject_input" required
                            value="Re: {{ $message->subject ?: ($message->service_type ?: 'Portfolio Inquiry') }}"
                            placeholder="Subject"
                            class="w-full bg-transparent text-xs sm:text-sm border-0 focus:outline-none focus:ring-0 p-0 font-medium composer-input">
                    </div>

                    <!-- Main Message Body Textarea -->
                    <div id="row_body" class="p-4 flex-1">
                        <textarea name="body" id="composer_text_body" rows="11" required
                            class="w-full border-0 focus:outline-none focus:ring-0 p-0 text-xs sm:text-sm leading-relaxed resize-none font-sans composer-textarea"
                            placeholder="Write your email reply here...">Hi {{ $message->name }},&#10;&#10;Thank you for reaching out regarding {{ $message->service_type ?? 'your project' }}.&#10;&#10;&#10;Best regards,&#10;{{ auth()->user()->name ?? 'Alex Rivera' }}</textarea>
                    </div>

                    <!-- Attachment preview chip -->
                    <div id="attachment_preview_chip"
                        class="hidden px-4 py-2 border-t flex items-center justify-between text-xs composer-chip">
                        <div class="flex items-center gap-2 truncate">
                            <svg class="w-3.5 h-3.5 text-blue-500 shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg>
                            <span id="attachment_name" class="font-medium truncate max-w-[280px]">file.pdf</span>
                            <span id="attachment_size" class="text-[10px] opacity-60 font-mono"></span>
                        </div>
                        <button type="button" onclick="removeAttachment()" title="Remove file"
                            class="opacity-60 hover:opacity-100 hover:text-rose-400 text-xs px-1 font-bold cursor-pointer">&times;</button>
                    </div>

                    <!-- Bottom Toolbar (ONLY Send btn, Attested file btn, and Delete btn) -->
                    <div id="composer_footer" class="px-4 py-3 border-t flex items-center justify-between">
                        <!-- Left: Send button + Attested file button -->
                        <div class="flex items-center gap-2.5">
                            <!-- Send Button with dropup options -->
                            <div
                                class="relative inline-flex items-center rounded-full bg-[#0b57d0] hover:bg-[#0842a0] text-white shadow-sm transition-all">
                                <button type="submit" id="send_submit_btn"
                                    class="pl-4 pr-3 py-2 text-xs sm:text-sm font-semibold flex items-center gap-1.5 focus:outline-none cursor-pointer">
                                    <span id="send_btn_label">Send</span>
                                </button>
                                <span class="w-[1px] h-4 bg-white/30"></span>
                                <button type="button" onclick="toggleSendMenu(event)" id="send_dropdown_trigger"
                                    class="px-2 py-2 hover:bg-black/10 rounded-r-full focus:outline-none cursor-pointer"
                                    title="Send options">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!-- Send Options Dropdown Popover -->
                                <div id="send_options_menu"
                                    class="hidden absolute left-0 bottom-full mb-2 w-56 rounded-xl border shadow-xl py-1.5 text-xs z-50 text-left font-sans composer-menu">
                                    <button type="submit"
                                        class="w-full text-left px-3.5 py-2 flex items-center gap-2 cursor-pointer">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                        <span>Send via SMTP Server</span>
                                    </button>
                                    <button type="button" onclick="openNativeMailClient()"
                                        class="w-full text-left px-3.5 py-2 flex items-center gap-2 border-t border-white/5 cursor-pointer">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <span>Open in Email App (mailto)</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Attested file (Attach file) button -->
                            <button type="button" onclick="triggerAttachmentPicker()" title="Attach file"
                                class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer composer-icon-btn">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                            </button>
                            <input type="file" id="composer_attachment_input" name="attachment" class="hidden"
                                onchange="handleAttachmentSelected(this)">
                            <a href="{{ route('admin.messages.previewReply', $message) }}" target="_blank"
                                class="text-[11px] font-mono text-slate-400 hover:text-indigo-300 ml-1 transition-colors hidden sm:inline-block"
                                title="Preview how this reply email looks">
                                Preview Template &nearr;
                            </a>
                        </div>

                        <!-- Right: Delete / Discard draft button -->
                        <button type="button" onclick="discardComposerDraft()" title="Delete draft"
                            class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer composer-icon-btn hover:text-rose-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- =========================================================================
                                     JAVASCRIPT LOGIC FOR MAIL COMPOSER
                                     ========================================================================= -->
    <script>
        let isComposerMinimized = false;
        let isComposerMaximized = false;

        // Theme Management: Dark / Light Mode
        function setComposerTheme(theme) {
            const win = document.getElementById('composer_window');
            const sunIcon = document.getElementById('theme_icon_sun');
            const moonIcon = document.getElementById('theme_icon_moon');

            if (theme === 'light') {
                win.classList.remove('composer-dark');
                win.classList.add('composer-light');
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
                localStorage.setItem('composer_theme', 'light');
            } else {
                win.classList.remove('composer-light');
                win.classList.add('composer-dark');
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
                localStorage.setItem('composer_theme', 'dark');
            }
        }

        function toggleComposerTheme(e) {
            if (e) e.stopPropagation();
            const win = document.getElementById('composer_window');
            const currentTheme = win.classList.contains('composer-light') ? 'light' : 'dark';
            setComposerTheme(currentTheme === 'light' ? 'dark' : 'light');
        }

        // Apply saved theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('composer_theme') || 'dark';
            setComposerTheme(savedTheme);
        });

        function openComposer() {
            const modal = document.getElementById('mail_composer_modal');
            const win = document.getElementById('composer_window');
            const bodySection = document.getElementById('composer_body_section');
            const snippet = document.getElementById('composer_minimized_snippet');

            modal.classList.remove('hidden');
            modal.className = 'fixed bottom-0 right-4 sm:right-8 z-50 transition-all duration-200';
            win.classList.remove('w-72');
            win.classList.add('w-[580px]');
            bodySection.classList.remove('hidden');
            snippet.classList.add('hidden');
            isComposerMinimized = false;
            isComposerMaximized = false;

            // Focus on body
            setTimeout(() => {
                const bodyInput = document.getElementById('composer_text_body');
                bodyInput?.focus();
            }, 100);
        }

        function closeComposer(e) {
            if (e) e.stopPropagation();
            document.getElementById('mail_composer_modal').classList.add('hidden');
            document.getElementById('send_options_menu').classList.add('hidden');
        }

        function toggleMinimizeComposer(e) {
            if (e) e.stopPropagation();
            const win = document.getElementById('composer_window');
            const bodySection = document.getElementById('composer_body_section');
            const snippet = document.getElementById('composer_minimized_snippet');

            if (!isComposerMinimized) {
                bodySection.classList.add('hidden');
                snippet.classList.remove('hidden');
                win.classList.remove('w-[580px]');
                win.classList.add('w-72');
                isComposerMinimized = true;
            } else {
                bodySection.classList.remove('hidden');
                snippet.classList.add('hidden');
                win.classList.remove('w-72');
                win.classList.add('w-[580px]');
                isComposerMinimized = false;
            }
        }

        function handleHeaderBarClick(e) {
            if (isComposerMinimized) {
                toggleMinimizeComposer(e);
            }
        }

        function toggleMaximizeComposer(e) {
            if (e) e.stopPropagation();
            const modal = document.getElementById('mail_composer_modal');
            const win = document.getElementById('composer_window');
            const bodySection = document.getElementById('composer_body_section');
            const snippet = document.getElementById('composer_minimized_snippet');

            if (isComposerMinimized) {
                bodySection.classList.remove('hidden');
                snippet.classList.add('hidden');
                isComposerMinimized = false;
            }

            if (!isComposerMaximized) {
                modal.className =
                    'fixed inset-4 sm:inset-10 z-50 flex items-center justify-center transition-all duration-200';
                win.className =
                    'w-full h-full max-w-4xl rounded-2xl shadow-2xl border flex flex-col font-sans overflow-hidden transition-all duration-200 ' +
                    (win.classList.contains('composer-light') ? 'composer-light' : 'composer-dark');
                isComposerMaximized = true;
            } else {
                modal.className = 'fixed bottom-0 right-4 sm:right-8 z-50 transition-all duration-200';
                win.className =
                    'w-[580px] max-w-[95vw] rounded-t-2xl shadow-2xl border flex flex-col font-sans overflow-hidden transition-all duration-200 ' +
                    (win.classList.contains('composer-light') ? 'composer-light' : 'composer-dark');
                isComposerMaximized = false;
            }
        }

        function toggleCcRow() {
            const row = document.getElementById('composer_cc_row');
            row.classList.toggle('hidden');
            if (!row.classList.contains('hidden')) {
                document.getElementById('composer_cc_input').focus();
            }
        }

        function toggleBccRow() {
            const row = document.getElementById('composer_bcc_row');
            row.classList.toggle('hidden');
            if (!row.classList.contains('hidden')) {
                document.getElementById('composer_bcc_input').focus();
            }
        }

        function toggleSendMenu(e) {
            if (e) e.stopPropagation();
            const menu = document.getElementById('send_options_menu');
            menu.classList.toggle('hidden');
        }

        // Close send menu when clicking outside
        document.addEventListener('click', function(e) {
            const menu = document.getElementById('send_options_menu');
            if (menu && !e.target.closest('#send_dropdown_trigger') && !e.target.closest('#send_options_menu')) {
                menu.classList.add('hidden');
            }
        });

        function openNativeMailClient() {
            const to = document.getElementById('composer_to_input').value;
            const subject = encodeURIComponent(document.getElementById('composer_subject_input').value);
            const body = encodeURIComponent(document.getElementById('composer_text_body').value);
            window.location.href = `mailto:${to}?subject=${subject}&body=${body}`;
            closeComposer();
        }

        function discardComposerDraft() {
            if (confirm('Delete this draft reply?')) {
                closeComposer();
                removeAttachment();
            }
        }

        function triggerAttachmentPicker() {
            document.getElementById('composer_attachment_input').click();
        }

        function handleAttachmentSelected(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const chip = document.getElementById('attachment_preview_chip');
                const nameEl = document.getElementById('attachment_name');
                const sizeEl = document.getElementById('attachment_size');

                nameEl.textContent = file.name;
                const sizeKB = (file.size / 1024).toFixed(1);
                sizeEl.textContent = `(${sizeKB} KB)`;
                chip.classList.remove('hidden');
            }
        }

        function removeAttachment() {
            const input = document.getElementById('composer_attachment_input');
            input.value = '';
            document.getElementById('attachment_preview_chip').classList.add('hidden');
        }

        async function sendReplyViaAjax(e) {
            e.preventDefault();

            const sendBtn = document.getElementById('send_submit_btn');
            const btnLabel = document.getElementById('send_btn_label');
            const alertBox = document.getElementById('reply_status_alert');
            const alertText = document.getElementById('reply_status_text');

            const to = document.getElementById('composer_to_input').value;
            const subject = document.getElementById('composer_subject_input').value;
            const body = document.getElementById('composer_text_body').value;
            const cc = document.getElementById('composer_cc_input')?.value || '';
            const bcc = document.getElementById('composer_bcc_input')?.value || '';

            const formData = new FormData();
            formData.append('to', to);
            formData.append('subject', subject);
            formData.append('body', body);
            formData.append('cc', cc);
            formData.append('bcc', bcc);

            const fileInput = document.getElementById('composer_attachment_input');
            if (fileInput && fileInput.files[0]) {
                formData.append('attachment', fileInput.files[0]);
            }

            // Loading state
            sendBtn.disabled = true;
            btnLabel.innerHTML =
                `<svg class="animate-spin h-3.5 w-3.5 text-white inline-block mr-1" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg> Sending...`;

            try {
                const response = await fetch("{{ route('admin.messages.reply', $message) }}", {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    closeComposer();
                    removeAttachment();

                    // Show success alert
                    alertBox.className =
                        'p-4 rounded-2xl text-xs flex items-center justify-between transition-all bg-emerald-500/10 border border-emerald-500/20 text-emerald-300';
                    alertText.innerHTML = `
                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>${data.message || 'Reply sent successfully!'}</span>
                `;
                    alertBox.classList.remove('hidden');
                } else {
                    throw new Error(data.message || 'Failed to send reply email.');
                }
            } catch (err) {
                console.error(err);
                alertBox.className =
                    'p-4 rounded-2xl text-xs flex items-center justify-between transition-all bg-rose-500/10 border border-rose-500/20 text-rose-300';
                alertText.innerHTML = `
                <svg class="w-4 h-4 text-rose-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>${err.message}. You can switch to your default email app via the arrow dropdown.</span>
            `;
                alertBox.classList.remove('hidden');
            } finally {
                sendBtn.disabled = false;
                btnLabel.textContent = 'Send';
            }
        }
    </script>
@endsection
