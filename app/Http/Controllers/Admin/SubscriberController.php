<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubscriberController extends Controller
{
    /**
     * Display a listing of subscribers.
     */
    public function index(Request $request): View
    {
        $query = Subscriber::query();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%")
                  ->orWhere('email_host', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            if ($status !== 'all') {
                $query->where('status', $status);
            }
        }

        $sort = $request->get('sort', 'latest');
        if ($sort === 'oldest') {
            $query->oldest();
        } elseif ($sort === 'name') {
            $query->orderBy('name', 'asc');
        } else {
            $query->latest();
        }

        $perPage = (int) $request->get('per_page', 20);
        if (!in_array($perPage, [5, 10, 20, 50, 100], true)) {
            $perPage = 20;
        }

        $subscribers = $query->paginate($perPage)->withQueryString();
        $totalSubscribers = Subscriber::count();
        $activeCount = Subscriber::where('status', 'active')->count();

        $this->data['subscribers'] = $subscribers;
        $this->data['totalSubscribers'] = $totalSubscribers;
        $this->data['activeCount'] = $activeCount;
        $this->data['search'] = $search;
        $this->data['status'] = $status;
        $this->data['sort'] = $sort;
        $this->data['perPage'] = $perPage;

        return view('admin.subscribers.index', $this->data);
    }

    /**
     * Delete a subscriber.
     */
    public function destroy(Subscriber $subscriber): RedirectResponse
    {
        $email = $subscriber->email;
        $subscriber->delete();

        flash()->success("Subscriber [{$email}] deleted successfully.");
        return redirect()->route('admin.subscribers.index');
    }

    /**
     * Bulk actions for subscribers.
     */
    public function bulk(Request $request): RedirectResponse
    {
        $ids = $request->input('selected_subscribers', []);
        $action = $request->input('action');

        if (empty($ids) || !is_array($ids)) {
            flash()->warning('No subscribers were selected.');
            return redirect()->route('admin.subscribers.index');
        }

        if ($action === 'delete') {
            Subscriber::whereIn('id', $ids)->delete();
            flash()->success(count($ids) . ' subscriber(s) removed.');
        }

        return redirect()->route('admin.subscribers.index');
    }
}

