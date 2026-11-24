# Skill: Conversation, Mailbox & Inquiry Subsystem

## Context & Overview
The project features a full **Client Inquiries & Communications Hub** in the Admin panel (`/admin/messages`) modeled after a Gmail-style dark-mode interface, combined with frontend contact forms and interactive messaging workflows.

---

## 1. Mailbox Architecture & Folder Navigation
- **Folders**: Inbox, Sent, Drafts, Important, Trash.
- **Filtering & State**: Controlled via `status` and `folder` parameters in `MessageController.php`.
- **VIP Badging**: Important client threads inherit importance indicators based on client history and repeat inquiries.
- **Trash & Soft Deletion**: Deleted messages move to Trash before permanent purge.

---

## 2. Background Draft Autosave with UUID `temp_id`
- When composing or replying to an inquiry, client inputs are continuously autosaved to prevent loss of work:
  ```javascript
  const draftPayload = {
      temp_id: currentDraftUuid,
      recipient: recipientEmail,
      subject: subjectInput.value,
      body: bodyEditor.innerHTML
  };
  fetch('/admin/messages/draft/autosave', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify(draftPayload)
  });
  ```
- Uses UUID `temp_id` to idempotently upsert draft records in the database.

---

## 3. Frontend Contact Form Handling
- Frontend contact forms submit to `POST /contact/send` or `POST /messages`.
- **Validation**: Name, Email (RFC compliant), Subject, and Message required.
- **Throttling**: Bound to `throttle:15,1` middleware to prevent spam.
- **Response Format**: Dual-response handling: JSON for AJAX submissions (`{ success: true, message: "..." }`) and traditional redirect with flash message for standard form posts.
- **Notification**: Automated email dispatched to `$settings['contact_email']` using Laravel Mailables.
