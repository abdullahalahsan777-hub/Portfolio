<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InquiryReplyMail;
use App\Models\ContactMessage;
use App\Models\Notification;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of messages with folders, metrics, filters, and pagination.
     */
    public function index(Request $request): View|JsonResponse
    {
        $currentType = $request->input('type', 'inbox');
        $search = trim($request->input('search', ''));
        $status = $request->input('status', 'all');
        $sort = $request->input('sort', 'latest');
        $perPage = (int) $request->input('per_page', 10);

        if ($perPage <= 0 || $perPage > 100) {
            $perPage = 10;
        }

        // 1. Sidebar & Summary Metrics Counts
        $counts = [
            'all'          => ContactMessage::count(),
            'inbox'        => ContactMessage::where('type', 'inbox')->count(),
            'unread_inbox' => ContactMessage::where('type', 'inbox')->where('is_read', false)->count(),
            'draft'        => ContactMessage::where('type', 'draft')->count(),
            'sent'         => ContactMessage::where('type', 'sent')->count(),
            'important'    => ContactMessage::where(function ($q) {
                $q->where('type', 'important')->orWhere('is_important', true);
            })->count(),
            'trash'        => ContactMessage::onlyTrashed()->count(),
        ];

        // 2. Base Query Formulation
        if ($currentType === 'trash') {
            $query = ContactMessage::onlyTrashed();
        } else {
            $query = ContactMessage::query();

            if ($currentType === 'inbox') {
                $query->where('type', 'inbox');
            } elseif ($currentType === 'draft') {
                $query->where('type', 'draft');
            } elseif ($currentType === 'sent') {
                $query->where('type', 'sent');
            } elseif ($currentType === 'important') {
                $query->where(function ($q) {
                    $q->where('type', 'important')->orWhere('is_important', true);
                });
            }
            // If 'all', no type filter is applied
        }

        // 3. Search Filter
        if (!empty($search)) {
            $term = "%{$search}%";
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                    ->orWhere('email', 'like', $term)
                    ->orWhere('subject', 'like', $term)
                    ->orWhere('message', 'like', $term)
                    ->orWhere('phone', 'like', $term);
            });
        }

        // 4. Status Filter (Unread / Read)
        if ($status === 'unread') {
            $query->where('is_read', false);
        } elseif ($status === 'read') {
            $query->where('is_read', true);
        }

        // 5. Sorting
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        // 6. Pagination (Default 10 items)
        $messages = $query->paginate($perPage)->withQueryString();

        $activeTheme = SiteSetting::getActiveTheme();

        return view('admin.messages.index', compact(
            'messages',
            'counts',
            'currentType',
            'search',
            'status',
            'sort',
            'perPage',
            'activeTheme'
        ));
    }

    /**
     * Show single inquiry details and mark as read.
     */
    public function show(ContactMessage $message): View
    {
        $message->update(['is_read' => true]);

        $this->data['message'] = $message;

        return view('admin.messages.show', $this->data);
    }

    /**
     * Toggle Read / Unread status.
     */
    public function toggleRead(ContactMessage $message): RedirectResponse|JsonResponse
    {
        $message->update(['is_read' => !$message->is_read]);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'is_read' => $message->is_read,
                'message' => $message->is_read ? 'Marked as Read' : 'Marked as Unread',
            ]);
        }

        flash()->success('Message status updated.');

        return redirect()->back();
    }

    /**
     * Toggle Important badge.
     * When any email ID gets the importance badge, all messages from that email ID inherit importance.
     */
    public function toggleImportant(ContactMessage $message): RedirectResponse|JsonResponse
    {
        $newImportant = !$message->isImportant();

        $message->is_important = $newImportant;
        if ($newImportant) {
            $message->type = 'important';

            // Propagate importance to all messages from this sender's email address
            if (!empty($message->email)) {
                ContactMessage::where('email', $message->email)->update([
                    'is_important' => true,
                ]);
            }
        } else {
            if ($message->type === 'important') {
                $message->type = 'inbox';
            }
        }
        $message->save();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success'      => true,
                'is_important' => $newImportant,
                'message'      => $newImportant ? 'Starred as Important' : 'Removed from Important',
            ]);
        }

        flash()->success($newImportant ? 'Message marked as Important.' : 'Message removed from Important.');

        return redirect()->back();
    }

    /**
     * Autosave draft by temporary ID on composer keyup.
     */
    public function autosaveDraft(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'temp_id' => 'required|string|max:64',
            'to'      => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'body'    => 'nullable|string',
        ]);

        $tempId = $validated['temp_id'];
        $to = trim($validated['to'] ?? '');
        $name = !empty($to) ? explode('@', $to)[0] : 'Draft Recipient';

        $draft = ContactMessage::withTrashed()->firstOrNew(['temp_id' => $tempId]);

        // If previously trashed draft, restore
        if ($draft->trashed()) {
            $draft->restore();
        }

        $draft->name = $name;
        $draft->email = $to ?: 'draft@recipient.local';
        $draft->subject = !empty($validated['subject']) ? $validated['subject'] : '(Draft Subject)';
        $draft->message = $validated['body'] ?? '';
        $draft->type = 'draft';
        $draft->is_read = true;
        $draft->save();

        return response()->json([
            'success'   => true,
            'temp_id'   => $tempId,
            'draft_id'  => $draft->id,
            'saved_at'  => now()->format('h:i:s A'),
            'message'   => 'Draft autosaved.',
        ]);
    }

    /**
     * Reply to an inquiry or send composed email.
     * When sent, saves type as 'sent', removes temporary ID, and queues mail in background.
     */
    public function reply(Request $request, ?ContactMessage $message = null): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'to'         => 'required|email',
            'subject'    => 'required|string|max:255',
            'body'       => 'required|string',
            'cc'         => 'nullable|string',
            'bcc'        => 'nullable|string',
            'temp_id'    => 'nullable|string|max:64',
            'attachment' => 'nullable|file|max:10240',
        ]);

        try {
            $attachmentInfo = null;

            // Handle file upload persistently for queued asynchronous mail delivery
            if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
                $file = $request->file('attachment');
                $originalName = $file->getClientOriginalName();
                $mimeType = $file->getMimeType() ?: 'application/octet-stream';
                $size = round($file->getSize() / 1024, 1).' KB';

                // Save to local storage disk (storage/app/private/mail-attachments)
                $storedPath = $file->store('mail-attachments', 'local');

                $attachmentInfo = [
                    'path' => $storedPath,
                    'name' => $originalName,
                    'mime' => $mimeType,
                    'size' => $size,
                ];
            }

            // Parse CC & BCC
            $ccs = [];
            if (!empty($validated['cc'])) {
                $ccs = array_filter(array_map('trim', explode(',', $validated['cc'])));
            }

            $bccs = [];
            if (!empty($validated['bcc'])) {
                $bccs = array_filter(array_map('trim', explode(',', $validated['bcc'])));
            }

            $siteName = SiteSetting::get('site_name', SiteSetting::get('site_title', config('app.name', 'Portfolio Studio')));
            $senderUser = Auth::user();

            // 1. Save or update record: type = 'sent', remove temp_id
            $tempId = $request->input('temp_id');
            $sentRecord = null;

            if (!empty($tempId)) {
                $sentRecord = ContactMessage::where('temp_id', $tempId)->first();
            }

            if ($sentRecord) {
                $sentRecord->type = 'sent';
                $sentRecord->temp_id = null; // Removed temporary ID
                $sentRecord->email = $validated['to'];
                $sentRecord->name = explode('@', $validated['to'])[0];
                $sentRecord->subject = $validated['subject'];
                $sentRecord->message = $validated['body'];
                $sentRecord->is_read = true;
                $sentRecord->save();
            } else {
                $sentRecord = ContactMessage::create([
                    'name'         => explode('@', $validated['to'])[0],
                    'email'        => $validated['to'],
                    'subject'      => $validated['subject'],
                    'message'      => $validated['body'],
                    'type'         => 'sent',
                    'temp_id'      => null,
                    'is_read'      => true,
                    'service_type' => $message ? $message->service_type : 'Direct Reply',
                ]);
            }

            // 2. Queue Email to send systematically one by one in the background
            $mailData = [
                'siteName'        => $siteName,
                'messageId'       => $message ? $message->id : $sentRecord->id,
                'subject'         => $validated['subject'],
                'sentAt'          => now()->format('M d, Y • h:i A T'),
                'recipientName'   => $message ? $message->name : explode('@', $validated['to'])[0],
                'replyContent'    => $validated['body'],
                'originalName'    => $message ? $message->name : null,
                'originalEmail'   => $message ? $message->email : null,
                'originalSubject' => $message ? ($message->subject ?: ($message->service_type ?: 'General Inquiry')) : null,
                'originalMessage' => $message ? $message->message : null,
                'senderName'      => $senderUser->name ?? $siteName,
                'senderTitle'     => ($senderUser && $senderUser->isAdmin()) ? 'Lead Administrator & Specialist' : 'Portfolio Team',
                'websiteUrl'      => url('/'),
                'cc'              => $ccs,
                'bcc'             => $bccs,
            ];

            $mailable = new InquiryReplyMail($mailData, $attachmentInfo);
            $pendingMail = Mail::to($validated['to']);

            if (!empty($ccs)) {
                $pendingMail->cc($ccs);
            }
            if (!empty($bccs)) {
                $pendingMail->bcc($bccs);
            }

            $pendingMail->queue($mailable);

            // Record notification for admin stream
            Notification::record([
                'user_id'    => Auth::id(),
                'type'       => 'reply',
                'title'      => 'Email Sent (Queued)',
                'message'    => 'Sent reply to '.$validated['to'].' on subject "'.$validated['subject'].'"',
                'action_url' => route('admin.messages.show', $sentRecord->id),
                'icon'       => 'send',
                'color'      => 'emerald',
            ]);

            $successMsg = 'Reply email queued successfully for '.$validated['to'].'. Dispatched to background queue for sequential sending.';

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success'   => true,
                    'message'   => $successMsg,
                    'record_id' => $sentRecord->id,
                ]);
            }

            flash()->success($successMsg);

            return redirect()->back();
        } catch (\Throwable $e) {
            Log::error('Reply mail queuing failed: '.$e->getMessage());

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email queuing failed: '.$e->getMessage(),
                ], 500);
            }

            flash()->danger('Email queuing failed: '.$e->getMessage());

            return redirect()->back();
        }
    }

    /**
     * Send newly composed email from the sidebar composer button.
     */
    public function sendCompose(Request $request): JsonResponse|RedirectResponse
    {
        return $this->reply($request, null);
    }

    /**
     * Preview the Inquiry Reply HTML email template in the browser.
     */
    public function previewReply(ContactMessage $message)
    {
        $siteName = SiteSetting::get('site_name', SiteSetting::get('site_title', config('app.name', 'Portfolio Studio')));
        $senderUser = Auth::user();

        $mail = new InquiryReplyMail([
            'siteName'        => $siteName,
            'messageId'       => $message->id,
            'subject'         => 'Re: '.($message->subject ?: ($message->service_type ?: 'Portfolio Inquiry')),
            'sentAt'          => now()->format('M d, Y • h:i A T'),
            'recipientName'   => $message->name,
            'replyContent'    => "Hi {$message->name},\n\nThank you for reaching out regarding {$message->service_type}!\n\nI have reviewed your requirements and would be delighted to collaborate with you. We can schedule a brief 15-minute introductory call this week to outline the milestones and architecture.\n\nPlease find the attached service brief document for your review.\n\nLooking forward to speaking with you soon!",
            'originalName'    => $message->name,
            'originalEmail'   => $message->email,
            'originalSubject' => $message->subject ?: ($message->service_type ?: 'General Inquiry'),
            'originalMessage' => $message->message,
            'senderName'      => $senderUser->name ?? $siteName,
            'senderTitle'     => ($senderUser && $senderUser->isAdmin()) ? 'Lead Administrator & Specialist' : 'Portfolio Team',
            'websiteUrl'      => url('/'),
        ], [
            'path' => null,
            'name' => 'Portfolio_Project_Scope.pdf',
            'mime' => 'application/pdf',
            'size' => '245.8 KB',
        ]);

        return $mail->render();
    }

    /**
     * Move message to Trash (SoftDelete).
     */
    public function destroy(ContactMessage $message): RedirectResponse|JsonResponse
    {
        $message->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Message moved to Trash.',
            ]);
        }

        flash()->delete('Message moved to Trash.');

        return redirect()->route('admin.messages.index');
    }

    /**
     * Restore message from Trash.
     */
    public function restore($id): RedirectResponse|JsonResponse
    {
        $message = ContactMessage::onlyTrashed()->findOrFail($id);
        $message->restore();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Message restored successfully from Trash.',
            ]);
        }

        flash()->success('Message restored successfully from Trash.');

        return redirect()->back();
    }

    /**
     * Permanently delete message from Trash.
     */
    public function forceDelete($id): RedirectResponse|JsonResponse
    {
        $message = ContactMessage::onlyTrashed()->findOrFail($id);
        $message->forceDelete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Message permanently deleted.',
            ]);
        }

        flash()->delete('Message permanently deleted.');

        return redirect()->back();
    }

    /**
     * Empty all messages in Trash.
     */
    public function emptyTrash(): RedirectResponse
    {
        ContactMessage::onlyTrashed()->forceDelete();

        flash()->success('Trash emptied successfully.');

        return redirect()->back();
    }

    /**
     * Perform batch actions on multiple messages.
     */
    public function batchAction(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ids'    => 'required|array|min:1',
            'ids.*'  => 'integer',
            'action' => 'required|string|in:mark_read,mark_unread,trash,restore,force_delete,star,unstar',
        ]);

        $ids = $validated['ids'];
        $action = $validated['action'];
        $count = count($ids);

        switch ($action) {
            case 'mark_read':
                ContactMessage::whereIn('id', $ids)->update(['is_read' => true]);
                $msg = "{$count} messages marked as read.";
                break;

            case 'mark_unread':
                ContactMessage::whereIn('id', $ids)->update(['is_read' => false]);
                $msg = "{$count} messages marked as unread.";
                break;

            case 'trash':
                ContactMessage::whereIn('id', $ids)->delete();
                $msg = "{$count} messages moved to Trash.";
                break;

            case 'restore':
                ContactMessage::onlyTrashed()->whereIn('id', $ids)->restore();
                $msg = "{$count} messages restored from Trash.";
                break;

            case 'force_delete':
                ContactMessage::onlyTrashed()->whereIn('id', $ids)->forceDelete();
                $msg = "{$count} messages permanently deleted.";
                break;

            case 'star':
                ContactMessage::whereIn('id', $ids)->update(['is_important' => true, 'type' => 'important']);
                $msg = "{$count} messages starred as important.";
                break;

            case 'unstar':
                ContactMessage::whereIn('id', $ids)->update(['is_important' => false]);
                $msg = "{$count} messages unstarred.";
                break;

            default:
                $msg = "Action completed.";
        }

        return response()->json([
            'success' => true,
            'action'  => $action,
            'count'   => $count,
            'message' => $msg,
        ]);
    }
}
