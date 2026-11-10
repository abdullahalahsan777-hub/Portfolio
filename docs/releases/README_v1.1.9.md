# Portfolio Studio — Version v1.1.9

> Newsletter Subscription Subsystem, Audience Health Metrics Telemetry, and Mathematical Sliding Window Pagination.

[![Version](https://img.shields.io/badge/Version-v1.1.9-indigo?style=flat-square&logo=git&logoColor=white)](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.1.9)
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
| **Version Tag** | `v1.1.9` |
| **Release Name** | Newsletter Subscription Engine & Pro Windowed Pagination |
| **Release Date** | September 15, 2026 |
| **Commit Target** | `#c92962e` |
| **Software Status** | Stable Release |
| **Upgrade Path** | **Direct one-click upgrade to `v1.3.0` via Version Control** |

---

## What's Included in Version v1.1.9

### 1. Newsletter Subscription Subsystem
- Public AJAX subscription endpoint with email validation, duplicate prevention, and dedicated database migration (`subscribers` table).

### 2. Admin Subscriber Management
- Full administrative list view with bulk deletion, quick copy email action, status badges, and direct mailto links.

### 3. Dashboard Newsletter Telemetry Card
- Real-time audience health KPI card displaying total subscribers, active rates, and weekly growth.

### 4. Smart Windowed Pagination
- Sliding window pagination (`1 2 3 [4] 5 ... 11`) capping pagination controls to 7 visible items with zero screen overflow.

### 5. Scroll-to-Top Auto Hide
- Enhanced back-to-top floating button that automatically hides when scrolling stops across all frontend themes.

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

