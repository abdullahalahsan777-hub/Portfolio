# Portfolio Studio — Version v1.1.8

> Unified System & Browser Diagnostics Center, Dual-Source Log Viewer, and Real-Time Client JavaScript Error Reporting Beacon.

[![Version](https://img.shields.io/badge/Version-v1.1.8-indigo?style=flat-square&logo=git&logoColor=white)](https://github.com/abdullahalahsan777-hub/Portfolio/releases/tag/v1.1.8)
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
| **Version Tag** | `v1.1.8` |
| **Release Name** | Unified System & Browser Diagnostics Center |
| **Release Date** | September 01, 2026 |
| **Commit Target** | `#be01293` |
| **Software Status** | Stable Release |
| **Upgrade Path** | **Direct one-click upgrade to `v1.3.0` via Version Control** |

---

## What's Included in Version v1.1.8

### 1. Unified Diagnostics Interface
- Centralized admin logs viewer (`/admin/logs`) for searching, filtering, and auditing both backend `laravel.log` and client `browser.log`.

### 2. Client Runtime Error Beacon
- Automatic `window.onerror` and `unhandledrejection` telemetry transmitter recording frontend JavaScript exceptions with stack traces.

### 3. Diagnostics Telemetry Cards
- Dual-metric card rows showing error distribution by severity (Critical, Error, Warning, Info) and runtime environment specs.

### 4. Log Export & Purge Controls
- One-click downloading of raw log files and dual-file log purge utilities.

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

