<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Notification;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(Request $request): View
    {
        $activeTheme    = SiteSetting::getActiveTheme();
        $selectedTheme  = $request->get('theme', $activeTheme);

        $posts = BlogPost::orderBy('sort_order')->get();

        $this->data['posts']         = $posts;
        $this->data['activeTheme']   = $activeTheme;
        $this->data['selectedTheme'] = $selectedTheme;
        $this->data['themeFilter']   = $selectedTheme;

        return view('admin.blog.index', $this->data);
    }

    public function create(Request $request): View
    {
        $activeTheme    = SiteSetting::getActiveTheme();
        $selectedTheme  = $request->get('theme', $activeTheme);
        $this->data['selectedTheme'] = $selectedTheme;

        return view('admin.blog.create', $this->data);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:200',
            'slug'       => 'nullable|string|max:200|unique:blog_posts,slug',
            'category'   => 'required|string|max:100',
            'date'       => 'nullable|string|max:50',
            'read_time'  => 'nullable|string|max:50',
            'author'     => 'nullable|string|max:100',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'image'      => 'nullable|string|max:500',
            'excerpt'    => 'required|string|max:500',
            'content'    => 'required|string',
            'theme'      => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'sort_order' => 'nullable|integer',
            'is_published'=> 'nullable|boolean',
        ]);

        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $counter = 1;
            while (BlogPost::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }
            $validated['slug'] = $slug;
        }

        if ($request->hasFile('image_file')) {
            $uploadedPath = uploadFile($request->file('image_file'), 'uploads/blog', 'article');
            if ($uploadedPath) {
                $validated['image'] = $uploadedPath;
            }
        }

        $validated['is_published'] = $request->has('is_published');
        $validated['author']       = $validated['author'] ?: 'Alex Rivera';
        $validated['read_time']    = $validated['read_time'] ?: '5 min read';
        $validated['date']         = $validated['date'] ?: date('M d, Y');
        $validated['sort_order']   = $validated['sort_order'] ?? ((BlogPost::max('sort_order') ?? 0) + 1);

        $blog = BlogPost::create($validated);

        Notification::record([
            'user_id'    => Auth::id(),
            'type'       => 'blog',
            'title'      => "Article Published: {$blog->title}",
            'message'    => "Article '{$blog->title}' ({$blog->category}) was published.",
            'action_url' => route('admin.blog.edit', $blog->id),
            'icon'       => 'book',
            'color'      => 'blue',
        ]);

        flash()->success('Article published successfully.');

        return redirect()->route('admin.blog.index');
    }

    public function edit(BlogPost $blog): View
    {
        $this->data['blog'] = $blog;

        return view('admin.blog.edit', $this->data);
    }

    public function update(Request $request, BlogPost $blog): RedirectResponse
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:200',
            'slug'       => 'required|string|max:200|unique:blog_posts,slug,' . $blog->id,
            'category'   => 'required|string|max:100',
            'date'       => 'nullable|string|max:50',
            'read_time'  => 'nullable|string|max:50',
            'author'     => 'nullable|string|max:100',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'image'      => 'nullable|string|max:500',
            'excerpt'    => 'required|string|max:500',
            'content'    => 'required|string',
            'theme'      => 'required|string|in:all,developer,graphic_designer,uiux_designer,app_developer,app_software_developer,digital_designer_illustrator',
            'sort_order' => 'nullable|integer',
            'is_published'=> 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $uploadedPath = uploadFile($request->file('image_file'), 'uploads/blog', 'article');
            if ($uploadedPath) {
                $oldImage = $blog->getRawOriginal('image');
                if (!empty($oldImage) && !str_starts_with($oldImage, 'http') && file_exists(public_path($oldImage))) {
                    @unlink(public_path($oldImage));
                }
                $validated['image'] = $uploadedPath;
            }
        }

        $validated['is_published'] = $request->has('is_published');

        $blog->update($validated);

        Notification::record([
            'user_id'    => Auth::id(),
            'type'       => 'blog',
            'title'      => "Article Updated: {$blog->title}",
            'message'    => "Article '{$blog->title}' was updated.",
            'action_url' => route('admin.blog.edit', $blog->id),
            'icon'       => 'book',
            'color'      => 'blue',
        ]);

        flash()->success('Article updated successfully.');

        return redirect()->route('admin.blog.index');
    }

    public function destroy(BlogPost $blog): RedirectResponse
    {
        $title = $blog->title;
        $oldImage = $blog->getRawOriginal('image');
        if (!empty($oldImage) && !str_starts_with($oldImage, 'http') && file_exists(public_path($oldImage))) {
            @unlink(public_path($oldImage));
        }

        $blog->delete();

        Notification::record([
            'user_id'    => Auth::id(),
            'type'       => 'blog',
            'title'      => "Article Deleted: {$title}",
            'message'    => "Article '{$title}' was deleted from the blog.",
            'action_url' => route('admin.blog.index'),
            'icon'       => 'book',
            'color'      => 'rose',
        ]);

        flash()->delete('Article deleted successfully.');

        return redirect()->route('admin.blog.index');
    }
}
