# Skill: Material 3 Dynamic Palette & Contrast System

## Context & Overview
The portfolio features an interactive, real-time **Material Color Palette Switcher** on the frontend that dynamically adjusts the primary accent color across all 7 themes.

---

## 1. CSS Variable Architecture
The styling system is governed in `resources/css/frontend/material_palette_accents.css`:
- `--theme-primary`: The active hex accent color (e.g., `#00e5ff`, `#ff4081`, `#aeea00`).
- `--theme-primary-rgb`: Red, green, blue values for opacity blending (`rgba(var(--theme-primary-rgb), 0.35)`).
- `--theme-primary-glow`: Soft ambient lighting box-shadows.
- `--theme-on-primary`: Text color rendered on top of the accent (`#000000` or `#ffffff`).

---

## 2. Nine Curated Material Accents
Every theme supports these 9 Material Palette accents:
1. **Cyan**: `#00e5ff` (Clean cyber tech)
2. **Orange**: `#ff5722` (High energy creative)
3. **Teal**: `#00bfa5` (Balanced organic modern)
4. **Indigo**: `#3d5afe` (Deep enterprise precision)
5. **Amber**: `#ffc107` (Warm luxury)
6. **Pink**: `#ff4081` (Vibrant poppy editorial)
7. **Purple**: `#7c4dff` (Electric violet imaginative)
8. **Lime**: `#aeea00` (High visibility futuristic)
9. **Blue**: `#2979ff` (Trusted corporate clarity)

---

## 3. WCAG AAA Contrast Calculation (YIQ)
To guarantee readability when accents change in real-time, the palette script computes contrast:
```javascript
const yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;
const onPrimary = (yiq >= 120) ? '#000000' : '#ffffff';
document.documentElement.style.setProperty('--theme-on-primary', onPrimary);
```
- Light accents (Lime `#aeea00`, Amber `#ffc107`, Cyan `#00e5ff`) get dark `#000000` text on buttons.
- Deep accents (Indigo `#3d5afe`, Purple `#7c4dff`, Orange `#ff5722`) get `#ffffff` text on buttons.

---

## 4. Zero-FOUC (Flash of Unstyled Content) Bootstrap
Every page must execute this synchronous `<head>` script before rendering HTML:
```javascript
const savedColor = localStorage.getItem('portfolio_theme_color') || themeDefault;
document.documentElement.style.setProperty('--theme-primary', savedColor);
```
This prevents color flickering on page navigation.

---

## 5. Micro-Interactions & Water Reflection
- **Trigger Button**: Fixed floating circular trigger button (`z-[9999]`) on the right screen edge with active accent ring and glow.
- **Active Swatch Highlight**: Double-ring indicator `box-shadow: 0 0 0 3px #0a0f1d, 0 0 0 5px <color>, 0 0 16px <color>80`.
- **Water Reflection**: Large headline typography in footers uses realistic water reflections and subtle color tinting rather than harsh text shadows.
