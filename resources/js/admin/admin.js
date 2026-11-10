import { initFlowbite, Datepicker } from 'flowbite';
import Sortable from 'sortablejs';

window.Datepicker = Datepicker;
window.initFlowbite = initFlowbite;
window.Sortable = Sortable;

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

    // Helper to close all open datepicker popups cleanly via instances
    function hideAllDatepickers() {
        document.querySelectorAll('[datepicker], [data-datepicker], .flowbite-datepicker').forEach(input => {
            const dp = input.datepicker || input._datepicker;
            if (dp && typeof dp.hide === 'function') {
                dp.hide();
            }
        });
        document.querySelectorAll('.datepicker:not(.inline)').forEach(picker => {
            picker.classList.add('hidden');
            picker.classList.remove('active', 'block');
        });
    }

    // 1. Initialize & Manage Flowbite Datepickers
    const datepickerElements = document.querySelectorAll('[datepicker], [data-datepicker], .flowbite-datepicker');
    datepickerElements.forEach(el => {
        // Initialize instance if not already done by initFlowbite()
        if (!el.datepicker) {
            const format = el.getAttribute('datepicker-format') || 'yyyy-mm-dd';
            const autohide = el.hasAttribute('datepicker-autohide') ? (el.getAttribute('datepicker-autohide') !== 'false') : true;
            try {
                new Datepicker(el, {
                    format: format,
                    autohide: autohide,
                });
            } catch (err) {
                console.warn('Datepicker init error on element:', el, err);
            }
        }

        // When a full date is selected (Flowbite dispatches 'changeDate' only on day pick)
        el.addEventListener('changeDate', () => {
            const dp = el.datepicker || el._datepicker;
            if (dp && typeof dp.hide === 'function') {
                dp.hide();
            }
            if (dp && dp.picker && dp.picker.element) {
                dp.picker.element.classList.add('hidden');
                dp.picker.element.classList.remove('active', 'block');
            }
        });
    });

    // 2. Global click delegator for datepicker popups
    document.addEventListener('click', (e) => {
        // A. If clicking a day cell in the days view, let the selection complete then hide
        const dayCell = e.target.closest('.datepicker-cell.day');
        if (dayCell && !dayCell.classList.contains('disabled')) {
            setTimeout(hideAllDatepickers, 80);
            return;
        }

        // B. If clicking on any other part of the datepicker (view switch, month, year, decade, prev/next arrows):
        // NEVER close! Let Flowbite navigate views freely.
        if (e.target.closest('.datepicker')) {
            return;
        }

        // C. If clicking on any datepicker input field, let it open
        if (e.target.closest('[datepicker], [data-datepicker], .flowbite-datepicker')) {
            return;
        }

        // D. Clicked outside both the datepicker popup and input: close open datepickers
        hideAllDatepickers();
    });

    // 3. Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            hideAllDatepickers();
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

    // 4. Initialize SortableJS for Drag-and-Drop Reordering across all modules
    const sortableContainers = document.querySelectorAll('[data-sortable-grid]');
    sortableContainers.forEach(container => {
        const model = container.getAttribute('data-sortable-grid');
        if (!model) return;

        if (container._sortableInstance && typeof container._sortableInstance.destroy === 'function') {
            container._sortableInstance.destroy();
        }

        container._sortableInstance = Sortable.create(container, {
            animation: 200,
            handle: '.drag-handle',
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            draggable: '[data-id]',
            onEnd: function(evt) {
                if (evt.oldIndex === evt.newIndex) return;

                const itemElements = Array.from(container.querySelectorAll(':scope > [data-id]'));
                const orderedIds = itemElements.map(el => parseInt(el.getAttribute('data-id'), 10)).filter(id => !isNaN(id));

                if (orderedIds.length === 0) return;

                // Update UI badges immediately for instant feedback
                itemElements.forEach((el, index) => {
                    const badge = el.querySelector('.order-badge');
                    if (badge) {
                        badge.textContent = `Order: #${index + 1}`;
                    }
                });

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const requestConfig = {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    }
                };

                const axiosClient = window.axios;
                if (axiosClient && typeof axiosClient.post === 'function') {
                    axiosClient.post('/admin/reorder', {
                        model: model,
                        ordered_ids: orderedIds,
                    }, requestConfig).then(response => {
                        if (window.toastr) {
                            window.toastr.success(response.data.message || 'Display order updated successfully.');
                        }
                    }).catch(error => {
                        console.error('Reorder error:', error);
                        if (window.toastr) {
                            const errMsg = error.response?.data?.message || 'Failed to update order. Please refresh.';
                            window.toastr.error(errMsg);
                        }
                    });
                }
            }
        });
    });
}
