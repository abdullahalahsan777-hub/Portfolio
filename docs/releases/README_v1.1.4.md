# Portfolio Studio — Version v1.1.4

> Client Inquiries & Communications Hub, Dark Mode Mailbox, Autosaving Drafts, VIP Importance Inheritance, and Background Queue Mail Delivery.

[![Version](https://img.shields.io/badge/Version-v1.1.4-indigo?style=flat-square&logo=git&logoColor=white)](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.1.4)
[![Status](https://img.shields.io/badge/Status-Stable-indigo?style=flat-square)](https://github.com/abdullahalahsan777-hub/Portfolio)
[![Upgrade Available](https://img.shields.io/badge/Upgrade_Available-v1.3.0_(Latest)-amber?style=flat-square&logo=github)](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.3.0)

---

> [!IMPORTANT]
> **A Newer Stable Version is Available (`v1.3.0`)!**  
> You can update this software automatically to **v1.3.0** with one click directly from the Admin Panel (**Dashboard**, **System Maintenance**, or **Version Control**). The built-in GitHub synchronization engine will automatically pull the latest release, merge conflict-free, execute database migrations, and purge caches.

---

## Release Overview

| Attribute | Specification |
| :--- | :--- |
| **Version Tag** | `v1.1.4` |
| **Release Name** | Client Inquiries & Communications Hub |
| **Release Date** | August 02, 2026 |
| **Commit Target** | `#5327b8d` |
| **Software Status** | Stable Release |
| **Upgrade Path** | **Direct one-click upgrade to `v1.3.0` via Version Control** |

---

## What's Included in Version v1.1.4

### 1. Gmail-Style Inquiries Hub
- Dark-mode communications mailbox with hover action buttons, checkboxes, folder navigation (Inbox, Sent, Drafts, Important, Trash), and full email threading.

### 2. Real-Time Autosave Drafts
- Background autosaving composer with temporary UUID identifiers (`temp_id`), preventing lost replies.

### 3. VIP Importance Inheritance
- Automatic VIP client badge assignment based on sender inquiry history and importance metrics.

### 4. Asynchronous File Attachments
- Background upload of proposal attachments to public storage with download chips.

### 5. Branded HTML Email Replies
- Responsive email templates sent to clients with attested file attachments and background queue delivery.

---

## Server Port Configuration

Configured exclusively via `SERVER_PORT` in your `.env` file:

```env
SERVER_PORT=8044
APP_URL=http://127.0.0.1:8044
```

---

## How to Update to Latest Version (v1.3.0)

1. Open your Admin Panel at `/admin/versions`.
2. Click **Update to v1.3.0** on the version card or top synchronization banner.
3. Review the **"What's New in this Update"** popup modal.
4. Click **Confirm & Update Now** to complete the automatic update.

