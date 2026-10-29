/**
 * Admin Panel Dedicated JavaScript
 * Handles sidebar toggles, theme switcher radio card feedback, and dismissible alerts.
 */

export function initAdminPanel() {
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
