@extends('admin.layout')

@section('title', 'General Settings')
@section('page_title', 'General Settings')
@section('page_subtitle', 'System Settings')

@section('content')
    <div class="w-full space-y-8">
        <div>
            <h1 class="text-2xl font-extrabold text-white">General Settings</h1>
            <p class="text-xs text-slate-400 mt-1">Configure global website metadata, identity, contact details, and location.</p>
        </div>

        <form action="{{ route('admin.settings.general.update') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Global Site & Brand Config -->
            <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 space-y-6 shadow-xl">
                <div class="border-b border-white/10 pb-4">
                    <span class="text-xs font-mono font-bold text-indigo-400 uppercase tracking-widest">Brand &amp; Identity</span>
                    <h2 class="text-xl font-bold text-white mt-1">Portfolio &amp; Brand Settings</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Your professional name, navbar brand mark, SEO tags, and headline pitch.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Portfolio Owner / Brand Name *</label>
                        <input type="text" name="site_name" required
                            value="{{ $settings['site_name'] ?? 'Abdullah Al Ahsan' }}"
                            placeholder="e.g. Abdullah Al Ahsan"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                        <p class="text-[11px] text-slate-500 mt-1">Your full personal name or creative agency studio brand.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Navbar Logo / Short Brand Name</label>
                        <input type="text" name="site_logo_text"
                            value="{{ $settings['site_logo_text'] ?? 'Ahsan' }}"
                            placeholder="e.g. Ahsan"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                        <p class="text-[11px] text-slate-500 mt-1">Displayed on the top navbar brand header.</p>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-mono text-slate-400 mb-1">SEO Title Tag (Browser Tab) *</label>
                        <input type="text" name="site_title" required
                            value="{{ $settings['site_title'] ?? 'Abdullah Al Ahsan — Full-Stack Engineer & UI/UX Specialist' }}"
                            placeholder="e.g. Abdullah Al Ahsan — Full-Stack Engineer & UI/UX Specialist"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                        <p class="text-[11px] text-slate-500 mt-1">Indexed by Google and shown in browser tabs and social preview cards.</p>
                    </div>
                </div>

                <div class="pt-2">
                    <label class="block text-xs font-mono text-slate-400 mb-1">Professional Bio / Elevator Pitch</label>
                    <textarea name="about_software" rows="3"
                        placeholder="e.g. Senior Full-Stack Engineer crafting resilient web systems, scalable backend architectures, and human-centered user experiences."
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">{{ $settings['about_software'] ?? 'Senior Full-Stack Engineer crafting resilient web systems, scalable backend architectures, and human-centered user experiences.' }}</textarea>
                    <p class="text-[11px] text-slate-500 mt-1">A concise, impactful statement highlighting your core strengths and client value.</p>
                </div>
            </div>

            <!-- Contact & Channels Information -->
            <div class="p-8 rounded-3xl bg-[#09101d] border border-white/10 space-y-6 shadow-xl">
                <div class="border-b border-white/10 pb-4">
                    <span class="text-xs font-mono font-bold text-indigo-400 uppercase tracking-widest">Communication</span>
                    <h2 class="text-xl font-bold text-white mt-1">Contact Channels &amp; Client Reachability</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Direct contact points for recruiters, prospective clients, and collaborators.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Business / Contact Email *</label>
                        <input type="email" name="email" required
                            value="{{ $settings['email'] ?? $settings['contact_email'] ?? 'abdullahalahsan777@gmail.com' }}"
                            placeholder="e.g. abdullahalahsan777@gmail.com"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                        <p class="text-[11px] text-slate-500 mt-1">Inquiries from the website contact forms are sent here.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Location &amp; Remote Availability</label>
                        <input type="text" name="location"
                            value="{{ $settings['location'] ?? $settings['contact_location'] ?? 'Sherpur, Bangladesh • Available Worldwide' }}"
                            placeholder="e.g. Sherpur, Bangladesh • Available Worldwide"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                        <p class="text-[11px] text-slate-500 mt-1">Reassures international clients that you are open to remote projects.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Primary Phone / Call Line</label>
                        <input type="text" name="phone_one"
                            value="{{ $settings['phone_one'] ?? $settings['contact_phone'] ?? '+880 1969-552552' }}"
                            placeholder="e.g. +880 1969-552552"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Secondary Phone (Optional)</label>
                        <input type="text" name="phone_two"
                            value="{{ $settings['phone_two'] ?? '' }}"
                            placeholder="e.g. +880..."
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">WhatsApp Direct Contact</label>
                        <input type="text" name="whatsapp"
                            value="{{ $settings['whatsapp'] ?? '+880 1718-926673' }}"
                            placeholder="e.g. +880 1718-926673"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                        <p class="text-[11px] text-slate-500 mt-1">Enables instant chat for high-conversion client communication.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-mono text-slate-400 mb-1">Microsoft Teams / Work ID</label>
                        <input type="text" name="teams"
                            value="{{ $settings['teams'] ?? '+880 1718-926673' }}"
                            placeholder="e.g. +880 1718-926673"
                            class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-indigo-500 transition-all">
                        <p class="text-[11px] text-slate-500 mt-1">Enterprise collaboration handle for international contracts.</p>
                    </div>
                </div>
            </div>

            <!-- Sticky Save Bar matching previous design -->
            <div class="pt-4 flex items-center justify-end gap-3 sticky bottom-6 p-4 rounded-2xl bg-black/80 backdrop-blur-md border border-white/15 shadow-2xl">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl text-xs text-slate-400 hover:text-white transition-colors">Cancel</a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-indigo-600 hover:bg-indigo-500 text-white shadow-lg shadow-indigo-600/30 transition-all hover:scale-105">
                    SAVE GENERAL SETTINGS
                </button>
            </div>
        </form>
    </div>
@endsection
