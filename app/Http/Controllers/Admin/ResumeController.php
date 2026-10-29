<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ResumeItem;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ResumeController extends Controller
{
    public function index(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $selectedTheme = $request->get('theme', $activeTheme);

        $education = ResumeItem::where('type', 'education')->orderBy('sort_order')->get();
        $experience = ResumeItem::where('type', 'experience')->orderBy('sort_order')->get();

        $this->data['education'] = $education;
        $this->data['experience'] = $experience;
        $this->data['activeTheme'] = $activeTheme;
        $this->data['selectedTheme'] = $selectedTheme;
        $this->data['themeFilter'] = $selectedTheme;

        return view('admin.resume.index', $this->data);
    }

    public function create(Request $request): View
    {
        $activeTheme = SiteSetting::getActiveTheme();
        $defaultType = $request->get('type', 'education');
        $selectedTheme = $request->get('theme', $activeTheme);

        $this->data['defaultType'] = $defaultType;
        $this->data['selectedTheme'] = $selectedTheme;

        return view('admin.resume.create', $this->data);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => 'required|in:education,experience',
            'title' => 'required|string|max:150',
            'institution' => 'nullable|string|max:150',
            'company' => 'nullable|string|max:150',
            'period' => 'required|string|max:100',
            'grade' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'theme' => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'sort_order' => 'nullable|integer',
        ]);

        if (empty($validated['sort_order'])) {
            $validated['sort_order'] = (ResumeItem::where('type', $validated['type'])->max('sort_order') ?? 0) + 1;
        }

        // Synchronize organization field if one is provided
        if (!empty($validated['institution']) && empty($validated['company'])) {
            $validated['company'] = $validated['institution'];
        } elseif (!empty($validated['company']) && empty($validated['institution'])) {
            $validated['institution'] = $validated['company'];
        }

        $resume = ResumeItem::create($validated);
        $typeLabel = ucfirst($resume->type ?? 'Experience');
        $org = $resume->company ?: $resume->institution;
        $orgSuffix = $org ? " at '{$org}'" : "";

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'resume',
            'title' => "{$typeLabel} Created: {$resume->title}",
            'message' => "{$typeLabel} '{$resume->title}'{$orgSuffix} was added to resume.",
            'action_url' => route('admin.resume.edit', $resume->id),
            'icon' => 'folder',
            'color' => 'cyan',
        ]);

        flash()->success(ucfirst($validated['type']) . ' item added successfully.');

        return redirect()->route('admin.resume.index');
    }

    public function edit(ResumeItem $resume): View
    {
        $this->data['resume'] = $resume;

        return view('admin.resume.edit', $this->data);
    }

    public function update(Request $request, ResumeItem $resume): RedirectResponse
    {
        $validated = $request->validate([
            'type' => 'required|in:education,experience',
            'title' => 'required|string|max:150',
            'institution' => 'nullable|string|max:150',
            'company' => 'nullable|string|max:150',
            'period' => 'required|string|max:100',
            'grade' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'theme' => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'sort_order' => 'nullable|integer',
        ]);

        // Synchronize organization field if one is provided
        if (!empty($validated['institution']) && empty($validated['company'])) {
            $validated['company'] = $validated['institution'];
        } elseif (!empty($validated['company']) && empty($validated['institution'])) {
            $validated['institution'] = $validated['company'];
        }

        $resume->update($validated);
        $typeLabel = ucfirst($resume->type ?? 'Experience');

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'resume',
            'title' => "{$typeLabel} Updated: {$resume->title}",
            'message' => "{$typeLabel} '{$resume->title}' was modified.",
            'action_url' => route('admin.resume.edit', $resume->id),
            'icon' => 'folder',
            'color' => 'cyan',
        ]);

        flash()->success(ucfirst($resume->type) . ' item updated successfully.');

        return redirect()->route('admin.resume.index');
    }

    public function destroy(ResumeItem $resume): RedirectResponse
    {
        $typeLabel = ucfirst($resume->type ?? 'Experience');
        $title = $resume->title;
        $resume->delete();

        Notification::record([
            'user_id' => Auth::id(),
            'type' => 'resume',
            'title' => "{$typeLabel} Deleted: {$title}",
            'message' => "{$typeLabel} '{$title}' was removed from resume.",
            'action_url' => route('admin.resume.index'),
            'icon' => 'folder',
            'color' => 'rose',
        ]);

        flash()->delete($typeLabel . ' item deleted successfully.');

        return redirect()->route('admin.resume.index');
    }

    /**
     * Upload or replace CV / Resume PDF file.
     */
    public function uploadPdf(Request $request): RedirectResponse
    {
        $request->validate([
            'resume_pdf' => 'required|file|mimes:pdf|max:25600', // max 25MB PDF
        ], [
            'resume_pdf.required' => 'Please select a PDF file to upload.',
            'resume_pdf.mimes' => 'The selected file must be a valid PDF document (.pdf).',
            'resume_pdf.max' => 'The PDF file size must not exceed 25MB.',
        ]);

        $file = $request->file('resume_pdf');
        $originalName = $file->getClientOriginalName();
        $fileSize = $file->getSize();

        // Human readable size
        $formattedSize = $fileSize >= 1048576 
            ? round($fileSize / 1048576, 2) . ' MB' 
            : round($fileSize / 1024, 1) . ' KB';

        $relativePath = uploadFile($file, 'uploads/resume', 'cv');
        if (! $relativePath) {
            flash()->danger('Failed to upload PDF resume file.');

            return redirect()->back();
        }

        // Copy to public/resume.pdf for direct asset fallback
        try {
            copy(public_path($relativePath), public_path('resume.pdf'));
        } catch (\Throwable $e) {
            // continue even if copy fails
        }

        SiteSetting::set('resume_pdf_file', $relativePath, 'resume');
        SiteSetting::set('resume_pdf_name', $originalName, 'resume');
        SiteSetting::set('resume_pdf_size', $formattedSize, 'resume');
        SiteSetting::set('resume_pdf_updated_at', now()->toDateTimeString(), 'resume');

        \App\Models\Notification::record([
            'user_id' => Auth::id(),
            'type' => 'resume',
            'title' => 'CV / Resume PDF Uploaded',
            'message' => "Document '{$originalName}' ({$formattedSize}) was uploaded and published for download.",
            'action_url' => route('admin.resume.index'),
            'icon' => 'folder',
            'color' => 'emerald',
        ]);

        flash()->success('CV / Resume PDF "' . $originalName . '" (' . $formattedSize . ') uploaded successfully!');

        return redirect()->back();
    }

    /**
     * Delete or reset uploaded CV / Resume PDF.
     */
    public function deletePdf(): RedirectResponse
    {
        $pdfPath = SiteSetting::get('resume_pdf_file');
        if ($pdfPath && file_exists(public_path($pdfPath))) {
            @unlink(public_path($pdfPath));
        }

        SiteSetting::set('resume_pdf_file', '', 'resume');
        SiteSetting::set('resume_pdf_name', '', 'resume');
        SiteSetting::set('resume_pdf_size', '', 'resume');
        SiteSetting::set('resume_pdf_updated_at', '', 'resume');

        \App\Models\Notification::record([
            'user_id' => Auth::id(),
            'type' => 'resume',
            'title' => 'CV / Resume PDF Removed',
            'message' => 'The uploaded CV / Resume PDF was deleted from storage.',
            'action_url' => route('admin.resume.index'),
            'icon' => 'folder',
            'color' => 'rose',
        ]);

        flash()->delete('Uploaded CV / Resume PDF removed successfully.');

        return redirect()->back();
    }
}
