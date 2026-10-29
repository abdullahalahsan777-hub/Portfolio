@extends('admin.layout')

@section('title', 'Social Media Settings')
@section('page_title', 'Social Media')
@section('page_subtitle', 'Public Profiles')

@section('content')
    <div class="w-full space-y-8">
        <div>
            <h1 class="text-2xl font-extrabold text-white">Social Media Settings</h1>
            <p class="text-xs text-slate-400 mt-1">Configure your public social channels and links for website headers and footers.</p>
        </div>

        <form action="{{ route('admin.settings.social.update') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Primary Social Profiles -->
            <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 space-y-6 shadow-xl">
                <div class="border-b border-white/10 pb-4">
                    <span class="text-xs font-mono font-bold text-indigo-400 uppercase tracking-widest">Connect</span>
                    <h2 class="text-xl font-bold text-white mt-1">Primary Social Profiles</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Direct social links matching your active communication channels.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Facebook</label>
                        <input type="url" name="social_facebook"
                            value="{{ $settings['social_facebook'] ?? '' }}"
                            placeholder="https://www.facebook.com/yourpage"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Instagram</label>
                        <input type="url" name="social_instagram"
                            value="{{ $settings['social_instagram'] ?? '' }}"
                            placeholder="https://www.instagram.com/yourpage"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">LinkedIn Profile</label>
                        <input type="url" name="social_linkedin"
                            value="{{ $settings['social_linkedin'] ?? 'https://linkedin.com' }}"
                            placeholder="https://www.linkedin.com/company/yourpage"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Pinterest</label>
                        <input type="url" name="social_pinterest"
                            value="{{ $settings['social_pinterest'] ?? '' }}"
                            placeholder="https://www.pinterest.com/yourpage"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">TikTok</label>
                        <input type="url" name="social_tiktok"
                            value="{{ $settings['social_tiktok'] ?? '' }}"
                            placeholder="https://www.tiktok.com/@yourpage"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Youtube</label>
                        <input type="url" name="social_youtube"
                            value="{{ $settings['social_youtube'] ?? '' }}"
                            placeholder="https://www.youtube.com/@yourchannel"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                    </div>
                </div>
            </div>

            <!-- Developer & Creative Portals -->
            <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 space-y-6 shadow-xl">
                <div class="border-b border-white/10 pb-4">
                    <span class="text-xs font-mono font-bold text-indigo-400 uppercase tracking-widest">Developer &amp; Creative</span>
                    <h2 class="text-xl font-bold text-white mt-1">Portfolio &amp; Code Repositories</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Professional engineering handles and showcase networks.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">GitHub Profile</label>
                        <input type="url" name="social_github"
                            value="{{ $settings['social_github'] ?? 'https://github.com' }}"
                            placeholder="https://github.com/yourusername"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Twitter / X</label>
                        <input type="url" name="social_twitter"
                            value="{{ $settings['social_twitter'] ?? 'https://twitter.com' }}"
                            placeholder="https://twitter.com/yourhandle"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Dribbble</label>
                        <input type="url" name="social_dribbble"
                            value="{{ $settings['social_dribbble'] ?? 'https://dribbble.com' }}"
                            placeholder="https://dribbble.com/yourhandle"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Behance</label>
                        <input type="url" name="social_behance"
                            value="{{ $settings['social_behance'] ?? 'https://behance.net' }}"
                            placeholder="https://behance.net/yourhandle"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                    </div>
                </div>
            </div>

            <!-- Sticky Save Bar matching previous design -->
            <div class="pt-4 flex items-center justify-end gap-3 sticky bottom-6 p-4 rounded-2xl bg-black/80 backdrop-blur-md border border-white/15 shadow-2xl">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl text-xs text-slate-400 hover:text-white transition-colors">Cancel</a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg shadow-indigo-600/30 transition-all hover:scale-105">
                    SAVE SOCIAL LINKS
                </button>
            </div>
        </form>
    </div>
@endsection
