# Skill: React & Phosphor Iconography Systems

## Context & Overview
The portfolio utilizes modern visual iconography with a primary integration of **Phosphor Icons Web** and support for React Icons / Lucide SVG patterns across all 7 themes and the admin control panel.

---

## 1. Phosphor Icons Integration
Phosphor Icons are loaded globally in `frontend.layouts.frontend`:
```html
<script src="https://unpkg.com/@phosphor-icons/web"></script>
```

### Usage Syntax
```html
<!-- Regular Phosphor class -->
<i class="ph ph-envelope text-lg"></i>
<i class="ph ph-phone text-lg"></i>
<i class="ph ph-map-pin text-lg"></i>

<!-- Weight variants (bold, fill, duotone) -->
<i class="ph-bold ph-arrow-up-right"></i>
<i class="ph-fill ph-check-circle text-emerald-400"></i>
```

---

## 2. React Icons & Inline SVG Standardization
When incorporating React-style SVG icons directly into Blade components:
- **Consistent Dimensions**: Standardize sizes using Tailwind utilities: `w-4 h-4` (inline/badges), `w-5 h-5` (buttons/nav), `w-6 h-6` (cards/features).
- **Current Color Inheritance**: Always set `fill="currentColor"` or `stroke="currentColor"` so icons automatically mirror their parent text color or `--theme-primary`.
- **ViewBox Standards**: Preserve native `viewBox="0 0 24 24"` or `viewBox="0 0 256 256"`.
- **Flex Shrink**: Always add `flex-shrink-0` to avoid icon distortion inside flexbox columns/rows.
- **Aria Labels**: When an icon represents an action without text, provide `aria-label="Action description"` and `role="img"`.
