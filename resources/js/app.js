import './bootstrap';
import { initFrontend } from './frontend/frontend';
import { initGraphicDesignerTheme } from './frontend/graphic_designer';
import { initDeveloperTheme } from './frontend/developer';
import { initUiUxDesignerTheme } from './frontend/uiux_designer';
import { initAdminPanel } from './admin/admin';

document.addEventListener('DOMContentLoaded', () => {
    // Check if we are on Admin panel or Frontend
    const isAdmin = document.body.classList.contains('admin-body') || document.querySelector('#adminSidebar');

    if (isAdmin) {
        initAdminPanel();
    } else {
        initFrontend();

        // Initialize specific theme JS based on body class
        if (document.body.classList.contains('theme-graphic_designer')) {
            initGraphicDesignerTheme();
        } else if (document.body.classList.contains('theme-developer')) {
            initDeveloperTheme();
        } else if (document.body.classList.contains('theme-uiux_designer')) {
            initUiUxDesignerTheme();
        }
    }
});
