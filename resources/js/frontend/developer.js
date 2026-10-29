/**
 * Developer Theme JavaScript
 * Handles skill percentage animations, video trigger modal, and interactive dev widgets.
 */

export function initDeveloperTheme() {
    // 1. Animated Skill Percentages
    const skillCircles = document.querySelectorAll('.theme-developer [data-skill-val]');
    if (skillCircles.length > 0 && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const val = parseInt(el.getAttribute('data-skill-val'), 10) || 80;
                    el.style.setProperty('--skill-percent', `${val}%`);
                    obs.unobserve(el);
                }
            });
        }, { threshold: 0.2 });

        skillCircles.forEach(circle => observer.observe(circle));
    }

    // 2. Interactive Video Play Trigger
    const playBtn = document.getElementById('devVideoPlay');
    if (playBtn) {
        playBtn.addEventListener('click', () => {
            alert('Developer Workspace Tour & Engineering Architecture Reel');
        });
    }
}
