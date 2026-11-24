# Skill: Laravel 11+ & PHP 8.3+ Architectural Standards

## Context & Overview
This project runs on **Laravel 12.x** and is fully optimized for **PHP 8.2 and PHP 8.3+**. All backend code must leverage modern PHP features and adhere to strict Laravel conventions.

---

## 1. PHP 8.2 & 8.3+ Idioms
- **Type Safety**: Use strict parameter and return types on all methods (`public function store(ServiceRequest $request): RedirectResponse`).
- **Readonly Classes & Properties**: Use `readonly` where properties or DTOs should not mutate after construction.
- **Match Expressions**: Prefer `match()` over verbose `switch()` statements:
  ```php
  $badgeColor = match($status) {
      'published', 'active' => 'emerald',
      'draft', 'pending'    => 'amber',
      'archived'            => 'neutral',
      default               => 'slate',
  };
  ```
- **Nullsafe Operator**: Use `$user?->profile?->avatar` safely when dealing with nullable relations.
- **Array Unpacking**: Use `...$params` for array merges and parameter spreading.

---

## 2. Eloquent & Traits Standards
- **Theme-Scoped Sequential Ordering (`AutoSortOrderById`)**:
  - Whenever creating items in Website modules (`Service`, `Project`, `Gallery`, `Skill`, `ResumeItem`, `Pricing`, `Testimonial`, `BlogPost`, `Faq`), the model MUST use the `App\Traits\AutoSortOrderById` trait.
  - The trait automatically assigns `sort_order` as `MAX(sort_order) + 1` scoped to the current `theme` (and `type` for resume items).
  - Never allow manual order input fields on frontend/admin forms.
- **Eager Loading**: Prevent N+1 queries by eager loading relations: `BlogPost::with('category')->latest()->get()`.
- **Query Scopes**: Define clean local scopes for reusability (`scopeActive($query)`, `scopeForTheme($query, $theme)`).

---

## 3. Controllers, Requests & Validation
- **Controller Responsibilities**: Keep controllers thin. Delegate complex business logic to Service classes (`app/Services/`).
- **Form Requests**: Use dedicated `FormRequest` classes for validation rather than inline `$request->validate([...])` for complex operations.
- **File Upload Security**:
  - Always validate mime-types and file extensions.
  - Blacklist `.php`, `.phtml`, `.exe`, `.sh`, `.bat`, `.js` files.
  - Sanitize filenames and store in `public/uploads/` via organized subdirectories.

---

## 4. Routes & Middleware
- Use route names for all links: `route('admin.services.index')`.
- Ensure public endpoints have rate-limiting: `throttle:15,1` on contact forms and newsletter subscriptions.
- Admin routes must be guarded by `auth` middleware and role checks where applicable.

---

## 5. Coding Standards & Tooling
- Run `composer run lint` (`vendor/bin/pint`) before finishing any PHP task to ensure PSR-12 and Laravel Pint compliance.
- Run `php artisan test` to verify zero regressions.
