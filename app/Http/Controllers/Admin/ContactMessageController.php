<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Notification;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
            $attachmentFile = $request->file('attachment');

            Mail::raw($validated['body'], function ($mail) use ($validated, $attachmentFile) {
                $mail->to($validated['to'])
                    ->subject($validated['subject']);

                if (!empty($validated['cc'])) {
                    $ccs = array_map('trim', explode(',', $validated['cc']));
                    $mail->cc(array_filter($ccs));
                }

                if (!empty($validated['bcc'])) {
                    $bccs = array_map('trim', explode(',', $validated['bcc']));
                    $mail->bcc(array_filter($bccs));
                }

                if ($attachmentFile && $attachmentFile->isValid()) {
                    $mail->attach($attachmentFile->getRealPath(), [
                        'as'    => $attachmentFile->getClientOriginalName(),
                        'mime'  => $attachmentFile->getMimeType(),
                    ]);
                }
            });

            Notification::record([
                'user_id'   => Auth::id(),
                'type'      => 'reply',
                'title'     => 'Email Reply Sent',
                'message'   => 'Replied to ' . $validated['to'] . ' on subject "' . $validated['subject'] . '"',
                'action_url'=> route('admin.messages.show', $message->id),
                'icon'      => 'send',
                'color'     => 'emerald',
            ]);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Reply sent successfully to ' . $validated['to'],
                ]);
            }

            flash()->success('Reply sent successfully to ' . $validated['to']);

            return redirect()->back();
        } catch (\Throwable $e) {
            Log::error('Reply mail failed: ' . $e->getMessage());

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email sending failed: ' . $e->getMessage(),
                ], 500);
            }

            flash()->danger('Email sending failed: ' . $e->getMessage());

            return redirect()->back();
        }
    }
}


