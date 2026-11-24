# Skill: Tailwind CSS v4 & Flowbite Dark UI Suite

## Context & Overview
The project uses **Tailwind CSS v4** bundled via `@tailwindcss/vite` and **Flowbite v4.0.2** for UI components and interactive widgets.

---

## 1. Tailwind CSS v4 Directives & Architecture
- In Tailwind v4, styles are declared in `resources/css/app.css` using:
  ```css
  @import "tailwindcss";
  ```
- Do not use obsolete `tailwind.config.js` content arrays. Tailwind v4 scans Vite templates and Blade files automatically.
- Custom tokens and theme extensions are declared via CSS variables or `@theme` blocks:
  ```css
  @theme {
      --color-primary: var(--theme-primary);
  }
  ```

---

## 2. Flowbite Dark Mode Components
- Flowbite handles dark mode styling via the `dark:` utility variant and `data-theme-mode` / `color-scheme` attributes on `<html>`.
- Use Flowbite modals, accordions, tooltips, and badges:
  - Tables: Use `.relative .overflow-x-auto .shadow-md .sm:rounded-2xl` wrappers.
  - Badges: `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium`.
  - Buttons: Standardize hover, focus, and disabled states.

---

## 3. Flowbite Datepicker Implementation
- Standardize all date inputs across Admin with the Flowbite autohiding datepicker:
  ```html
  <div class="relative">
      <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-neutral-400">
          <svg class="w-4 h-4" ...></svg>
      </div>
      <input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" type="text"
             class="bg-black/60 border border-white/10 text-white text-xs rounded-xl focus:border-[var(--theme-primary)] block w-full ps-10 p-2.5"
             placeholder="Select date">
  </div>
  ```
- Format must strictly follow ISO `YYYY-MM-DD` for direct MySQL compatibility.

---

## 4. Modern Glassmorphism & UI Accents
- Use dark frosted glass utility: `bg-[#0a0f1d]/90 backdrop-blur-2xl border border-white/10 shadow-2xl`.
- Subtle ambient light glows:
  ```html
  <div class="absolute top-0 right-1/4 w-[500px] h-[500px] bg-[var(--theme-primary)]/10 rounded-full blur-[160px] pointer-events-none -z-10"></div>
  ```
- High-contrast text: `text-white` for primary headings, `text-neutral-400` for subtitles, `text-xs font-mono uppercase tracking-wider` for metadata labels.
