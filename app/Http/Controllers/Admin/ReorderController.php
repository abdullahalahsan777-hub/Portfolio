<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\PricingPlan;
use App\Models\Project;
use App\Models\ResumeItem;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReorderController extends Controller
{
    /**
     * Map model aliases to Eloquent model class names.
     */
    protected array $models = [
        'services'      => Service::class,
        'service'       => Service::class,
        'projects'      => Project::class,
        'project'       => Project::class,
        'galleries'     => Gallery::class,
        'gallery'       => Gallery::class,
        'skills'        => Skill::class,
        'skill'         => Skill::class,
        'resume'        => ResumeItem::class,
        'resumes'       => ResumeItem::class,
        'resume_items'  => ResumeItem::class,
        'resume_item'   => ResumeItem::class,
        'pricing'       => PricingPlan::class,
        'pricing_plans' => PricingPlan::class,
        'pricing_plan'  => PricingPlan::class,
        'testimonials'  => Testimonial::class,
        'testimonial'   => Testimonial::class,
        'blog'          => BlogPost::class,
        'blog_posts'    => BlogPost::class,
        'blog_post'     => BlogPost::class,
        'faqs'          => Faq::class,
        'faq'           => Faq::class,
    ];

    /**
     * Update sort_order for a list of model IDs in the provided sequence.
     */
    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'model'         => 'required|string',
            'ordered_ids'   => 'required|array',
            'ordered_ids.*' => 'integer',
            'start_order'   => 'nullable|integer|min:1',
        ]);

        $modelAlias = strtolower(trim($validated['model']));

        if (!isset($this->models[$modelAlias])) {
            return response()->json([
                'success' => false,
                'message' => "Unsupported model: {$modelAlias}",
            ], 422);
        }

        $modelClass = $this->models[$modelAlias];
        $startOrder = $validated['start_order'] ?? 1;

        try {
            DB::transaction(function () use ($modelClass, $validated, $startOrder) {
                foreach ($validated['ordered_ids'] as $index => $id) {
                    $orderNum = $startOrder + $index;
                    $modelClass::where('id', $id)->update(['sort_order' => $orderNum]);
                }
            });
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save reordered sequence: ' . $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Display order successfully updated.',
        ]);
    }
}

