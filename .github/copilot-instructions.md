# GitHub Copilot & ChatGPT Project Instructions

You are assisting development on **Portfolio Studio CMS** — an enterprise-grade multi-theme portfolio and content management system built with Laravel 12.x, PHP 8.2+, Tailwind CSS v4, and Vite 7.

## Critical Project Invariants
- **Dynamic Database Content Only**: Hardcoded arrays for portfolio projects, skills, services, testimonials, or blogs are strictly prohibited.
- **Port Authority**: Application server port is governed strictly by `SERVER_PORT` in `.env` (default: 8044).
- **Auto-Sorting**: Reordering uses SortableJS drag-and-drop with AJAX sync. Sequential sorting is handled by `AutoSortOrderById`.
- **7 Themes Standard**: Themes (`developer`, `uiux_designer`, `graphic_designer`, `app_developer`, `app_software_developer`, `digital_designer_illustrator`, `laravel_developer`) all extend `frontend.layouts.frontend`.
- **Material Palette**: Dynamic 9-color accent palette with automated YIQ contrast calculation for text readability.

## Skills & Architecture
Refer to `.agents/agents-manifest.json` for full skill documentation and architectural patterns.
