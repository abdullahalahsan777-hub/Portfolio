<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use App\Services\NewsletterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function __construct(
        protected NewsletterService $newsletterService
    ) {}

    /**
     * Subscribe to newsletter.
     */
    public function subscribe(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|email:filter|max:191',
        ], [
            'email.required' => 'Please provide your email address.',
            'email.email' => 'Please provide a valid email address.',
        ]);

        $result = $this->newsletterService->subscribe($validated['email'], $request);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json($result);
        }

        flash()->success($result['message']);
        return back();
    }

    /**
     * Return current subscriber count.
     */
    public function count(): JsonResponse
    {
        $count = Subscriber::where('status', 'active')->count();

        return response()->json([
            'count' => $count,
        ]);
    }
}

