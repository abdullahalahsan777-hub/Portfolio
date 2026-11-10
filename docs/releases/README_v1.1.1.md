# Portfolio Studio — Version v1.1.1

> System Maintenance & Infrastructure Hub, Configurable HTTP 503 Maintenance Mode, Automated Email Broadcasts, and Cache Controls.

[![Version](https://img.shields.io/badge/Version-v1.1.1-indigo?style=flat-square&logo=git&logoColor=white)](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.1.1)
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
| **Version Tag** | `v1.1.1` |
| **Release Name** | System Maintenance & Infrastructure Hub |
| **Release Date** | July 01, 2026 |
| **Commit Target** | `#cc94965` |
| **Software Status** | Stable Release |
| **Upgrade Path** | **Direct one-click upgrade to `v1.3.0` via Version Control** |

---

## What's Included in Version v1.1.1

### 1. Maintenance Mode Engine
- Configurable HTTP 503 maintenance mode with admin preview bypass and custom maintenance messaging.

### 2. Automated Broadcast Emails
- Server status change notifications automatically queued and sent to all registered users upon maintenance toggle.

### 3. Database Sizing Telemetry
- Real-time database metrics querying MySQL `information_schema` and SQLite file sizes.

### 4. Cache & Optimization Controls
- Admin controls to purge compiled views, route caches, and application configurations.

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

