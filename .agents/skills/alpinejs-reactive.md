# Skill: Alpine.js State & Micro-Interactions

## Context & Overview
Alpine.js provides lightweight, declarative reactivity for admin UI widgets, dropdowns, modal windows, and responsive components without the overhead of heavy SPA bundles.

---

## 1. Core Alpine Directives & Patterns
- `x-data`: Declare component reactive state directly in Blade templates:
  ```html
  <div x-data="{ open: false, activeTab: 'general' }">
  ```
- `x-show` & `x-cloak`: Smooth element toggles. Always include `[x-cloak] { display: none !important; }` in CSS to prevent flash during initial load.
- `x-transition`: Smooth entering and leaving transitions:
  ```html
  <div x-show="open"
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0 translate-y-2 scale-95"
       x-transition:enter-end="opacity-100 translate-y-0 scale-100"
       x-transition:leave="transition ease-in duration-150"
       x-transition:leave-start="opacity-100 translate-y-0 scale-100"
       x-transition:leave-end="opacity-0 translate-y-2 scale-95">
  ```
- `@click.outside`: Automatically dismiss modals or dropdowns when clicking outside.
- `@keydown.escape.window`: Dismiss overlays on `Escape` key press.

---

## 2. Best Practices for Laravel + Alpine.js
1. **Blade String Escaping**: When passing backend variables to Alpine state, use `@js()` directive:
   ```html
   <div x-data="{ initialValue: @js($currentSetting) }">
   ```
2. **Form Submissions**: When using AJAX within Alpine, pair with `fetch()` or `axios`, and always include CSRF token:
   ```javascript
   headers: {
       'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
       'Accept': 'application/json'
   }
   ```
3. **Avoid Over-Engineering**: Use Alpine for UI state (toggles, tabs, tooltips, drawers, confirmations). For complex data tables with sorting/pagination, utilize the dedicated jQuery DataTables integration.
