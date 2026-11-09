@extends('admin.layout')

@section('title', 'Edit Resume Item')
@section('page_title', 'Edit ' . ucfirst($resume->type) . ' Entry')
@section('page_subtitle', 'Group: Website')

@section('content')
    <div class="w-full space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h1 class="text-xl font-bold text-white flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full {{ $resume->type === 'education' ? 'bg-violet-400' : 'bg-cyan-400' }}"></span>
                    <span id="page-header-title">Edit {{ ucfirst($resume->type) }}: {{ $resume->title }}</span>
                </h1>
                <p class="text-xs text-slate-400 mt-1">Update milestone details, institution/company information, or deliverables from your CV / Resume.</p>
            </div>
            <a href="{{ route('admin.resume.index') }}"
                class="text-xs text-slate-400 hover:text-white inline-flex items-center gap-1.5 transition-colors">&larr; Back to Resume</a>
        </div>

        <form action="{{ route('admin.resume.update', $resume) }}" method="POST"
            class="p-4 sm:p-6 lg:p-8 rounded-3xl bg-[#09101d] border border-white/10 shadow-xl space-y-6">
            @csrf
            @method('PUT')

            <!-- Milestone Type Selector -->
            <div>
                <label class="block text-xs font-mono text-slate-400 mb-1.5">Milestone Category *</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <label
                        class="cursor-pointer p-4 rounded-2xl border border-white/10 bg-black/40 flex items-center gap-3 transition-all has-[:checked]:border-violet-500 has-[:checked]:bg-violet-600/10 has-[:checked]:shadow-lg hover:border-white/20">
                        <input type="radio" name="type" value="education"
                            {{ old('type', $resume->type) === 'education' ? 'checked' : '' }}
                            onchange="switchMilestoneType('education')"
                            class="text-violet-600 focus:ring-0 w-4 h-4">
                        <div>
                            <span class="text-xs font-bold text-white block flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-violet-400"></span>
                                Education Milestones
                            </span>
                            <span class="text-[11px] font-mono text-slate-400">Degrees, Academic Diplomas &amp; Certifications</span>
                        </div>
                    </label>

                    <label
                        class="cursor-pointer p-4 rounded-2xl border border-white/10 bg-black/40 flex items-center gap-3 transition-all has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-600/10 has-[:checked]:shadow-lg hover:border-white/20">
                        <input type="radio" name="type" value="experience"
                            {{ old('type', $resume->type) === 'experience' ? 'checked' : '' }}
                            onchange="switchMilestoneType('experience')"
                            class="text-indigo-600 focus:ring-0 w-4 h-4">
                        <div>
                            <span class="text-xs font-bold text-white block flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                                Work Experience
                            </span>
                            <span class="text-[11px] font-mono text-slate-400">Job Positions, Employment Roles &amp; Responsibilities</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- PDF Quick Autofill Presets -->
            <div class="p-3.5 rounded-2xl bg-black/30 border border-white/5 space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 flex items-center gap-1.5 font-bold">
                        <svg class="w-3.5 h-3.5 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Quick Autofill from Resume PDF:
                    </span>
                    <span class="text-[10px] font-mono text-slate-500 hidden sm:inline">Click any entry to populate all form fields</span>
                </div>
                <div id="pdf-presets-container" class="flex flex-wrap items-center gap-2">
                    <!-- Dynamic presets inserted via JS based on selected type -->
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Title Field -->
                <div>
                    <label class="block text-xs font-mono text-slate-300 font-semibold mb-1" id="lbl-title">
                        Degree / Certificate Title *
                    </label>
                    <input type="text" name="title" id="input-title" required value="{{ old('title', $resume->title) }}"
                        placeholder="e.g. Higher Secondary Certificate (HSC)"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-500 transition-colors">
                    @error('title')
                        <p class="text-[11px] text-rose-400 mt-1 font-mono">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Organization Field (Institution for Edu / Company for Exp) -->
                <div>
                    <label class="block text-xs font-mono text-slate-300 font-semibold mb-1" id="lbl-organization">
                        Institution / College / Institute *
                    </label>
                    <input type="text" name="institution" id="input-organization" required
                        value="{{ old('institution', $resume->institution ?: $resume->company) }}"
                        placeholder="e.g. Sherpur Govt. University Collage"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-500 transition-colors">
                    <input type="hidden" name="company" id="input-company-sync"
                        value="{{ old('company', $resume->company ?: $resume->institution) }}">
                    @error('institution')
                        <p class="text-[11px] text-rose-400 mt-1 font-mono">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Time Period / Completion Year -->
                <div>
                    <label class="block text-xs font-mono text-slate-300 font-semibold mb-1" id="lbl-period">
                        Passing Year / Period *
                    </label>
                    <input type="text" name="period" id="input-period" required value="{{ old('period', $resume->period) }}"
                        placeholder="e.g. Completed in 2010"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-500 transition-colors">
                    @error('period')
                        <p class="text-[11px] text-rose-400 mt-1 font-mono">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Grade / Level / Distinction / Role Tag -->
                <div>
                    <label class="block text-xs font-mono text-slate-300 font-semibold mb-1" id="lbl-grade">
                        Level / Certificate / Grade (Optional)
                    </label>
                    <input type="text" name="grade" id="input-grade" value="{{ old('grade', $resume->grade) }}"
                        placeholder="e.g. National Skills Certificate (NSDA) Level- 3"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-500 transition-colors">
                    @error('grade')
                        <p class="text-[11px] text-rose-400 mt-1 font-mono">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Display Theme (Selected by Theme Settings) -->
                <div>
                    <label class="block text-xs font-mono text-slate-300 font-semibold mb-1">Display Theme</label>
                    @php
                        $targetTheme = old(
                            'theme',
                            $resume->theme ??
                                request('theme', $selectedTheme ?? \App\Models\SiteSetting::getActiveTheme()),
                        );
                    @endphp
                    <select name="theme"
                        class="w-full px-3 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-xs focus:outline-none focus:border-cyan-500">
                        <option value="all" {{ $targetTheme === 'all' ? 'selected' : '' }}>All Themes (Global)</option>
                        <option value="developer" {{ $targetTheme === 'developer' ? 'selected' : '' }}>Developer</option>
                        <option value="graphic_designer" {{ $targetTheme === 'graphic_designer' ? 'selected' : '' }}>Graphic Designer</option>
                        <option value="uiux_designer" {{ $targetTheme === 'uiux_designer' ? 'selected' : '' }}>UI/UX Designer</option>
                        <option value="app_developer" {{ $targetTheme === 'app_developer' ? 'selected' : '' }}>App Developer</option>
                        <option value="app_software_developer" {{ $targetTheme === 'app_software_developer' ? 'selected' : '' }}>App &amp; Software Developer</option>
                        <option value="digital_designer_illustrator" {{ $targetTheme === 'digital_designer_illustrator' ? 'selected' : '' }}>Digital Designer &amp; Illustrator</option>
                        <option value="laravel_developer" {{ $targetTheme === 'laravel_developer' ? 'selected' : '' }}>Full-Stack Laravel Developer</option>
                    </select>
                </div>

                <!-- Display Order -->
                <div>
                    <label class="block text-xs font-mono text-slate-300 font-semibold mb-1">Display Order (Sort Index)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $resume->sort_order) }}" min="1"
                        class="w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-500">
                </div>
            </div>

            <!-- Description / Responsibilities (Summernote) -->
            <div>
                <label class="block text-xs font-mono text-slate-300 font-semibold mb-1" id="lbl-description">
                    Key Responsibilities / Overview &amp; Project Deliverables
                </label>
                <textarea name="description" id="resume_description" rows="5" data-height="200"
                    placeholder="Enter project bullet points or course overview..."
                    class="summernote w-full px-4 py-2.5 rounded-xl bg-black/40 border border-white/10 text-white text-sm focus:outline-none focus:border-cyan-500">{{ old('description', $resume->description) }}</textarea>
                @error('description')
                    <p class="text-[11px] text-rose-400 mt-1 font-mono">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 flex flex-col-reverse sm:flex-row items-center justify-end gap-3 border-t border-white/10">
                <a href="{{ route('admin.resume.index') }}"
                    class="w-full sm:w-auto px-4 py-2.5 rounded-xl text-xs text-slate-400 hover:text-white text-center transition-colors">Cancel</a>
                <button type="submit"
                    class="w-full sm:w-auto px-7 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-gradient-to-r from-indigo-600 to-cyan-600 hover:from-indigo-500 hover:to-cyan-500 text-white shadow-lg transition-all text-center">
                    Update Entry
                </button>
            </div>
        </form>
    </div>

    <!-- Dynamic Field Context & PDF Presets Script -->
    <script>
        const resumePdfPresets = {
            education: [
                {
                    title: "Higher Secondary Certificate (HSC)",
                    organization: "Sherpur Govt. University Collage",
                    period: "Completed in 2010",
                    grade: "Passed",
                    description: "<p>Higher Secondary Certificate with focus on general education, analytical studies, and computer fundamentals.</p>"
                },
                {
                    title: "Web Design and Development for Freelancing, Level- 3",
                    organization: "European IT Solutions Institute (Dhaka)",
                    period: "Completed in 2025",
                    grade: "National Skills Certificate (NSDA) Level- 3",
                    description: "<p>National Skills Certificate (NSDA) Level-3 competency certified by European IT Solutions Institute covering modern full-stack web development and freelance client delivery.</p>"
                },
                {
                    title: "Web Design & Development",
                    organization: "Freelance iT Lab (Mymensingh)",
                    period: "Completed in 2016",
                    grade: "Professional Certification",
                    description: "<p>Comprehensive professional web development course covering PHP, MySQL, frontend UI architecture, and dynamic web application engineering.</p>"
                },
                {
                    title: "Computer Office Application (360 Hours)",
                    organization: "School Of Science And Technology (Sherpur)",
                    period: "Completed in 2013",
                    grade: "National Skill Standard Basic Course Examination",
                    description: "<p>National Skill Standard Basic Course Examination certified by Bangladesh Technical Education Board covering office automation, database operations, and system administration.</p>"
                }
            ],
            experience: [
                {
                    title: "Laravel Developer",
                    organization: "Devzet LLC (Modhupur)",
                    period: "2024 - 2025",
                    grade: "Full-Stack Developer",
                    description: "<ul><li>Build custom backend with authentication and user privilege (RBAC).</li><li>Devzet: Custom orders &amp; automated PDF invoice backend.</li><li>Linksposting: Dynamic frontend page management.</li><li>Boutique: E-commerce backend (cart, wishlist, search, orders, checkout).</li></ul>"
                },
                {
                    title: "Web Devoloper & Trainer (Office Application & Web Design)",
                    organization: "Freelance IT Lab (Mymensingh)",
                    period: "2017 - 2023",
                    grade: "Web Developer & Trainer",
                    description: "<ul><li>Build custom backend with authentication and user privilege.</li><li>BBGC (Tarakanda): Managed the creation of a school management ERP system using the Coordinator.</li><li>Rafiq Ent (Tangail): Developed an inventory and POS management system using the Coordinator.</li><li>Ananda Mohan College (Mymensingh): Created a college management website using Laravel.</li><li>Conducted hands-on training sessions on Microsoft Office applications and basic web design for over 20 students each batch.</li></ul>"
                },
                {
                    title: "Store keeper",
                    organization: "Pentalon Textile (Gazipur)",
                    period: "2011 - 2013",
                    grade: "Inventory & Records Keeper",
                    description: "<ul><li>Maintained inventory records and stock management using computer systems.</li><li>Prepared daily stock reports and coordinated with production teams.</li><li>Ensured accuracy in data entry for materials received and issued.</li><li>Assisted in preparing documentation for audits and inspections.</li></ul>"
                }
            ]
        };

        function switchMilestoneType(type) {
            const pageHeader = document.getElementById('page-header-title');
            const lblTitle = document.getElementById('lbl-title');
            const inputTitle = document.getElementById('input-title');
            const lblOrg = document.getElementById('lbl-organization');
            const inputOrg = document.getElementById('input-organization');
            const lblPeriod = document.getElementById('lbl-period');
            const inputPeriod = document.getElementById('input-period');
            const lblGrade = document.getElementById('lbl-grade');
            const inputGrade = document.getElementById('input-grade');
            const lblDesc = document.getElementById('lbl-description');

            if (type === 'education') {
                pageHeader.textContent = 'Edit Education Milestone';
                lblTitle.innerHTML = 'Degree / Certificate Title *';
                inputTitle.placeholder = 'e.g. Higher Secondary Certificate (HSC) or Web Design & Development';
                lblOrg.innerHTML = 'Institution / College / Institute *';
                inputOrg.placeholder = 'e.g. Sherpur Govt. University Collage';
                lblPeriod.innerHTML = 'Passing Year / Completion Period *';
                inputPeriod.placeholder = 'e.g. Completed in 2010';
                lblGrade.innerHTML = 'Certificate Standard / Level / Grade (Optional)';
                inputGrade.placeholder = 'e.g. National Skills Certificate (NSDA) Level- 3';
                lblDesc.innerHTML = 'Course Overview / Syllabus &amp; Notes (Optional)';
            } else {
                pageHeader.textContent = 'Edit Work Experience Entry';
                lblTitle.innerHTML = 'Job Title / Designation *';
                inputTitle.placeholder = 'e.g. Laravel Developer or Web Devoloper & Trainer';
                lblOrg.innerHTML = 'Company / Organization (with Location) *';
                inputOrg.placeholder = 'e.g. Devzet LLC (Modhupur) or Freelance IT Lab (Mymensingh)';
                lblPeriod.innerHTML = 'Employment Duration / Period *';
                inputPeriod.placeholder = 'e.g. 2024 - 2025 or 2024 - Present';
                lblGrade.innerHTML = 'Role Category / Seniority / Specialization (Optional)';
                inputGrade.placeholder = 'e.g. Full-Stack Developer or Technical Trainer';
                lblDesc.innerHTML = 'Key Responsibilities &amp; Project Deliverables (Bullet Points)';
            }

            renderPresets(type);
        }

        function renderPresets(type) {
            const container = document.getElementById('pdf-presets-container');
            container.innerHTML = '';
            const presets = resumePdfPresets[type] || [];

            presets.forEach((item, idx) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'px-2.5 py-1 rounded-lg text-[10px] font-mono bg-white/5 hover:bg-cyan-500/20 text-slate-300 hover:text-cyan-300 border border-white/10 hover:border-cyan-500/40 transition-all cursor-pointer flex items-center gap-1.5';
                btn.innerHTML = `<span class="w-1.5 h-1.5 rounded-full ${type === 'education' ? 'bg-violet-400' : 'bg-cyan-400'}"></span>` +
                                `<span>${item.title}</span>` +
                                `<span class="text-slate-500">(${item.period})</span>`;
                btn.onclick = () => applyPreset(item);
                container.appendChild(btn);
            });
        }

        function applyPreset(item) {
            document.getElementById('input-title').value = item.title;
            document.getElementById('input-organization').value = item.organization;
            document.getElementById('input-company-sync').value = item.organization;
            document.getElementById('input-period').value = item.period;
            document.getElementById('input-grade').value = item.grade;

            if (typeof $ !== 'undefined' && $('#resume_description').summernote) {
                $('#resume_description').summernote('code', item.description);
            } else {
                document.getElementById('resume_description').value = item.description;
            }
        }

        // Keep hidden company sync input aligned
        document.getElementById('input-organization')?.addEventListener('input', function() {
            document.getElementById('input-company-sync').value = this.value;
        });

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            const checkedRadio = document.querySelector('input[name="type"]:checked');
            switchMilestoneType(checkedRadio ? checkedRadio.value : '{{ $resume->type }}');
        });
    </script>
@endsection
