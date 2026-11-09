import { initFlowbite, Datepicker } from 'flowbite';

window.Datepicker = Datepicker;
window.initFlowbite = initFlowbite;

/**
 * Admin Panel Dedicated JavaScript
 * Handles Flowbite initialization, datepickers, sidebar toggles, theme switcher radio card feedback, and dismissible alerts.
 */

export function initAdminPanel() {
    // 0. Initialize Flowbite components (modals, dropdowns, tooltips, datepicker, etc.)
    try {
        if (typeof initFlowbite === 'function') {
            initFlowbite();
        }
    } catch (e) {
        console.warn('Flowbite init error:', e);
    }

    // Helper to close all open datepicker popups
    function closeAllDatepickers() {
        document.querySelectorAll('.datepicker').forEach(p => {
            p.classList.remove('active', 'block');
            p.classList.add('hidden');
        });
    }

    // 1. Listen for date selection and click events on Flowbite Datepicker
    const datepickerElements = document.querySelectorAll('[datepicker], [data-datepicker], .flowbite-datepicker');
    datepickerElements.forEach(el => {
        // When a date is selected, flowbite dispatches 'changeDate'
        el.addEventListener('changeDate', () => {
            closeAllDatepickers();
        });

        // Also close if value changes
        el.addEventListener('change', () => {
            closeAllDatepickers();
        });
    });

    // Close when clicking on a date cell in days view
    document.addEventListener('click', (e) => {
        const cell = e.target.closest('.datepicker-cell');
        if (cell && !cell.classList.contains('disabled')) {
            // Check if this is a day selection cell (inside days grid)
            const isDayCell = cell.closest('.days') || cell.dataset.date;
            if (isDayCell) {
                setTimeout(closeAllDatepickers, 80);
                return;
            }
        }

        // Close on outside click (not inside input and not inside picker)
        const isInput = e.target.closest('[datepicker], [data-datepicker], .flowbite-datepicker');
        const isPicker = e.target.closest('.datepicker');
        if (!isInput && !isPicker) {
            closeAllDatepickers();
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeAllDatepickers();
        }
    });
    // 1. Theme Radio Selector Interactive Cards
    const themeCards = document.querySelectorAll('input[name="active_theme"]');
    if (themeCards.length > 0) {
        themeCards.forEach(radio => {
            radio.addEventListener('change', () => {
                themeCards.forEach(r => {
                    const parentLabel = r.closest('label');
                    if (parentLabel) {
                        parentLabel.classList.remove('ring-2', 'ring-indigo-500', 'border-indigo-500');
                    }
                });

                const activeLabel = radio.closest('label');
                if (activeLabel) {
                    activeLabel.classList.add('ring-2', 'ring-indigo-500', 'border-indigo-500');
                }
            });
        });
    }

    // 2. Auto-dismiss Flash Alerts
    const alerts = document.querySelectorAll('[data-auto-dismiss]');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.4s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 400);
        }, 4000);
    });

    // 3. Mobile Sidebar Toggle
    const sidebarToggleBtn = document.getElementById('adminSidebarToggle');
    const adminSidebar = document.getElementById('adminSidebar');
    if (sidebarToggleBtn && adminSidebar) {
        sidebarToggleBtn.addEventListener('click', () => {
            adminSidebar.classList.toggle('hidden');
        });
    }
}
