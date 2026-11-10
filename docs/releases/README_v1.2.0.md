# Portfolio Studio — Version v1.2.0

> Enterprise Security Hardening, SQL Injection Audit Verification, Root Gateway Protection, Rate Limiting, and Full Responsive Layout Overhaul.

[![Version](https://img.shields.io/badge/Version-v1.2.0-indigo?style=flat-square&logo=git&logoColor=white)](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.2.0)
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
| **Version Tag** | `v1.2.0` |
| **Release Name** | Enterprise Security Hardening & Full Responsive Overhaul |
| **Release Date** | October 02, 2026 |
| **Commit Target** | `#3a1d133` |
| **Software Status** | Stable Release |
| **Upgrade Path** | **Direct one-click upgrade to `v1.3.0` via Version Control** |

---

## What's Included in Version v1.2.0

### 1. Root Gateway Security Policy
- Top-level `.htaccess` protection blocking direct HTTP requests to `.env`, `composer.json`, `.git`, `storage/logs`, and all core directories.

### 2. Upload Script Execution Prohibition
- Hardened `.htaccess` in `public/uploads` and `storage/app/public` disabling PHP engines (`php_flag engine off`) and denying execution of `.php`, `.phar`, `.phtml`, `.sh`, and `.exe` files.

### 3. File Upload Extension Blacklist
- Second-layer defense in `uploadFile()` helper rejecting executable and scripting extensions before any filesystem write.

### 4. HTTP Security Headers Middleware
- Global injection of `X-Frame-Options: SAMEORIGIN`, `X-Content-Type-Options: nosniff`, `X-XSS-Protection`, `Referrer-Policy: strict-origin-when-cross-origin`, and `Permissions-Policy`.

### 5. Anti-Brute-Force & DoS Throttle
- Rate limiting on public endpoints: Contact messages (15/min), Newsletter (15/min), Login (10/min), Register (10/min), and Password reset (5/min).

### 6. Fixed 100vh Admin Sidebar
- Pinned desktop sidebar with slim scrollbars, preventing top-scrolling and page overflow.

### 7. Universal Device Responsiveness
- Refined responsive behavior across large desktop monitors, laptops, tablets, and mobile screens.

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
2. Locate the **Current Version & GitHub Sync** card or the **v1.3.0** release card.
3. Click **Update Software Now** / **Update to v1.3.0**.
4. Review the **"What's New in this Update"** popup modal.
5. Click **Confirm & Update Now** to complete the automatic update.

