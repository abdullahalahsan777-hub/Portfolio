<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InquiryReplyMail;
use App\Models\ContactMessage;
use App\Models\Notification;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        $this->data['messages']     = ContactMessage::latest()->get();
        $this->data['activeTheme']  = SiteSetting::getActiveTheme();
        $this->data['selectedTheme']= request('theme', $this->data['activeTheme']);

        return view('admin.messages.index', $this->data);
    }

    public function show(ContactMessage $message): View
    {
        $message->update(['is_read' => true]);

        $this->data['message'] = $message;

        return view('admin.messages.show', $this->data);
    }

    public function toggleRead(ContactMessage $message): RedirectResponse
    {
        $message->update(['is_read' => ! $message->is_read]);

        flash()->success('Message status updated.');

        return redirect()->back();
    }

    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        flash()->delete('Message deleted successfully.');

        return redirect()->route('admin.messages.index');
    }

    public function reply(Request $request, ContactMessage $message): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'to'        => 'required|email',
            'subject'   => 'required|string|max:255',
            'body'      => 'required|string',
            'cc'        => 'nullable|string',
            'bcc'       => 'nullable|string',
            'attachment'=> 'nullable|file|max:10240',
        ]);

        try {
            $attachmentInfo = null;

            // Handle file upload persistently for queued asynchronous mail delivery
            if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
                $file = $request->file('attachment');
                $originalName = $file->getClientOriginalName();
                $mimeType = $file->getMimeType() ?: 'application/octet-stream';
                $size = round($file->getSize() / 1024, 1) . ' KB';

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

            $mailData = [
                'siteName'        => $siteName,
                'messageId'       => $message->id,
                'subject'         => $validated['subject'],
                'sentAt'          => now()->format('M d, Y • h:i A T'),
                'recipientName'   => $message->name ?: explode('@', $validated['to'])[0],
                'replyContent'    => $validated['body'],
                'originalName'    => $message->name,
                'originalEmail'   => $message->email,
                'originalSubject' => $message->subject ?: ($message->service_type ?: 'General Inquiry'),
                'originalMessage' => $message->message,
                'senderName'      => $senderUser->name ?? $siteName,
                'senderTitle'     => ($senderUser && $senderUser->isAdmin()) ? 'Lead Administrator & Specialist' : 'Portfolio Team',
                'websiteUrl'      => url('/'),
                'cc'              => $ccs,
                'bcc'             => $bccs,
            ];

            // Queue the email to send systematically one by one in the background
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
                'user_id'   => Auth::id(),
                'type'      => 'reply',
                'title'     => 'Email Reply Queued',
                'message'   => 'Reply to ' . $validated['to'] . ' queued for background delivery (Subject: "' . $validated['subject'] . '")',
                'action_url'=> route('admin.messages.show', $message->id),
                'icon'      => 'send',
                'color'     => 'emerald',
            ]);

            $successMsg = 'Reply email queued successfully for ' . $validated['to'] . '. Dispatched to background queue for sequential sending.';

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $successMsg,
                ]);
            }

            flash()->success($successMsg);

            return redirect()->back();
        } catch (\Throwable $e) {
            Log::error('Reply mail queuing failed: ' . $e->getMessage());

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email queuing failed: ' . $e->getMessage(),
                ], 500);
            }

            flash()->danger('Email queuing failed: ' . $e->getMessage());

            return redirect()->back();
        }
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
            'subject'         => 'Re: ' . ($message->subject ?: ($message->service_type ?: 'Portfolio Inquiry')),
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
}


