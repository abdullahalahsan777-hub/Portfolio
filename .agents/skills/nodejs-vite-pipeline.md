# Skill: Node.js & Vite 7 Build Pipeline

## Context & Overview
The frontend assets are bundled with **Vite 7.x** using the official **Laravel Vite Plugin** (`laravel-vite-plugin`) and **Tailwind CSS v4** (`@tailwindcss/vite`).

---

## 1. Configuration (`vite.config.js`)
```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
```

---

## 2. Standard Build & Development Commands
- **Production Build**:
  ```bash
  npm run build
  ```
  Generates optimized CSS and JS chunks in `public/build/assets/` along with `public/build/manifest.json`.
- **Local Dev Server with Hot Reload**:
  ```bash
  npm run dev
  ```
  Runs Vite dev server. Integrated with Laravel via `@vite([...])` in Blade headers.
- **Concurrent Execution**:
  `composer run dev` runs PHP server, queue listener, and Vite concurrently:
  ```bash
  composer run dev
  ```

---

## 3. Blade Inclusion Rules
All layouts MUST load Vite assets via the directive:
```blade
@vite(['resources/css/app.css', 'resources/js/app.js'])
```
Never manually link `public/build/assets/*.css` with `<link>` tags in main layouts, as Vite hashes file names on each build.

---

## 4. Verification Check
After any CSS or JavaScript modification, agents MUST verify:
```bash
npm run build && php artisan view:clear
```
Ensure build exits with code 0 and `public/build/manifest.json` is generated.
