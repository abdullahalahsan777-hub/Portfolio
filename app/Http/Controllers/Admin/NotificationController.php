<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of notifications.
     */
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        $query = Notification::with('user')->forUser($currentUser);

        // Filter / Status
        $status = $request->get('status', $request->get('filter', 'all'));
        $filter = $status; // maintain backward compatibility

        if ($status === 'unread') {
            $query->unread();
        } elseif ($status === 'read') {
            $query->read();
        } elseif ($status === 'inquiries') {
            $query->whereIn('type', ['inquiry', 'reply']);
        } elseif ($status === 'users') {
            $query->whereIn('type', ['user', 'auth']);
        } elseif ($status === 'system') {
            $query->whereIn('type', ['system', 'maintenance', 'settings']);
        } elseif ($status === 'today') {
            $query->whereDate('created_at', today());
        } elseif ($status === 'mine' && $currentUser->isAdmin()) {
            $query->where('user_id', $currentUser->id);
        } elseif (in_array($status, ['project', 'blog', 'service', 'skill', 'pricing', 'testimonial', 'faq', 'resume', 'content', 'settings', 'system', 'auth', 'inquiry'], true)) {
            $query->where('type', $status);
        }

        // Search query
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // User filter for admin
        if ($currentUser->isAdmin() && $request->filled('user_id')) {
            if ($request->get('user_id') === 'system') {
                $query->whereNull('user_id');
            } else {
                $query->where('user_id', $request->get('user_id'));
            }
        }

        // Per page (default 20)
        $perPage = (int) $request->get('per_page', 20);
        if (!in_array($perPage, [10, 20, 50, 100], true)) {
            $perPage = 20;
        }

        $notifications = $query->latest()->paginate($perPage)->withQueryString();

        // Calculate counts for top 4 cards
        $baseQuery = Notification::forUser($currentUser);
        $totalCount = (clone $baseQuery)->count();
        $unreadCount = (clone $baseQuery)->unread()->count();
        $readCount = (clone $baseQuery)->read()->count();
        $todayCount = (clone $baseQuery)->whereDate('created_at', today())->count();

        // All users list for admin filter dropdown
        $users = $currentUser->isAdmin() ? User::orderBy('name')->get(['id', 'name', 'email', 'role']) : collect();

        return view('admin.notifications.index', compact(
            'notifications',
            'filter',
            'status',
            'totalCount',
            'unreadCount',
            'readCount',
            'todayCount',
            'perPage',
            'users'
        ));
    }

    /**
     * Return unread count and latest notifications for live topbar badge and dropdown.
     */
    public function unreadCount()
    {
        $currentUser = Auth::user();
        if (! $currentUser) {
            return response()->json(['unread_count' => 0, 'latest' => []]);
        }

        $baseQuery = Notification::forUser($currentUser);
        $unreadCount = (clone $baseQuery)->unread()->count();
        $latest = (clone $baseQuery)->with('user')->latest()->take(6)->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'message' => $item->message,
                'type' => $item->type,
                'icon' => $item->icon,
                'color' => $item->color,
                'is_read' => $item->is_read,
                'action_url' => $item->action_url,
                'user_name' => $item->user ? $item->user->name : 'System',
                'user_avatar' => $item->user && $item->user->avatar ? asset($item->user->avatar) : null,
                'time_ago' => $item->created_at->diffForHumans(),
                'view_url' => route('admin.notifications.show', $item),
            ];
        });

        return response()->json([
            'unread_count' => $unreadCount,
            'latest' => $latest,
        ]);
    }

    /**
     * View notification details and mark as read.
     */
    public function show(Request $request, Notification $notification)
    {
        $this->authorizeAccess($notification);

        // Mark as read automatically on view
        if (! $notification->is_read) {
            $notification->markAsRead();
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'notification' => [
                    'id' => $notification->id,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'type' => $notification->type,
                    'icon' => $notification->icon,
                    'color' => $notification->color,
                    'is_read' => $notification->is_read,
                    'action_url' => $notification->action_url,
                    'created_at' => $notification->created_at->format('M d, Y h:i A'),
                    'user_name' => $notification->user ? $notification->user->name : 'System Notification',
                    'user_email' => $notification->user ? $notification->user->email : null,
                    'user_role' => $notification->user ? $notification->user->role : null,
                ],
            ]);
        }

        if ($notification->action_url) {
            return redirect($notification->action_url);
        }

        return redirect()->route('admin.notifications.index');
    }

    /**
     * Toggle read / unread status of a single notification.
     */
    public function toggleRead(Request $request, Notification $notification)
    {
        $this->authorizeAccess($notification);

        if ($notification->is_read) {
            $notification->markAsUnread();
            $status = 'unread';
        } else {
            $notification->markAsRead();
            $status = 'read';
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_read' => $notification->is_read,
                'status' => $status,
                'message' => "Notification marked as {$status}.",
            ]);
        }

        flash()->success("Notification marked as {$status}.");

        return back();
    }

    /**
     * Mark all notifications as read for current user.
     */
    public function markAllRead(Request $request)
    {
        $currentUser = Auth::user();
        $query = Notification::forUser($currentUser)->unread();
        $query->update([
            'is_read' => true,
            'read_at' => now(),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'All notifications marked as read.',
            ]);
        }

        flash()->success('All notifications marked as read.');

        return back();
    }

    /**
     * Delete a single notification.
     */
    public function destroy(Request $request, Notification $notification)
    {
        $this->authorizeAccess($notification);

        $notification->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Notification deleted.',
            ]);
        }

        flash()->delete('Notification deleted successfully.');

        return back();
    }

    /**
     * Bulk actions (mark read, mark unread, delete selected).
     */
    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $ids = $request->input('ids', []);

        if (empty($ids) || ! is_array($ids)) {
            flash()->warning('Please select at least one notification.');

            return back();
        }

        $currentUser = Auth::user();
        $query = Notification::forUser($currentUser)->whereIn('id', $ids);

        if ($action === 'mark_read') {
            $query->update(['is_read' => true, 'read_at' => now()]);
            $msg = 'Selected notifications marked as read.';
            $status = 'success';
        } elseif ($action === 'mark_unread') {
            $query->update(['is_read' => false, 'read_at' => null]);
            $msg = 'Selected notifications marked as unread.';
            $status = 'info';
        } elseif ($action === 'delete') {
            $query->delete();
            $msg = 'Selected notifications deleted.';
            $status = 'delete';
        } else {
            flash()->danger('Invalid action.');

            return back();
        }

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => $msg]);
        }

        flash()->$status($msg);

        return back();
    }

    /**
     * Clear all read notifications.
     */
    public function clearRead(Request $request)
    {
        $currentUser = Auth::user();
        Notification::forUser($currentUser)->read()->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'All read notifications cleared.',
            ]);
        }

        flash()->info('All read notifications have been cleared.');

        return back();
    }

    /**
     * Authorize access to notification.
     */
    private function authorizeAccess(Notification $notification): void
    {
        $user = Auth::user();
        if (! $user) {
            abort(401);
        }

        if ($user->isAdmin()) {
            return; // Admin can view/modify any notification
        }

        if ($notification->user_id !== $user->id) {
            abort(403, 'Unauthorized access to this notification.');
        }
    }
}
